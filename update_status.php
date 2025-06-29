<?php
session_start();
require_once('function.php');
$pdo = DB();

if (isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $id = $_POST['id'];

    // 現在の状態を取得
    $sql = "SELECT status FROM todos WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id, $_SESSION['user_id']]);
    $todo = $stmt->fetch();

    if ($todo) {
        // 状態を切り替え
        $newStatus = $todo['status'] === 'done' ? 'todo' : 'done';
        $updateSql = "UPDATE todos SET status = ? WHERE id = ? AND user_id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$newStatus, $id, $_SESSION['user_id']]);
    }
}
header("Location: todo.php"); // 元のページに戻す
exit;
