<?php
include 'config/auth.php';
include 'config/koneksi.php';

$data = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

    <div class="max-w-7xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <div class="flex justify-between items-center mb-6">

                <div>
                    <h1 class="text-3xl font-bold text-blue-600">
                        Dashboard Buku
                    </h1>

                    <p class="text-gray-600 mt-2">
                        Login sebagai:
                        <span class="font-semibold">
                            <?= htmlspecialchars($_SESSION['nama']); ?>
                        </span>
                        (<?= $_SESSION['role']; ?>)
                    </p>
                </div>

                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl">

                    Logout
                </a>

            </div>

            <?php if ($_SESSION['role'] == 'admin'): ?>

                <a href="tambah_buku.php"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl inline-block mb-5">

                    Tambah Buku
                </a>

            <?php endif; ?>

            <div class="overflow-x-auto">

                <table class="w-full border border-gray-300">

                    <thead class="bg-blue-600 text-white">

                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Judul</th>
                            <th class="p-3">Penulis</th>
                            <th class="p-3">Penerbit</th>
                            <th class="p-3">Tahun</th>
                            <th class="p-3">Stok</th>

                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <th class="p-3">Aksi</th>
                            <?php endif; ?>
                        </tr>

                    </thead>

                    <tbody>

                        <?php $no = 1; ?>

                        <?php while ($row = $data->fetch_assoc()): ?>

                            <tr class="border-t hover:bg-gray-100">

                                <td class="p-3"><?= $no++; ?></td>

                                <td class="p-3">
                                    <?= htmlspecialchars($row['judul']); ?>
                                </td>

                                <td class="p-3">
                                    <?= htmlspecialchars($row['penulis']); ?>
                                </td>

                                <td class="p-3">
                                    <?= htmlspecialchars($row['penerbit']); ?>
                                </td>

                                <td class="p-3">
                                    <?= htmlspecialchars($row['tahun_terbit']); ?>
                                </td>

                                <td class="p-3">
                                    <?= htmlspecialchars($row['stok']); ?>
                                </td>

                                <?php if ($_SESSION['role'] == 'admin'): ?>

                                    <td class="p-3 space-x-2">

                                        <a href="edit_buku.php?id=<?= $row['id']; ?>"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg">

                                            Edit
                                        </a>

                                        <a href="hapus_buku.php?id=<?= $row['id']; ?>"
                                            onclick="return confirm('Yakin hapus data?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">

                                            Hapus
                                        </a>

                                    </td>

                                <?php endif; ?>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>