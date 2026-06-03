<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    die("Akses ditolak. Hanya untuk Admin.");
}

$id = $_GET['id'] ?? null;
if (!$id) { 
    header("Location: dashboard.php"); 
    exit; 
}

$stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) { 
    header("Location: dashboard.php"); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['user_id'] ?? '');
    $total_price = trim($_POST['total_price'] ?? '');

    if ($user_id !== '' && $total_price !== '') {
        try {
            $pdo->exec("SET sql_mode = ''");
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

            $stmt_update = $pdo->prepare("UPDATE reservations SET user_id = ?, total_price = ? WHERE id = ?");
            $stmt_update->execute([$user_id, $total_price, $id]);
            
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

            header("Location: dashboard.php?status=sukses");
            exit;
        } catch (PDOException $e) {
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
            die("Gagal memperbarui data database: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Reservasi - Grand Mirama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #0d0e12; 
        }
        .font-luxury { 
            font-family: 'Marcellus', serif; 
        }
    </style>
</head>
<body class="min-h-screen text-gray-200 flex items-center justify-center p-4">
    <div class="bg-[#12141c]/50 backdrop-blur-xl p-8 rounded-2xl border border-white/5 w-full max-w-md shadow-2xl">
        <h2 class="font-luxury text-lg text-white tracking-widest text-center mb-1">KOREKSI DATA</h2>
        <p class="text-[9px] uppercase tracking-widest text-gray-500 text-center mb-6">ID Log: #RES-<?= $row['id'] ?></p>

        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 font-medium px-1">User ID (ID Tamu)</label>
                <input type="number" name="user_id" value="<?= htmlspecialchars($row['user_id']) ?>" required class="w-full bg-[#0d0e12] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-[#bf953f] transition-all">
            </div>
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 font-medium px-1">Total Harga (IDR)</label>
                <input type="number" name="total_price" value="<?= htmlspecialchars($row['total_price']) ?>" required class="w-full bg-[#0d0e12] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-[#bf953f] transition-all">
            </div>
            <div class="flex gap-4 pt-2">
                <a href="dashboard.php" class="w-1/2 text-center border border-white/10 text-gray-400 py-3 rounded-lg text-xs uppercase tracking-wider hover:bg-white/5 transition duration-200">Batal</a>
                <button type="submit" class="w-1/2 bg-[#bf953f] text-black font-semibold py-3 rounded-lg text-xs uppercase tracking-wider hover:brightness-110 transition duration-200 shadow-md">Perbarui</button>
            </div>
        </form>
    </div>
</body>
</html>