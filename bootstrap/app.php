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

$app = new App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

if (file_exists(__DIR__ . '/../.env')) {
    $env = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $env->load();
}

$container = $app->getContainer();

$container['config'] = function ($c) {
    return new Config(__DIR__ .'/../config');
};

$container['storage'] = function ($e) {
    $adapter = new Local($e->config->get('services.files.storage'));
    
    return new FileStorage(new Filesystem($adapter));
};

$container['image'] = function ($c) {
    return new Manipulator(new ImageManager(), $c->config);
};

$container['cache'] = function ($c) {
    $client = new Predis([
        'scheme' => 'tcp',
        'host'  => $c->config->get('database.redis.host'),
        'port'  => $c->config->get('database.redis.port'),
        'password'  => $c->config->get('database.redis.password') ?: null
    ]);
    
    return new RedisCache($client);
};


require __DIR__ . '/../routes/web.php';