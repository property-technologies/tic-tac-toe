<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲームルール - オセロ</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rules.css">
</head>
<body>
    <div class="container rules-container">
        <h1>オセロのルール</h1>
        
        <section class="rules-section">
            <h2>📝 基本ルール</h2>
            <p>オセロ（Othello）は、2人のプレイヤーが黒と白の駒を使って8×8のマス目（ボード）で対戦するゲームです。駒を挟んで相手の駒を自分の色に反転させながら、最終的により多くの駒を持っている方が勝ちとなります。</p>
        </section>

        <section class="rules-section">
            <h2>🎯 ゲームの目的</h2>
            <p>相手の駒を挟んで<strong>自分の色に反転</strong>させ、ゲーム終了時に<strong>より多くの駒を持つ</strong>ことが目的です。</p>
        </section>

        <section class="rules-section">
            <h2>🎮 遊び方</h2>
            <ol class="rules-list">
                <li>
                    <strong>初期配置</strong><br>
                    ゲーム開始時、ボードの中央4マスに黒2個、白2個が斜めに配置されています。
                </li>
                <li>
                    <strong>手番</strong><br>
                    黒から始まります。交互に手番が回ります。
                </li>
                <li>
                    <strong>駒の配置</strong><br>
                    自分の駒で相手の駒を挟める位置にのみ、駒を置くことができます。縦・横・斜めのいずれかの方向で、相手の駒の列を挟む必要があります。
                </li>
                <li>
                    <strong>駒の反転</strong><br>
                    駒を置いたら、挟んだ相手の駒を全て自分の色に反転させます。複数方向で挟んだ場合、全ての駒が反転します。
                </li>
                <li>
                    <strong>パス</strong><br>
                    置ける場所がない場合は自動的にパスとなり、相手の手番になります。
                </li>
                <li>
                    <strong>ゲーム終了</strong><br>
                    両プレイヤーとも置ける場所がなくなるか、ボードが全て埋まったらゲーム終了です。
                </li>
            </ol>
        </section>

        <section class="rules-section">
            <h2>🏆 勝利条件</h2>
            <p>ゲーム終了時に、<strong>より多くの駒を持っているプレイヤー</strong>が勝利です。</p>
            <ul class="rules-list">
                <li><strong>勝ち</strong>：自分の駒の数が相手より多い</li>
                <li><strong>引き分け</strong>：両プレイヤーの駒の数が同じ</li>
            </ul>
        </section>

        <section class="rules-section">
            <h2>📋 配置可能な場所の条件</h2>
            <p>駒を置くには、以下の条件を満たす必要があります：</p>
            <ul class="rules-list">
                <li>空いているマスであること</li>
                <li>縦・横・斜めのいずれかの方向で、<strong>相手の駒を1つ以上挟める</strong>こと</li>
                <li>挟む列の端は自分の駒で終わっていること</li>
            </ul>
            
            <div class="example-board">
                <div class="example-title">配置可能な場所の例（黒の番）：</div>
                <p style="color: #666; font-size: 0.95em; margin-bottom: 15px;">
                    ⚫ = 黒の駒、⚪ = 白の駒、🟢 = 黒が置ける場所
                </p>
                <div class="examples-grid">
                    <div class="example-item">
                        <div class="mini-board" style="grid-template-columns: repeat(4, 1fr); width: 160px; height: 160px;">
                            <div class="mini-cell"></div>
                            <div class="mini-cell" style="background: #90EE90;">🟢</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell">⚪</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell">⚫</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                        </div>
                        <div class="example-label">縦に挟む</div>
                    </div>
                    <div class="example-item">
                        <div class="mini-board" style="grid-template-columns: repeat(4, 1fr); width: 160px; height: 160px;">
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell">⚫</div>
                            <div class="mini-cell">⚪</div>
                            <div class="mini-cell" style="background: #90EE90;">🟢</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                        </div>
                        <div class="example-label">横に挟む</div>
                    </div>
                    <div class="example-item">
                        <div class="mini-board" style="grid-template-columns: repeat(4, 1fr); width: 160px; height: 160px;">
                            <div class="mini-cell">⚫</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell">⚪</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell" style="background: #90EE90;">🟢</div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                            <div class="mini-cell"></div>
                        </div>
                        <div class="example-label">斜めに挟む</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rules-section">
            <h2>💡 戦略のヒント</h2>
            <ul class="rules-list">
                <li><strong>角（四隅）</strong>を取ると、その駒は絶対に反転されないため非常に有利です。</li>
                <li><strong>辺（端）</strong>の駒も反転されにくく、安定した位置です。</li>
                <li>序盤は駒の数を少なく保ち、相手に多く取らせることで後半の選択肢を増やす戦略もあります。</li>
                <li>相手が角を取れる位置（角の隣のマス）に駒を置くのは避けましょう。</li>
            </ul>
        </section>

        <section class="rules-section">
            <h2>🔄 リセット</h2>
            <p>ゲームが終了したら、「リセット」ボタンを押すことで新しいゲームを始められます。</p>
        </section>

        <div class="button-group">
            <a href="./othello.php" class="action-button primary-button">ゲームで遊ぶ</a>
        </div>
    </div>
</body>
</html>
