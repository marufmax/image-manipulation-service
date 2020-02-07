<?php

$app->get('/', function ($request, $response, $args) {
   return 'Welcome';
});

$app->get('/{path}', function ($request, $response, $args) {
    
    try {
        $key = "image:{$args['path']}:{$_SERVER['QUERY_STRING']}";
        
        // var_dump($request->getQueryParams()); exit();
        
        $image = $this->cache->remember($key, null, function () use ($request, $args) {
            return  $this->image
                        ->load($this->storage->get($args['path'])->read())
                        ->withFilters($request->getParams())
                        ->stream();
        });
        
    } catch (\App\Storage\Exceptions\FileNotFoundException $e) {
        return $response->withStatus(404)->write('File not found');
    }
    
    return $response->withHeader('Content-Type', 'image/png')->write($image);
});