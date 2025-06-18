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
    $pdo = new PDO(
        'mysql:host=mysql304.phy.lolipop.lan;
        dbname=LAA1554903-php2024;charset=utf8',
        'LAA??????????',
        'データベースのパスワード'
    );
    
    // 初期化
    $id = '';
    $name = '';
    $day = '';
    $priority = '';
    $status = '';

    // 編集するとき
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $edit = $pdo->prepare('SELECT * FROM tasks WHERE id=?');
    $edit->execute([$id]);
    $task = $edit->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        $name = $task['name'];
        $day = $task['day'];
        $priority = $task['priority'];
        $status = $task['status'];
    } else {
        echo 'データが見つかりません';
        exit;
    }
}

    // 更新するとき
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $day = $_POST['day'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $sql = $pdo->prepare('UPDATE tasks SET name=?, day=?, priority=?, status=? WHERE id=?');
    $sql->execute([$name, $day, $priority, $status, $id]);

    echo '更新完了';
}
?>

<!-- 編集画面 --> 
<form action="#" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <dl>
        <dd>
            内容：<input type="text" name="name" value="<?php echo $name; ?>"><br>
            期限：<input type="date" name="day" value="<?php echo $day; ?>"><br>
            優先度：
            <select name="priority">
                <option value="高" <?php if($priority=="高") echo "selected"; ?>>高</option>
                <option value="中" <?php if($priority=="中") echo "selected"; ?>>中</option>
                <option value="低" <?php if($priority=="低") echo "selected"; ?>>低</option>
            </select><br><br>
            状態：
            <select name="status">
                <option value="未完了" <?php if($status=="未完了") echo "selected"; ?>>未完了</option>
                <option value="完了" <?php if($status=="完了") echo "selected"; ?>>完了</option>
            </select><br><br>
        </dd>
            <input type="submit" value="保存" class="button">
            <a href="#">キャンセル</a>
    </dl>
</form>
</body>
</html>