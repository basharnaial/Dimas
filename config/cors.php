<?php

return [

    'paths' => [
        'api/*',
        'login',
        'logout',
        'sanctum/csrf-cookie',
    ],

    // فضّل تحديد النطاق الأمامي من .env
    'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:5173')],

    // اتركها فاضية عادةً
    'allowed_origins_patterns' => [],

    'allowed_methods' => ['*'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,

    // مهم لملفات تعريف الارتباط (كوكيز) عبر المتصفح
    'supports_credentials' => true,
];
