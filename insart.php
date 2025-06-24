<?php
session_start(); // セッション開始

// 定義
$task = $_POST['task'] ?? '';
$day = $_POST['day'] ?? '';
$priority = $_POST['priority'] ?? '';
$status = '未完了'; // 例: デフォルトのステータス（必要に応じて）

// DB接続
require_once 'function.php'; // DB接続用関数が入っていると想定
$pdo = DB(); // 接続

// SQL準備
$sql = "INSERT INTO todos (user_id, task, status, due_date, priority) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

// 実行（プレースホルダ5つに対応）
$stmt->execute([
    $_SESSION['user_id'], // ✅ ここを$_SESSIONに
    $task,
    $status,
    $day,
    $priority
]);

// 登録後にフォーム画面へ戻す
header("Location: todo.php");
exit;
?>
