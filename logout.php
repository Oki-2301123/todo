<?php
session_start();
session_destroy(); // セッションを破棄

// ログアウト後はログインページへリダイレクト
header("Location: login.php");
exit;
?>