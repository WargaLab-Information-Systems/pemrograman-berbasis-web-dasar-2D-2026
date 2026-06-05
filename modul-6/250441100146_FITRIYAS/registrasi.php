<?php
include 'koneksi.php';

if(isset($_POST['register'])) {

    $username = htmlspecialchars(trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = $conn->prepare("SELECT id FROM users WHERE username=?");
    $cek->bind_param("s", $username);
    $cek->execute();

    $hasil = $cek->get_result();

    if($hasil->num_rows > 0) {
        $pesan = "Username sudah digunakan!";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO users(username,password)
            VALUES(?,?)"
        );

        $stmt->bind_param("ss", $username, $password);

        if($stmt->execute()) {
            $pesan = "Registrasi berhasil!";
        } else {
            $pesan = "Registrasi gagal!";
             }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-300 flex justify-center items-center h-screen">

<form method="POST" class="bg-white p-6 rounded shadow w-80">

    <h2 class="text-2xl font-bold mb-4 text-center">
        Registrasi
    </h2>

    <?php if(isset($pesan)): ?>
        <div class="bg-blue-100 text-blue-700 p-2 mb-3 rounded">
            <?= $pesan; ?>
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
    name="register"
    class="bg-blue-500 text-white w-full p-2 rounded">
        Register
    </button>

    <p class="text-center mt-3">
        Sudah punya akun?
        <a href="login.php" class="text-blue-500">
            Login
        </a>
    </p>

</form>
</body>
</html>