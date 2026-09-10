<?php

/*
|--------------------------------------------------------------------------
| Enable Full Debugging for Vercel
|--------------------------------------------------------------------------
*/
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/*
|--------------------------------------------------------------------------
| Setup Vercel Read-Only Storage Bypass
|--------------------------------------------------------------------------
*/
$storageDirs = [
    '/tmp/storage/app',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Environment overrides for Vercel
putenv('APP_STORAGE=/tmp/storage');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

/*
|--------------------------------------------------------------------------
| Run Laravel Application
|--------------------------------------------------------------------------
*/
require __DIR__ . '/../public/index.php';