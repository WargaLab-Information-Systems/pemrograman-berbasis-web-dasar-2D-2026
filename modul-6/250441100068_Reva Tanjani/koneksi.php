<?php

session_start();

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "db_mieayam"
);

if($conn->connect_error){
    die("Koneksi gagal");
}

?>