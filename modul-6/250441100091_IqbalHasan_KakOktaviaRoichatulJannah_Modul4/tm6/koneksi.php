<?php
$conn = new mysqli("localhost", "root", "", "pbwd_6");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>