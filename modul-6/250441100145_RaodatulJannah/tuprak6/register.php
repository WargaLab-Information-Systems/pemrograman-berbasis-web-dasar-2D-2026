<?php

include 'koneksi.php';

$pesan = "";

if (isset($_POST['register'])) {

    $nama  = $_POST['nama'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $cek = $conn->prepare(
        "SELECT id FROM users WHERE email=?"
    );

    $cek->bind_param("s", $email);

    $cek->execute();

    $hasil = $cek->get_result();

    if ($hasil->num_rows > 0) {

        $pesan = "Email sudah digunakan";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO users(nama,email,password)
            VALUES(?,?,?)"
        );

        $stmt->bind_param(
            "sss",
            $nama,
            $email,
            $password
        );

        if ($stmt->execute()) {

            header("Location: login.php");
            exit;

        } else {

            $pesan = "Register gagal";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-pink-100 to-rose-200">

<div class="flex justify-center items-center h-screen">

<div class="bg-white/70 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-md">

<h2 class="text-4xl font-bold mb-5 text-center text-pink-600">

<i class="fa-solid fa-user-plus mr-2"></i>

Register

</h2>

<p class="text-center text-red-500 mb-3">
<?= $pesan ?>
</p>

<form method="POST">

<input
type="text"
name="nama"
placeholder="Nama"
required
class="w-full border p-3 rounded-lg mb-4"
>

<input
type="email"
name="email"
placeholder="Email"
required
class="w-full border p-3 rounded-lg mb-4"
>

<input
type="password"
name="password"
placeholder="Password"
required
minlength="6"
class="w-full border p-3 rounded-lg mb-4"
>

<button
type="submit"
name="register"
class="w-full bg-pink-500 hover:bg-pink-700 text-white p-3 rounded-xl">

Register

</button>

</form>

<a href="login.php"
class="block text-center mt-4 text-pink-500 font-semibold hover:underline">

Sudah punya akun?

</a>

</div>
</div>

</body>
</html>