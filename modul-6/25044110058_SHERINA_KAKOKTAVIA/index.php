<?php
session_start();

$is_logged_in = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? 'user';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0d0e12; color: #e2e8f0; }
        .font-luxury { font-family: 'Marcellus', serif; }
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <title>Grand Mirama - Absolute Luxury</title>
</head>
<body class="antialiased">

    <nav class="fixed w-full z-50 px-6 md:px-12 py-5 flex justify-between items-center bg-[#0d0e12]/80 backdrop-blur-lg border-b border-white/5">
        <div class="flex items-center gap-3">
            <span class="font-luxury text-2xl font-bold tracking-widest gold-gradient">GRAND MIRAMA</span>
        </div>
        <div class="flex items-center gap-8 text-xs font-medium uppercase tracking-[0.2em] text-gray-400">
            <div class="hidden md:flex gap-10">
                <a href="#fasilitas" class="hover:text-[#bf953f] transition duration-300">Fasilitas</a>
                <a href="#kamar" class="hover:text-[#bf953f] transition duration-300">Kamar</a>
                <a href="#kontak" class="hover:text-[#bf953f] transition duration-300">Kontak</a>
            </div>
            
            <?php if ($is_logged_in): ?>
                <a href="dashboard.php" class="bg-[#bf953f]/10 border border-[#bf953f]/30 hover:bg-[#bf953f] text-[#bf953f] hover:text-black px-4 py-2 rounded text-[11px] font-semibold transition flex items-center gap-1.5 tracking-wider">
                    <i class="fas fa-th-large"></i> Ke Dashboard (<?= ucfirst($role) ?>)
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <header class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2070" alt="Hotel View" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0e12] via-[#0d0e12]/60 to-transparent"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 md:px-12 text-center space-y-8 max-w-4xl">
            <span class="text-xs font-semibold uppercase tracking-[0.4em] text-[#bf953f]">A New Standard of Elegance</span>
            <h1 class="font-luxury text-5xl md:text-7xl font-normal tracking-wide text-white leading-tight">
                CIPUTRA <br> <span class="gold-gradient">WORLD SURABAYA</span>
            </h1>
            <p class="text-gray-400 text-sm md:text-base max-w-2xl mx-auto font-light leading-relaxed">
                Temukan kemewahan mutlak di jantung kota. Perpaduan sempurna antara desain modern yang megah, fasilitas kelas dunia, dan pelayanan personal yang tulus.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center">
                <a href="<?= $is_logged_in ? 'dashboard.php' : 'login.php' ?>" class="px-8 py-4 bg-gradient-to-r from-[#bf953f] via-[#b38728] to-[#aa771c] text-[#0d0e12] font-bold text-xs uppercase tracking-[0.15em] rounded-md hover:opacity-90 transition shadow-lg shadow-yellow-900/20">
                    <?= $is_logged_in ? 'BUKA DASHBOARD ANDA' : 'BOOKING SEKARANG' ?>
                </a>
                
                <?php if (!$is_logged_in): ?>
                <a href="register.php" class="px-8 py-4 border border-white/10 text-white font-bold text-xs uppercase tracking-[0.15em] rounded-md hover:bg-white/5 hover:border-white/30 transition">
                    DAFTAR AKUN
                </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <section id="fasilitas" class="py-28 bg-[#090a0d] border-t border-white/5">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center max-w-md mx-auto mb-20 space-y-3">
                <h2 class="font-luxury text-3xl text-white tracking-wide">Fasilitas Kelas Dunia</h2>
                <div class="w-10 h-[2px] bg-[#bf953f] mx-auto"></div>
                <p class="text-gray-500 text-xs font-light">Dirancang khusus demi kenyamanan maksimal Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#12141c] rounded-xl overflow-hidden border border-white/5 group hover:border-[#bf953f]/30 transition duration-500">
                    <div class="h-52 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Pool">
                    </div>
                    <div class="p-6 space-y-2">
                        <h3 class="font-luxury text-xl text-white">Infinity Pool</h3>
                        <p class="text-gray-400 text-xs font-light leading-relaxed">Nikmati kesegaran air kolam renang sembari memandang panorama gemerlap lampu kota.</p>
                    </div>
                </div>

                <div class="bg-[#12141c] rounded-xl overflow-hidden border border-white/5 group hover:border-[#bf953f]/30 transition duration-500">
                    <div class="h-52 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Restaurant">
                    </div>
                    <div class="p-6 space-y-2">
                        <h3 class="font-luxury text-xl text-white">Sky Lounge & Bar</h3>
                        <p class="text-gray-400 text-xs font-light leading-relaxed">Sajian kuliner mewah dari koki internasional berpadu dengan atmosfer malam yang intim.</p>
                    </div>
                </div>

                <div class="bg-[#12141c] rounded-xl overflow-hidden border border-white/5 group hover:border-[#bf953f]/30 transition duration-500">
                    <div class="h-52 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Gym">
                    </div>
                    <div class="p-6 space-y-2">
                        <h3 class="font-luxury text-xl text-white">Wellness Center</h3>
                        <p class="text-gray-400 text-xs font-light leading-relaxed">Pusat kebugaran eksklusif dengan alat modern terstandar serta layanan pijat relaksasi tubuh.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kamar" class="py-28 bg-[#0d0e12]">
        <div class="container mx-auto px-6 md:px-12">
            <div class="mb-16 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-white/5 pb-6">
                <div>
                    <span class="text-xs font-semibold text-[#bf953f] uppercase tracking-widest">Our Sanctuaries</span>
                    <h2 class="font-luxury text-3xl text-white tracking-wide mt-1">Kamar & Suite Eksklusif</h2>
                </div>
                <p class="text-gray-500 text-xs max-w-xs font-light">Setiap kamar dilengkapi kasur premium berbalut katun sutra alami untuk tidur ternyaman Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#12141c] rounded-xl border border-white/5 overflow-hidden flex flex-col justify-between hover:border-[#bf953f]/30 transition duration-500">
                    <div>
                        <div class="h-52 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=800" class="w-full h-full object-cover" alt="Standard Room">
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-baseline">
                                <h3 class="font-luxury text-xl text-white">Standard Room</h3>
                                <span class="text-[#bf953f] text-xs font-semibold">IDR 500k / malam</span>
                            </div>
                            <p class="text-gray-400 text-xs font-light leading-relaxed">Kamar bergaya minimalis modern dengan penataan ruang efisien dan pemandangan jendela yang asri.</p>
                            <div class="flex flex-wrap gap-2 text-[10px] text-gray-500 font-semibold tracking-wider">
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="<?= $is_logged_in ? 'dashboard.php' : 'login.php' ?>" class="block text-center py-3 bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] font-bold text-xs uppercase tracking-wider rounded transition">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="bg-[#12141c] rounded-xl border border-white/5 overflow-hidden flex flex-col justify-between hover:border-[#bf953f]/30 transition duration-500">
                    <div>
                        <div class="h-52 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?q=80&w=800" class="w-full h-full object-cover" alt="Deluxe Suite">
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-baseline">
                                <h3 class="font-luxury text-xl text-white">Deluxe Suite</h3>
                                <span class="text-[#bf953f] text-xs font-semibold">IDR 1.5jt / malam</span>
                            </div>
                            <p class="text-gray-400 text-xs font-light leading-relaxed">Fasilitas ruang bersantai komunal terpisah, bar mini privat, serta kamar mandi berlapis marmer mewah.</p>
                            <div class="flex flex-wrap gap-2 text-[10px] text-gray-500 font-semibold tracking-wider">
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="<?= $is_logged_in ? 'dashboard.php' : 'login.php' ?>" class="block text-center py-3 bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] font-bold text-xs uppercase tracking-wider rounded transition">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="bg-[#12141c] rounded-xl border border-white/5 overflow-hidden flex flex-col justify-between hover:border-[#bf953f]/30 transition duration-500">
                    <div>
                        <div class="h-52 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800" class="w-full h-full object-cover" alt="Presidential">
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-baseline">
                                <h3 class="font-luxury text-xl text-white">Presidential</h3>
                                <span class="text-[#bf953f] text-xs font-semibold">IDR 2.2jt / malam</span>
                            </div>
                            <p class="text-gray-400 text-xs font-light leading-relaxed">Kemewahan kasta tertinggi dengan bak jacuzzi privat, ruang makan formal, dan layanan asisten pribadi 24 jam.</p>
                            <div class="flex flex-wrap gap-2 text-[10px] text-gray-500 font-semibold tracking-wider">
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="<?= $is_logged_in ? 'dashboard.php' : 'login.php' ?>" class="block text-center py-3 bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] font-bold text-xs uppercase tracking-wider rounded transition">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="py-24 bg-[#090a0d] border-t border-white/5">
        <div class="container mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-16">
            <div class="lg:col-span-5 space-y-4">
                <h2 class="font-luxury text-4xl text-white tracking-wide">Hubungi Layanan Concierge.</h2>
                <p class="text-gray-500 text-xs font-light leading-relaxed">Butuh bantuan reservasi khusus atau pengaturan acara privat? Tim resepsionis kami siap melayani Anda sepanjang waktu.</p>
                <div class="space-y-2 pt-4 text-xs font-medium text-gray-400">
                    <p><strong class="text-white">Alamat:</strong> Jl.Raya Darmo 68-78,Tegalsari,Surabaya,Jawa Timur,Indonesia</p>
                    <p><strong class="text-white">WhatsApp:</strong> <span class="text-[#bf953f]">+62 819 3644 6278</span></p>
                </div>
            </div>

            <div class="lg:col-span-7">
                <form action="#" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="text" placeholder="Nama Lengkap" class="w-full px-4 py-3.5 bg-[#12141c] border border-white/5 rounded text-xs text-white placeholder-gray-600 focus:outline-none focus:border-[#bf953f] transition">
                        <input type="email" placeholder="Alamat Email" class="w-full px-4 py-3.5 bg-[#12141c] border border-white/5 rounded text-xs text-white placeholder-gray-600 focus:outline-none focus:border-[#bf953f] transition">
                    </div>
                    <textarea placeholder="Tulis pesan Anda di sini..." rows="4" class="w-full px-4 py-3.5 bg-[#12141c] border border-white/5 rounded text-xs text-white placeholder-gray-600 focus:outline-none focus:border-[#bf953f] transition"></textarea>
                    <button class="px-6 py-3.5 bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] font-bold text-xs uppercase tracking-wider rounded transition w-full sm:w-auto">Kirim Pesan</button>
                </form>
            </div>
        </div>
        
        <div class="container mx-auto mt-24 pt-8 border-t border-white/5 text-center text-gray-600 text-[11px] tracking-wider">
            &copy; 2026 Grand Hotel Ciputra World. Elegance Reimagined.
        </div>
    </footer>

</body>
</html>