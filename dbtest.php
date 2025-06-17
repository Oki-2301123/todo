<?php
require_once 'function.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザーとTODO一覧</title>
</head>
<body>
    <h2>📄 ユーザー一覧</h2>
    <?php
    $pdo = DB();
    $stmt = $pdo->query("SELECT * FROM users");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div style='border:1px solid #ccc; margin:10px; padding:10px;'>";
        echo "<p><strong>id:</strong> " . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ":A_I</p>";
        echo "<p><strong>username:</strong> " . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>password:</strong> " . htmlspecialchars($row['password'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>created_at:</strong> " . htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') . ":C_T</p>";
        echo "</div>";
    }

    echo "<hr><h2>✅ ToDo一覧</h2>";

    $stmt = $pdo->query("SELECT * FROM todos");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div style='border:1px solid #ccc; margin:10px; padding:10px;'>";
        echo "<p><strong>id:</strong> " . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ":A_I</p>";
        echo "<p><strong>user_id:</strong> " . htmlspecialchars($row['user_id'], ENT_QUOTES, 'UTF-8') . ":F_K</p>";
        echo "<p><strong>task:</strong> " . htmlspecialchars($row['task'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>status:</strong> " . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>due_date:</strong> " . htmlspecialchars($row['due_date'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>priority:</strong> " . htmlspecialchars($row['priority'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>created_at:</strong> " . htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') . ":C_T</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
