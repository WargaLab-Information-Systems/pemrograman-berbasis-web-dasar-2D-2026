<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$query = "DELETE FROM buku WHERE id='$id'";

mysqli_query($conn, $query);
header("Location: index.php");
exit;

?>