<?php
session_start();
include 'config.php';

$error_msg = ""; 

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = htmlspecialchars(trim($_POST['username']));
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$user, $pass, $role]);
        
        header("Location: login.php?status=success");
        exit();
    } catch (PDOException $e) {

        if ($e->getCode() == 23000) {
            $error_msg = "Username <b>'$user'</b> sudah dipakai, silakan pilih yang lain.";
        } else {
            $error_msg = "Terjadi kesalahan sistem: " . $e->getMessage();
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0d0e12; }
        .font-luxury { font-family: 'Marcellus', serif; }
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
        .animate-shake { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
    <title>Join Grand Hotel - Exclusive Access</title>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-8 overflow-x-hidden relative">

    <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-yellow-900/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-5xl bg-[#12141c]/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/5 overflow-hidden flex flex-col md:flex-row min-h-[80vh]">
        
        <div class="relative w-full md:w-1/2 min-h-[300px] md:min-h-full overflow-hidden flex items-center p-8 md:p-12">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1000" alt="Hotel Interior" class="absolute inset-0 w-full h-full object-cover opacity-30 grayscale contrast-125">
            <div class="absolute inset-0 bg-gradient-to-tr from-[#0d0e12] via-[#0d0e12]/70 to-transparent"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <span class="font-luxury text-xl font-bold tracking-widest gold-gradient">GRAND MIRAMA</span>
                </div>
        
                <h1 class="font-luxury text-4xl font-normal text-white leading-tight tracking-wide">
                    START YOUR <br> <span class="gold-gradient">JOURNEY</span> WITH US.
                </h1>
                <p class="text-gray-400 mt-4 text-sm font-light leading-relaxed max-w-sm">
                    Dapatkan akses eksklusif ke kamar terbaik, reservasi prioritas, dan layanan personal concierge bintang lima kami.
                </p>
        
                <div class="mt-10 flex gap-8">
                    <div>
                        <p class="font-luxury text-2xl text-white">5K+</p>
                        <p class="text-gray-500 text-[10px] uppercase tracking-widest mt-1">Happy Guests</p>
                    </div>
                    <div class="w-px h-8 bg-white/10"></div>
                    <div>
                        <p class="font-luxury text-2xl text-white">120+</p>
                        <p class="text-gray-500 text-[10px] uppercase tracking-widest mt-1">Luxury Rooms</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-6 md:p-16 flex flex-col justify-center bg-[#0d0e12]/40">
            <div class="max-w-sm mx-auto w-full animate-fade">
                <div class="mb-8">
                    <span class="text-[10px] font-semibold text-[#bf953f] uppercase tracking-[0.3em] block mb-1">Registrasi Anggota</span>
                    <h2 class="font-luxury text-3xl text-white tracking-wide">Create Account</h2>
                </div>

                <?php if ($error_msg): ?>
                    <div class="bg-red-950/30 border border-red-900/50 text-red-400 p-4 rounded-lg mb-6 text-xs flex items-center gap-3 backdrop-blur-sm animate-shake">
                        <i class="fas fa-exclamation-circle text-sm flex-shrink-0 text-red-500"></i>
                        <span class="font-medium"><?= $error_msg ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-5">
                    
                    <div class="group">
                        <label class="text-[10px] font-medium text-gray-500 uppercase tracking-[0.2em] ml-1 block mb-2 group-focus-within:text-[#bf953f] transition-colors">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 group-focus-within:text-[#bf953f] transition-colors">
                                <i class="fas fa-user text-xs"></i>
                            </span>
                            <input type="text" name="username" required 
                                class="w-full bg-[#12141c] border border-white/5 p-3.5 pl-11 rounded-lg focus:bg-[#12141c]/90 focus:border-[#bf953f]/50 text-white text-sm outline-none transition-all placeholder:text-gray-700" 
                                placeholder="Pilih nama pengguna">
                        </div>
                    </div>
                    
                    <div class="group">
                        <label class="text-[10px] font-medium text-gray-500 uppercase tracking-[0.2em] ml-1 block mb-2 group-focus-within:text-[#bf953f] transition-colors">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 group-focus-within:text-[#bf953f] transition-colors">
                                <i class="fas fa-lock text-xs"></i>
                            </span>
                            <input type="password" name="password" required 
                                class="w-full bg-[#12141c] border border-white/5 p-3.5 pl-11 rounded-lg focus:bg-[#12141c]/90 focus:border-[#bf953f]/50 text-white text-sm outline-none transition-all placeholder:text-gray-700" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-medium text-gray-500 uppercase tracking-[0.2em] ml-1 block mb-2 group-focus-within:text-[#bf953f] transition-colors">Account Role</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 group-focus-within:text-[#bf953f] transition-colors">
                                <i class="fas fa-user-tag text-xs"></i>
                            </span>
                            <select name="role" 
                                class="w-full bg-[#12141c] border border-white/5 p-3.5 pl-11 rounded-lg focus:bg-[#12141c]/90 focus:border-[#bf953f]/50 text-gray-300 text-sm outline-none font-medium cursor-pointer transition-all appearance-none">
                                <option value="user" class="bg-[#0d0e12] text-white">Tamu (Customer)</option>
                                <option value="admin" class="bg-[#0d0e12] text-white">Administrator</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray-600">
                                <i class="fas fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3">
                        <button type="submit" class="w-full bg-[#bf953f] hover:bg-[#b38728] text-[#0d0e12] py-3.5 rounded-lg font-bold text-xs uppercase tracking-[0.15em] transition duration-300 shadow-lg shadow-yellow-950/10">
                            Register Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-white/5 text-center">
                    <p class="text-gray-500 text-xs tracking-wide">
                        Sudah memiliki akun? 
                        <a href="login.php" class="text-[#bf953f] ml-1 font-medium hover:underline tracking-wide">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>