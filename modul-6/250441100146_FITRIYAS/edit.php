<?php
include 'auth.php';
include 'koneksi.php';
wajib_admin();

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM buku WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(isset($_POST['update'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = (int)$_POST['tahun'];
    $stok = (int)$_POST['stok'];

    $update = $conn->prepare(
    "UPDATE buku SET
    judul=?,
    penulis=?,
    penerbit=?,
    tahun_terbit=?,
    stok=?
    WHERE id=?"
    );

    $update->bind_param(
    "sssiii",
    $judul,
    $penulis,
    $penerbit,
    $tahun,
    $stok,
    $id
    );

    $update->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<form method="POST"
class="bg-white p-6 rounded shadow w-96 mx-auto">

    <h2 class="text-2xl font-bold mb-4 text-center">
        Edit Buku
    </h2>

    <label class="block mb-1 font-semibold">
        Judul Buku
    </label>

    <input type="text"
    name="judul"
    value="<?= htmlspecialchars($data['judul']); ?>"
    placeholder="Masukkan judul buku"
    class="w-full border p-2 mb-3 rounded"
    required>

    <label class="block mb-1 font-semibold">
        Nama Penulis
    </label>

    <input type="text"
    name="penulis"
    value="<?= htmlspecialchars($data['penulis']); ?>"
    placeholder="Masukkan nama penulis"
    class="w-full border p-2 mb-3 rounded"
    required>

    <label class="block mb-1 font-semibold">
        Nama Penerbit
    </label>

    <input type="text"
    name="penerbit"
    value="<?= htmlspecialchars($data['penerbit']); ?>"
    placeholder="Masukkan nama penerbit"
    class="w-full border p-2 mb-3 rounded"
    required>

    <label class="block mb-1 font-semibold">
        Tahun Terbit
    </label>

    <input type="number"
    name="tahun"
    value="<?= $data['tahun_terbit']; ?>"
    placeholder="Masukkan tahun terbit"
    class="w-full border p-2 mb-3 rounded"
    required>

    <label class="block mb-1 font-semibold">
        Stok Buku
    </label>

    <input type="number"
    name="stok"
    value="<?= $data['stok']; ?>"
    placeholder="Masukkan stok buku"
    class="w-full border p-2 mb-4 rounded"
    required>

    <button type="submit"
    name="update"
    class="bg-yellow-500 text-white px-4 py-2 rounded w-full">

        Update

    </button>

</form>

</body>
</html>