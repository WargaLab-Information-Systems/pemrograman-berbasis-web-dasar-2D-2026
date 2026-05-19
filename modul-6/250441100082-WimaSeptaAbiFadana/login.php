<?php
session_start();
include "koneksi.php";

$error="";
if (isset($_POST['LOGIN'])) {
    $username = $_POST['username'];
    $pasword = $_POST['pasword'];
    $query = "SELECT * FROM users WHERE username='$username'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($data) {
    if (password_verify($pasword, $data['pasword'])) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        header("location: index.php");
        exit;
    } else {
        $error = "Password salah";
    }
} else {   
    $error = "Username tidak ditemukan";
}
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-xl shadow-lg w-80">
            <h1 class="text-3xl font-bold text-center mb-6">Login</h1>
            <?php if ($error != "") { ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= $error; ?>
            </div>
            <?php } ?>
            <form method="POST">
                <p class="text-center mt-4 text-gray-600"> Belum punya akun?
                    <a href="registasi.php" class="text-blue-500 font-semibold hover:underline"> Daftar sekarang </a>
                </p>
                <input type="text" name="username" placeholder="Username"
                    class="w-full border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <br><br>
                <input type="password" name="pasword" placeholder="Password"
                    class="w-full border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <br><br>
                <button type="submit" name="LOGIN"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Login</button>
            </form>
        </div>
    </div>
</body>
</html>