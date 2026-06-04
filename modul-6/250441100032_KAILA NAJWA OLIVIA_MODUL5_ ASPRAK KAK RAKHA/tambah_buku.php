 <?php
include 'auth.php';
include 'koneksi.php';

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak!");
}

if(isset($_POST['submit'])){

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("
        INSERT INTO buku
        (judul_buku, penulis, penerbit, tahun_terbit, stok)
        VALUES (?,?,?,?,?)
    ");

    $stmt->bind_param(
        "ssssi",
        $judul,
        $penulis,
        $penerbit,
        $tahun,
        $stok
    );

    $stmt->execute();

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen">

<form method="POST"
class="bg-white p-8 rounded-xl shadow-lg w-96">

<h2 class="text-3xl font-bold text-center mb-6">
Tambah Buku
</h2>

<input type="text"
name="judul"
placeholder="Judul Buku"
required
class="w-full border p-3 rounded mb-4">

<input type="text"
name="penulis"
placeholder="Penulis"
required
class="w-full border p-3 rounded mb-4">

<input type="text"
name="penerbit"
placeholder="Penerbit"
required
class="w-full border p-3 rounded mb-4">

<input type="number"
name="tahun"
placeholder="Tahun Terbit"
required
class="w-full border p-3 rounded mb-4">

<input type="number"
name="stok"
placeholder="Stok"
required
class="w-full border p-3 rounded mb-4">

<button type="submit"
name="submit"
class="bg-green-500 text-white w-full p-3 rounded">

Tambah Buku

</button>

</form>

</div>

</body>
</html>