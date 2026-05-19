    <?php
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    $query = "SELECT * FROM buku ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Perpustakaan</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 min-h-screen">
        <nav class="bg-white shadow-md px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600"> Perpustakaan </h1>
            <div class="flex items-center gap-5">
                <div class="text-right">
                    <p class="font-semibold text-gray-700"> <?= $_SESSION['username']; ?> </p>
                    <p class="text-sm text-gray-500"> Role : <?= $_SESSION['role']; ?> </p>
                </div>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition"> Logout </a>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-700"> List Buku </h2>
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <a href="tambah_buku.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition"> + Tambah Buku </a>
        <?php } ?>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="grid grid-cols-6 bg-blue-500 text-white font-bold p-4">
            <div>Judul</div>
            <div>Penulis</div>
            <div>Penerbit</div>
            <div>Tahun</div>
            <div>Stok</div>
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <div>Aksi</div>
            <?php } ?>
        </div>
        <?php while($buku = mysqli_fetch_assoc($result)) { ?>

        <div class="grid grid-cols-6 p-4 border-b items-center hover:bg-gray-100 transition">
            <div> <?= htmlspecialchars($buku['judul']); ?> </div>
            <div> <?= htmlspecialchars($buku['penulis']); ?> </div>
            <div> <?= htmlspecialchars($buku['penerbit']); ?> </div>
            <div> <?= htmlspecialchars($buku['tahun_terbit']); ?> </div>
            <div> <?= htmlspecialchars($buku['stok']); ?> </div>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <div class="flex gap-2">
                <a href="edit_buku.php?id=<?= $buku['id']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"> Edit </a>
                <a href="hapus_buku.php?id=<?= $buku['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"> Hapus </a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
            <div class="flex justify-between items-center mb-6"></div>
    </html>