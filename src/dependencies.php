<?php
// DIC configuration

$container = $app->getContainer();

/* 
view renderer
Se récupère dans les controller avec la variable $container de la class parent Controller
$renderer = $this->container->get('renderer');
pour utiliser le rendu : 
return $renderer->render($response, 'path/to/file.ext', $args);
*/
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Error Handler, gestion des erreurs
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
    	var_dump($exception);
        return $c['response']->withStatus(404)
                             ->withHeader('Content-Type', 'text/html')
                             ->write('OOOPS!');
    };
};

//Override the default 404
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response, $args) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page not found');
    };
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
