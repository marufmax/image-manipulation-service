<?php

return [
  'services' => [
      's3' => [
          'key' => getenv('S3_KEY'),
          'secret' =>getenv('S3_SECRET'),
          'region' => getenv('S3_REGION'),
          'bucket' => getenv('S3_BUCKET')
      ],
      'pcloud' => [
          "appKey" => getenv('PCLOUD_KEY'),
          "appSecret" => getenv('PCLOUD_SECRET'),
          "redirect_uri" => getenv('PCLOUD_REDIRECT_URL')
      ],
      'files' => [
          'storage' => __DIR__ . '/../' .getenv('STORAGE_DIR')
      ]
  ]
];