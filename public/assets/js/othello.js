/**
 * オセロゲーム (Othello/Reversi) - メインロジック
 */

// 定数
const BOARD_SIZE = 8;
const TOTAL_CELLS = BOARD_SIZE * BOARD_SIZE;
const BLACK = 'black';
const WHITE = 'white';
const EMPTY = '';

// 8方向のオフセット (上、右上、右、右下、下、左下、左、左上)
const DIRECTIONS = [
    [-1, 0],  // 上
    [-1, 1],  // 右上
    [0, 1],   // 右
    [1, 1],   // 右下
    [1, 0],   // 下
    [1, -1],  // 左下
    [0, -1],  // 左
    [-1, -1]  // 左上
];

// ゲーム状態管理
const gameState = {
    board: Array(TOTAL_CELLS).fill(EMPTY),
    currentPlayer: BLACK,
    blackCount: 2,
    whiteCount: 2,
    isGameOver: false,
    consecutivePasses: 0,
    passTimeoutId: null
};

// DOM要素
let cells = [];
const boardElement = document.getElementById('board');
const blackCountElement = document.getElementById('black-count');
const whiteCountElement = document.getElementById('white-count');
const currentPlayerText = document.getElementById('current-player-text');
const gameStatusElement = document.getElementById('game-status');
const passMessageElement = document.getElementById('pass-message');
const resetButton = document.getElementById('reset-button');

/**
 * 初期化処理
 */
function init() {
    createBoard();
    initializeBoard();
    resetButton.addEventListener('click', resetGame);
    updateDisplay();
}

/**
 * 盤面のDOM要素を作成
 */
function createBoard() {
    boardElement.innerHTML = '';
    cells = [];
    
    for (let i = 0; i < TOTAL_CELLS; i++) {
        const cell = document.createElement('div');
        cell.classList.add('othello-cell');
        cell.dataset.index = i;
        cell.addEventListener('click', handleCellClick);
        boardElement.appendChild(cell);
        cells.push(cell);
    }
}

/**
 * 盤面を初期状態に設定
 */
function initializeBoard() {
    // 中央4マスに初期配置
    const center1 = 27; // (3, 3)
    const center2 = 28; // (3, 4)
    const center3 = 35; // (4, 3)
    const center4 = 36; // (4, 4)
    
    gameState.board[center1] = WHITE;
    gameState.board[center2] = BLACK;
    gameState.board[center3] = BLACK;
    gameState.board[center4] = WHITE;
    
    updateBoardDisplay();
    updateCounts();
    highlightValidMoves();
}

/**
 * インデックスから行と列を取得
 */
function indexToRowCol(index) {
    return {
        row: Math.floor(index / BOARD_SIZE),
        col: index % BOARD_SIZE
    };
}

/**
 * 行と列からインデックスを取得
 */
function rowColToIndex(row, col) {
    if (row < 0 || row >= BOARD_SIZE || col < 0 || col >= BOARD_SIZE) {
        return -1;
    }
    return row * BOARD_SIZE + col;
}

/**
 * セルクリック時の処理
 */
function handleCellClick(event) {
    if (gameState.isGameOver) {
        return;
    }
    
    const index = parseInt(event.currentTarget.dataset.index);
    
    if (!isValidMove(index, gameState.currentPlayer)) {
        return;
    }
    
    placePiece(index, gameState.currentPlayer);
    gameState.consecutivePasses = 0;
    passMessageElement.textContent = '';
    
    switchPlayer();
    
    // 次のプレイヤーが置ける場所があるかチェック
    if (!hasValidMoves(gameState.currentPlayer)) {
        handlePass();
    }
}

/**
 * 駒を配置
 */
function placePiece(index, player) {
    gameState.board[index] = player;
    
    // 反転する駒を取得
    const toFlip = getPiecesToFlip(index, player);
    
    // 駒を反転
    toFlip.forEach(flipIndex => {
        gameState.board[flipIndex] = player;
    });
    
    updateBoardDisplay();
    updateCounts();
    highlightValidMoves();
}

/**
 * 指定位置に駒を置けるか判定
 */
function isValidMove(index, player) {
    if (gameState.board[index] !== EMPTY) {
        return false;
    }
    
    return getPiecesToFlip(index, player).length > 0;
}

/**
 * 反転される駒のインデックスリストを取得
 */
function getPiecesToFlip(index, player) {
    const { row, col } = indexToRowCol(index);
    const opponent = player === BLACK ? WHITE : BLACK;
    const toFlip = [];
    
    // 8方向をチェック
    for (const [dRow, dCol] of DIRECTIONS) {
        const lineFlip = [];
        let r = row + dRow;
        let c = col + dCol;
        
        while (r >= 0 && r < BOARD_SIZE && c >= 0 && c < BOARD_SIZE) {
            const currentIndex = rowColToIndex(r, c);
            const piece = gameState.board[currentIndex];
            
            if (piece === EMPTY) {
                break;
            }
            
            if (piece === opponent) {
                lineFlip.push(currentIndex);
            } else if (piece === player) {
                if (lineFlip.length > 0) {
                    toFlip.push(...lineFlip);
                }
                break;
            }
            
            r += dRow;
            c += dCol;
        }
    }
    
    return toFlip;
}

