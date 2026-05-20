<?php
include 'config/auth.php';
include 'config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM buku WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan");
}

if (isset($_POST['update'])) {

    $judul = htmlspecialchars($_POST['judul']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $update = $conn->prepare("UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, stok=? WHERE id=?");

    $update->bind_param("sssiii", $judul, $penulis, $penerbit, $tahun, $stok, $id);

    if ($update->execute()) {

        echo "
        <script>
            alert('Data berhasil diupdate');
            window.location='dashboard.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-5">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">

        <h1 class="text-3xl font-bold text-yellow-500 mb-6">
            Edit Buku
        </h1>

        <form method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 font-semibold">
                    Judul Buku
                </label>

                <input type="text" name="judul" required value="<?= htmlspecialchars($data['judul']); ?>"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <div>
                <label class="block mb-2 font-semibold">
                    Penulis
                </label>

                <input type="text" name="penulis" required value="<?= htmlspecialchars($data['penulis']); ?>"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <div>
                <label class="block mb-2 font-semibold">
                    Penerbit
                </label>

                <input type="text" name="penerbit" required value="<?= htmlspecialchars($data['penerbit']); ?>"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 font-semibold">
                        Tahun Terbit
                    </label>

                    <input type="number" name="tahun" required value="<?= htmlspecialchars($data['tahun_terbit']); ?>"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Stok
                    </label>

                    <input type="number" name="stok" required value="<?= htmlspecialchars($data['stok']); ?>"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

            </div>

            <div class="flex gap-3 pt-3">

                <button type="submit" name="update"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-semibold transition">

                    Update
                </button>

                <a href="dashboard.php"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold transition">

                    Kembali
                </a>

            </div>

        </form>

    </div>

</body>

</html>