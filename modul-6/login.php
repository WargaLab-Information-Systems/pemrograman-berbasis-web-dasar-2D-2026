<?php
// login.php — Halaman Login & Registrasi

session_start();
require_once 'koneksi.php';

// Sudah login? langsung ke halaman utama
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error   = '';
$success = '';
$tab     = $_GET['tab'] ?? 'login'; // 'login' | 'register'

// ── Handle POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // ── LOGIN 
    if ($action === 'login') {
        $username_input = trim($_POST['username'] ?? '');
        $password_input = $_POST['password'] ?? '';

        if ($username_input === '' || $password_input === '') {
            $error = 'Username dan password wajib diisi.';
        } else {
            // Prepared statement — sesuai ketentuan modul
            $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param('s', $username_input);
            $stmt->execute();
            $result = $stmt->get_result();
            $user   = $result->fetch_assoc();
            $stmt->close();

            // Verifikasi password hash (sesuai modul: password_verify)
            if ($user && password_verify($password_input, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];
                header("Location: index.php");
                exit;
            } else {
                // Pesan generik agar penyerang tidak tahu username mana yang valid
                $error = 'Username atau password salah.';
            }
        }
        $tab = 'login';
    }

    // ── REGISTER 
    if ($action === 'register') {
        $reg_username = trim($_POST['reg_username'] ?? '');
        $reg_password = $_POST['reg_password'] ?? '';
        $reg_confirm  = $_POST['reg_confirm']  ?? '';

        // Validasi sisi server
        if ($reg_username === '' || $reg_password === '' || $reg_confirm === '') {
            $error = 'Semua kolom wajib diisi.';
        } elseif (strlen($reg_username) < 3) {
            $error = 'Username minimal 3 karakter.';
        } elseif (strlen($reg_password) < 6) {
            $error = 'Password minimal 6 karakter.';
        } elseif ($reg_password !== $reg_confirm) {
            $error = 'Konfirmasi password tidak cocok.';
        } else {
            // Cek duplikasi username — prepared statement
            $chk = $conn->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
            $chk->bind_param('s', $reg_username);
            $chk->execute();
            $chk->store_result();

            if ($chk->num_rows > 0) {
                $error = 'Username sudah digunakan.';
            } else {
                // Hash password sebelum disimpan (sesuai modul: PASSWORD_DEFAULT)
                $hash = password_hash($reg_password, PASSWORD_DEFAULT);
                $ins  = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
                $ins->bind_param('ss', $reg_username, $hash);
                $ins->execute();
                $ins->close();
                $success = 'Registrasi berhasil! Silakan login.';
                $tab = 'login';
            }
            $chk->close();
        }
        if ($error) $tab = 'register';
    }
}

