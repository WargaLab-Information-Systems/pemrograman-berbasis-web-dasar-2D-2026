<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

function adminOnly(){
    if($_SESSION['role'] != 'admin'){
        die("Akses ditolak!");
    }
}
?>

