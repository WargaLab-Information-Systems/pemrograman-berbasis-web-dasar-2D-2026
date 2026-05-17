<?php
include("koneksi.php");

$sukses = "";
$error = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($username && $password && $confirm_password) {
        if ($password !== $confirm_password) {
            $error = "Konfirmasi password tidak cocok!";
        } else {
           
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $role = 'user'; 
            
            $stmt_cek = $koneksi->prepare("SELECT username FROM users WHERE username = ?");
            $stmt_cek->bind_param("s", $username);
            $stmt_cek->execute();
            $result_cek = $stmt_cek->get_result();

            if ($result_cek->num_rows > 0) {
                $error = "Username sudah digunakan, silakan pilih yang lain.";
            } else {
                
                $stmt = $koneksi->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $hashed_password, $role);

                if ($stmt->execute()) {
                    $sukses = "Registrasi berhasil! Silakan <a href='login.php'>Login</a>";
                } else {
                    $error = "Terjadi kesalahan saat registrasi.";
                }
            }
        }
    } else {
        $error = "Semua kolom harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-image: url(thumbnail-3.png);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container" style="max-width: 450px;">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h4>Daftar Akun Baru</h4>
            </div>
            <div class="card-body">
                <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <?php if($sukses) echo "<div class='alert alert-success'>$sukses</div>"; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required minlength="4">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="register" class="btn btn-success">Daftar Sekarang</button>
                        <a href="login.php" class="btn btn-outline-secondary">Sudah punya akun? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>