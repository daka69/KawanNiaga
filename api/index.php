<?php

// Set environment PALING AWAL, sebelum apapun dimuat
$_ENV['VERCEL'] = '1';
putenv('VERCEL=1');
putenv('VIEW_COMPILED_PATH=/tmp/framework/views');

// Buat semua folder yang dibutuhkan Laravel sebelum ia boot
$dirs = [
    '/tmp/app/public',
    '/tmp/framework/views',
    '/tmp/framework/cache/data',
    '/tmp/framework/sessions',
    '/tmp/framework/testing',
    '/tmp/logs',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    header('Content-Type: text/plain');
    echo "CRITICAL ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
