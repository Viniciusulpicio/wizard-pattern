<?php

declare(strict_types=1);

namespace Combr\Wizard\Config;

use Dotenv\Dotenv;

class AppConfig
{
    private static ?self $instance = null;
    private array $config = [];

    private function __construct()
    {
        $rootDir = dirname(__DIR__, 2);
        if (file_exists($rootDir . '/.env')) {
            $dotenv = Dotenv::createImmutable($rootDir);
            $dotenv->safeLoad();
        }

        $this->config = [
            'app_name' => $_ENV['APP_NAME'] ?? 'Wizard Pattern - Diagnóstico de E-mail Corporativo',
            'app_env' => $_ENV['APP_ENV'] ?? 'production',
            'app_debug' => filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'app_url' => $_ENV['APP_URL'] ?? 'http://localhost:8000',
            'provisioning_api_url' => $_ENV['PROVISIONING_API_URL'] ?? 'https://api.combr.com.br/v1/provisioning/infrastructures',
            'provisioning_api_key' => $_ENV['PROVISIONING_API_KEY'] ?? 'demo_key',
            'whatsapp_number' => $_ENV['WHATSAPP_NUMBER'] ?? '5511999999999',
            'company_name' => 'Combr Soluções em Nuvem',
            'company_url' => 'https://combr.com.br',
            'version' => '2.0.0'
        ];
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->config;
    }
}
