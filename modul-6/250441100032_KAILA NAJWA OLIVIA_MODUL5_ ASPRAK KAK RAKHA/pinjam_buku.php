<?php
include 'auth.php';
include 'koneksi.php';

if($_SESSION['role'] != 'user'){
    die("Akses ditolak!");
}

$id_buku = $_GET['id'];
$username = $_SESSION['username'];

$user = $conn->prepare("SELECT * FROM users WHERE username=?");
$user->bind_param("s", $username);
$user->execute();

$data_user = $user->get_result()->fetch_assoc();

$id_user = $data_user['id'];

$cek = $conn->prepare("SELECT * FROM peminjaman WHERE id_buku=? AND status='dipinjam'");
$cek->bind_param("i", $id_buku);
$cek->execute();

$hasil = $cek->get_result();

if($hasil->num_rows > 0){

    echo "<script>
    alert('Buku sedang dipinjam');
    window.location='dashboard.php';
    </script>";

} else {

    $tanggal = date('Y-m-d');
    $status = 'dipinjam';

    $stmt = $conn->prepare("INSERT INTO peminjaman(id_user,id_buku,tanggal_pinjam,status) VALUES(?,?,?,?)");

    $stmt->bind_param("iiss", $id_user, $id_buku, $tanggal, $status);

    $stmt->execute();

    echo "<script>
    alert('Buku berhasil dipinjam');
    window.location='dashboard.php';
    </script>";
}
?>