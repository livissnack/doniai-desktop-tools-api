<?php

return [
    'id' => 'user_api',
    'env' => env('APP_ENV', 'prod'),
    'debug' => env('APP_DEBUG', false),
    'version' => '1.1.1',
    'timezone' => 'PRC',
    'master_key' => env('MASTER_KEY'),
    'params' => [
        'ali_oss_access_key' => env('ALI_OSS_ACCESS_KEY'),
        'ali_oss_access_secret' => env('ALI_OSS_ACCESS_SECRET'),
        'ali_oss_bucket_name' => env('ALI_OSS_BUCKET_NAME', 'doniai-mini'),
    ],
    'aliases' => [],
    'components' => [
        'db' => [env('DB_URL')],
        'redis' => [env('REDIS_URL')],
        'logger' => ['level' => env('LOGGER_LEVEL', 'info')],
        'restClient' => ['proxy' => env('REST_CLIENT_PROXY', '')],
    ],
    'services' => [
        'baiduService' => [
            'base_url' => env('BAIDU_AI_URL'),
            'access_key' => env('BAIDU_ACCESS_KEY'),
            'secret_key' => env('BAIDU_SECRET_KEY'),
        ],
        'aliyunSmsService' => [

        ],
    ],
    'listeners' => [],
    'plugins' => [
//        'debugger',
        'logger',
    ]
];
