<?php 
session_start();
include_once("../database/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div class="min-h-screen flex flex-col md:flex-row">
        <div class="w-full bg-[#eff7ff] flex flex-col justify-center items-center px-6 py-10">

            <h1 class="font-semibold text-2xl mb-2">Login Page</h1>
            <h4 class="text-[#757575] font-bold text-sm mb-6 text-center">
                Masukkan Username dan Password Anda
            </h4>

            <form action="login.php" id="submit" method="POST" class="w-full max-w-sm">
                <input
                    class="bg-white shadow-sm w-full py-3 rounded-xl text-center font-bold mb-3"
                    type="email" name="email" id="emailUser" placeholder="Email Address" required>

                <input
                    class="bg-white shadow-sm w-full py-3 rounded-xl text-center font-bold mb-3"
                    type="password" name="password" id="passwordUser" placeholder="Password" required>

                <button type="submit" name="login" id="btnLogin"
                    class="bg-[#3852B4] hover:bg-[#2a3d8c] w-full py-3 rounded-xl font-bold text-white">
                    Login
                </button>
            </form>

            <?php 
            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$email, $password]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $_SESSION['login'] = true;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    if ($user['role'] === 'admin') {
                        header("Location: ../backend/dashboard.php");
                    } else {
                        header("Location: ../index.php");
                    }
                    exit;
                } else {
                    echo "<script>alert('Email atau Password salah');</script>";
                }
            }
            ?>

            <div class="flex items-center w-full max-w-sm my-5">
                <span class="grow h-0.5 bg-gray-400"></span>
                <span class="mx-3 text-sm font-medium">Tidak punya Akun?</span>
                <span class="grow h-0.5 bg-gray-400"></span>
            </div>

            <div class="flex items-center justify-center bg-[#3852B4] hover:bg-[#2a3d8c] shadow w-full max-w-sm py-3 rounded-xl font-bold text-white">
                <a href="register.php">Registrasi</a>
            </div>

        </div>
    </div>
    </div>
</body>

</html>