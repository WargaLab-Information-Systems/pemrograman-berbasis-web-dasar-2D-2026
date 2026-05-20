<?php
include 'koneksi.php';

if(isset($_POST['register'])){

    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){
 
        echo "<script>alert('Username sudah digunakan')</script>";

    } else {

        $query = mysqli_query($conn,"INSERT INTO users(username,password,role)
        VALUES('$username','$password','user')");

        if($query){

            if($username == 'intan'){
                mysqli_query($conn,"UPDATE users SET role='admin' WHERE username='intan'");
            }

            echo "<script>
            alert('Registrasi berhasil');
            window.location='login.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="min-h-screen bg-gradient-to-br from-orange-400 via-orange-200 to-yellow-100 overflow-y-autoo">

<div class="absolute top-0 left-0 w-72 h-72 bg-white/30 rounded-full blur-3xl"></div>
<div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl"></div>

<div class="flex justify-center items-center min-h-screen relative z-10 p-6">

    <div class="grid md:grid-cols-2 bg-white/30 backdrop-blur-2xl shadow-2xl rounded-[40px] overflow-hidden max-w-5xl w-full border border-white/40">

        <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-orange-500 to-orange-700 text-white p-12 relative overflow-hidden">

            <div class="absolute -top-10 -right-10 w-52 h-52 bg-white/20 rounded-full"></div>
            <div class="absolute bottom-0 -left-10 w-60 h-60 bg-white/10 rounded-full"></div>

            <h1 class="text-6xl font-black leading-tight relative z-10">
                Cafe
                <br>
                Modern ☕
            </h1>

            <p class="mt-6 text-lg text-orange-100 relative z-10">
                Sistem pemesanan menu cafe silahkan registrasi untuk melihat menu menarik kami.
            </p>

        </div>

        <div class="bg-white p-10 md:p-14">

            <div class="text-center mb-8">

                <div class="w-24 h-24 bg-orange-500 mx-auto rounded-3xl flex items-center justify-center text-5xl shadow-xl mb-5">
                    ☕
                </div>

                <h1 class="text-4xl font-black text-orange-500">
                    Register
                </h1>

                <p class="text-gray-500 mt-2">
                    Buat akun baru untuk masuk ke sistem cafe
                </p>

            </div>

            <form method="POST" class="space-y-5">

                <div>
                    <label class="font-semibold text-gray-700">Username</label>
                    <input type="text"
                    name="username"
                    placeholder="Masukkan username"
                    class="w-full mt-2 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl bg-orange-50"
                    required>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Password</label>
                    <input type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full mt-2 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl bg-orange-50"
                    required>
                </div>

                <button type="submit"
                name="register"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:scale-105 duration-300 text-white font-bold p-4 rounded-2xl shadow-2xl">
                    Register Sekarang
                </button>

            </form>

            <p class="text-center mt-8 text-gray-600">
                Sudah punya akun?
                <a href="login.php" class="text-orange-500 font-bold hover:underline">
                    Login
                </a>
            </p>

        </div>

    </div>

</div>

</body>
</html>