<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="../teamdev_todo/css/login_style.css">
</head>
<body>

   <h1 class="center">ログイン</h1>   
    <!-- ここにエラー表示を追加 -->
<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo $_SESSION['error']; ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<!-- ログインフォーム -->
<form action="logincheck.php" method="post">
  ユーザー名: <input type="text" name="username" value="テストユーザー"><br>
  パスワード: <input type="password" name="password" value="test1234"><br>
<input type="submit" value="ログイン">
</form>

<p><a href="signup.php">新規登録</a></p>

</body>
</html>
 