<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Combr\Wizard\Services\DiagnosticEngine;
use Combr\Wizard\Services\PayloadBuilder;
use Combr\Wizard\Services\QuestionsRepository;
use Combr\Wizard\Services\WebhookDispatcher;

echo "=== INICIANDO TESTES DO WIZARD PATTERN ===\n\n";

$repo = new QuestionsRepository();
$engine = new DiagnosticEngine();
$payloadBuilder = new PayloadBuilder();
$dispatcher = new WebhookDispatcher();

// 1. Test Questions Repository
$steps = $repo->getSteps();
assert(count($steps) === 8, "Deveriam existir 8 steps catalogados.");
echo "✓ [PASS] QuestionsRepository retornou 8 steps com sucesso.\n";

// 2. Test Diagnostic Engine with Hybrid Cloud scenario
$sampleAnswers = [
    'mailboxes_volume' => 'business',
    'hosting_architecture' => 'hybrid_cloud',
    'security_compliance' => ['dns_authentication', 'antispam_gateway', 'tls_2fa'],
    'backup_continuity' => 'savemail_immutable',
    'smtp_volume' => 'smtp_standard',
    'company_details' => [
        'company_name' => 'Acme Corporativa Brasil Ltda',
        'domain' => 'acmecorp.com.br',
        'contact_name' => 'Roberto Mendes',
        'contact_email' => 'roberto@acmecorp.com.br',
        'contact_phone' => '(11) 98888-7777',
        'current_provider' => 'cPanel'
    ]
];

$diagnostic = $engine->evaluate($sampleAnswers);
assert($diagnostic['status'] === 'SUCCESS', "Diagnóstico deveria retornar status SUCCESS.");
assert($diagnostic['summary']['mailboxes'] === 35, "Quantidade de caixas para 'business' deveria ser 35.");
assert($diagnostic['summary']['securityScore'] === 95, "Score de segurança deveria ser 95.");
assert(str_contains($diagnostic['summary']['architecture']['name'], 'Híbrida'), "Arquitetura deveria ser Híbrida.");
echo "✓ [PASS] DiagnosticEngine calculou dimensionamento, score (95/100) e arquitetura híbrida.\n";

// 3. Test Payload Builder
$payload = $payloadBuilder->build($sampleAnswers, $diagnostic);
assert(isset($payload['meta']['requestId']), "Payload deve conter requestId.");
assert($payload['customer']['primaryDomain'] === 'acmecorp.com.br', "Domínio deve ser acmecorp.com.br.");
assert($payload['provisioningSpec']['sizing']['mailboxCount'] === 35, "Mailbox count no payload deve ser 35.");
assert(isset($payload['ansibleDirectives']['playbook']), "Payload deve conter ansibleDirectives.");
assert(isset($payload['terraformPayload']['module']), "Payload deve conter terraformPayload.");

$jsonOutput = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
assert(!empty($jsonOutput), "JSON do payload não pode ser vazio.");
echo "✓ [PASS] PayloadBuilder gerou payload JSON padronizado com sucesso.\n";

// 4. Test Webhook Dispatcher (Simulated)
$dispatchResult = $dispatcher->dispatch($payload, true);
assert($dispatchResult['statusCode'] === 200, "Webhook simulado deve retornar HTTP 200.");
assert(isset($dispatchResult['response']['jobId']), "Resposta deve conter jobId.");
echo "✓ [PASS] WebhookDispatcher simulou envio com sucesso (HTTP 200 / Job ID: {$dispatchResult['response']['jobId']}).\n";

echo "\n============================================\n";
echo "🎉 TODOS OS 4 TESTES PASSARAM COM SUCESSO!\n";
echo "============================================\n";
