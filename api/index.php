<?php

// 1. Tampilkan error mentah PHP untuk debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// 2. Buat direktori sementara di /tmp (Storage Vercel)
$storageDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 3. Set Environment Variable Storage & Views
putenv('APP_STORAGE=/tmp/storage');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('APP_DEBUG=true');
putenv('APP_ENV=production');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('CACHE_DRIVER=array');

// 4. Jalankan aplikasi Laravel lewat public/index.php resmi
require __DIR__ . '/../public/index.php';