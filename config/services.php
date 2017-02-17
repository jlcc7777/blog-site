<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => blog\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '893361053265-s1fcfsj4l1acbaq04ktnq7nm2b31p2h1.apps.googleusercontent.com',
        'client_secret' => 'p5R0y2-yN72APIzFoHIJPvh5',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

    'google' => [
        'client_id' => '893361053265-s1fcfsj4l1acbaq04ktnq7nm2b31p2h1.apps.googleusercontent.com',
        'client_secret' => 'p5R0y2-yN72APIzFoHIJPvh5',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],
    
];
