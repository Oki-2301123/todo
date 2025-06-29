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
    $sql = $pdo->prepare('SELECT * FROM todos WHERE id = ? AND user_id = ?');
    $sql->execute([$id, $_SESSION['user_id']]);
    $task = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <form action="action.php" method="post">
        <p>内容：<input type="text" name="task" value="<?php echo htmlspecialchars($task['task'], ENT_QUOTES, 'UTF-8'); ?>"></p>
        <p>期限:<input type="date" name="day" value="<?php echo htmlspecialchars($task['due_date'], ENT_QUOTES, 'UTF-8'); ?>"></p>
        <p>優先度：
            <select name="priority">
                <option value="1" <?php if ($task['priority'] == '1') echo 'selected'; ?>>低</option>
                <option value="2" <?php if ($task['priority'] == '2') echo 'selected'; ?>>中</option>
                <option value="3" <?php if ($task['priority'] == '3') echo 'selected'; ?>>高</option>
            </select>
        </p>
        <p>状態：
            <select name="status">
                <option value="todo" <?php if ($task['status'] == 'todo') echo 'selected'; ?>>未完了</option>
                <option value="done" <?php if ($task['status'] == 'done') echo 'selected'; ?>>完了</option>
            </select>
        </p>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($task['user_id'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" name="update" value="更新">
    </form>
    <form action="todo.php" method="post">
        <input type="submit" value="戻る">
    </form>
</body>

</html>