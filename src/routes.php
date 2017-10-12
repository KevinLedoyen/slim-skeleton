<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Controller\ArticleController;

// Routes

$app->get('/article', ArticleController::class . ':get');

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Class App dans le namespace App
    // $app = new App\App();
    // $app->setVariable('une variable');
    // echo $app->getVariable();

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
