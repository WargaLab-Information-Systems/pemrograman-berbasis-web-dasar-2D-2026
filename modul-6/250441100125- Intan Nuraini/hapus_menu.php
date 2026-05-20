<?php
include 'auth.php';
include 'koneksi.php';

adminOnly();

$id = $_GET['id'];

$hapus = mysqli_query($conn,"DELETE FROM menu WHERE id_menu='$id'");    

if($hapus){

    echo "<script>
    alert('Menu berhasil dihapus');
    window.location='dashboard.php';
    </script>";
}
?>