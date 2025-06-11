
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoリスト</title>
</head>
<body>
    
<h1>ToDoリスト</h1>
<!-- ログイン者の名前
 　　<a href="#">ログアウト</a> -->

    <h2>タスク追加</h2>
    <input type="text" name="task" placeholder="タスク内容"　required>> // タスク追加のテキストボックス
    <input type="date" name="y/m/d"　required>> //タスク追加の日付入力欄
    <select name='priority'　required>> //タスク追加の優先度選択欄(プルダウン)        
        <option value="1">優先度(低)</option>
        <option value="2">優先度(中)</option>
        <option value="3">優先度(高)</option>
</select>
</form>
<button>適用</button>

    <h2>フィルタ/検索</h2>

    
    <input type="text" name="filter" placeholder="キーワード">  <!--フィルタ/検索のテキストボックス-->
    <input type="date" name="y/m/d"> <!--フィルタ/検索の日付入力欄-->
    <select name='priority'> <!--フィルタ/検索の優先度選択欄(プルダウン)  -->      
        <option value="1">優先度(全て)</option>
        <option value="2">優先度(低)</option>
        <option value="3">優先度(中)</option>
        <option value="3">優先度(高)</option>
</select>
<button>適用</button>

<th>状態</th>
<th>タスク</th>
<th>期限</th>
<th>優先度</th>
<th>操作</th>

</body>
</html>