<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク編集</title>
</head>
<body>
    <h1>タスク編集</h1>
<form action="tina4-2_out.php" mathod="post">   
    <dl>
        <dd>
            内容：<input type="text" name="name"><br>
            期限：<input type="date" name="day"><br>
            優先度：<input type="text" name="yosan">円<br>
            状態：<textarea name="tuku" cols="50" rows="5"></textarea>
        </dd>
            <button type="submit">送信</button>
    </dl>
</form>
</body>
</html>