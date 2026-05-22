<?php

$servername = "localhost";
$username   = "root";
$password   = "";           // password kosong (default XAMPP/Laragon)
$database   = "db_mahasiswa";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');