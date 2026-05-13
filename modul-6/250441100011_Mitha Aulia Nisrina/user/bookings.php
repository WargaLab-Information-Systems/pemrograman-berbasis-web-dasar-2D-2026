<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

// CEK LOGIN USER
if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

// DATA SESSION
$idUser = $_SESSION['id_user'];
$nama = $_SESSION['nama'];

// AMBIL DATA BOOKING USER
$stmt = $conn->prepare("
    SELECT bookings.*, cats.nama_kucing
    FROM bookings
    JOIN cats ON bookings.cat_id = cats.id
    WHERE bookings.user_id = ?
    ORDER BY bookings.id DESC
");
$stmt->execute([$idUser]);
$dataBooking = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Booking | MeowStay</title>

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

        /* NAVBAR */
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

        /* HERO */
        .hero-page {
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');

            background-size: cover;
            background-position: center;

            min-height: 330px;
            display: flex;
            align-items: center;

            padding-top: 120px;
            padding-bottom: 70px;

            color: white;
        }

        .hero-page h1 {
            font-size: 55px;
            font-weight: 900;
        }

        .hero-page h1 span {
            color: #F4A460;
        }

        .hero-page p {
            font-size: 18px;
            color: #FDFBD4;
            margin-top: 18px;
            line-height: 1.8;
        }

        /* BUTTON */
        .btn-main {
            background: #E35336;
            border: none;
            color: white;
            padding: 13px 28px;
            border-radius: 50px;
            font-weight: 700;
            transition: .3s;
            box-shadow: 0 8px 20px rgba(227, 83, 54, .25);
        }

        .btn-main:hover {
            background: #C05800;
            color: white;
            transform: translateY(-2px);
        }

        .btn-second {
            background: #F4A460;
            border: none;
            color: white;
            padding: 13px 28px;
            border-radius: 50px;
            font-weight: 700;
        }

        .btn-second:hover {
            background: #d98b3d;
            color: white;
        }

        /* SECTION */
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
            margin-top: 10px;
            margin-bottom: 35px;
        }

        /* TABLE */
        .table-wrapper {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .table {
            margin: 0;
        }

        .table thead {
            background: #713600;
            color: white;
        }

        .table td {
            vertical-align: middle;
        }

        .booking-title {
            font-weight: 800;
            color: #713600;
        }

        .detail-box {
            background: #FFF6EE;
            padding: 12px;
            border-radius: 14px;
            font-size: 14px;
            color: #6c4b2a;
        }

        /* BADGE */
        .badge-status {
            padding: 10px 14px;
            border-radius: 30px;
            font-size: 13px;
        }

        /* ACTION */
        .action-btn {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            color: white;
            transition: .3s;
        }

        .btn-edit {
            background: #F4A460;
        }

        .btn-edit:hover {
            background: #d98b3d;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn-delete:hover {
            background: #bb2d3b;
        }

        /* EMPTY */
        .empty-box {
            background: white;
            padding: 60px 30px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .empty-box i {
            font-size: 80px;
            color: #E35336;
        }

        .empty-box h3 {
            margin-top: 20px;
            font-weight: 900;
            color: #713600;
        }

        /* FOOTER */
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

        /* MOBILE */
        @media(max-width:768px) {

            .hero-page {
                text-align: center;
            }

            .hero-page h1 {
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

            <a class="navbar-brand" href="#">
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
                        <a class="nav-link active" href="bookings.php">Booking</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero-page">

        <div class="container">

            <div class="row">

                <div class="col-lg-8">

                    <h1>Data <span>Booking</span></h1>

                    <p>
                        Seluruh data reservasi penitipan kucing anda akan tampil
                        pada halaman ini lengkap dengan status booking dan detail layanan.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4">

                        <a href="tambah_booking.php" class="btn btn-main">
                            <i class="bi bi-plus-circle-fill"></i>
                            Tambah Booking
                        </a>

                        <a href="dashboard.php" class="btn btn-second">
                            <i class="bi bi-house-door-fill"></i>
                            Kembali Dashboard
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- DATA -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    Riwayat <span>Booking</span>
                </h2>

                <p class="section-sub">
                    Seluruh data booking penitipan kucing milik pengguna.
                </p>

            </div>

            <?php if (count($dataBooking) > 0) { ?>

                <div class="table-responsive table-wrapper">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kucing</th>
                                <th>Paket</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($dataBooking as $booking) {
                                ?>

                                <tr>

                                    <td><?php echo $no++; ?></td>

                                    <td>
                                        <div class="booking-title">
                                            <?php echo htmlspecialchars($booking['nama_kucing']); ?>
                                        </div>

                                        <small class="text-muted">
                                            <?php echo $booking['lama_hari']; ?> Hari
                                        </small>
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
                                        Rp <?php echo number_format($booking['total_harga'], 0, ',', '.'); ?>
                                    </td>

                                    <td>

                                        <?php
                                        if ($booking['status'] == "Menunggu") {
                                            echo "<span class='badge bg-warning text-dark badge-status'>Menunggu</span>";
                                        } elseif ($booking['status'] == "Diterima") {
                                            echo "<span class='badge bg-success badge-status'>Diterima</span>";
                                        } elseif ($booking['status'] == "Ditolak") {
                                            echo "<span class='badge bg-danger badge-status'>Ditolak</span>";
                                        } else {
                                            echo "<span class='badge bg-primary badge-status'>Selesai</span>";
                                        }
                                        ?>

                                    </td>

                                    <td width="260">

                                        <div class="detail-box">
                                            <?php echo htmlspecialchars($booking['catatan']); ?>
                                        </div>

                                    </td>

                                    <td>

                                        <?php if ($booking['status'] == "Menunggu") { ?>

                                            <div class="d-flex gap-2">

                                                <a href="edit_booking.php?id=<?php echo $booking['id']; ?>"
                                                    class="action-btn btn-edit d-flex align-items-center justify-content-center text-decoration-none">

                                                    <i class="bi bi-pencil-fill"></i>

                                                </a>

                                                <a href="hapus_booking.php?id=<?php echo $booking['id']; ?>"
                                                    class="action-btn btn-delete d-flex align-items-center justify-content-center text-decoration-none"
                                                    onclick="return confirm('Yakin ingin menghapus booking ini?')">

                                                    <i class="bi bi-trash-fill"></i>

                                                </a>

                                            </div>

                                        <?php } else { ?>

                                            <span class="text-muted fw-bold">
                                                Terkunci
                                            </span>

                                        <?php } ?>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } else { ?>

                <div class="empty-box">

                    <i class="bi bi-calendar-x-fill"></i>

                    <h3>Belum Ada Booking</h3>

                    <p class="mt-3 mb-4">
                        Anda belum melakukan booking penitipan kucing.
                        Silahkan lakukan reservasi terlebih dahulu.
                    </p>

                    <a href="tambah_booking.php" class="btn btn-main">

                        <i class="bi bi-plus-circle-fill"></i>

                        Booking Sekarang !

                    </a>

                </div>

            <?php } ?>

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