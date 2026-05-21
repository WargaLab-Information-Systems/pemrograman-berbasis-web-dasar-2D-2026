<?php
$host = "localhost";
$db   = "praktikum_db";
$user = "root";
$pass = "12345678"; // Coba kosongkan jika sebelumnya "12345678" gagal

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal! Periksa nama DB atau Password MySQL Anda: " . $e->getMessage());
}