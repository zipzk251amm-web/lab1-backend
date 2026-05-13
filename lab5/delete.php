<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Використання prepare для безпеки
    $stmt = $pdo->prepare("DELETE FROM tov WHERE id = ?");
    $stmt->execute([$id]);
    
    $affected_rows = $stmt->rowCount();
    
    if ($affected_rows > 0) {
        header("Location: tov_index.php?deleted=1");
    } else {
        header("Location: tov_index.php?error=not_found");
    }
} else {
    header("Location: tov_index.php");
}
exit();
?>