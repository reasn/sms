<?php

use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application();

$config = Yaml::parse(file_get_contents(__DIR__ . '/config/config.yml'));

$app->post('/send', function () use ($app, $config) {
    $data  = json_decode(file_get_contents('php://input'), true);
    $recipients = explode("\n", $data['recipient']) ;
    $count = 0;

    if ($data['password'] === $config['password']) {
        foreach ($recipients as $recipient) {
            $url = sprintf($config['api']['urlPattern'],
                $config['api']['key'],
                trim($recipient),
                urlencode($data['message']),
                urlencode($data['sender']));


            $browser  = new \Buzz\Browser();
            $response = $browser->get($url);
            $count++;
        }

        return json_encode(['status' => 'ok',
                            'count'  => $count]);
    } else {
        return json_encode(['status'  => 'error',
                            'message' => 'access denied']);
    }
});


$app->get('/', function () {
    return file_get_contents(__DIR__ . '/view/index.html');
});

$app->run();