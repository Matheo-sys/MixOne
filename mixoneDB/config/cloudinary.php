<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | This file is used to configure your Cloudinary credentials.
    |
    */

    'cloud_url' => env('CLOUDINARY_URL'),

    /**
    |--------------------------------------------------------------------------
    | Cloud Name
    |--------------------------------------------------------------------------
    | The name of your Cloudinary cloud.
    */
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],

    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),

];
