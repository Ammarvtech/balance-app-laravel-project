<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'dapi' => [
        'appSecret' => 'd75df7dfe76957181d8d0f386847b2f22ce12d3e67280e18b7a3c75f3c02025414040567fbe6421e0640973b197a07408ce0aaf56c6fd24579042a3ca908394f7d886bba9481feb999b37f443edcaf3dc435269bff0445c8192890bf24af3f9227cda95b93c6f52d0307796bb4d667bee66cba89be25e6b34e75afce00339502',
        'appKey' => 'f81a81cd99e890dd7aacaf694f93437ecd1dff7a79d081a729c08b69bf48a182',
    ],

];
