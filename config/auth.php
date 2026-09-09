<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Default guard dan password reset. Kita ganti guard default ke 'web'
    | dan provider default ke 'logins' (model Login).
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'logins',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Guard 'web' memakai session dan provider 'logins'.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'logins',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Provider 'logins' memakai model App\Models\Login dan tabel 'logins'.
    |
    */

    'providers' => [
        'logins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Login::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Reset password table untuk provider 'logins'.
    |
    */

    'passwords' => [
        'logins' => [
            'provider' => 'logins',
            'table' => 'password_reset_tokens', // bisa disesuaikan
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];
