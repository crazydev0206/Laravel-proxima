<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    
    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => config('app.url') . '' .env('FACEBOOK_REDIRECT'),
    ],
    
    'google' => [
        'client_id'     => env('GOOGLE_APP_ID'),
        'client_secret' => env('GOOGLE_APP_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT', config('app.url'))
    ],
    
    'linkedin' => [
        'client_id'     => env('LINKEDIN_APP_ID'),
        'client_secret' => env('LINKEDIN_APP_SECRET'),
        'redirect'      => env('LINKEDIN_REDIRECT', config('app.url'))
    ],
    'instagram' => [    
        'client_id' => env('INSTAGRAM_CLIENT_ID'),  
        'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),  
        'redirect' => env('INSTAGRAM_REDIRECT_URI', config('app.url')) 
      ],
      'snapchat' => [    
        'client_id' => env('SNAPCHAT_CLIENT_ID'),  
        'client_secret' => env('SNAPCHAT_CLIENT_SECRET'),  
        'redirect' => env('SNAPCHAT_REDIRECT_URI') 
      ],

];
