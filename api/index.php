<?php

// 1. Tampilkan error PHP mentah
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Bypass folder storage read-only Vercel
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

putenv('APP_STORAGE=/tmp/storage');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

// 3. Force APP_KEY & Mode Debug langsung di sini
putenv('APP_KEY=base64:T2cRudFG8KWbGQTaKH3QFgZQ2H2fNrOwOGl6nQvQLHE=');
putenv('APP_DEBUG=true');
putenv('APP_ENV=production');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');

// 4. Jalankan Laravel
require __DIR__ . '/../public/index.php';