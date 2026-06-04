<?php
include 'auth.php';
include 'koneksi.php';

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak!");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

    $judul = htmlspecialchars($_POST['judul']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $update = $conn->prepare("
        UPDATE buku
        SET
        judul_buku=?,
        penulis=?,
        penerbit=?,
        tahun_terbit=?,
        stok=?
        WHERE id_buku=?
    ");

    $update->bind_param(
        "ssssii",
        $judul,
        $penulis,
        $penerbit,
        $tahun,
        $stok,
        $id
    );

    $update->execute();

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen">

<form method="POST"
class="bg-white p-8 rounded-xl shadow-lg w-96">

<h2 class="text-3xl font-bold text-center mb-6">
Edit Buku
</h2>

<input type="text"
name="judul"
value="<?= htmlspecialchars($row['judul_buku']) ?>"
required
class="w-full border p-3 rounded mb-4">

<input type="text"
name="penulis"
value="<?= htmlspecialchars($row['penulis']) ?>"
required
class="w-full border p-3 rounded mb-4">

<input type="text"
name="penerbit"
value="<?= htmlspecialchars($row['penerbit']) ?>"
required
class="w-full border p-3 rounded mb-4">

<input type="number"
name="tahun"
value="<?= htmlspecialchars($row['tahun_terbit']) ?>"
required
class="w-full border p-3 rounded mb-4">

<input type="number"
name="stok"
value="<?= htmlspecialchars($row['stok']) ?>"
required
class="w-full border p-3 rounded mb-4">

<button type="submit"
name="update"
class="bg-blue-500 text-white w-full p-3 rounded">

Update Buku

</button>

</form>

</div>

</body>
</html>