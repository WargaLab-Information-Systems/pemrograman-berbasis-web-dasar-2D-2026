<?php

session_start();

include 'koneksi.php';

$pesan = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email=?"
    );

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        header("Location: dashboard.php");
        exit;

    } else {

        $pesan = "Email atau password salah";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-pink-100 via-rose-100 to-pink-200">

<div class="flex justify-center items-center h-screen">

<div class="bg-white/70 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-md border border-white">

<h2 class="text-3xl font-bold mb-5 text-center text-pink-600">

<i class="fa-solid fa-bowl-food mr-2"></i>

Silahkan Login

</h2>

<p class="text-center text-red-500 mb-3">
<?= $pesan ?>
</p>

<form method="POST">

<input
type="email"
name="email"
placeholder="Email"
required
class="w-full border border-pink-200 p-3 rounded-xl mb-4"
>

<input
type="password"
name="password"
placeholder="Password"
required
class="w-full border border-pink-200 p-3 rounded-xl mb-4"
>

<button
type="submit"
name="login"
class="w-full bg-pink-500 hover:bg-pink-700 text-white p-3 rounded-xl">

Login

</button>

</form>

<p class="text-center mt-5 text-gray-600">

Belum punya akun?

<a href="register.php"
class="text-pink-500 font-semibold hover:underline">

Register

</a>

</p>

</div>
</div>

</body>
</html>