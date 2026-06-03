<?php
session_start();
$role = $_SESSION['role'] ?? 'user';
$customer_name = $_SESSION['username'] ?? 'Pelanggan Setia';

if ($role === 'admin') {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();
    header("Location: login.php");
    exit();
}

$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Grand Mirama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0d0e12; }
        .font-luxury { font-family: 'Marcellus', serif; }
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes subtleScale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }
        .animate-subtle { animation: subtleScale 6s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 overflow-x-hidden relative">

    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[450px] h-[450px] bg-yellow-900/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="bg-[#12141c]/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/5 max-w-xl w-full p-8 md:p-12 text-center relative overflow-hidden">
        
        <div class="relative z-10">

            <div class="w-20 h-20 bg-gradient-to-br from-[#bf953f] via-[#b38728] to-[#aa771c] text-[#0d0e12] rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-yellow-950/20 animate-subtle">
                <i class="fas fa-concierge-bell text-3xl"></i>
            </div>

            <span class="text-[10px] font-semibold tracking-[0.3em] text-[#bf953f] uppercase bg-[#bf953f]/10 px-4 py-1 rounded-full inline-block mb-4">
                Check-out Berhasil
            </span>

            <h2 class="font-luxury text-3xl md:text-4xl text-white mb-4 tracking-wide">
                Sampai Jumpa, <br><span class="gold-gradient"><?= htmlspecialchars($customer_name) ?></span>
            </h2>
            
            <div class="w-12 h-[1px] bg-white/10 mx-auto my-5"></div>

            <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-sm mx-auto mb-8 font-light">
                Terima kasih telah memercayakan kenyamanan istirahat Anda di <span class="font-normal text-white font-luxury tracking-wide">GRAND MIRAMA</span>. Pintu kami selalu terbuka menyambut kepulangan Anda berikutnya.
            </p>

            <div class="bg-[#0d0e12]/50 border border-white/5 rounded-xl p-5 mb-8 text-center backdrop-blur-sm">
                <p class="text-[10px] font-medium text-gray-500 uppercase tracking-[0.15em] mb-3">Bagaimana Pengalaman Anda?</p>
                <div class="flex justify-center text-xl text-gray-700 space-x-2">
                    <i class="fas fa-star cursor-pointer text-[#bf953f] hover:text-[#fcf6ba] transition transform hover:scale-110"></i>
                    <i class="fas fa-star cursor-pointer text-[#bf953f] hover:text-[#fcf6ba] transition transform hover:scale-110"></i>
                    <i class="fas fa-star cursor-pointer text-[#bf953f] hover:text-[#fcf6ba] transition transform hover:scale-110"></i>
                    <i class="fas fa-star cursor-pointer text-[#bf953f] hover:text-[#fcf6ba] transition transform hover:scale-110"></i>
                    <i class="fas fa-star cursor-pointer text-[#bf953f] hover:text-[#fcf6ba] transition transform hover:scale-110"></i>
                </div>
                <p class="text-[10px] text-gray-600 mt-2 italic">Ketuk bintang untuk menilai pelayanan concierge kami</p>
            </div>

            <div class="space-y-4">
                <a href="login.php" class="block w-full bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] font-bold py-3.5 rounded-lg text-xs uppercase tracking-[0.15em] transition duration-300 shadow-lg shadow-yellow-950/10">
                    <i class="fas fa-sign-in-alt mr-2"></i> Kembali ke Login
                </a>
                
                <p class="text-xs text-gray-500">
                    Ingin merencanakan kunjungan lagi? 
                    <a href="login.php" class="text-[#bf953f] font-medium hover:underline ml-1">
                        Reservasi Kamar
                    </a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>