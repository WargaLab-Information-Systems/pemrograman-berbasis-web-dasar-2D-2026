<?php
include 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    if (($_SESSION['role'] ?? '') === 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_user.php");
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $u = $stmt->fetch();
    
    if ($u && password_verify($pass, $u['password'])) {
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['username'] = $u['username'];
        $_SESSION['role'] = $u['role']; 
        
        if ($u['role'] === 'admin') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_user.php");
        }
        exit();
    } else { 
        $error = "Kombinasi Username/Password salah!"; 
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0d0e12; }
        .font-luxury { font-family: 'Marcellus', serif; }
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
    <title>Welcome Back - Grand Mirama</title>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-8 overflow-x-hidden relative">

    <div class="absolute top-1/4 left-1/3 w-[500px] h-[500px] bg-yellow-900/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-5xl bg-[#12141c]/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/5 overflow-hidden flex flex-col md:flex-row-reverse min-h-[80vh]">
        
        <div class="relative w-full md:w-1/2 min-h-[300px] md:min-h-full overflow-hidden flex items-end p-8 md:p-12">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070" alt="Luxury Hotel" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale contrast-125">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0e12] via-[#0d0e12]/50 to-transparent"></div>
            
            <div class="relative z-10 w-full">
                <div class="flex items-center gap-3 mb-6">
                    <span class="font-luxury text-xl font-bold tracking-widest gold-gradient">GRAND MIRAMA</span>
                </div>
                <h1 class="font-luxury text-4xl font-normal text-white leading-tight tracking-wide">
                    CIPUTRA <br> <span class="gold-gradient">WORLD</span>
                </h1>
                <p class="text-gray-400 mt-3 text-sm font-light leading-relaxed max-w-xs">
                    Kembali ke tempat peristirahatan eksklusif Anda di pusat kota.
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-6 md:p-16 flex flex-col justify-center bg-[#0d0e12]/40">
            <div class="max-w-sm mx-auto w-full animate-fade">
                
                <div class="mb-8">
                    <span class="text-[10px] font-semibold text-[#bf953f] uppercase tracking-[0.3em] block mb-1">Portal Eksklusif</span>
                    <h2 class="font-luxury text-3xl text-white tracking-wide">Sign In</h2>
                </div>

                <?php if(isset($error)): ?>
                    <div class="bg-red-950/30 border border-red-900/50 text-red-400 p-4 rounded-lg mb-6 text-xs flex items-center gap-3 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium"><?= $error ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-5">
                    
                    <div class="group">
                        <label class="text-[10px] font-medium text-gray-500 uppercase tracking-[0.2em] ml-1 block mb-2 group-focus-within:text-[#bf953f] transition-colors">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 group-focus-within:text-[#bf953f] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </span>
                            <input type="text" name="username" required 
                                class="w-full bg-[#12141c] border border-white/5 p-3.5 pl-11 rounded-lg focus:bg-[#12141c]/90 focus:border-[#bf953f]/50 text-white text-sm outline-none transition-all placeholder:text-gray-700" 
                                placeholder="Masukkan username">
                        </div>
                    </div>
                    
                    <div class="group">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-[10px] font-medium text-gray-500 uppercase tracking-[0.2em] ml-1 block group-focus-within:text-[#bf953f] transition-colors">Password</label>
                            <a href="#" class="text-[10px] font-medium text-[#bf953f] hover:underline uppercase tracking-wider">Lupa?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 group-focus-within:text-[#bf953f] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 118 0v4" /></svg>
                            </span>
                            <input type="password" name="password" required 
                                class="w-full bg-[#12141c] border border-white/5 p-3.5 pl-11 rounded-lg focus:bg-[#12141c]/90 focus:border-[#bf953f]/50 text-white text-sm outline-none transition-all placeholder:text-gray-700" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="pt-3 space-y-3">
                        <button type="submit" class="w-full bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] py-3.5 rounded-lg font-bold text-xs uppercase tracking-[0.15em] transition duration-300 shadow-lg shadow-yellow-950/10">
                            Masuk Sekarang
                        </button>

                        <div class="flex items-center py-2 justify-between">
                            <div class="w-full h-[1px] bg-white/5"></div>
                            <span class="text-[9px] font-medium text-gray-600 uppercase tracking-widest px-3 shrink-0">Atau</span>
                            <div class="w-full h-[1px] bg-white/5"></div>
                        </div>

                        <a href="register.php" class="block w-full text-center bg-transparent border border-white/10 hover:border-white/20 text-gray-300 py-3.5 rounded-lg font-semibold text-xs uppercase tracking-[0.15em] transition duration-300">
                            Daftar Akun Baru
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>