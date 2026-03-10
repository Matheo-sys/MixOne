<?php

/**
 * Router script for PHP built-in server (Railway deployment).
 * Serves static files directly, routes everything else through Laravel.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// If the file exists in /public, serve it directly (CSS, JS, images, fonts...)
$publicFile = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicFile) && !is_dir($publicFile)) {
    return false;
}

// Otherwise, route through Laravel's entry point
require_once __DIR__ . '/public/index.php';
