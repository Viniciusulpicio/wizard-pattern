<?php

declare(strict_types=1);

namespace Combr\Wizard\Controllers;

use Combr\Wizard\Services\DiagnosticEngine;
use Combr\Wizard\Services\PayloadBuilder;
use Combr\Wizard\Services\QuestionsRepository;
use Combr\Wizard\Services\WebhookDispatcher;

class ApiController
{
    private QuestionsRepository $questionsRepo;
    private DiagnosticEngine $diagnosticEngine;
    private PayloadBuilder $payloadBuilder;
    private WebhookDispatcher $webhookDispatcher;

    public function __construct()
    {
        $this->questionsRepo = new QuestionsRepository();
        $this->diagnosticEngine = new DiagnosticEngine();
        $this->payloadBuilder = new PayloadBuilder();
        $this->webhookDispatcher = new WebhookDispatcher();
    }

    public function getQuestions(): void
    {
        $this->jsonResponse([
            'status' => 'SUCCESS',
            'totalSteps' => $this->questionsRepo->getTotalSteps(),
            'steps' => $this->questionsRepo->getSteps()
        ]);
    }

    public function diagnose(): void
    {
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true) ?? $_POST;

        if (empty($data)) {
            $this->jsonResponse([
                'status' => 'ERROR',
                'message' => 'Nenhum dado enviado para diagnóstico.'
            ], 400);
            return;
        }

        $answers = $data['answers'] ?? $data;
        $diagnostic = $this->diagnosticEngine->evaluate($answers);
        $payload = $this->payloadBuilder->build($answers, $diagnostic);

        $this->jsonResponse([
            'status' => 'SUCCESS',
            'diagnostic' => $diagnostic,
            'payload' => $payload
        ]);
    }

    public function dispatchWebhook(): void
    {
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true) ?? [];

        $payload = $data['payload'] ?? null;
        $simulate = filter_var($data['simulate'] ?? true, FILTER_VALIDATE_BOOLEAN);

        if (!$payload) {
            $this->jsonResponse([
                'status' => 'ERROR',
                'message' => 'Payload ausente para disparo.'
            ], 400);
            return;
        }

        $result = $this->webhookDispatcher->dispatch($payload, $simulate);
        $this->jsonResponse($result);
    }

    public function health(): void
    {
        $this->jsonResponse([
            'status' => 'UP',
            'service' => 'Combr Wizard Pattern Engine',
            'phpVersion' => PHP_VERSION,
            'timestamp' => date('c')
        ]);
    }

    private function jsonResponse(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}
