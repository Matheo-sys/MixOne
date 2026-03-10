<?php

/**
 * Router script for PHP built-in server (Railway deployment).
 * Serves static files directly from /public, routes everything else through Laravel.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Build the full path of the requested static file in /public
$publicPath = __DIR__ . '/public' . $uri;

// If the file exists in public/ and is not a directory, serve it directly
if ($uri !== '/' && file_exists($publicPath) && !is_dir($publicPath)) {
    // Return false lets the built-in server serve the file with correct MIME type
    return false;
}

// For everything else (routes), load Laravel's entry point
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/public/index.php';
