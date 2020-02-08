<?php

use App\Cache\RedisCache;
use App\Image\Manipulator;
use App\Storage\FileStorage;
use App\Storage\S3Storage;
use Intervention\Image\ImageManager;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Noodlehaus\Config;
use Predis\Client as Predis;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

$container = new \DI\Container();
\Slim\Factory\AppFactory::setContainer($container);

$app = \Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();


if (file_exists(__DIR__ . '/../.env')) {
    $env = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $env->load();
}

$container->set('config', function ($c) {
    return new Config(__DIR__ .'/../config');
});

$container->set('storage', function ($c) {
    $config = $c->get('config');
    $adapter = new Local($config->get('services.files.storage'));
    
    return new FileStorage(new Filesystem($adapter));
});

$container->set('image', function ($c) {
    return new Manipulator(new ImageManager(), $c->get('config'));
});

$container->set('cache', function ($c) {
    
    $config = $c->get('config');
    
    $client = new Predis([
        'scheme' => 'tcp',
        'host'  => $config->get('database.redis.host'),
        'port'  => $config->get('database.redis.port'),
        'password'  => $config->get('database.redis.password') ?: null
    ]);
    
    return new RedisCache($client);
});

$errorMiddleware = $app->addErrorMiddleware(true, true, true);


require __DIR__ . '/../routes/web.php';

// Run app
$app->run();