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
    $customer_name = $_SESSION['username'] ?? 'Tamu';
    $room_type = $_POST['room_type'] ?? 'Standard';
    $check_in = $_POST['check_in'] ?? date('Y-m-d');
    $duration = (int)($_POST['duration'] ?? 1);

    $prices = ['Standard room' => 500000, 'Deluxe suite' => 1500000, 'Presidential' => 2200000];
    $total_price = ($prices[$room_type] ?? 500000) * $duration;

    try {
        $pdo->exec("SET sql_mode = ''"); 
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
        $sql = "INSERT INTO reservations (user_id, customer_name, room_type, check_in, duration_nights, total_price) VALUES (?, ?, ?, ?, ?, ?)";
        $pdo->prepare($sql)->execute([$user_id, $customer_name, $room_type, $check_in, $duration, $total_price]);
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

        header("Location: " . $_SERVER['PHP_SELF'] . "?status=booked");
        exit();
    } catch (PDOException $e) {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        header("Location: " . $_SERVER['PHP_SELF'] . "?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$my_reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="font-luxury text-lg font-bold tracking-[0.2em] bg-gradient-to-r from-[#bf953f] to-[#fbf5b7] bg-clip-text text-transparent">GRAND MIRAMA</h1>
            <a href="logout.php" class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-2 rounded-lg text-xs font-bold tracking-widest uppercase hover:bg-red-500 hover:text-white transition-all duration-300">KELUAR</a>
        </nav>

        <?php if (isset($_GET['status'])): ?>
            <div class="mb-6 p-4 rounded-xl border text-xs bg-gray-900 border-white/10 font-mono <?= $_GET['status'] === 'booked' ? 'text-green-400' : 'text-red-400' ?>">
                <?= $_GET['status'] === 'booked' ? '✓ Reservasi berhasil disimpan!' : '✗ Gagal: ' . htmlspecialchars($_GET['msg'] ?? '') ?>
            </div>
        <?php endif; ?>

        <div class="bg-[#12141c] p-6 rounded-xl border border-white/5 mb-6 shadow-xl">
            <h3 class="font-luxury text-xs text-white/80 mb-5 uppercase tracking-[0.15em] font-bold flex items-center gap-2">
                <span class="w-1.5 h-3 bg-[#bf953f] rounded-full"></span> Buat Reservasi Baru
            </h3>
            
            <form method="POST" action="" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="hidden" name="action" value="tambah">
                
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold px-1">Tipe Kamar</label>
                    <select name="room_type" required class="bg-[#0d0e12] border border-white/10 rounded-lg p-3 text-xs text-gray-300 focus:outline-none focus:border-[#bf953f] cursor-pointer transition-all">
                        <option value="Standard">Standard Room (Rp 500.000)</option>
                        <option value="Deluxe">Deluxe suite (Rp 1.500.000)</option>
                        <option value="Suite">Presidential (Rp 2.500.000)</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold px-1">Check-In</label>
                    <input type="date" name="check_in" required class="bg-[#0d0e12] border border-white/10 rounded-lg p-3 text-xs text-gray-300 focus:outline-none focus:border-[#bf953f] cursor-pointer transition-all">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold px-1">Durasi</label>
                    <input type="number" name="duration" min="1" value="1" required class="bg-[#0d0e12] border border-white/10 rounded-lg p-3 text-xs text-gray-300 focus:outline-none focus:border-[#bf953f] transition-all" placeholder="Malam">
                </div>
                <button type="submit" class="md:col-span-3 mt-2 bg-gradient-to-r from-[#bf953f] to-[#d4a84c] text-black text-xs font-bold py-4 rounded-lg hover:brightness-110 tracking-[0.15em] uppercase transition-all duration-300 shadow-md">
                    Konfirmasi Pesanan Sekarang
                </button>
            </form>
        </div>

        <div class="bg-[#12141c] rounded-xl border border-white/5 overflow-hidden shadow-xl">
            <div class="p-4 bg-[#0d0e12]/50 border-b border-white/5">
                <h3 class="font-luxury text-xs text-gray-400 uppercase tracking-wider font-bold">Riwayat Transaksi</h3>
            </div>
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-[#0d0e12] border-b border-white/5 text-gray-500 tracking-wider text-[10px] uppercase font-semibold">
                        <th class="p-4">Kode Booking</th>
                        <th class="p-4">Detail Kamar</th>
                        <th class="p-4">Check-In</th>
                        <th class="p-4">Durasi</th>
                        <th class="p-4">Total Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    <?php if(!empty($my_reservations)): foreach ($my_reservations as $row): ?>
                    <tr class="hover:bg-white/[0.01] transition-colors duration-200">
                        <td class="p-4 text-white font-luxury font-semibold tracking-wide text-sm">#Res-<?= $row['id'] ?></td>
                        <td class="p-4 text-gray-300 font-medium"><?= htmlspecialchars($row['room_type'] ?? 'Standard') ?> Room</td>
                        <td class="p-4 text-gray-400 font-light"><?= htmlspecialchars($row['check_in'] ?? '-') ?></td>
                        <td class="p-4 text-gray-400 font-light"><?= htmlspecialchars($row['duration_nights'] ?? '1') ?> Malam</td>
                        <td class="p-4 text-sm font-luxury font-bold tracking-wide">
                            <span class="gold-gradient">Rp <?= number_format($row['total_price'] ?? 0, 0, ',', '.') ?></span>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5" class="p-8 text-center text-gray-600 italic font-light">Anda belum memiliki riwayat pemesanan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>