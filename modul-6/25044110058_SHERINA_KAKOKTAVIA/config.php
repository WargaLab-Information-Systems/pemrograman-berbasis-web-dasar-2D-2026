<?php

$host = 'localhost';
$db   = 'hotel_reservations'; 
$user = 'root';
$pass = '051206';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}