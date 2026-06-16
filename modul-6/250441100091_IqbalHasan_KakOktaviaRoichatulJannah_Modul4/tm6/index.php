<?php
include 'auth.php';
include 'koneksi.php';

if (!is_login()) {
    header("Location: login.php");
    exit;
}


if (isset($_GET['aksi']) && $_GET['aksi'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}

// crud
if (is_admin() && isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $stmt = $conn->prepare("DELETE FROM sparepart_motor WHERE id=?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

if (is_admin() && isset($_POST['simpan'])) {
    $nama = $_POST['nama']; 
    $merk = $_POST['merk']; 
    $hrg = $_POST['harga']; 
    $brt = $_POST['berat']; 
    $kon = $_POST['kondisi'];

    if (!empty($_POST['id'])) {
        $stmt = $conn->prepare("UPDATE sparepart_motor SET nama_part=?, merk=?, harga=?, berat_kg=?, kondisi=? WHERE id=?");
        $stmt->bind_param("ssidsi", $nama, $merk, $hrg, $brt, $kon, $_POST['id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO sparepart_motor (nama_part, merk, harga, berat_kg, kondisi) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssids", $nama, $merk, $hrg, $brt, $kon);
    }
    $stmt->execute();
    header("Location: index.php");
    exit;
}


$edit = null;
if (is_admin() && isset($_GET['aksi']) && $_GET['aksi'] == 'edit') {
    $stmt = $conn->prepare("SELECT * FROM sparepart_motor WHERE id=?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Sparepart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 font-sans">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white p-4 rounded shadow flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-bold">Sistem Sparepart</h1>
                <p class="text-sm">User: <b><?= htmlspecialchars($_SESSION['username']) ?></b> (Role: <?= $_SESSION['role'] ?>)</p>
            </div>
            <a href="?aksi=logout" class="bg-red-500 text-white px-4 py-2 rounded font-bold">Logout</a>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            <?php if (is_admin()): ?>
            <div class="w-full md:w-1/3 bg-white p-4 rounded shadow h-fit">
                <h2 class="font-bold mb-4"><?= $edit ? "Edit Barang" : "Tambah Barang" ?></h2>
                <form method="POST" class="space-y-3">
                    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
                    <input type="text" name="nama" placeholder="Nama Part" required class="w-full border p-2 rounded" value="<?= htmlspecialchars($edit['nama_part'] ?? '') ?>">
                    <input type="text" name="merk" placeholder="Merk" required class="w-full border p-2 rounded" value="<?= htmlspecialchars($edit['merk'] ?? '') ?>">
                    <input type="number" name="harga" placeholder="Harga" required class="w-full border p-2 rounded" value="<?= $edit['harga'] ?? '' ?>">
                    <input type="number" step="any" name="berat" placeholder="Berat (kg)" required class="w-full border p-2 rounded" value="<?= $edit['berat_kg'] ?? '' ?>">
                    <select name="kondisi" class="w-full border p-2 rounded">
                        <option value="baru" <?= (isset($edit) && $edit['kondisi'] == 'baru') ? 'selected' : '' ?>>Baru</option>
                        <option value="bekas" <?= (isset($edit) && $edit['kondisi'] == 'bekas') ? 'selected' : '' ?>>Bekas</option>
                    </select>
                    <button type="submit" name="simpan" class="w-full bg-blue-600 text-white font-bold p-2 rounded">Simpan Data</button>
                    <?php if($edit): ?><a href="index.php" class="block text-center mt-2 text-sm text-blue-500">Batal Edit</a><?php endif; ?>
                </form>
            </div>
            <?php endif; ?>

            <div class="<?= is_admin() ? 'w-full md:w-2/3' : 'w-full' ?> bg-white p-4 rounded shadow overflow-x-auto">
                <h2 class="font-bold mb-4">Daftar Sparepart</h2>
                <table class="w-full text-left border-collapse text-sm">
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Nama Part</th>
                        <th class="p-2 border">Merk</th>
                        <th class="p-2 border">Harga</th>
                        <th class="p-2 border">Berat</th>
                        <th class="p-2 border">Kondisi</th>
                        <th class="p-2 border text-center">Aksi</th>
                    </tr>
                    <?php

                    $result = $conn->query("SELECT * FROM sparepart_motor ORDER BY id DESC");
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="p-2 border font-bold"><?= htmlspecialchars($row['nama_part']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($row['merk']) ?></td>
                        <td class="p-2 border text-blue-600">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($row['berat_kg']) ?> kg</td>
                        <td class="p-2 border uppercase"><?= $row['kondisi'] ?></td>
                        <td class="p-2 border text-center">

                        
                            <?php if (is_admin()): ?>
                                <a href="?aksi=edit&id=<?= $row['id'] ?>" class="text-blue-500 font-bold mr-2">Edit</a>
                                <a href="?aksi=hapus&id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-500 font-bold">Hapus</a>
                            <?php else: ?>
                                <span class="text-gray-400 italic">Hanya Baca</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>