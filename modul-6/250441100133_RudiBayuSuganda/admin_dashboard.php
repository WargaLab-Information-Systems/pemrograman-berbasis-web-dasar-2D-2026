<?php
session_start();
require 'koneksi.php';

// Proteksi Halaman: Hanya Admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// --- LOGIKA CRUD ---

// 1. DELETE: Menghapus Member
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_dashboard.php");
    exit;
}

// 2. CREATE: Menambah Member Baru
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_lengkap'];
    $paket = $_POST['paket_layanan'];
    $berat = $_POST['berat_badan'];
    $tgl = $_POST['tanggal_daftar'];
    $user_id = $_POST['user_id'];

    $stmt = $pdo->prepare("INSERT INTO members (user_id, nama_lengkap, paket_layanan, berat_badan, tanggal_daftar, is_active) VALUES (?, ?, ?, ?, ?, 1)");
    $stmt->execute([$user_id, $nama, $paket, $berat, $tgl]);
    header("Location: admin_dashboard.php");
    exit;
}

// 3. UPDATE: Mengedit Member (Logika jika form edit dikirim)
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_lengkap'];
    $paket = $_POST['paket_layanan'];
    $berat = $_POST['berat_badan'];

    $stmt = $pdo->prepare("UPDATE members SET nama_lengkap = ?, paket_layanan = ?, berat_badan = ? WHERE id = ?");
    $stmt->execute([$nama, $paket, $berat, $id]);
    header("Location: admin_dashboard.php");
    exit;
}

// 4. READ: Ambil Data untuk Tabel
$stmt = $pdo->query("SELECT members.*, users.email FROM members JOIN users ON members.user_id = users.id");
$members = $stmt->fetchAll();

// Ambil data user yang belum jadi member untuk dropdown "Tambah"
$users_stmt = $pdo->query("SELECT id, email FROM users WHERE role = 'user' AND id NOT IN (SELECT user_id FROM members)");
$available_users = $users_stmt->fetchAll();

// Ambil data untuk modal Edit (jika ada parameter edit di URL)
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $edit_data = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard - CRUD Gym</title>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4 text-blue-600">
                <?= $edit_data ? "Edit Member: " . htmlspecialchars($edit_data['nama_lengkap']) : "Tambah Member Baru" ?>
            </h2>

            <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                <?php else: ?>
                    <select name="user_id" class="border p-2 rounded" required>
                        <option value="">Pilih Akun User</option>
                        <?php foreach ($available_users as $u): ?>
                            <option value="<?= $u['id'] ?>"><?= $u['email'] ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>

                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                    value="<?= $edit_data ? htmlspecialchars($edit_data['nama_lengkap']) : '' ?>"
                    class="border p-2 rounded" required>

                <select name="paket_layanan" class="border p-2 rounded">
                    <option value="Daily" <?= ($edit_data && $edit_data['paket_layanan'] == 'Daily') ? 'selected' : '' ?>>Daily</option>
                    <option value="Monthly" <?= ($edit_data && $edit_data['paket_layanan'] == 'Monthly') ? 'selected' : '' ?>>Monthly</option>
                    <option value="Yearly" <?= ($edit_data && $edit_data['paket_layanan'] == 'Yearly') ? 'selected' : '' ?>>Yearly</option>
                </select>

                <input type="number" name="berat_badan" placeholder="Berat (kg)"
                    value="<?= $edit_data ? $edit_data['berat_badan'] : '' ?>"
                    class="border p-2 rounded">

                <?php if (!$edit_data): ?>
                    <input type="date" name="tanggal_daftar" class="border p-2 rounded" required>
                <?php endif; ?>

                <div class="flex gap-2">
                    <button type="submit" name="<?= $edit_data ? 'edit' : 'tambah' ?>"
                        class="w-full bg-blue-600 text-white p-2 rounded font-bold hover:bg-blue-700">
                        <?= $edit_data ? 'Update' : 'Simpan' ?>
                    </button>
                    <?php if ($edit_data): ?>
                        <a href="admin_dashboard.php" class="bg-gray-500 text-white p-2 rounded text-center">Batal</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-4">Email</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Paket</th>
                        <th class="p-4">Berat</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($members) > 0): ?>
                        <?php foreach ($members as $m): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4"><?= $m['email'] ?></td>
                                <td class="p-4 font-semibold"><?= htmlspecialchars($m['nama_lengkap']) ?></td>
                                <td class="p-4"><?= $m['paket_layanan'] ?></td>
                                <td class="p-4"><?= $m['berat_badan'] ?> kg</td>
                                <td class="p-4 flex gap-3">
                                    <a href="?edit_id=<?= $m['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="?hapus=<?= $m['id'] ?>" onclick="return confirm('Hapus member ini?')" class="text-red-500 hover:underline">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data member.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>