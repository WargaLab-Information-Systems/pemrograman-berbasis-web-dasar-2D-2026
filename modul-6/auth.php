<?php
// auth.php — Session checking & helper functions
// Mulai session (jika belum dimulai)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect ke login jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Helper function untuk escape HTML — output aman dari XSS
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}