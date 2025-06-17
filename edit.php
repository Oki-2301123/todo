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
    $name=$_POST['name'];
    $day=$_POST['day'];
    $priority=$_POST['priority'];
    $status=$_POST['status'];

    $sql = $pdo->prepare('INSERT INTO データベース名を書く(name,day,priority,status)VALUES(?,?,?,?)');
    $sql->execute([$name,$day,$priority,$status]);
    $pdo = null;
    echo 'データ転送完了';
?>
<form action="#" method="post">
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