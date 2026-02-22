<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SSO Auth Server URL
    |--------------------------------------------------------------------------
    |
    | The URL of the central authentication server.
    |
    */
    'auth_server_url' => env('SSO_AUTH_SERVER_URL', 'http://localhost:8000'),

    /*
    |--------------------------------------------------------------------------
    | Client Credentials
    |--------------------------------------------------------------------------
    |
    | This application's client ID and secret for SSO.
    |
    */
    'client_id' => env('SSO_CLIENT_ID', 'ecommerce'),
    'client_secret' => env('SSO_CLIENT_SECRET', 'ecommerce-secret-key'),

    /*
    |--------------------------------------------------------------------------
    | JWT Secret Key
    |--------------------------------------------------------------------------
    |
    | Must match the auth server's JWT secret for token validation.
    |
    */
    'jwt_secret' => env('SSO_JWT_SECRET', 'sso-super-secret-key-change-in-production'),

    /*
    |--------------------------------------------------------------------------
    | Callback URL
    |--------------------------------------------------------------------------
    |
    | The URL where the auth server will redirect after authentication.
    |
    */
    'callback_url' => env('APP_URL', 'http://localhost:8001') . '/sso/callback',
];
