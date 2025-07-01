<?php
header('Location: https://aso2301123.tonkotsu.jp/teamdev_todo/login.php');
require_once('function.php');
$pdo = DB();
    $user = $_POST['user'];
    $password = $_POST['password'];
    $sql = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $sql->execute([$user,$password]);
exit();
?>