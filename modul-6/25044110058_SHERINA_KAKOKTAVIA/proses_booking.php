<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_id = $_SESSION['user_id'];
    $customer_name = $_SESSION['username'];
    $room_type = $_POST['room_type'];
    $check_in = $_POST['check_in'];
    $duration = (int)$_POST['duration'];

    $prices = [
        'Standard' => 500000, 
        'Deluxe'   => 1500000, 
        'Suite'    => 2500000
    ];
    
    $total_price = ($prices[$room_type] ?? 500000) * $duration;

    try {
        $sql = "INSERT INTO reservations (user_id, customer_name, room_type, check_in, duration_nights, total_price) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $customer_name, $room_type, $check_in, $duration, $total_price]);

        header("Location: dashboard.php?status=booked");
        exit();

    } catch (PDOException $e) {
        $error_message = urlencode("Gagal menyimpan reservasi. Sistem mendeteksi: " . $e->getMessage());
        header("Location: dashboard.php?status=error&msg=" . $error_message);
        exit();
    }
}

$user_id = $_SESSION['user_id'];
$stmt_history = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY id DESC");
$stmt_history->execute([$user_id]);
$my_reservations = $stmt_history->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Grand Mirama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0d0e12; }
        .font-luxury { font-family: 'Marcellus', serif; }
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen text-gray-200 overflow-x-hidden relative">

    <nav class="bg-[#12141c]/60 backdrop-blur-xl border-b border-white/5 px-6 py-5 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="font-luxury text-xl font-bold tracking-widest text-[#bf953f]">
                GRAND MIRAMA
            </h1>
            <div class="flex items-center gap-6">
                <span class="text-gray-400 text-sm font-light">Selamat datang, <span class="font-semibold text-white"><?= htmlspecialchars($_SESSION['username'] ?? 'Saya') ?></span></span>
                <a href="logout.php" class="bg-red-950/20 text-red-400 border border-red-900/30 px-4 py-2 rounded-lg font-medium hover:bg-red-900 hover:text-white transition duration-300 text-xs uppercase tracking-wider">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10 max-w-6xl">
        
        <?php if (isset($_GET['status']) && $_GET['status'] === 'booked'): ?>
            <div class="mb-6 p-4 bg-emerald-950/30 border border-emerald-900/40 text-emerald-400 rounded-xl text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> Reservasi Anda berhasil disimpan! Silakan cek riwayat pesanan di bawah.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
            <div class="mb-6 p-4 bg-red-950/30 border border-red-900/40 text-red-400 rounded-xl text-sm flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['msg'] ?? 'Terjadi kesalahan sistem.') ?>
            </div>
        <?php endif; ?>

        <div class="bg-[#12141c]/50 backdrop-blur-xl p-6 md:p-8 rounded-2xl shadow-xl border border-white/5 mb-10">
            <h2 class="font-luxury text-base text-white tracking-wider flex items-center gap-2 mb-6 uppercase">
                <i class="fas fa-bookmark text-[#bf953f] text-sm"></i> Buat Reservasi Baru
            </h2>

            <form method="POST" action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-2">Tipe Kamar</label>
                        <div class="relative">
                            <i class="fas fa-bed absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                            <select name="room_type" required class="w-full bg-[#0d0e12] border border-white/10 rounded-xl pl-11 pr-4 py-3.5 text-sm text-gray-300 focus:outline-none focus:border-[#bf953f] appearance-none cursor-pointer">
                                <option value="Standard">Standard Room (Rp 500.000 / malam)</option>
                                <option value="Deluxe">Deluxe Room (Rp 1.500.000 / malam)</option>
                                <option value="Suite">Suite Room (Rp 2.500.000 / malam)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-2">Tanggal Check-In</label>
                        <div class="relative">
                            <input type="date" name="check_in" required class="w-full bg-[#0d0e12] border border-white/10 rounded-xl px-4 py-3 text-sm text-gray-300 focus:outline-none focus:border-[#bf953f] cursor-pointer">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-2">Durasi (Malam)</label>
                        <div class="relative">
                            <i class="fas fa-moon absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                            <input type="number" name="duration" min="1" value="1" required class="w-full bg-[#0d0e12] border border-white/10 rounded-xl pl-11 pr-4 py-3 text-sm text-gray-300 focus:outline-none focus:border-[#bf953f]">
                        </div>
                    </div>

                </div>

                <button type="submit" class="w-full bg-[#bf953f] hover:bg-[#a67c33] text-black font-semibold uppercase tracking-wider py-4 rounded-xl text-xs transition duration-300 shadow-lg cursor-pointer">
                    Konfirmasi Pesanan Sekarang
                </button>
            </form>
        </div>

        <div class="bg-[#12141c]/40 backdrop-blur-xl rounded-2xl shadow-xl border border-white/5 overflow-hidden">
            <div class="p-6 md:p-8 bg-[#12141c]/80 border-b border-white/5 flex justify-between items-center">
                <h2 class="font-luxury text-base text-white tracking-wider uppercase">Riwayat Pesanan Anda</h2>
                <span class="bg-[#bf953f]/10 border border-[#bf953f]/20 text-[#bf953f] text-[10px] font-semibold px-3 py-1 rounded-md uppercase tracking-wider">
                    <?= count($my_reservations) ?> Transaksi
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#0d0e12]/80 border-b border-white/5">
                            <th class="px-6 py-4.5 text-[9px] font-semibold text-gray-500 uppercase tracking-widest">Kode Booking</th>
                            <th class="px-6 py-4.5 text-[9px] font-semibold text-gray-500 uppercase tracking-widest">Detail Kamar</th>
                            <th class="px-6 py-4.5 text-[9px] font-semibold text-gray-500 uppercase tracking-widest">Tanggal Check-In</th>
                            <th class="px-6 py-4.5 text-[9px] font-semibold text-gray-500 uppercase tracking-widest">Durasi</th>
                            <th class="px-6 py-4.5 text-[9px] font-semibold text-gray-500 uppercase tracking-widest">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.03]">
                        <?php if(!empty($my_reservations)): ?>
                            <?php foreach ($my_reservations as $row): ?>
                            <tr class="hover:bg-white/[0.01] transition duration-300">
                                <td class="px-6 py-5 font-luxury text-sm text-white tracking-wider">#GM-<?= $row['id'] ?></td>
                                <td class="px-6 py-5 text-sm font-medium text-gray-300"><?= htmlspecialchars($row['room_type']) ?> Room</td>
                                <td class="px-6 py-5 text-sm text-gray-400"><?= htmlspecialchars($row['check_in']) ?></td>
                                <td class="px-6 py-5 text-sm text-gray-400"><?= htmlspecialchars($row['duration_nights']) ?> Malam</td>
                                <td class="px-6 py-5 font-luxury text-sm gold-gradient tracking-wide">
                                    IDR <?= number_format($row['total_price'], 0, ',', '.') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-16 text-center text-gray-600 italic text-sm font-light tracking-wide">
                                <i class="fas fa-history text-3xl block mb-4 text-gray-700"></i>
                                Anda belum memiliki riwayat pemesanan kamar di Grand Mirama.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>