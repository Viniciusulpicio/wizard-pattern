<?php

declare(strict_types=1);

namespace Combr\Wizard\Controllers;

use Combr\Wizard\Config\AppConfig;
use Combr\Wizard\Services\QuestionsRepository;

class HomeController
{
    private QuestionsRepository $questionsRepo;
    private AppConfig $config;

    public function __construct()
    {
        $this->questionsRepo = new QuestionsRepository();
        $this->config = AppConfig::getInstance();
    }

    public function index(): void
    {
        $steps = $this->questionsRepo->getSteps();
        $appName = $this->config->get('app_name');
        $companyName = $this->config->get('company_name');
        $companyUrl = $this->config->get('company_url');
        $whatsappNumber = $this->config->get('whatsapp_number');

        // Render HTML template
        require dirname(__DIR__, 2) . '/templates/layout.php';
    }
}
