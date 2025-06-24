<?php
$sql = "INSERT INTO items (task,dya,priority ) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$task, $day, $priority]);

header("Location: form.html"); exit;
?>

