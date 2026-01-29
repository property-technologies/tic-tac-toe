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

// Route /rules endpoint
if ($path === '/rules' && $requestMethod === 'GET') {
    require_once __DIR__ . '/rules.php';
    exit;
}

// Route /othello-rules endpoint
if ($path === '/othello-rules' && $requestMethod === 'GET') {
    require_once __DIR__ . '/othello-rules.php';
    exit;
}

// Route /tictactoe endpoint
if ($path === '/tictactoe' && $requestMethod === 'GET') {
    require_once __DIR__ . '/tictactoe.php';
    exit;
}

// Route /othello endpoint
if ($path === '/othello' && $requestMethod === 'GET') {
    require_once __DIR__ . '/othello.php';
    exit;
}

// Default route - Top page (game selection)
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲームセンター</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/top.css">
</head>
<body>
    <div class="container top-container">
        <h1>🎮 ゲームセンター</h1>
        <p class="subtitle">遊びたいゲームを選んでください</p>
        
        <div class="game-selection">
            <a href="./tictactoe.php" class="game-card tictactoe">
                <div class="game-icon">⭕❌</div>
                <div class="game-title">マルバツゲーム</div>
                <div class="game-description">
                    3×3のマス目で、縦・横・斜めに<br>
                    3つ揃えると勝ち！
                </div>
            </a>
            
            <a href="./othello.php" class="game-card othello">
                <div class="game-icon">⚫⚪</div>
                <div class="game-title">オセロ</div>
                <div class="game-description">
                    8×8のボードで駒を挟んで<br>
                    反転させよう！
                </div>
            </a>
        </div>
    </div>
</body>
</html>
