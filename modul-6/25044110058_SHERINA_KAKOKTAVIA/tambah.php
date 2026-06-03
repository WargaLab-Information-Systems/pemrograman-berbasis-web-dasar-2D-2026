<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once 'config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['user_id'] ?? '');
    $total_price = trim($_POST['total_price'] ?? '');
    $customer_name = trim($_POST['customer_name'] ?? ''); 
    
    if ($user_id !== '' && $total_price !== '' && $customer_name !== '') {
        try {
            $stmt = $pdo->prepare("INSERT INTO reservations (user_id, total_price, customer_name) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $total_price, $customer_name]);
            
            header("Location: dashboard.php");
            exit;
        } catch (PDOException $e) {
            $message = "Gagal menyimpan data: " . $e->getMessage();
        }
    } else {
        $message = "Semua kolom wajib diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Berkas Baru - Grand Mirama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0d0e12; }</style>
</head>
<body class="min-h-screen text-gray-200 flex items-center justify-center p-4">
    <div class="bg-[#12141c]/50 backdrop-blur-xl p-8 rounded-2xl border border-white/5 w-full max-w-md">
        <h2 class="font-luxury text-lg text-white tracking-widest text-center mb-6">REGISTRASI DATA LOG BARU</h2>
        
        <?php if ($message): ?>
            <div class="bg-red-950/30 border border-red-900/40 text-red-400 p-3 rounded-xl text-xs text-center mb-4"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 font-medium">ID Klien / Tamu</label>
                <input type="text" name="user_id" required class="w-full bg-[#0d0e12] border border-white/10 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#bf953f] text-white">
            </div>
            
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 font-medium">Nama Lengkap Tamu</label>
                <input type="text" name="customer_name" required placeholder="Contoh: John Doe" class="w-full bg-[#0d0e12] border border-white/10 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#bf953f] text-white">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 font-medium">Nilai Nominal Transaksi</label>
                <input type="number" name="total_price" required class="w-full bg-[#0d0e12] border border-white/10 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#bf953f] text-white">
            </div>
            
            <div class="flex gap-4 pt-2">
                <a href="dashboard.php" class="w-1/2 text-center border border-white/10 text-gray-400 py-3 rounded-lg text-xs uppercase tracking-wider hover:bg-white/5 transition">Batal</a>
                <button type="submit" class="w-1/2 bg-[#bf953f] text-black font-semibold py-3 rounded-lg text-xs uppercase tracking-wider hover:bg-[#d4a84c] transition">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>