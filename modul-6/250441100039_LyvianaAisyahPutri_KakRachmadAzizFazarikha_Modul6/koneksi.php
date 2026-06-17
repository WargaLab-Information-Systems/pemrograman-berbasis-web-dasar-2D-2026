<?php
$conn = new mysqli("localhost", "root", "", "pbwdmodul6");
if ($conn->connect_error) {
    die("Gagal konek ke cafe: " . $conn->connect_error);
}
?>