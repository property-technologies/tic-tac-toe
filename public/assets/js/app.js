/**
 * マルバツゲーム (Tic-Tac-Toe) - メインロジック
 */

// 定数
const BOARD_SIZE = 9;
const MAX_MARKS_PER_PLAYER = 3; // 各プレイヤーの最大マーク数

// ゲーム状態管理
const gameState = {
    board: Array(BOARD_SIZE).fill(''), // "" | "o" | "x"
    currentPlayer: 'o', // "o" | "x"
    winner: null, // "o" | "x" | "draw" | null
    isGameOver: false,
    // 各プレイヤーのマーク履歴（配置順序を追跡）
    moveHistory: {
        o: [], // [index1, index2, index3]
        x: []  // [index1, index2, index3]
    }
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

    // 現在のプレイヤーのマーク履歴を取得
    const currentPlayerHistory = gameState.moveHistory[gameState.currentPlayer];

    // マーク数が上限に達している場合、最も古いマークを削除
    if (currentPlayerHistory.length >= MAX_MARKS_PER_PLAYER) {
        const oldestIndex = currentPlayerHistory.shift(); // 最古のインデックスを削除
        removeMarkFromCell(oldestIndex);
    }

    // マスに現在のプレイヤーのマークを配置
    gameState.board[index] = gameState.currentPlayer;
    currentPlayerHistory.push(index); // 履歴に追加
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
 * セルからマークを削除
 */
function removeMarkFromCell(index) {
    const cell = cells[index];
    gameState.board[index] = '';
    
    // フェードアウトアニメーション
    cell.classList.add('fading-out');
    
    setTimeout(() => {
        cell.textContent = '';
        cell.classList.remove('occupied', 'player-o', 'player-x', 'fading-out');
    }, 300); // アニメーション時間と同期
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
    gameState.board = Array(BOARD_SIZE).fill('');
    gameState.currentPlayer = 'o';
    gameState.winner = null;
    gameState.isGameOver = false;
    gameState.moveHistory = {
        o: [],
        x: []
    };

    // セルの表示をリセット
    cells.forEach(cell => {
        cell.textContent = '';
        cell.classList.remove('occupied', 'player-o', 'player-x', 'winning', 'fading-out');
    });

    // ステータス表示をクリア
    gameStatusDisplay.textContent = '';

    // 表示を更新
    updateDisplay();
}

// ページ読み込み時に初期化
document.addEventListener('DOMContentLoaded', init);
