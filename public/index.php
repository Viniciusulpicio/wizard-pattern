<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Bramus\Router\Router;
use Combr\Wizard\Controllers\ApiController;
use Combr\Wizard\Controllers\HomeController;

// Handle CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    http_response_code(200);
    exit;
}

$router = new Router();

// Web Routes
$router->get('/', function() {
    $controller = new HomeController();
    $controller->index();
});

// API Routes
$router->mount('/api', function() use ($router) {
    $router->get('/health', function() {
        $api = new ApiController();
        $api->health();
    });

    $router->get('/questions', function() {
        $api = new ApiController();
        $api->getQuestions();
    });

    $router->post('/diagnose', function() {
        $api = new ApiController();
        $api->diagnose();
    });

    $router->post('/dispatch', function() {
        $api = new ApiController();
        $api->dispatchWebhook();
    });
});

// Custom 404
$router->set404(function() {
    if (str_starts_with($_SERVER['REQUEST_URI'], '/api')) {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['status' => 'ERROR', 'message' => 'Endpoint não encontrado.']);
    } else {
        header('Location: /');
    }
    exit;
});

$router->run();
