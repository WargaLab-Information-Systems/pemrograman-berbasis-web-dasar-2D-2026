<?php 
session_start();
include_once("../database/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div class="min-h-screen flex flex-col md:flex-row">
        <div class="w-full bg-[#eff7ff] flex flex-col justify-center items-center px-6 py-10">

            <h1 class="font-semibold text-2xl mb-2">Register Page</h1>
            <h4 class="text-[#757575] font-bold text-sm mb-6 text-center">
                Buat Username dan Password Anda
            </h4>

            <form action="register.php" id="submit" method="POST" class="w-full max-w-sm">
                <input
                    class="bg-white shadow-sm w-full py-3 rounded-xl text-center font-bold mb-3"
                    type="text" name="username" id="usernameUser" placeholder="Username" required>

                <input
                    class="bg-white shadow-sm w-full py-3 rounded-xl text-center font-bold mb-3"
                    type="email" name="email" id="emailUser" placeholder="Email Address" required>

                <input
                    class="bg-white shadow-sm w-full py-3 rounded-xl text-center font-bold mb-3"
                    type="password" name="password" id="passwordUser" placeholder="Password" required>

                <button type="submit" name="register" id="btnRegister"
                    class="bg-[#3852B4] hover:bg-[#2a3d8c] w-full py-3 rounded-xl font-bold text-white">
                    Register
                </button>
            </form>

            <?php
            if (isset($_POST['register'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $role = 'user';

                $sql = "INSERT INTO users (id, username, email, password, role) VALUES (null, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username, $email, $password, $role]);

                header("Location: login.php");
                exit;
            }
            ?>

            <div class="flex items-center w-full max-w-sm my-5">
                <span class="grow h-0.5 bg-gray-400"></span>
                <span class="mx-3 text-sm font-medium">Sudah punya Akun?</span>
                <span class="grow h-0.5 bg-gray-400"></span>
            </div>

            <div class="flex items-center justify-center bg-[#3852B4] hover:bg-[#2a3d8c] shadow w-full max-w-sm py-3 rounded-xl font-bold text-white">
                <a href="login.php">Login</a>
            </div>

        </div>
    </div>
    </div>
</body>

</html>