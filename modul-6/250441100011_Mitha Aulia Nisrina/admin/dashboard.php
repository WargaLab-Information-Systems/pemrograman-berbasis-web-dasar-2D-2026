<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../user/dashboard.php");
    exit;
}

// SESSION
$nama = $_SESSION['nama'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// TOTAL USER
$stmtUser = $conn->prepare("
    SELECT COUNT(*) as total_user
    FROM users
    WHERE role='user'
");
$stmtUser->execute();
$totalUser = $stmtUser->fetch(PDO::FETCH_ASSOC);

// TOTAL KUCING
$stmtCats = $conn->prepare("
    SELECT COUNT(*) as total_kucing
    FROM cats
");
$stmtCats->execute();
$totalKucing = $stmtCats->fetch(PDO::FETCH_ASSOC);

// TOTAL BOOKING
$stmtBooking = $conn->prepare("
    SELECT COUNT(*) as total_booking
    FROM bookings
");
$stmtBooking->execute();
$totalBooking = $stmtBooking->fetch(PDO::FETCH_ASSOC);

// BOOKING MENUNGGU
$stmtMenunggu = $conn->prepare("
    SELECT COUNT(*) as total_menunggu
    FROM bookings
    WHERE status='Menunggu'
");
$stmtMenunggu->execute();
$totalMenunggu = $stmtMenunggu->fetch(PDO::FETCH_ASSOC);

// BOOKING DITERIMA
$stmtDiterima = $conn->prepare("
    SELECT COUNT(*) as total_diterima
    FROM bookings
    WHERE status='Diterima'
");
$stmtDiterima->execute();
$totalDiterima = $stmtDiterima->fetch(PDO::FETCH_ASSOC);

// BOOKING SELESAI
$stmtSelesai = $conn->prepare("
    SELECT COUNT(*) as total_selesai
    FROM bookings
    WHERE status='Selesai'
");
$stmtSelesai->execute();
$totalSelesai = $stmtSelesai->fetch(PDO::FETCH_ASSOC);

// BOOKING TERBARU
$stmtLast = $conn->prepare("
    SELECT bookings.*, cats.nama_kucing
    FROM bookings
    JOIN cats ON bookings.cat_id = cats.id
    JOIN users ON bookings.user_id = users.id
    WHERE users.role='user'
    ORDER BY bookings.id DESC
    LIMIT 6
");
$stmtLast->execute();
$dataBooking = $stmtLast->fetchAll(PDO::FETCH_ASSOC);

// USER TERBARU
$stmtNewUser = $conn->prepare("
    SELECT *
    FROM users
    WHERE role='user'
    ORDER BY id DESC
    LIMIT 5
");
$stmtNewUser->execute();
$dataUser = $stmtNewUser->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Admin | MeowStay</title>

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
            min-height: 430px;
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding-top: 120px;
            color: white;
        }

        .hero h1 {
            font-size: 58px;
            font-weight: 900;
        }

        .hero span {
            color: #F4A460;
        }

        .hero p {
            font-size: 18px;
            color: #FDFBD4;
            margin-top: 20px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 900;
            color: #713600;
        }

        .section-title span {
            color: #E35336;
        }

        .section-sub {
            color: #6c4b2a;
            margin-bottom: 40px;
        }

        .card-box {
            background: white;
            border: none;
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            height: 100%;
        }

        .icon-box {
            width: 75px;
            height: 75px;
            background: #FFF1E8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #E35336;
            margin-bottom: 18px;
        }

        .card-box h3 {
            font-size: 40px;
            font-weight: 900;
            color: #713600;
        }

        .table-custom {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .table thead {
            background: #713600;
            color: white;
        }

        .footer {
            background: #38240D;
            padding: 25px 0;
            margin-top: 70px;
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

            .hero {
                text-align: center;
            }

            .hero h1 {
                font-size: 38px;
            }

            .section-title {
                font-size: 32px;
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

                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="cats.php">Data Kucing</a></li>
                    <li class="nav-item"><a class="nav-link" href="bookings.php">Data Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- HERO -->
    <section class="hero">

        <div class="container">

            <h1>
                Selamat Datang,<br>
                <span><?php echo htmlspecialchars($nama); ?></span>
            </h1>

            <p>
                Dashboard admin digunakan untuk mengelola seluruh data sistem MeowStay.
            </p>

        </div>

    </section>

    <!-- STATISTIK -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">
                <h2 class="section-title">Statistik <span>Admin</span></h2>
                <p class="section-sub">Ringkasan data sistem MeowStay.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                        <h5>Total User</h5>
                        <h3><?php echo $totalUser['total_user']; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon-box"><i class="bi bi-heart-fill"></i></div>
                        <h5>Total Kucing</h5>
                        <h3><?php echo $totalKucing['total_kucing']; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon-box"><i class="bi bi-calendar-check-fill"></i></div>
                        <h5>Total Booking</h5>
                        <h3><?php echo $totalBooking['total_booking']; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon-box"><i class="bi bi-clock-fill"></i></div>
                        <h5>Menunggu</h5>
                        <h3><?php echo $totalMenunggu['total_menunggu']; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon-box"><i class="bi bi-check-circle-fill"></i></div>
                        <h5>Diterima</h5>
                        <h3><?php echo $totalDiterima['total_diterima']; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon-box"><i class="bi bi-award-fill"></i></div>
                        <h5>Selesai</h5>
                        <h3><?php echo $totalSelesai['total_selesai']; ?></h3>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- BOOKING TERBARU -->
    <section class="pb-5">

        <div class="container">

            <h2 class="section-title mb-4">Booking <span>Terbaru</span></h2>

            <div class="table-responsive table-custom">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kucing</th>
                            <th>Paket</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($dataBooking as $row) {
                            ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_kucing']); ?></td>
                                <td><?php echo htmlspecialchars($row['paket']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

    <!-- USER TERBARU -->
    <section class="pb-5">

        <div class="container">

            <h2 class="section-title mb-4">User <span>Terbaru</span></h2>

            <div class="table-responsive table-custom">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($dataUser as $u) {
                            ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($u['nama_lengkap']); ?></td>
                                <td><?php echo htmlspecialchars($u['username']); ?></td>
                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

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