// Helper output aman
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SIDATA Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f2744 100%); }
        .glass-card  { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); }
        .input-field { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); color: #fff; transition: all .2s; }
        .input-field::placeholder { color: rgba(255,255,255,0.35); }
        .input-field:focus { outline: none; background: rgba(255,255,255,0.1); border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56,189,248,.15); }
        .tab-active   { border-bottom: 2px solid #38bdf8; color: #38bdf8; }
        .tab-inactive { color: rgba(255,255,255,0.45); border-bottom: 2px solid transparent; }
        .btn-primary  { background: linear-gradient(135deg,#0ea5e9,#2563eb); transition: all .2s; }
        .btn-primary:hover { background: linear-gradient(135deg,#38bdf8,#3b82f6); transform: translateY(-1px); box-shadow: 0 8px 20px rgba(14,165,233,.35); }
        .orb { position:absolute; border-radius:9999px; filter:blur(80px); opacity:.18; pointer-events:none; }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="orb w-96 h-96 bg-sky-400 top-[-80px] left-[-80px]"></div>
    <div class="orb w-80 h-80 bg-blue-600 bottom-[-60px] right-[-60px]"></div>

    <div class="w-full max-w-md relative z-10">

        <!-- Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-sky-500/20 border border-sky-500/30 mb-4">
                <svg class="w-8 h-8 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">SIDATA Mahasiswa</h1>
            <p class="text-white/40 text-sm mt-1">Sistem Informasi Data Akademik</p>
        </div>

        <!-- Card -->
        <div class="glass-card rounded-2xl p-8">

            <!-- Tabs -->
            <div class="flex mb-6 border-b border-white/10">
                <button onclick="switchTab('login')" id="tab-login"
                    class="pb-3 px-1 mr-6 text-sm font-semibold transition-all <?= $tab==='login' ? 'tab-active' : 'tab-inactive' ?>">
                    Login
                </button>
                <button onclick="switchTab('register')" id="tab-register"
                    class="pb-3 px-1 text-sm font-semibold transition-all <?= $tab==='register' ? 'tab-active' : 'tab-inactive' ?>">
                    Registrasi
                </button>
            </div>

            <!-- Alert error -->
            <?php if ($error): ?>
            <div class="mb-4 px-4 py-3 rounded-xl bg-red-500/15 border border-red-500/30 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                </svg>
                <span class="text-red-300 text-sm"><?= e($error) ?></span>
            </div>
            <?php endif; ?>

            <!-- Alert success -->
            <?php if ($success): ?>
            <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-500/15 border border-emerald-500/30 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <span class="text-emerald-300 text-sm"><?= e($success) ?></span>
            </div>
            <?php endif; ?>

            <!-- ── FORM LOGIN ── -->
            <div id="form-login" class="<?= $tab==='login' ? '' : 'hidden' ?>">
                <form method="POST" novalidate>
                    <input type="hidden" name="action" value="login">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-white/60 text-xs font-semibold mb-1.5 uppercase tracking-wide">Username</label>
                            <input type="text" name="username" placeholder="Masukkan username"
                                class="input-field w-full px-4 py-3 rounded-xl text-sm"
                                value="<?= e($_POST['username'] ?? '') ?>" required minlength="3">
                        </div>
                        <div>
                            <label class="block text-white/60 text-xs font-semibold mb-1.5 uppercase tracking-wide">Password</label>
                            <input type="password" name="password" placeholder="Masukkan password"
                                class="input-field w-full px-4 py-3 rounded-xl text-sm" required minlength="6">
                        </div>
                        <button type="submit" class="btn-primary w-full py-3 rounded-xl text-white font-semibold text-sm mt-2">
                            Masuk
                        </button>
                    </div>
                </form>
                <p class="text-center text-white/35 text-xs mt-5">
                    Demo &mdash; <span class="font-mono">admin</span> / <span class="font-mono">password</span>
                </p>
            </div>

            <!-- FORM REGISTRASI -->
            <div id="form-register" class="<?= $tab==='register' ? '' : 'hidden' ?>">
                <form method="POST" novalidate>
                    <input type="hidden" name="action" value="register">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-white/60 text-xs font-semibold mb-1.5 uppercase tracking-wide">Username</label>
                            <input type="text" name="reg_username" placeholder="Minimal 3 karakter"
                                class="input-field w-full px-4 py-3 rounded-xl text-sm"
                                value="<?= e($_POST['reg_username'] ?? '') ?>" required minlength="3">
                        </div>
                        <div>
                            <label class="block text-white/60 text-xs font-semibold mb-1.5 uppercase tracking-wide">Password</label>
                            <input type="password" name="reg_password" placeholder="Minimal 6 karakter"
                                class="input-field w-full px-4 py-3 rounded-xl text-sm" required minlength="6">
                        </div>
                        <div>
                            <label class="block text-white/60 text-xs font-semibold mb-1.5 uppercase tracking-wide">Konfirmasi Password</label>
                            <input type="password" name="reg_confirm" placeholder="Ulangi password"
                                class="input-field w-full px-4 py-3 rounded-xl text-sm" required minlength="6">
                        </div>
                        <button type="submit" class="btn-primary w-full py-3 rounded-xl text-white font-semibold text-sm mt-2">
                            Daftar Akun
                        </button>
                    </div>
                </form>
            </div>

        </div><!-- /glass-card -->
    </div>

    <script>
        function switchTab(tab) {
            ['login','register'].forEach(t => {
                document.getElementById('form-' + t).classList.add('hidden');
                document.getElementById('tab-'  + t).className = 'pb-3 px-1 text-sm font-semibold transition-all tab-inactive' + (t === 'login' ? ' mr-6' : '');
            });
            document.getElementById('form-' + tab).classList.remove('hidden');
            document.getElementById('tab-'  + tab).className = 'pb-3 px-1 text-sm font-semibold transition-all tab-active' + (tab === 'login' ? ' mr-6' : '');
        }
    </script>
</body>
</html>