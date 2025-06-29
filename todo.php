<?php
session_start();
require_once('function.php');

$pdo = DB();
if (!isset($_SESSION['user_id'])) {
    // ユーザーがログインしていない場合はログインページへリダイレクト
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoリスト</title>
</head>

<body>
    <!--データベース接続-->
    <?php

    if (isset($_GET['search'])) {
        $keyword = '';
        $day = ''; // 初期値を設定
        $priority = 'all'; // 初期値を設定

        // フォームからのデータを受け取る
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
        }
        if (isset($_GET['day'])) {
            $day = $_GET['day'];
        }
        if (isset($_GET['priority'])) {
            $priority = $_GET['priority'];
        }

        // SQL準備
        $sql = "SELECT * FROM todos WHERE user_id =? AND task LIKE ? AND due_date LIKE ? AND (priority = ? OR ? = 'all')";
        $stmt = $pdo->prepare($sql);

        // 実行（プレースホルダ5つに対応）
        $stmt->execute([
            $_SESSION['user_id'], // 
            $keyword ? "%$keyword%" : '%', // キーワード検索
            $day ? $day : '%', // 日付検索
            $priority,
            $priority // 優先度検策
        ]);
        // 検索結果を取得
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // ユーザーのタスクを取得
        $sql = "SELECT * FROM todos WHERE user_id= :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo "<p>" . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . "さん</p>";
    ?>
    <a href="logout.php">ログアウト</a>
    <h1>ToDoリスト</h1>

    <!--タスク追加 -->
    <h2>タスク追加</h2>
    <form action="action.php" method="post">
        <input type="text" name="task" placeholder="タスク内容" 　required> <!--タスク追加のテキストボックス-->
        <input type="date" name="day" 　required> <!--タスク追加の日付入力欄-->
        <select name='priority' 　required> <!--タスク追加の優先度選択欄(プルダウン) -->
            <option value="1">
                優先度(低)
            </option>
            <option value="2">
                優先度(中)
            </option>
            <option value="3">
                優先度(高)
            </option>
        </select>
        <button type="submit" name="insert">適用</button>
    </form>

    <!--フィルタ/検索 -->
    <h2>フィルタ/検索</h2>
    <form action="#" method="get">
        <input type="text" name="keyword" placeholder="キーワード"> <!--フィルタ/検索のテキストボックス-->
        <input type="date" name="day"> <!--フィルタ/検索の日付入力欄-->
        <select name='priority'> <!--フィルタ/検索の優先度選択欄(プルダウン)  -->
            <option value="all">
                優先度(全て)
            </option>
            <option value="1">
                優先度(低)
            </option>
            <option value="2">
                優先度(中)
            </option>
            <option value="3">
                優先度(高)
            </option>
        </select>
        <button type="submit" name="search">適用</button>
    </form>
    <br>
    <br>

    <table border="1">
        <tr>
            <th>
                状態
            </th>
            <th>
                タスク
            </th>
            <th>
                期限
            </th>
            <th>
                優先度
            </th>
            <th>
                操作
            </th>
        </tr>
        <?php
        foreach ($userData as $i) {
        ?>
            <tr>
                <td>
                    <form action="update_status.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $i['id'] ?>">
                        <input type="checkbox" name="status" onchange="this.form.submit()" <?= $i['status'] == 'done' ? 'checked' : '' ?>>
                    </form>
                    
                </td>
                <td>
                    <?= htmlspecialchars($i['task'], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td>
                    <?= htmlspecialchars($i['due_date'], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td>
                    <?php
                    switch ($i['priority']) {
                        case 1:
                            echo '優先度(低)';
                            break;
                        case 2:
                            echo '優先度(中)';
                            break;
                        case 3:
                            echo '優先度(高)';
                            break;
                    }
                    ?>
                </td>
                <td>
                    <form action="edit.php" method="get">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($i['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" name="edit">編集</button>
                    </form>
                    <form action="action.php" method="get">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($i['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" name="delete">削除</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

    <?php
    // タスク数と完了数の取得
    $sql = "SELECT COUNT(*) as total, SUM(CASE WHEN status = 'done' THEN 1 ELSE 0 END) as done_count FROM todos WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $counts = $stmt->fetch(PDO::FETCH_ASSOC);
    $donePercentage = $counts['total'] > 0 ? round(($counts['done_count'] / $counts['total']) * 100) : 0;
    ?>
    <div>
        <p>完了率: <?= $donePercentage ?>%</p>
        <progress value="<?= $donePercentage ?>" max="100" style="width: 100%; height: 20px;"></progress>
    </div>



</body>

</html>