<?php
include 'config/auth.php';
include 'config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

if (isset($_POST['simpan'])) {

    $judul = htmlspecialchars($_POST['judul']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("INSERT INTO buku(judul, penulis, penerbit, tahun_terbit, stok) VALUES(?,?,?,?,?)");

    $stmt->bind_param("sssii", $judul, $penulis, $penerbit, $tahun, $stok);

    if ($stmt->execute()) {

        echo "
        <script>
            alert('Data berhasil ditambahkan');
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
    <title>Tambah Buku</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-5">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">

        <h1 class="text-3xl font-bold text-blue-600 mb-6">
            Tambah Buku
        </h1>

        <form method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 font-semibold">
                    Judul Buku
                </label>

                <input type="text" name="judul" required placeholder="Masukkan judul buku"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 font-semibold">
                    Penulis
                </label>

                <input type="text" name="penulis" required placeholder="Masukkan nama penulis"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 font-semibold">
                    Penerbit
                </label>

                <input type="text" name="penerbit" required placeholder="Masukkan penerbit"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 font-semibold">
                        Tahun Terbit
                    </label>

                    <input type="number" name="tahun" required min="2000" max="2099"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Stok
                    </label>

                    <input type="number" name="stok" required min="1"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

            </div>

            <div class="flex gap-3 pt-3">

                <button type="submit" name="simpan"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">

                    Simpan
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