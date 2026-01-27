<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲームルール - マルバツゲーム</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rules.css">
</head>
<body>
    <div class="container rules-container">
        <h1>マルバツゲームのルール</h1>
        
        <section class="rules-section">
            <h2>📝 基本ルール</h2>
            <p>マルバツゲーム（Tic-Tac-Toe）は、2人のプレイヤーが交互に「○」と「×」を3×3のマス目に配置していくゲームです。</p>
        </section>

        <section class="rules-section">
            <h2>🎯 ゲームの目的</h2>
            <p>縦・横・斜めのいずれかで、自分のマーク（○または×）を<strong>3つ揃える</strong>ことが目的です。</p>
        </section>

        <section class="rules-section">
            <h2>🎮 遊び方</h2>
            <ol class="rules-list">
                <li>
                    <strong>手番</strong><br>
                    プレイヤー1（○）から始まります。
                </li>
                <li>
                    <strong>マークの配置</strong><br>
                    自分の手番で、空いているマス（セル）を1つ選んでクリックすると、自分のマークが配置されます。
                </li>
                <li>
                    <strong>交互にプレイ</strong><br>
                    マークを配置したら、相手プレイヤーに手番が移ります。これを繰り返します。
                </li>
                <li>
                    <strong>勝敗の決定</strong><br>
                    先に3つ揃えたプレイヤーが勝利です。全てのマスが埋まっても勝者がいない場合は引き分けです。
                </li>
            </ol>
        </section>

        <section class="rules-section">
            <h2>🏆 勝利条件</h2>
            <p>以下のいずれかのパターンで自分のマークを3つ揃えると勝利です：</p>
            <ul class="rules-list">
                <li><strong>横一列</strong>：1行目、2行目、または3行目</li>
                <li><strong>縦一列</strong>：1列目、2列目、または3列目</li>
                <li><strong>斜め</strong>：左上から右下、または右上から左下</li>
            </ul>
            
            <div class="example-board">
                <div class="example-title">勝利パターンの例：</div>
                <div class="examples-grid">
                    <div class="example-item">
                        <div class="mini-board">
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell">×</div>
                            <div class="mini-cell">×</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                        </div>
                        <div class="example-label">横一列</div>
                    </div>
                    <div class="example-item">
                        <div class="mini-board">
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell">×</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell">×</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                        </div>
                        <div class="example-label">縦一列</div>
                    </div>
                    <div class="example-item">
                        <div class="mini-board">
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell">×</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell">×</div>
                            <div class="mini-cell win">○</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell win">○</div>
                        </div>
                        <div class="example-label">斜め</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rules-section">
            <h2>🤝 引き分け</h2>
            <p>9つ全てのマスが埋まっても、どちらのプレイヤーも3つ揃えられなかった場合は引き分けとなります。</p>
        </section>

        <section class="rules-section">
            <h2>💡 ヒント</h2>
            <ul class="rules-list">
                <li>中央のマス（真ん中）は、最も多くの勝利パターンに関わる重要な位置です。</li>
                <li>相手が2つ揃えそうな場合は、そのマスを先に取って防ぎましょう。</li>
                <li>自分が2つ揃えている場合、相手も同じように防いでくることを予測しましょう。</li>
            </ul>
        </section>

        <section class="rules-section">
            <h2>🔄 リセット</h2>
            <p>ゲームが終了したら、「リセット」ボタンを押すことで新しいゲームを始められます。</p>
        </section>

        <div class="button-group">
            <a href="/" class="action-button primary-button">ゲームで遊ぶ</a>
        </div>
    </div>
</body>
</html>
