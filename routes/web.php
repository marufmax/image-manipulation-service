<?php

use App\Storage\Exceptions\FileNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;
use function Slim\Psr7\Response;

$app->get('/', function ($request, $response, $args) {
   return 'Welcome';
});

$app->get('/{path}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
    
    try {
        $key = "image:{$args['path']}:{$_SERVER['QUERY_STRING']}";
        
        $cache = $this->get('cache');
        
        $file = $cache->remember($key, null, function () use ($request, $args) {
            $image = $this->get('image');
            $storage = $this->get('storage');

            return $image->load($storage->get($args['path'])->read())
                        ->withFilters($request->getQueryParams())
                        ->stream();
        });
        
    } catch (FileNotFoundException $e) {
        return $response->withStatus(404)->write('File not found');
    }
    
    if(!is_resource($file)) {
        $image = $this->get('image');
        
        $file = $image->load($file)->stream();
    }
    
    $res = (new Response())
                ->withHeader('Content-Type', 'image/png')
                ->withBody($file);
    
    return $res;
});