<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

// CEK ROLE
if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

// SESSION USER
$idUser = $_SESSION['id_user'];
$nama = $_SESSION['nama'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// TOTAL KUCING
$stmtCats = $conn->prepare("
    SELECT COUNT(*) as total_kucing
    FROM cats
    WHERE user_id=?
");
$stmtCats->execute([$idUser]);
$totalKucing = $stmtCats->fetch(PDO::FETCH_ASSOC);

// TOTAL BOOKING
$stmtBooking = $conn->prepare("
    SELECT COUNT(*) as total_booking
    FROM bookings
    WHERE user_id=?
");
$stmtBooking->execute([$idUser]);
$totalBooking = $stmtBooking->fetch(PDO::FETCH_ASSOC);

// BOOKING TERAKHIR
$stmtLastBooking = $conn->prepare("
    SELECT bookings.*,cats.nama_kucing
    FROM bookings
    JOIN cats ON bookings.cat_id=cats.id
    WHERE bookings.user_id=?
    ORDER BY bookings.id DESC
    LIMIT 5
");
$stmtLastBooking->execute([$idUser]);
$dataBooking = $stmtLastBooking->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard User | MeowStay</title>

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
            box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 900;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            margin-left: 10px;
            transition: .3s;
        }

        .nav-link:hover {
            color: #F4A460 !important;
        }

        .hero-dashboard {
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
            min-height: 450px;
            display: flex;
            align-items: center;
            padding-top: 120px;
            padding-bottom: 80px;
            color: white;
        }

        .hero-dashboard h1 {
            font-size: 58px;
            font-weight: 900;
            line-height: 1.2;
        }

        .hero-dashboard h1 span {
            color: #F4A460;
        }

        .hero-dashboard p {
            font-size: 18px;
            color: #FDFBD4;
            line-height: 1.8;
            margin-top: 20px;
        }

        .btn-main {
            background: #E35336;
            border: none;
            color: white;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            transition: .3s;
            box-shadow: 0 8px 20px rgba(227, 83, 54, .3);
        }

        .btn-main:hover {
            background: #C05800;
            transform: translateY(-2px);
            color: white;
        }

        .section-title {
            font-size: 42px;
            font-weight: 900;
            color: #713600;
            margin-bottom: 12px;
        }

        .section-title span {
            color: #E35336;
        }

        .section-sub {
            color: #6c4b2a;
            margin-bottom: 45px;
        }

        .dashboard-card {
            background: white;
            border: none;
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            height: 100%;
            transition: .3s;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
        }

        .dashboard-icon {
            width: 80px;
            height: 80px;
            background: #FFF1E8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            color: #E35336;
            margin-bottom: 20px;
        }

        .dashboard-card h3 {
            font-size: 40px;
            font-weight: 900;
            color: #713600;
        }

        .dashboard-card h5 {
            font-weight: 800;
            margin-bottom: 12px;
        }

        .table-custom {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .table-custom .table {
            margin: 0;
        }

        .table thead {
            background: #713600;
            color: white;
        }

        .badge-status {
            padding: 10px 15px;
            border-radius: 30px;
            font-size: 13px;
        }

        .info-user {
            background: white;
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .footer {
            background: #38240D;
            padding: 25px 0;
            margin-top: 80px;
        }

        .footer p {
            margin: 0;
            color: #FDFBD4;
        }

        .footer span {
            color: #F4A460;
            font-weight: 800;
        }

        @media(max-width:768px) {

            .hero-dashboard {
                text-align: center;
            }

            .hero-dashboard h1 {
                font-size: 40px;
            }

            .section-title {
                font-size: 34px;
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
                        <a class="nav-link" href="dashboard.php">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cats.php">
                            Data Kucing
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="tambah_kucing.php">
                            Tambah Kucing
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">
                            Booking
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="tambah_booking.php">
                            Tambah Booking
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- HERO -->
    <section class="hero-dashboard">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h1>
                        Selamat Datang,<br>
                        <span><?php echo htmlspecialchars($nama); ?></span>
                    </h1>

                    <p>
                        Dashboard pengguna MeowStay digunakan untuk mengelola data anabul,
                        melakukan booking penitipan kucing, melihat status reservasi,
                        serta mengakses berbagai layanan hotel kucing premium secara online.
                    </p>

                    <div class="mt-4">

                        <a href="tambah_booking.php" class="btn btn-main me-3">
                            Booking Sekarang !
                        </a>

                        <a href="cats.php" class="btn btn-light btn-lg rounded-pill fw-bold">
                            Data Kucing
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- STATISTIK -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    Statistik <span>Pengguna</span>
                </h2>

                <p class="section-sub">
                    Informasi singkat mengenai aktivitas akun MeowStay anda.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="dashboard-card">

                        <div class="dashboard-icon">
                            <i class="bi bi-heart-fill"></i>
                        </div>

                        <h5>Total Kucing</h5>

                        <h3>
                            <?php echo $totalKucing['total_kucing']; ?>
                        </h3>

                        <p>
                            Jumlah seluruh data anabul yang telah didaftarkan pada sistem MeowStay.
                        </p>

                        <a href="cats.php" class="btn btn-main mt-2">
                            Lihat Data
                        </a>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="dashboard-card">

                        <div class="dashboard-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>

                        <h5>Total Booking</h5>

                        <h3>
                            <?php echo $totalBooking['total_booking']; ?>
                        </h3>

                        <p>
                            Jumlah seluruh reservasi penitipan yang pernah dilakukan pengguna.
                        </p>

                        <a href="bookings.php" class="btn btn-main mt-2">
                            Lihat Booking
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- MENU CEPAT -->
    <section class="pb-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    Menu <span>Cepat</span>
                </h2>

                <p class="section-sub">
                    Akses fitur utama MeowStay dengan lebih mudah dan cepat.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="dashboard-card text-center">

                        <div class="dashboard-icon mx-auto">
                            <i class="bi bi-plus-circle-fill"></i>
                        </div>

                        <h5>Tambah Kucing</h5>

                        <p>
                            Tambahkan data anabul baru ke sistem MeowStay.
                        </p>

                        <a href="tambah_kucing.php" class="btn btn-main">
                            Tambah
                        </a>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="dashboard-card text-center">

                        <div class="dashboard-icon mx-auto">
                            <i class="bi bi-calendar2-check-fill"></i>
                        </div>

                        <h5>Booking</h5>

                        <p>
                            Lakukan reservasi penitipan kucing dengan mudah.
                        </p>

                        <a href="tambah_booking.php" class="btn btn-main">
                            Booking
                        </a>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="dashboard-card text-center">

                        <div class="dashboard-icon mx-auto">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <h5>Riwayat</h5>

                        <p>
                            Lihat seluruh riwayat booking penitipan anda.
                        </p>

                        <a href="bookings.php" class="btn btn-main">
                            Riwayat
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- INFORMASI AKUN -->
    <section class="pb-5">

        <div class="container">

            <div class="info-user">

                <div class="row align-items-center">

                    <div class="col-md-2 text-center mb-4 mb-md-0">

                        <div class="dashboard-icon mx-auto">
                            <i class="bi bi-person-fill"></i>
                        </div>

                    </div>

                    <div class="col-md-10">

                        <h3 class="fw-bold mb-4">
                            <b>Informasi Akun Pengguna</b>
                        </h3>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <strong>Nama Lengkap</strong>

                                <p class="mt-2">
                                    <?php echo htmlspecialchars($nama); ?>
                                </p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Username</strong>

                                <p class="mt-2">
                                    <?php echo htmlspecialchars($username); ?>
                                </p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Role Akun</strong>

                                <p class="mt-2 text-capitalize">
                                    <?php echo htmlspecialchars($role); ?>
                                </p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Status Akun</strong>

                                <p class="mt-2">
                                    Aktif
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- BOOKING TERAKHIR -->
    <section class="pb-5">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

                <div>

                    <h2 class="section-title mb-1">
                        Booking <span>Terakhir</span>
                    </h2>

                    <p class="section-sub mb-0">
                        Riwayat booking terbaru pengguna MeowStay.
                    </p>

                </div>

                <a href="bookings.php" class="btn btn-main">
                    Lihat Semua
                </a>

            </div>

            <div class="table-responsive table-custom">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Nama Kucing</th>
                            <th>Paket</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (count($dataBooking) == 0) { ?>

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <i class="bi bi-calendar-x-fill" style="font-size:70px;color:#E35336;"></i>

                                    <h4 class="mt-4 fw-bold">
                                        Belum Ada Booking
                                    </h4>

                                    <p class="text-muted">
                                        Anda belum melakukan reservasi penitipan kucing.
                                    </p>

                                    <a href="tambah_booking.php" class="btn btn-main mt-2">
                                        Tambah Booking
                                    </a>

                                </td>

                            </tr>

                        <?php } else { ?>

                            <?php
                            $no = 1;

                            foreach ($dataBooking as $booking) {
                                ?>

                                <tr>

                                    <td>
                                        <?php echo $no++; ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($booking['nama_kucing']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($booking['paket']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($booking['checkin']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($booking['checkout']); ?>
                                    </td>

                                    <td>

                                        <?php
                                        if ($booking['status'] == "Diterima") {
                                            echo "<span class='badge bg-success badge-status'>Diterima</span>";
                                        } elseif ($booking['status'] == "Menunggu") {
                                            echo "<span class='badge bg-warning text-dark badge-status'>Menunggu</span>";
                                        } elseif ($booking['status'] == "Ditolak") {
                                            echo "<span class='badge bg-danger badge-status'>Ditolak</span>";
                                        } else {
                                            echo "<span class='badge bg-primary badge-status'>Selesai</span>";
                                        }
                                        ?>

                                    </td>

                                </tr>

                            <?php } ?>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="pb-5">

        <div class="container">

            <div class="dashboard-card text-center">

                <h2 class="section-title">
                    Siap Menitipkan <span>Anabul</span> ?
                </h2>

                <p class="section-sub">
                    Lakukan booking sekarang dan berikan kenyamanan terbaik untuk kucing kesayangan anda.
                </p>

                <a href="tambah_booking.php" class="btn btn-main">
                    Booking Sekarang !
                </a>

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