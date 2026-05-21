<?php
require 'koneksi.php';

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Validasi kecocokan password
    if ($password !== $confirm_password) {
        $error_msg = "Konfirmasi password tidak cocok!";
    } elseif (strlen($password) < 6) {
        $error_msg = "Password minimal harus 6 karakter!";
    } else {
        try {
            // 2. Cek apakah email sudah terdaftar
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $error_msg = "Email ini sudah digunakan!";
            } else {
                // 3. Hash password sebelum disimpan ke database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // 4. Masukkan data ke tabel users (Role default: user)
                $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 'user')");

                if ($stmt->execute([$email, $hashed_password])) {
                    echo "<script>
                            alert('Registrasi Berhasil! Silakan Login.');
                            window.location.href='index.php';
                          </script>";
                    exit;
                }
            }
        } catch (PDOException $e) {
            $error_msg = "Kesalahan Sistem: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register Account - Gym System</title>
</head>

<body class="bg-gray-900">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Daftar Akun</h2>
                <p class="text-gray-500 mt-2">Buat akun gratis Anda sekarang</p>

                <?php if (!empty($error_msg)) : ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mt-4 text-sm text-left">
                        <?= $error_msg; ?>
                    </div>
                <?php endif; ?>
            </div>

            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 outline-none transition"
                        placeholder="nama@email.com" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 outline-none transition"
                        placeholder="Minimal 6 karakter" required>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 outline-none transition"
                        placeholder="Ulangi password" required>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform active:scale-[0.98]">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-8 text-center border-t pt-6">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="index.php" class="text-green-600 font-semibold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>