/**
 * マルバツゲーム (Tic-Tac-Toe) - メインロジック
 */

// ゲーム状態管理
const gameState = {
    board: Array(9).fill(''), // "" | "o" | "x"
    currentPlayer: 'o', // "o" | "x"
    winner: null, // "o" | "x" | "draw" | null
    isGameOver: false
};

// 勝利パターン (0-8のインデックス)
const WIN_PATTERNS = [
    [0, 1, 2], // 横1行目
    [3, 4, 5], // 横2行目
    [6, 7, 8], // 横3行目
    [0, 3, 6], // 縦1列目
    [1, 4, 7], // 縦2列目
    [2, 5, 8], // 縦3列目
    [0, 4, 8], // 斜め左上→右下
    [2, 4, 6]  // 斜め右上→左下
];

// DOM要素の取得
const cells = document.querySelectorAll('.cell');
const currentPlayerDisplay = document.getElementById('current-player');
const gameStatusDisplay = document.getElementById('game-status');
const resetButton = document.getElementById('reset-button');

/**
 * 初期化処理
 */
function init() {
    // セルにクリックイベントを追加
    cells.forEach(cell => {
        cell.addEventListener('click', handleCellClick);
    });

    // リセットボタンにイベントを追加
    resetButton.addEventListener('click', resetGame);

    // 初期表示を更新
    updateDisplay();
}

/**
 * セルクリック時の処理
 */
function handleCellClick(event) {
    const cell = event.target;
    const index = parseInt(cell.dataset.index);

    // ゲームが終了しているか、既に埋まっている場合は無視
    if (gameState.isGameOver || gameState.board[index] !== '') {
        return;
    }

    // マスに現在のプレイヤーのマークを配置
    gameState.board[index] = gameState.currentPlayer;
    updateCellDisplay(cell, index);

    // 勝敗判定
    checkWinner();

    // ゲームが終了していなければプレイヤーを切り替え
    if (!gameState.isGameOver) {
        switchPlayer();
        updateDisplay();
    }
}

/**
 * セルの表示を更新
 */
function updateCellDisplay(cell, index) {
    const player = gameState.board[index];
    if (player === 'o') {
        cell.textContent = '○';
        cell.classList.add('occupied', 'player-o');
    } else if (player === 'x') {
        cell.textContent = '×';
        cell.classList.add('occupied', 'player-x');
    }
}

/**
 * プレイヤーを切り替え
 */
function switchPlayer() {
    gameState.currentPlayer = gameState.currentPlayer === 'o' ? 'x' : 'o';
}

/**
 * 勝敗判定
 */
function checkWinner() {
    // 勝利パターンをチェック
    for (const pattern of WIN_PATTERNS) {
        const [a, b, c] = pattern;
        const boardValues = gameState.board;

        if (
            boardValues[a] !== '' &&
            boardValues[a] === boardValues[b] &&
            boardValues[a] === boardValues[c]
        ) {
            // 勝者が決定
            gameState.winner = boardValues[a];
            gameState.isGameOver = true;
            highlightWinningCells(pattern);
            displayWinner(gameState.winner);
            return;
        }
    }

    // 引き分け判定（全マスが埋まっている）
    if (!gameState.board.includes('')) {
        gameState.winner = 'draw';
        gameState.isGameOver = true;
        displayDraw();
    }
}

/**
 * 勝利セルをハイライト
 */
function highlightWinningCells(pattern) {
    pattern.forEach(index => {
        cells[index].classList.add('winning');
    });
}

/**
 * 勝者を表示
 */
function displayWinner(winner) {
    const displayText = winner === 'o' ? '○' : '×';
    gameStatusDisplay.textContent = `${displayText} の勝利！`;
    gameStatusDisplay.style.color = winner === 'o' ? '#667eea' : '#e74c3c';
}

/**
 * 引き分けを表示
 */
function displayDraw() {
    gameStatusDisplay.textContent = '引き分け！';
    gameStatusDisplay.style.color = '#f39c12';
}

/**
 * 画面表示を更新
 */
function updateDisplay() {
    const displayText = gameState.currentPlayer === 'o' ? '○' : '×';
    currentPlayerDisplay.textContent = displayText;
}

/**
 * ゲームをリセット
 */
function resetGame() {
    // 状態をリセット
    gameState.board = Array(9).fill('');
    gameState.currentPlayer = 'o';
    gameState.winner = null;
    gameState.isGameOver = false;

    // セルの表示をリセット
    cells.forEach(cell => {
        cell.textContent = '';
        cell.classList.remove('occupied', 'player-o', 'player-x', 'winning');
    });

    // ステータス表示をクリア
    gameStatusDisplay.textContent = '';

    // 表示を更新
    updateDisplay();
}

// ページ読み込み時に初期化
document.addEventListener('DOMContentLoaded', init);
