<?php
include 'config/koneksi.php';

if (isset($_POST['register'])) {

    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $role = "user";

    $stmt = $conn->prepare("INSERT INTO users(nama, username, password, role) VALUES(?,?,?,?)");

    $stmt->bind_param("ssss", $nama, $username, $password, $role);

    if ($stmt->execute()) {

        echo "
        <script>
            alert('Registrasi berhasil');
            window.location='login.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">

        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">
            Register
        </h1>

        <form method="POST" class="space-y-4">

            <input type="text" name="nama" required placeholder="Nama"
                class="w-full border border-gray-300 rounded-xl p-3">

            <input type="text" name="username" required placeholder="Username"
                class="w-full border border-gray-300 rounded-xl p-3">

            <input type="password" name="password" minlength="6" required placeholder="Password"
                class="w-full border border-gray-300 rounded-xl p-3">

            <button type="submit" name="register"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl font-semibold">

                Register
            </button>

        </form>

        <p class="text-center mt-5">
            Sudah punya akun?
            <a href="login.php" class="text-blue-600 font-semibold">
                Login
            </a>
        </p>

    </div>

</body>

</html>