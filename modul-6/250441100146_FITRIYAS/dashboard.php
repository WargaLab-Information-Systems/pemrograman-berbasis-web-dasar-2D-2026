<?php
include 'auth.php';
include 'koneksi.php';

$data = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between items-center mb-5">

        <h2 class="text-2xl font-bold">
            Data Buku
        </h2>

        <div>
            Halo,
            <b><?= htmlspecialchars($_SESSION['username']); ?></b>

            <a href="logout.php"
            class="bg-red-500 text-white px-4 py-2 rounded ml-3 inline-block">
                Logout
            </a>
        </div>

    </div>

    <?php if($_SESSION['role'] == 'admin'): ?>

        <a href="tambah.php"
        class="bg-blue-500 text-white px-4 py-2 rounded inline-block">
            Tambah Buku
        </a>

    <?php endif; ?>

    <table class="w-full border mt-5">

        <tr class="bg-gray-200">

            <th class="border p-2">ID</th>
            <th class="border p-2">Judul</th>
            <th class="border p-2">Penulis</th>
            <th class="border p-2">Penerbit</th>
            <th class="border p-2">Tahun</th>
            <th class="border p-2">Stok</th>

            <?php if($_SESSION['role'] == 'user'): ?>
                <th class="border p-2">Pinjam</th>
            <?php endif; ?>

            <?php if($_SESSION['role'] == 'admin'): ?>
                <th class="border p-2">Aksi</th>
            <?php endif; ?>

        </tr>

        <?php while($row = $data->fetch_assoc()): ?>

        <tr>

            <td class="border p-2">
                <?= $row['id']; ?>
            </td>

            <td class="border p-2">
                <?= htmlspecialchars($row['judul']); ?>
            </td>

            <td class="border p-2">
                <?= htmlspecialchars($row['penulis']); ?>
            </td>

            <td class="border p-2">
                <?= htmlspecialchars($row['penerbit']); ?>
            </td>

            <td class="border p-2">
                <?= $row['tahun_terbit']; ?>
            </td>

            <td class="border p-2">
                <?= $row['stok']; ?>
            </td>

            <?php if($_SESSION['role'] == 'user'): ?>

            <td class="border p-2">

                <?php if($row['stok'] > 0): ?>

                    <a href="pinjam.php?id=<?= $row['id']; ?>"
                    class="bg-green-500 text-white px-3 py-2 rounded inline-block">

                        Pinjam

                    </a>

                <?php else: ?>

                    <span class="text-red-500">
                        Habis
                    </span>

                <?php endif; ?>

            </td>

            <?php endif; ?>

            <?php if($_SESSION['role'] == 'admin'): ?>

            <td class="border p-2">

                <a href="edit.php?id=<?= $row['id']; ?>"
                class="bg-yellow-400 px-3 py-2 rounded inline-block">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $row['id']; ?>"
                onclick="return confirm('Yakin hapus data?')"
                class="bg-red-500 text-white px-3 py-2 rounded inline-block">
                    Hapus
                </a>

            </td>

            <?php endif; ?>

        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>