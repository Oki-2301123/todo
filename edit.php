<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク編集</title>
</head>
<body>
    <h1>タスク編集</h1>
<form action="#" mathod="post">
    <dl>
        <dd>
            内容：<input type="text" name="name"><br>
            期限：<input type="date" name="day"><br>
            優先度：
            <select name="priority">
                <option value="高">高</option>
                <option value="中">中</option>
                <option value="低">低</option>
            </select><br>
            状態：<select name="Status">
                <option value="未完了">未完了</option>
                <option value="完了">完了</option>
        </dd>
            <input type="submit" value="保存" class="button">
            <a href="#">キャンセル</a>
    </dl>
</form>
</body>
</html>