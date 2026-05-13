<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../user/dashboard.php");
    exit;
}

$id = $_SESSION['id_user'];
$success = "";
$error = "";

if (isset($_POST['update_profil'])) {

    $nama = htmlspecialchars(trim($_POST['nama']));
    $username = htmlspecialchars(trim($_POST['username']));

    if ($nama == "" || $username == "") {

        $error = "Nama dan username wajib diisi!";

    } else {

        $cek = $conn->prepare("
            SELECT id FROM users
            WHERE username=? AND id!=?
        ");
        $cek->execute([$username, $id]);

        if ($cek->rowCount() > 0) {

            $error = "Username sudah digunakan!";

        } else {

            $update = $conn->prepare("
                UPDATE users
                SET nama_lengkap=?, username=?
                WHERE id=?
            ");

            $update->execute([
                $nama,
                $username,
                $id
            ]);

            $_SESSION['nama'] = $nama;
            $_SESSION['username'] = $username;

            $success = "Profil berhasil diperbarui.";
        }
    }
}

if (isset($_POST['update_password'])) {

    $lama = $_POST['lama'];
    $baru = $_POST['baru'];
    $konfirmasi = $_POST['konfirmasi'];

    $stmt = $conn->prepare("
        SELECT password
        FROM users
        WHERE id=?
    ");

    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($lama, $user['password'])) {

        $error = "Password lama salah!";

    } elseif (strlen($baru) < 6) {

        $error = "Password baru minimal 6 karakter!";

    } elseif ($baru != $konfirmasi) {

        $error = "Konfirmasi password tidak cocok!";

    } else {

        $hash = password_hash($baru, PASSWORD_DEFAULT);

        $update = $conn->prepare("
            UPDATE users
            SET password=?
            WHERE id=?
        ");

        $update->execute([$hash, $id]);

        $success = "Password berhasil diganti.";
    }
}

$stmt = $conn->prepare("
    SELECT *
    FROM users
    WHERE id=?
");
$stmt->execute([$id]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profile Admin | MeowStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            font-family: Arial, sans-serif;
        }

        body {
            background: #FDFBD4;
            color: #38240D;
        }

        .navbar {
            background: linear-gradient(90deg, #713600, #A0522D);
            padding: 15px 0;
        }

        .navbar-brand {
            color: white !important;
            font-size: 28px;
            font-weight: 900;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            margin-left: 10px;
        }

        .nav-link:hover {
            color: #F4A460 !important;
        }

        .hero {
            min-height: 320px;
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding-top: 100px;
            color: white;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 900;
        }

        .hero span {
            color: #F4A460;
        }

        .card-box {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            height: 100%;
        }

        .section-title {
            font-size: 42px;
            font-weight: 900;
            color: #713600;
        }

        .section-title span {
            color: #E35336;
        }

        .btn-main {
            background: #E35336;
            border: none;
            color: white;
            font-weight: 700;
        }

        .btn-main:hover {
            background: #C05800;
            color: white;
        }

        .footer {
            background: #38240D;
            padding: 25px 0;
            margin-top: 70px;
            color: #FDFBD4;
        }

        .footer span {
            color: #F4A460;
            font-weight: 800;
        }

        @media(max-width:768px) {

            .hero {
                text-align: center;
            }

            .hero h1 {
                font-size: 38px;
            }

            .section-title {
                font-size: 30px;
            }

        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">

        <div class="container">

            <a class="navbar-brand" href="dashboard.php">
                MeowStay
            </a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cats.php">Data Kucing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">Data Booking</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">

        <div class="container">

            <h1>
                Profile <span>Admin</span>
            </h1>

            <p>
                Kelola akun administrator MeowStay dengan aman.
            </p>

        </div>
    </section>

    <!-- CONTENT -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    Akun <span>Saya</span>
                </h2>

            </div>

            <?php if ($success != "") { ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
            <?php } ?>

            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <div class="row g-4">

                <!-- DATA AKUN -->
                <div class="col-md-6">

                    <div class="card-box">

                        <h4 class="mb-4">Informasi Akun</h4>

                        <p><b>Nama :</b>
                            <?php echo $data['nama_lengkap']; ?>
                        </p>
                        <p><b>Username :</b>
                            <?php echo $data['username']; ?>
                        </p>
                        <p><b>Email :</b>
                            <?php echo $data['email']; ?>
                        </p>
                        <p><b>Role :</b>
                            <?php echo ucfirst($data['role']); ?>
                        </p>

                    </div>

                </div>

                <!-- EDIT PROFILE -->
                <div class="col-md-6">

                    <div class="card-box">

                        <h4 class="mb-4">Edit Profil</h4>

                        <form method="POST">

                            <div class="mb-3">
                                <input type="text" name="nama" class="form-control"
                                    value="<?php echo $data['nama_lengkap']; ?>">
                            </div>

                            <div class="mb-3">
                                <input type="text" name="username" class="form-control"
                                    value="<?php echo $data['username']; ?>">
                            </div>

                            <button type="submit" name="update_profil" class="btn btn-main w-100">
                                Update Profil
                            </button>

                        </form>

                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="col-md-12">

                    <div class="card-box">

                        <h4 class="mb-4">Ganti Password</h4>

                        <form method="POST">

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <input type="password" name="lama" class="form-control" placeholder="Password Lama">
                                </div>

                                <div class="col-md-4">
                                    <input type="password" name="baru" class="form-control" placeholder="Password Baru">
                                </div>

                                <div class="col-md-4">
                                    <input type="password" name="konfirmasi" class="form-control"
                                        placeholder="Konfirmasi Password">
                                </div>

                                <div class="col-12 d-grid">
                                    <button type="submit" name="update_password" class="btn btn-main">
                                        Ganti Password
                                    </button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="footer text-center">

        <div class="container">

            <p>
                © Copyright 2026 <span>MeowStay</span>.
                Sistem Penitipan Kucing Berbasis Web.
            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>