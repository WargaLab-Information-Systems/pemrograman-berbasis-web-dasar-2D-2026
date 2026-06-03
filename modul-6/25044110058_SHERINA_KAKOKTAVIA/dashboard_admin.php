<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'] ?? 'user';
$user_id = $_SESSION['user_id'];
$data = [];
$revenue = 0;
$msg = '';

try {
    if ($role === 'admin') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'tambah') {
            $input_user = trim($_POST['user_id'] ?? '');
            $input_price = trim($_POST['total_price'] ?? '');
            
            if ($input_user !== '' && $input_price !== '') {
                try {
                    $pdo->exec("SET sql_mode = ''");
                    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
                    
                    $stmt_add = $pdo->prepare("INSERT INTO reservations (user_id, total_price) VALUES (?, ?)");
                    $stmt_add->execute([$input_user, $input_price]);
                    
                    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

                    header("Location: " . $_SERVER['PHP_SELF'] . "?status=sukses");
                    exit();
                } catch (PDOException $db_error) {
                    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
                    $msg = "Gagal tambah: " . $db_error->getMessage();
                }
            }
        }

        if (isset($_GET['aksi_hapus'])) {
            $stmt_del = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt_del->execute([$_GET['aksi_hapus']]);
            header("Location: " . $_SERVER['PHP_SELF'] . "?status=hapus_sukses");
            exit();
        }

        $stmt = $pdo->query("SELECT * FROM reservations ORDER BY id DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resRevenue = $pdo->query("SELECT SUM(total_price) FROM reservations");
        $revenue = $resRevenue ? $resRevenue->fetchColumn() : 0;
    } else {
        $stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY id DESC");
        $stmt->execute([$user_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    $msg = "Error Umum: " . $e->getMessage();
}
?>
  
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Grand Mirama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #0d0e12;
        }
        .font-luxury { 
            font-family: 'Marcellus', serif; 
        }
        .font-serif-luxury {
            font-family: 'Playfair Display', serif;
        }
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 30%, #b38728 70%, #fbf5b7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="text-gray-200 p-6 min-h-screen">
    <div class="max-w-5xl mx-auto">
        
        <nav class="bg-[#12141c]/80 backdrop-blur-md border border-white/5 p-5 rounded-xl mb-6 flex justify-between items-center shadow-2xl">
            <h1 class="font-luxury text-sm font-bold tracking-[0.2em] text-white">
                GRAND MIRAMA <span class="gold-gradient font-black"><?= strtoupper($role) ?></span>
            </h1>
            <a href="logout.php" class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-2 rounded-lg text-xs font-bold tracking-widest uppercase hover:bg-red-500 hover:text-white transition-all duration-300">
                <i class="fas fa-sign-out-alt mr-1"></i> KELUAR
            </a>
        </nav>

        <?php if (!empty($msg) || isset($_GET['status'])): ?>
            <div class="mb-6 p-4 rounded-xl border text-xs bg-gray-900 border-white/10 text-yellow-400 font-mono">
                <?= !empty($msg) ? htmlspecialchars($msg) : "✓ Operasi database berhasil diperbarui!" ?>
            </div>
        <?php endif; ?>

        <?php if ($role === 'admin'): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="md:col-span-2 bg-[#12141c] border border-white/5 p-6 rounded-xl shadow-xl">
                <h3 class="font-luxury text-xs text-white/80 mb-5 uppercase tracking-[0.15em] font-bold flex items-center gap-2">
                    <span class="w-1.5 h-3 bg-[#bf953f] rounded-full"></span> Tambah Reservasi Baru
                </h3>
                <form action="" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="hidden" name="action" value="tambah">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold px-1">User ID</label>
                        <input type="number" name="user_id" required placeholder="Contoh: 12" class="bg-[#0d0e12] border border-white/10 rounded-lg p-3 text-xs text-white focus:outline-none focus:border-[#bf953f] transition-all">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold px-1">Total Harga (IDR)</label>
                        <input type="number" name="total_price" required placeholder="Contoh: 500000" class="bg-[#0d0e12] border border-white/10 rounded-lg p-3 text-xs text-white focus:outline-none focus:border-[#bf953f] transition-all">
                    </div>
                    <button type="submit" class="sm:col-span-2 mt-2 bg-gradient-to-r from-[#bf953f] to-[#d4a84c] text-black text-xs font-bold py-3.5 rounded-lg hover:brightness-110 tracking-[0.15em] uppercase transition-all duration-300 shadow-md">
                        Tambah
                    </button>
                </form>
            </div>
            
            <div class="bg-[#12141c] border border-white/5 p-6 rounded-xl shadow-xl flex flex-col justify-center items-center text-center">
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold">Total Pendapatan</p>
                <h3 class="font-luxury text-xl font-bold mt-2 tracking-wide">
                    <span class="gold-gradient">IDR <?= number_format($revenue ?? 0, 0, ',', '.') ?></span>
                </h3>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-[#12141c] rounded-xl border border-white/5 overflow-hidden shadow-xl">
            <div class="p-4 bg-[#0d0e12]/50 border-b border-white/5">
                <h3 class="font-luxury text-xs text-gray-400 uppercase tracking-wider font-bold">Daftar Transaksi</h3>
            </div>
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-[#0d0e12] border-b border-white/5 text-gray-500 tracking-wider text-[10px] uppercase font-semibold">
                        <th class="p-4">ID Transaksi</th>
                        <th class="p-4">User ID</th>
                        <th class="p-4">Total Harga</th>
                        <?php if ($role === 'admin'): ?><th class="p-4 text-center">Aksi</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    <?php if(!empty($data)): foreach ($data as $row): ?>
                    <tr class="hover:bg-white/[0.01] transition-colors duration-200">
                        <td class="p-4 text-white font-serif-luxury italic font-semibold tracking-wide text-sm">#RES-<?= $row['id'] ?></td>
                        <td class="p-4">
                            <span class="bg-[#0d0e12] border border-white/5 px-2.5 py-1 rounded-md text-gray-400 font-mono text-[11px]">
                                ID: <?= htmlspecialchars($row['user_id']) ?>
                            </span>
                        </td>
                        <td class="p-4 text-sm font-luxury font-bold tracking-wide">
                            <span class="gold-gradient">Rp <?= number_format($row['total_price'], 0, ',', '.') ?></span>
                        </td>
                        <?php if ($role === 'admin'): ?>
                        <td class="p-4 text-center text-xs">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="bg-blue-500/10 border border-blue-500/20 text-blue-400 p-2 rounded-md hover:bg-blue-500 hover:text-white transition-all mr-1.5" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="?aksi_hapus=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="bg-red-500/10 border border-red-500/20 text-red-400 p-2 rounded-md hover:bg-red-500 hover:text-white transition-all" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="<?= $role === 'admin' ? 4 : 3 ?>" class="p-8 text-center text-gray-600 italic font-light">Tidak ada data ditemukan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>