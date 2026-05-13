<?php
include 'koneksi.php';

$success = "";
$error = "";

if (isset($_POST['register'])) {

    $nama = htmlspecialchars(trim($_POST['nama']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $nohp = htmlspecialchars(trim($_POST['nohp']));
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // VALIDASI
    if (
        empty($nama) ||
        empty($username) ||
        empty($email) ||
        empty($password) ||
        empty($konfirmasi)
    ) {

        $error = "Semua data wajib diisi!";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Format email tidak valid!";

    } elseif (strlen($password) < 6) {

        $error = "Password minimal 6 karakter!";

    } elseif ($password != $konfirmasi) {

        $error = "Konfirmasi password tidak cocok!";

    } else {

        // CEK USERNAME & EMAIL
        $cek = $conn->prepare("
            SELECT * FROM users
            WHERE username = ? OR email = ?
        ");

        $cek->execute([$username, $email]);

        if ($cek->rowCount() > 0) {

            $error = "Username atau email sudah digunakan!";

        } else {

            // HASH PASSWORD
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            // INSERT DATA USER
            $insert = $conn->prepare("
                INSERT INTO users
                (nama_lengkap, username, email, password, no_hp, role)
                VALUES
                (?, ?, ?, ?, ?, 'user')
            ");

            $insert->execute([
                $nama,
                $username,
                $email,
                $hashPassword,
                $nohp
            ]);

            $success = "Registrasi berhasil! Silahkan login ke akun MeowStay.";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | MeowStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('assets/images/hero-cat.jpg');

            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }

        .register-container {
            width: 100%;
            max-width: 620px;
        }

        .register-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
        }

        .register-header {
            background: linear-gradient(90deg, #713600, #A0522D);
            padding: 35px;
            text-align: center;
            color: white;
        }

        .register-header h1 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .register-header h1 span {
            color: #F4A460;
        }

        .register-header p {
            margin: 0;
            font-size: 16px;
            color: #FDFBD4;
        }

        .register-body {
            padding: 40px;
        }

        .section-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-text h3 {
            font-weight: 800;
            color: #713600;
            margin-bottom: 10px;
        }

        .section-text p {
            color: #6c4b2a;
            font-size: 15px;
        }

        .form-label {
            font-weight: 700;
            color: #713600;
            margin-bottom: 8px;
        }

        .input-group-text {
            border-radius: 14px 0 0 14px;
            border: 1px solid #ddd;
            background: #FFF6EE;
            color: #E35336;
        }

        .form-control {
            height: 55px;
            border-radius: 0 14px 14px 0;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #E35336;
            box-shadow: none;
        }

        .input-group {
            margin-bottom: 22px;
        }

        .btn-register {
            width: 100%;
            height: 55px;
            border: none;
            border-radius: 16px;
            background: #E35336;
            color: white;
            font-size: 17px;
            font-weight: 800;
            transition: .3s;
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(227, 83, 54, .3);
        }

        .btn-register:hover {
            background: #C05800;
            transform: translateY(-2px);
        }

        .login-link {
            margin-top: 25px;
            text-align: center;
            color: #6c4b2a;
        }

        .login-link a {
            text-decoration: none;
            color: #E35336;
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 15px;
            font-weight: 600;
        }

        .info-box {
            background: #FFF6EE;
            border-left: 5px solid #E35336;
            padding: 18px;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .info-box h6 {
            font-weight: 800;
            color: #713600;
            margin-bottom: 10px;
        }

        .info-box ul {
            margin: 0;
            padding-left: 18px;
            color: #6c4b2a;
        }

        .info-box ul li {
            margin-bottom: 6px;
            font-size: 14px;
        }

        @media(max-width:768px) {

            .register-header h1 {
                font-size: 34px;
            }

            .register-body {
                padding: 30px 22px;
            }

        }
    </style>
</head>

<body>

    <div class="register-container">

        <div class="register-card">

            <!-- HEADER -->
            <div class="register-header">

                <h1>
                    Meow<span>Stay</span>
                </h1>

                <p>
                    Sistem Hotel dan Penitipan Kucing Premium
                </p>

            </div>

            <!-- BODY -->
            <div class="register-body">

                <div class="section-text">

                    <h3>Buat Akun Baru</h3>

                    <p>
                        Daftarkan akun anda sekarang untuk melakukan booking penitipan anabul kesayangan,
                        melihat data reservasi, dan menikmati layanan MeowStay.
                    </p>

                </div>

                <!-- INFO -->
                <div class="info-box">

                    <h6>
                        <i class="bi bi-shield-check"></i>
                        Keamanan Akun
                    </h6>

                    <ul>
                        <li>Password disimpan menggunakan sistem hash.</li>
                        <li>Data pengguna diproses menggunakan prepared statement.</li>
                        <li>Sistem menggunakan validasi form untuk keamanan input.</li>
                    </ul>

                </div>

                <!-- ALERT -->
                <?php if ($error != "") { ?>

                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?php echo $error; ?>
                    </div>

                <?php } ?>

                <?php if ($success != "") { ?>

                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        <?php echo $success; ?>
                    </div>

                <?php } ?>

                <!-- FORM -->
                <form method="POST">

                    <!-- NAMA -->
                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>

                        <input type="text" name="nama"
                            class="form-control <?php echo empty($_POST['nama']) && isset($_POST['register']) ? 'is-invalid' : ''; ?>"
                            placeholder="Masukkan Nama Lengkap"
                            value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">

                        <div class="invalid-feedback">
                            Nama lengkap wajib diisi!
                        </div>

                    </div>

                    <!-- USERNAME -->
                    <label class="form-label">
                        Username
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-at"></i>
                        </span>

                        <input type="text" name="username"
                            class="form-control <?php echo empty($_POST['username']) && isset($_POST['register']) ? 'is-invalid' : ''; ?>"
                            placeholder="Masukkan Username"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

                        <div class="invalid-feedback">
                            Username wajib diisi!
                        </div>

                    </div>

                    <!-- EMAIL -->
                    <label class="form-label">
                        Email
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope-fill"></i>
                        </span>

                        <input type="email" name="email" class="form-control 
                            <?php
                            echo empty($_POST['email']) && isset($_POST['register'])
                                ? 'is-invalid'
                                : '';

                            echo (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                                ? ' is-invalid'
                                : '';
                            ?>" placeholder="Masukkan Email Aktif"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

                        <div class="invalid-feedback">

                            <?php
                            if (empty($_POST['email'])) {
                                echo "Email wajib diisi!";
                            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                echo "Format email tidak valid!";
                            }
                            ?>

                        </div>

                    </div>

                    <!-- NO HP -->
                    <label class="form-label">
                        Nomor Handphone
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-telephone-fill"></i>
                        </span>

                        <input type="text" name="nohp"
                            class="form-control <?php echo empty($_POST['nohp']) && isset($_POST['register']) ? 'is-invalid' : ''; ?>"
                            placeholder="Contoh: 08123456789"
                            value="<?php echo isset($_POST['nohp']) ? htmlspecialchars($_POST['nohp']) : ''; ?>">

                        <div class="invalid-feedback">
                            Nomor handphone wajib diisi!
                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>

                        <input type="password" name="password" class="form-control 
                            <?php
                            echo empty($_POST['password']) && isset($_POST['register'])
                                ? 'is-invalid'
                                : '';

                            echo (!empty($_POST['password']) && strlen($_POST['password']) < 6)
                                ? ' is-invalid'
                                : '';
                            ?>" placeholder="Password Minimal 6 Karakter">

                        <div class="invalid-feedback">

                            <?php
                            if (empty($_POST['password'])) {
                                echo "Password wajib diisi!";
                            } elseif (strlen($_POST['password']) < 6) {
                                echo "Password minimal 6 karakter!";
                            }
                            ?>

                        </div>

                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <label class="form-label">
                        Konfirmasi Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-shield-lock-fill"></i>
                        </span>

                        <input type="password" name="konfirmasi" class="form-control 
                            <?php
                            echo empty($_POST['konfirmasi']) && isset($_POST['register'])
                                ? 'is-invalid'
                                : '';

                            echo (
                                !empty($_POST['konfirmasi']) &&
                                isset($_POST['password']) &&
                                $_POST['password'] != $_POST['konfirmasi']
                            )
                                ? ' is-invalid'
                                : '';
                            ?>" placeholder="Ulangi Password Anda">

                        <div class="invalid-feedback">

                            <?php
                            if (empty($_POST['konfirmasi'])) {
                                echo "Konfirmasi password wajib diisi!";
                            } elseif (
                                isset($_POST['password']) &&
                                $_POST['password'] != $_POST['konfirmasi']
                            ) {
                                echo "Konfirmasi password tidak cocok!";
                            }
                            ?>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" name="register" class="btn-register">

                        <i class="bi bi-person-plus-fill"></i>
                        Daftar Sekarang

                    </button>

                </form>

                <!-- LOGIN -->
                <div class="login-link">

                    Sudah memiliki akun?

                    <a href="login.php">
                        Login di sini
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>