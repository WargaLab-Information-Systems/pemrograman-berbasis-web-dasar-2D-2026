<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mdl6_praktikum_tiket_konser";

try {
    $dsn = "mysql:host=$servername;dbname=$database;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi ke database berhasil!";
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}   