<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = "Username atau password salah";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">

        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">
            Login
        </h1>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <?= $error; ?>
            </div>
        <?php endif; ?> 

        <form method="POST" class="space-y-4">

            <div>
                <label class="block mb-2 font-medium">
                    Username
                </label>

                <input type="text" name="username" required
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan username">
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Password
                </label>

                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password">
            </div>

            <button type="submit" name="login"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl font-semibold transition">

                Login
            </button>

        </form>

        <p class="text-center mt-5 text-gray-600">
            Belum punya akun?
            <a href="register.php" class="text-blue-600 font-semibold">
                Register
            </a>
        </p>

    </div>

</body>

</html>