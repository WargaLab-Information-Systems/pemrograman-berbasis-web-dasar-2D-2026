<?php
include 'auth.php';
include 'koneksi.php';

if (is_login()) {
    header("Location: index.php");
    exit;
}

$pesan = "";

if (isset($_POST['register'])) {
    $user = htmlspecialchars($_POST['username']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);
    
    if ($stmt->execute()) {
        $pesan = "Berhasil daftar! Silakan login.";
    } else {
        $pesan = "Username telah terdaftar!";
    }
}

if (isset($_POST['login'])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    
    if ($data && password_verify($_POST['password'], $data['password'])) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role']; 
        header("Location: index.php"); 
        exit;
    } else {
        $pesan = "Login gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Login Sistem Bengkel</h2>
        <p class="text-red-500 text-center mb-4"><?= $pesan ?></p>
        
        <form method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" required class="w-full border p-2 rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full border p-2 rounded">
            
            <div class="flex gap-2">
                <button type="submit" name="login" class="w-1/2 bg-blue-500 text-white p-2 rounded font-bold">Login</button>
                <button type="submit" name="register" class="w-1/2 bg-gray-200 p-2 rounded font-bold">Daftar</button>
            </div>
        </form>
    </div>
</body>
</html>