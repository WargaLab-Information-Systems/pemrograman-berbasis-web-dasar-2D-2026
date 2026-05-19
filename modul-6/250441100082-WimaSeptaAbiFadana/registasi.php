<?php
include "koneksi.php";
$error="";
$sukses="";
if (isset($_POST['registasi'])) {
    $username = trim($_POST['username']);
    $pasword = trim($_POST['pasword']);
    if ($username == "" || $pasword == "") {
        $error = "Semua field wajib diisi";
    } else {
        $cek = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $cek);

        if (mysqli_num_rows($result) > 0) {
            $error = "Username sudah digunakan";
        } else {
            $hash = password_hash(
                $pasword,
                PASSWORD_DEFAULT
            );
            $query = "INSERT INTO users (username,pasword,role) VALUES ('$username','$hash','user')";

            mysqli_query($conn, $query);
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-xl shadow-lg w-80">
            <h1 class="text-3xl font-bold text-center mb-6">Registrasi</h1>
            <form method="POST">
                <input type="text" name="username" placeholder="Username"
                    class="w-full border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <br><br>
                <input type="password" name="pasword" placeholder="Password"
                    class="w-full border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <br><br>
                <button type="submit" name="registasi"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Registrasi</button>
            </form>
        </div>
    </div>
</body>
</html>