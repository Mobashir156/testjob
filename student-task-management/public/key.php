<?php
$secureToken = 'my-secret-key';

if (!isset($_GET['token']) || $_GET['token'] !== $secureToken) {
    die('❌ Access denied.');
}

// Correct path: Go up one level from /public to root
$envPath = realpath(__DIR__ . '/../.env');

if (!$envPath || !file_exists($envPath)) {
    die("❌ .env file not found.\n");
}

// Generate key
$key = 'base64:' . base64_encode(random_bytes(32));

// Load and modify .env content
$env = file_get_contents($envPath);
if (preg_match('/^APP_KEY=.*$/m', $env)) {
    $env = preg_replace('/^APP_KEY=.*$/m', "APP_KEY={$key}", $env);
} else {
    $env .= PHP_EOL . "APP_KEY={$key}" . PHP_EOL;
}

// Save updated .env file
file_put_contents($envPath, $env);

echo "✅ APP_KEY has been set: {$key}";
