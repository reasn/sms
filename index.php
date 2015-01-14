<?php

use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application();

$config = Yaml::parse(file_get_contents(__DIR__ . '/config/config.yml'));

$app->post('/send', function () use ($app, $config) {
    $data = json_decode(file_get_contents('php://input'));

    print_r($data);
    die();
    $browser  = new Buzz\Browser();
    $response = $browser->get(sprintf($config['api']['urlPattern'], null));
    Yaml::parse(file_get_contents(__DIR__ . '/config/config.yml'));

    return json_encode(['status' => 'ok']);
});

$app->run();