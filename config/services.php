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

    'creatio' => [
        'login' => env('CREATIO_LOGIN'),
        'password' => env('CREATIO_PASSWORD'),
        'auth_link' => env('CREATIO_AUTH_LINK'),
        'order_link' => env('CREATIO_ORDER_LINK'),
        'domain' => env('CREATIO_DOMAIN'),
    ],

    'creatio_test' => [
        'login' => env('CREATIO_TEST_LOGIN'),
        'password' => env('CREATIO_TEST_PASSWORD'),
        'auth_link' => env('CREATIO_TEST_AUTH_LINK'),
        'order_link' => env('CREATIO_TEST_ORDER_LINK'),
        'domain' => env('CREATIO_TEST_DOMAIN'),
    ],

];
