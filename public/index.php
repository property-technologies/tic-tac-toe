<?php

/**
 * Simple Router for Tic-Tac-Toe Application
 */

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

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
    <title>マルバツゲーム - Tic-Tac-Toe</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>マルバツゲーム</h1>
        
        <div class="game-info">
            <div id="turn-display" class="turn-display">
                現在の手番: <span id="current-player">○</span>
            </div>
            <div id="game-status" class="game-status"></div>
        </div>

        <div id="board" class="board">
            <div class="cell" data-index="0"></div>
            <div class="cell" data-index="1"></div>
            <div class="cell" data-index="2"></div>
            <div class="cell" data-index="3"></div>
            <div class="cell" data-index="4"></div>
            <div class="cell" data-index="5"></div>
            <div class="cell" data-index="6"></div>
            <div class="cell" data-index="7"></div>
            <div class="cell" data-index="8"></div>
        </div>

        <button id="reset-button" class="reset-button">リセット</button>
    </div>

    <script src="assets/js/app.js"></script>
</body>
</html>
