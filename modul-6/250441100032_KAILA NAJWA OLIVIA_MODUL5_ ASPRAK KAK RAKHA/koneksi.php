<?php
$conn = new mysqli("localhost","root","","perpustakaan_dbmodul6");

if($conn->connect_error){
    die("Koneksi gagal");
}
?>