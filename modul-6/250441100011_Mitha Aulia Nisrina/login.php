<?php
session_start();
include 'koneksi.php';

$success = "";
$error = "";

// JIKA SUDAH LOGIN
if (isset($_SESSION['login'])) {

    if ($_SESSION['role'] == "admin") {

        header("Location: admin/dashboard.php");
        exit;

    } else {

        header("Location: user/dashboard.php");
        exit;

    }

}

if (isset($_POST['login'])) {

    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // VALIDASI
    if (empty($username) || empty($password)) {

        $error = "Username dan password wajib diisi!";

    } else {

        // CEK USER
        $cek = $conn->prepare("
            SELECT * FROM users
            WHERE username=? OR email=?
        ");

        $cek->execute([$username, $username]);

        if ($cek->rowCount() > 0) {

            $user = $cek->fetch(PDO::FETCH_ASSOC);

            // CEK PASSWORD HASH
            if (password_verify($password, $user['password'])) {

                // SESSION LOGIN
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $user['id'];
                $_SESSION['nama'] = $user['nama_lengkap'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // REDIRECT ROLE
                if ($user['role'] == "admin") {

                    header("Location: admin/dashboard.php");
                    exit;

                } else {

                    header("Location: user/dashboard.php");
                    exit;

                }

            } else {

                $error = "Password salah!";

            }

        } else {

            $error = "Username atau email tidak ditemukan!";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | MeowStay</title>

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

        .login-container {
            width: 100%;
            max-width: 560px;
        }

        .login-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
        }

        .login-header {
            background: linear-gradient(90deg, #713600, #A0522D);
            padding: 35px;
            text-align: center;
            color: white;
        }

        .login-header h1 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .login-header h1 span {
            color: #F4A460;
        }

        .login-header p {
            margin: 0;
            font-size: 16px;
            color: #FDFBD4;
        }

        .login-body {
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

        .form-label {
            font-weight: 700;
            color: #713600;
            margin-bottom: 8px;
        }

        .input-group {
            margin-bottom: 22px;
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

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .btn-login {
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

        .btn-login:hover {
            background: #C05800;
            transform: translateY(-2px);
        }

        .register-link {
            margin-top: 25px;
            text-align: center;
            color: #6c4b2a;
        }

        .register-link a {
            text-decoration: none;
            color: #E35336;
            font-weight: 700;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 15px;
            font-weight: 600;
        }

        .back-home {
            text-align: center;
            margin-top: 18px;
        }

        .back-home a {
            text-decoration: none;
            color: #713600;
            font-weight: 700;
        }

        .back-home a:hover {
            color: #E35336;
        }

        @media(max-width:768px) {

            .login-header h1 {
                font-size: 34px;
            }

            .login-body {
                padding: 30px 22px;
            }

        }
    </style>

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <!-- HEADER -->
            <div class="login-header">

                <h1>
                    Meow<span>Stay</span>
                </h1>

                <p>
                    Sistem Hotel dan Penitipan Kucing Premium
                </p>

            </div>

            <!-- BODY -->
            <div class="login-body">

                <div class="section-text">

                    <h3>Login Akun</h3>

                    <p>
                        Masuk ke akun anda untuk melakukan booking penitipan kucing,
                        melihat data reservasi, dan mengakses layanan MeowStay.
                    </p>

                </div>

                <!-- INFO -->
                <div class="info-box">

                    <h6>

                        <i class="bi bi-shield-lock-fill"></i>

                        Sistem Keamanan Login

                    </h6>

                    <ul>

                        <li>Password diverifikasi menggunakan hash password.</li>

                        <li>Sistem login menggunakan session PHP.</li>

                        <li>Seluruh query menggunakan prepared statement.</li>

                        <li>Role admin dan user memiliki hak akses berbeda.</li>

                    </ul>

                </div>

                <!-- ALERT -->
                <?php if ($error != "") { ?>

                    <div class="alert alert-danger">

                        <i class="bi bi-exclamation-circle-fill"></i>

                        <?php echo $error; ?>

                    </div>

                <?php } ?>

                <!-- FORM LOGIN -->
                <form method="POST">

                    <!-- USERNAME -->
                    <label class="form-label">
                        Username / Email
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-person-fill"></i>

                        </span>

                        <input type="text" name="username"
                            class="form-control <?php echo empty($_POST['username']) && isset($_POST['login']) ? 'is-invalid' : ''; ?>"
                            placeholder="Masukkan Username atau Email"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

                    </div>

                    <!-- PASSWORD -->
                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-lock-fill"></i>

                        </span>

                        <input type="password" name="password"
                            class="form-control <?php echo empty($_POST['password']) && isset($_POST['login']) ? 'is-invalid' : ''; ?>"
                            placeholder="Masukkan Password Anda">

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" name="login" class="btn-login">

                        <i class="bi bi-box-arrow-in-right"></i>

                        Login Sekarang

                    </button>

                </form>

                <!-- REGISTER -->
                <div class="register-link">

                    Belum memiliki akun?

                    <a href="register.php">
                        Daftar di sini
                    </a>

                </div>

                <!-- BACK -->
                <div class="back-home">

                    <a href="index.php">

                        <i class="bi bi-arrow-left-circle-fill"></i>

                        Kembali ke Halaman Utama

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>