<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],
        'class-photo' => [
            'driver' => 'local',
            'root' => storage_path('app/classes/photo'),
            'throw' => false,
            'visibility' => 'private',
        ],

        'class-recording' => [
            'driver' => 'local',
            'root' => storage_path('app/classes/recording'),
            'throw' => false,
            'visibility' => 'private',
        ],

        'student-payment' => [
            'driver' => 'local',
            'root' => storage_path('app/billing/student-payment-receipt'),
            'throw' => false,
            'visibility' => 'private',
        ],

        'student-refund' => [
            'driver' => 'local',
            'root' => storage_path('app/billing/student-refund-receipt'),
            'throw' => false,
            'visibility' => 'private',
        ],

        'tutor-payment' => [
            'driver' => 'local',
            'root' => storage_path('app/finance/tutor-payment-receipt'),
            'throw' => false,
            'visibility' => 'private',
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'snapshots' => [
            'driver' => 'local',
            'root' => database_path('snapshots'),
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        // public_path('class-photo') => storage_path('app/classes/photo'),
    ],

];
