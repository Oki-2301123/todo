<?php
session_start();
require_once('function.php'); // DB関数を読み込む
$pdo = DB(); // データベース接続
$user = $_POST['username'] ?? null;
$pass = $_POST['password'] ?? null;
if (!$user || !$pass) {
    $_SESSION['error'] = 'ユーザー名またはパスワードが入力されていません。';
    header('Location: rogin.php');
    exit();
}
// ユーザー名が一致するユーザーを探す（パスワードの照合は後で行う）
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute([':username' => $user]);
$userData = $stmt->fetch();
if ($userData && password_verify($pass, $userData['password'])) {
    // ログイン成功
    $_SESSION['user_id'] = $userData['id'];
    $_SESSION['username'] = $userData['username'];
    header('Location: todo.php');
    exit();
} else {
    // ログイン失敗
    $_SESSION['error'] = 'ユーザー名またはパスワードが違います。';
    header('Location: rogin.php');
    exit();
}
 