<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Controller\ArticleController;
use App\Controller\StaticPageController;

// Routes
$app->get('/article', ArticleController::class . ':home');
$app->get('/{page}', StaticPageController::class . ':staticPage');
$app->get('/', StaticPageController::class . ':home');


/*
$app->get('/[{page}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Class App dans le namespace App
    // $app = new App\App();
    // $app->setVariable('une variable');
    // echo $app->getVariable();

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/