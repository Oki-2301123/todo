<?php
session_start(); // セッション開始
// DB接続
require_once 'function.php';
$pdo = DB(); // 接続
if (isset($_POST['insert'])) {
    // フォームからのデータを受け取る
    $task = $_POST['task'];
    $day = $_POST['day'];
    $priority = $_POST['priority'];

    // SQL準備
    $sql = "INSERT INTO todos (user_id, task, status, due_date, priority) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // 実行（プレースホルダ5つに対応）
    $stmt->execute([
        $_SESSION['user_id'], // 
        $task,
        'todo',
        $day,
        $priority
    ]);

    // 登録後にフォーム画面へ戻す
    header("Location: todo.php");
    exit;
} else if (isset($_GET['delete'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // SQL準備
        $sql = "DELETE FROM todos WHERE id = ? AND user_id = ?";
        $stmt = $pdo->prepare($sql);
        // 実行
        $stmt->execute([$id, $_SESSION['user_id']]);
    }
    header("Location: todo.php");
    exit;
} else if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $day = $_POST['day'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    
    $sql = "UPDATE todos SET task = ?, due_date = ?, priority = ?, status = ? WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $task,
        $day,
        $priority,
        $status,
        $id,
        $_SESSION['user_id']
    ]);
    header("Location: todo.php");
    exit;
}
