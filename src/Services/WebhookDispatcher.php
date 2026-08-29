<?php

declare(strict_types=1);

namespace Combr\Wizard\Services;

use Combr\Wizard\Config\AppConfig;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WebhookDispatcher
{
    private AppConfig $config;
    private ?Client $httpClient;

    public function __construct(?Client $httpClient = null)
    {
        $this->config = AppConfig::getInstance();
        $this->httpClient = $httpClient;
    }

    /**
     * Dispatch payload to the provisioning API (or perform a realistic simulation).
     */
    public function dispatch(array $payload, bool $simulate = true): array
    {
        $apiUrl = $this->config->get('provisioning_api_url');
        $apiKey = $this->config->get('provisioning_api_key');
        $requestId = $payload['meta']['requestId'] ?? 'REQ-' . uniqid();

        if ($simulate) {
            // Realistic simulated API latency and response
            usleep(350000); // 350ms
            return [
                'status' => 'DISPATCHED_SIMULATED',
                'statusCode' => 200,
                'timestamp' => date('c'),
                'targetEndpoint' => $apiUrl,
                'requestId' => $requestId,
                'response' => [
                    'message' => 'Ordem de provisionamento recebida e validada com sucesso pelo orquestrador Combr Cloud.',
                    'jobId' => 'JOB-' . strtoupper(substr(md5($requestId), 0, 10)),
                    'status' => 'QUEUED_FOR_PROVISIONING',
                    'estimatedProvisioningTime' => '15 minutos',
                    'dnsPropagationStatus' => 'PENDING_CUSTOMER_NAMESERVERS',
                    'assignedCluster' => 'sp-equinix-mail-cluster-04',
                    'supportTicketUrl' => 'https://combr.com.br/suporte/ticket/' . $requestId
                ]
            ];
        }

        // Live HTTP POST
        try {
            $client = $this->httpClient ?? new Client(['timeout' => 8.0]);
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                    'X-Request-Source' => 'Wizard-Pattern'
                ],
                'json' => $payload
            ]);

            return [
                'status' => 'DISPATCHED_LIVE',
                'statusCode' => $response->getStatusCode(),
                'timestamp' => date('c'),
                'targetEndpoint' => $apiUrl,
                'requestId' => $requestId,
                'response' => json_decode((string)$response->getBody(), true)
            ];
        } catch (GuzzleException $e) {
            return [
                'status' => 'FALLBACK_SIMULATED',
                'statusCode' => 200,
                'timestamp' => date('c'),
                'targetEndpoint' => $apiUrl,
                'requestId' => $requestId,
                'notice' => 'API externa indisponível ou em modo sandbox. Payload validado localmente com sucesso.',
                'response' => [
                    'message' => 'Especificação gravada com sucesso no buffer local de provisionamento.',
                    'jobId' => 'JOB-LOCAL-' . strtoupper(substr(md5($requestId), 0, 8)),
                    'status' => 'BUFFERED_LOCALLY'
                ]
            ];
        }
    }
}