/**
 * プレイヤーに有効な手があるかチェック
 */
function hasValidMoves(player) {
    for (let i = 0; i < TOTAL_CELLS; i++) {
        if (isValidMove(i, player)) {
            return true;
        }
    }
    return false;
}

/**
 * 有効な手をハイライト
 */
function highlightValidMoves() {
    cells.forEach((cell, index) => {
        cell.classList.remove('can-place');
        
        if (!gameState.isGameOver && isValidMove(index, gameState.currentPlayer)) {
            cell.classList.add('can-place');
        }
    });
}

/**
 * プレイヤーを切り替え
 */
function switchPlayer() {
    gameState.currentPlayer = gameState.currentPlayer === BLACK ? WHITE : BLACK;
    updateDisplay();
}

/**
 * パス処理
 */
function handlePass() {
    const playerName = gameState.currentPlayer === BLACK ? '黒' : '白';
    passMessageElement.textContent = `${playerName}は置ける場所がありません。パスします。`;
    
    // consecutivePassesをインクリメント
    gameState.consecutivePasses++;
    
    // 両者がパスした場合、ゲーム終了
    if (gameState.consecutivePasses >= 2) {
        endGame();
        return;
    }
    
    // 次のプレイヤーに切り替え（タイムアウトIDを先に設定）
    gameState.passTimeoutId = setTimeout(() => {
        if (gameState.passTimeoutId !== null) {
            gameState.passTimeoutId = null;
            switchPlayer();
            passMessageElement.textContent = '';
            
            // 次のプレイヤーも置けない場合はパス処理を再帰的に呼び出し
            if (!hasValidMoves(gameState.currentPlayer)) {
                handlePass();
            }
        }
    }, 1500);
}

/**
 * ゲーム終了処理
 */
function endGame() {
    gameState.isGameOver = true;
    passMessageElement.textContent = '';
    
    cells.forEach(cell => {
        cell.classList.remove('can-place');
    });
    
    // 勝者を判定
    if (gameState.blackCount > gameState.whiteCount) {
        gameStatusElement.textContent = `⚫ 黒の勝利！ (${gameState.blackCount} - ${gameState.whiteCount})`;
        gameStatusElement.style.color = '#333';
    } else if (gameState.whiteCount > gameState.blackCount) {
        gameStatusElement.textContent = `⚪ 白の勝利！ (${gameState.whiteCount} - ${gameState.blackCount})`;
        gameStatusElement.style.color = '#333';
    } else {
        gameStatusElement.textContent = `引き分け！ (${gameState.blackCount} - ${gameState.whiteCount})`;
        gameStatusElement.style.color = '#f39c12';
    }
}

/**
 * 盤面表示を更新
 */
function updateBoardDisplay() {
    cells.forEach((cell, index) => {
        const piece = gameState.board[index];
        cell.innerHTML = '';
        cell.classList.remove('has-piece');
        
        if (piece !== EMPTY) {
            const pieceElement = document.createElement('div');
            pieceElement.classList.add('piece', piece);
            cell.appendChild(pieceElement);
            cell.classList.add('has-piece');
        }
    });
}

/**
 * 駒の数をカウント
 */
function updateCounts() {
    let blackCount = 0;
    let whiteCount = 0;
    
    gameState.board.forEach(piece => {
        if (piece === BLACK) blackCount++;
        if (piece === WHITE) whiteCount++;
    });
    
    gameState.blackCount = blackCount;
    gameState.whiteCount = whiteCount;
    
    blackCountElement.textContent = blackCount;
    whiteCountElement.textContent = whiteCount;
}

/**
 * 表示を更新
 */
function updateDisplay() {
    if (gameState.currentPlayer === BLACK) {
        currentPlayerText.textContent = '⚫ 黒の番';
        document.querySelector('.black-player').classList.add('active');
        document.querySelector('.white-player').classList.remove('active');
    } else {
        currentPlayerText.textContent = '⚪ 白の番';
        document.querySelector('.white-player').classList.add('active');
        document.querySelector('.black-player').classList.remove('active');
    }
}

/**
 * ゲームをリセット
 */
function resetGame() {
    // 保留中のタイムアウトをクリア
    clearTimeout(gameState.passTimeoutId);
    gameState.passTimeoutId = null;
    
    // 状態をリセット
    gameState.board = Array(TOTAL_CELLS).fill(EMPTY);
    gameState.currentPlayer = BLACK;
    gameState.blackCount = 2;
    gameState.whiteCount = 2;
    gameState.isGameOver = false;
    gameState.consecutivePasses = 0;
    
    // 表示をリセット
    gameStatusElement.textContent = '';
    passMessageElement.textContent = '';
    
    // 盤面を初期化
    initializeBoard();
    updateDisplay();
}

// ページ読み込み時に初期化
document.addEventListener('DOMContentLoaded', init);
