<?php

/**
 * Simple Router for Tic-Tac-Toe Application
 */

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove query string if exists
$path = parse_url($requestUri, PHP_URL_PATH);

// Route /health endpoint
if ($path === '/health' && $requestMethod === 'GET') {
    require_once __DIR__ . '/health.php';
    exit;
}

// Default route - Tic-Tac-Toe game page
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe</title>
</head>
<body>
    <h1>Tic-Tac-Toe Game</h1>
    <p>Coming soon...</p>
</body>
</html>
