<?php

use Silex\Application;
use EstCeQueCestBientot\Service\MessageService;
use EstCeQueCestBientot\Service\ConfigurationService;

$app = new Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
));

$app['config.service'] = $app->share(function() {
    return new ConfigurationService(__DIR__.'/../config/estcequecestbientotlheureducafe_configuration.yml');
});
$app['message.service'] = $app->share(function($app) {
    return new MessageService(__DIR__.'/../config/estcequecestbientotlheureducafe_configuration.yml');
});

$app->get('/', 'EstCeQueCestBientot\Controller\IndexController::indexAction');

return $app;