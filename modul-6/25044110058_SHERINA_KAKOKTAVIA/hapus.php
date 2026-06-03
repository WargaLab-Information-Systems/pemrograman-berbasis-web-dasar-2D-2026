<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM reservasi WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        die("Gagal menghapus log data: " . $e->getMessage());
    }
}

header("Location: dashboard.php");
exit;
?>