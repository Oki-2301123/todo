<?php
session_start();
require_once('function.php'); //DB関数を読み込む

$pdo = DB(); //データベース接続

$user = $_POST['username'];
$pass = $_POST['password'];

// ユーザー名が一致するユーザーを探す
$spl = "SELECT * FROM users WHERE username = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    // ログイン成功
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: todo.php');
    exit();
} else {
    // ログイン失敗
    $_SESSION['error'] = 'ユーザー名またはパスワードが違います。';
    header('Location:rogin.php');
    exit();
}
?>
 