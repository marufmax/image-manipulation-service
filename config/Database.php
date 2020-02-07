<?php

return [
    'database' => [
        'redis' => [
           'host'   => getenv('REDIS_HOST'),
           'port'   => getenv('REDIS_port'),
           'password'   => getenv('REDIS_PASSWORD'),
        ]
    ]
];