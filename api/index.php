<?php

try {
    $_ENV['VERCEL'] = 1;
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp/framework/views';
    putenv('VIEW_COMPILED_PATH=/tmp/framework/views');
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    header('Content-Type: text/plain');
    echo "CRITICAL ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
