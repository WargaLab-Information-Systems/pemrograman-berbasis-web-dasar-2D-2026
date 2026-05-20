<?php
session_start(); 
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data){

        if(password_verify($password,$data['password'])){

            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "<script>alert('Password salah')</script>";
        }

    } else {
        echo "<script>alert('Username tidak ditemukan')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="min-h-screen bg-gradient-to-br from-orange-500 via-orange-300 to-yellow-100 overflow-y-auto">

<div class="absolute top-0 left-0 w-80 h-80 bg-white/20 rounded-full blur-3xl"></div>
<div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-900/10 rounded-full blur-3xl"></div>

<div class="flex justify-center items-center min-h-screen relative z-10 p-6">

    <div class="grid md:grid-cols-2 bg-white/30 backdrop-blur-2xl rounded-[40px] overflow-hidden shadow-2xl max-w-5xl w-full border border-white/40">

        <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-orange-600 to-orange-800 text-white p-14 relative overflow-hidden">

            <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/10 rounded-full"></div>

            <h1 class="text-6xl font-black leading-tight relative z-10">
                Welcome
                <br>
                Back ☕
            </h1>

            <p class="mt-6 text-orange-100 text-lg relative z-10">
                Login untuk mengakses dashboard cafe modern dan mengelola menu cafe.
            </p>

        </div>

        <div class="bg-white p-10 md:p-14">

            <div class="text-center mb-10">

                <div class="w-24 h-24 rounded-3xl bg-gradient-to-r from-orange-500 to-orange-700 mx-auto flex items-center justify-center text-5xl shadow-2xl mb-5">
                    ☕
                </div>

                <h1 class="text-5xl font-black text-orange-500">
                    Login
                </h1>

                <p class="text-gray-500 mt-3">
                    Sistem Pemesanan Menu Cafe
                </p>

            </div>

            <form method="POST" class="space-y-6">

                <div>
                    <label class="font-bold text-gray-700">Username</label>
                    <input type="text"
                    name="username"
                    placeholder="Masukkan username"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Password</label>
                    <input type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <button type="submit"
                name="login"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-700 hover:scale-105 duration-300 text-white p-4 rounded-2xl font-black shadow-2xl text-lg">
                    Login Sekarang
                </button>

            </form>

            <p class="text-center mt-8 text-gray-600">
                Belum punya akun?
                <a href="register.php" class="text-orange-500 font-bold hover:underline">
                    Register
                </a>
            </p>

        </div>

    </div>

</div>

</body>
</html>