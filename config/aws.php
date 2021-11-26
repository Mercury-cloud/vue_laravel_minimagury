<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. This file
    | is published to the application config directory for modification by the
    | user. The full set of possible options are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID', ''),
        'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
    ],
    'region' => env('AWS_REGION', 'us-east-1'),
    'version' => 'latest',
    'ua_append' => [
        'L5MOD/' . AwsServiceProvider::VERSION,
    ],

    'S3' => [
        'region' => 'ap-northeast-1'
    ],
    'cloud_front' => [
        "uri"      => env('AWS_CLOUD_FRONT_STORAGE_URI'),
        "key_path" => base_path(env('AWS_CLOUD_FRONT_KEY_PATH')),
        "key_name" => env('AWS_CLOUD_FRONT_KEY_NAME')
    ]
];