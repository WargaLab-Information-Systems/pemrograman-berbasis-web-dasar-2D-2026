<?php
session_start();
include 'koneksi.php';

if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE username=?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
      header("Location: dashboard.php");
        exit;

    } else {

        $error = "Username atau password salah!";
    }
}
?>
  <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-200 flex justify-center items-center h-screen">

<form method="POST" class="bg-white p-6 rounded shadow w-80">

    <h2 class="text-2xl font-bold mb-4 text-center">
        Login
    </h2>

    <?php if(isset($error)): ?>
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            <?= $error; ?>
        </div>
    <?php endif; ?>

    <input type="text"
    name="username"
    placeholder="Username"
    class="w-full border p-2 mb-3 rounded"
    required>

    <input type="password"
    name="password"
    placeholder="Password"
    class="w-full border p-2 mb-3 rounded"
    required>

    <button type="submit"
    name="login"
     class="bg-green-500 text-white w-full p-2 rounded">
        Login
    </button>

    <p class="text-center mt-3">
        Belum punya akun?
        <a href="registrasi.php" class="text-blue-500">
            Register
        </a>
    </p>

</form>

</body>
</html>