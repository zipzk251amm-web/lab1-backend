<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT id, name, email, created_at FROM users ORDER BY id");
$users = $stmt->fetchAll();

echo json_encode(['success' => true, 'users' => $users]);
?>