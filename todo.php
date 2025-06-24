<?php
session_start();
require_once('function.php'); ?>
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
    $pdo = DB();
    $sql = "SELECT * FROM todos WHERE user_id= :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':user_id' =>$_SESSION['user_id'] ]);
    $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<p>ようこそ、" . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . "さん</p>";
    ?>
    <h1>ToDoリスト</h1>
    <!-- ログイン者の名前
 　　<a href="#">ログアウト</a> -->

    <h2>タスク追加</h2>
    <form action="insart.php" method="post">
    <input type="text" name="task" placeholder="タスク内容" 　required> <!--タスク追加のテキストボックス-->
    <input type="date" name="due_date" 　required> <!--タスク追加の日付入力欄-->
    <select name='priority' 　required> <!--タスク追加の優先度選択欄(プルダウン) -->
        <option value="1">優先度(低)</option>
        <option value="2">優先度(中)</option>
        <option value="3">優先度(高)</option>
    </select>
    <button>適用</button>
    </form>

    <h2>フィルタ/検索</h2>


    <input type="text" name="filter" placeholder="キーワード"> <!--フィルタ/検索のテキストボックス-->
    <input type="date" name="day"> <!--フィルタ/検索の日付入力欄-->
    <select name='priority'> <!--フィルタ/検索の優先度選択欄(プルダウン)  -->
        <option value="all">優先度(全て)</option>
        <option value="1">優先度(低)</option>
        <option value="2">優先度(中)</option>
        <option value="3">優先度(高)</option>
    </select>
    <button>適用</button>

    <br>
    <br>

    <table>
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
        foreach ($userData as $i){
            ?>
        <tr>
            <td>
                <?php
                if($i['status'] == 'todo'){
                    echo '<input type="checkbox" name="status">';
                } else {
                    echo '<input type="checkbox" name="status" checked>';  
                } 
                ?>
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
                    default:
                        echo '不明';
                }
                ?>
            </td>
            <td>
                <button>編集</button>
                <button>削除</button>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>