<?php
session_start();
require_once 'function.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク編集</title>
</head>

<body>
    <h1>タスク編集</h1>
    <?php
    $pdo = DB();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        header('Location: todo.php');
        exit;
    }
    $sql = $pdo->prepare('SELECT * FROM データベース名を書く WHERE id = ?');
    $sql->execute([$id]);
    $task = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <form action="#" method="post">
    <p>内容：<input type="text" name="task" value="<?php echo htmlspecialchars($task['task'], ENT_QUOTES, 'UTF-8'); ?>"></p>
    <p>期限:<input type="date" name="day" value="<?php echo htmlspecialchars($task['due_date'], ENT_QUOTES, 'UTF-8'); ?>"></p>
    <input type="select" name="priority">
    <option value="高" <?php if ($task['priority'] == '高') echo 'selected'; ?>>高</option>
    <option value="中" <?php if ($task['priority'] == '中') echo 'selected'; ?>>中</option>
    <option value="低" <?php if ($task['priority'] == '低') echo 'selected'; ?>>低</option>
    <input type="select" name="status">
    <option value="未完了" <?php if ($task['status'] == 'todo') echo 'selected'; ?>>未完了</option>
    <option value="完了" <?php if ($task['status'] == 'done') echo 'selected'; ?>>完了</option>
    
        <dl>
            <dd>
                内容：<input type="text" name="name" value="<?php echo $name; ?>"><br>
                期限：<input type="date" name="day" value="<?php echo $day; ?>"><br>
                優先度：
                <select name="priority">
                    <option value="高" <?php if ($priority == "高") echo "selected"; ?>>高</option>
                    <option value="中" <?php if ($priority == "中") echo "selected"; ?>>中</option>
                    <option value="低" <?php if ($priority == "低") echo "selected"; ?>>低</option>
                </select><br><br>
                状態：
                <select name="status">
                    <option value="未完了">未完了</option>
                    <option value="完了">完了</option>
                </select><br><br>
            </dd>
            <input type="submit" value="保存" class="button">
            <a href="#">キャンセル</a>
        </dl>
    </form>
</body>

</html>