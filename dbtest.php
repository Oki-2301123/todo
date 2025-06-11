<?php
require_once 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $pdo = DB();

    $stmt = $pdo->query("SELECT * FROM users");

    // データを表示
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p>名前: " . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</p>";
    }
    ?>
</body>
</html>