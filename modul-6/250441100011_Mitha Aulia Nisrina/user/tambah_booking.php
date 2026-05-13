<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$idUser = $_SESSION['id_user'];
$nama = $_SESSION['nama'];

$success = "";
$error = "";

$stmtCats = $conn->prepare("
    SELECT *
    FROM cats
    WHERE user_id=?
    ORDER BY id DESC
");
$stmtCats->execute([$idUser]);
$dataCats = $stmtCats->fetchAll(PDO::FETCH_ASSOC);

if (count($dataCats) == 0) {
    $error = "Anda belum memiliki data kucing. Silakan tambahkan data kucing terlebih dahulu.";
}

if (isset($_POST['booking'])) {

    $cat_id = trim($_POST['cat_id']);
    $paket = trim($_POST['paket']);
    $checkin = trim($_POST['checkin']);
    $checkout = trim($_POST['checkout']);
    $catatan = trim($_POST['catatan']);

    /* VALIDASI KOSONG */
    if (
        empty($cat_id) ||
        empty($paket) ||
        empty($checkin) ||
        empty($checkout)
    ) {

        $error = "Semua data wajib diisi!";

    } else {

        $tgl1 = strtotime($checkin);
        $tgl2 = strtotime($checkout);

        $selisih = ($tgl2 - $tgl1) / (60 * 60 * 24);

        /* VALIDASI TANGGAL */
        if ($selisih <= 0) {

            $error = "Tanggal Check Out harus lebih besar dari Check In!";

        } else {

            $lama_hari = $selisih;

            /* HITUNG HARGA */
            if ($paket == "Regular") {

                $harga = 70000;

            } elseif ($paket == "Premium") {

                $harga = 110000;

            } else {

                $harga = 150000;

            }

            $total_harga = $harga * $lama_hari;

            /* INSERT DATABASE */
            $insert = $conn->prepare("
                INSERT INTO bookings
                (
                    user_id,
                    cat_id,
                    paket,
                    checkin,
                    checkout,
                    lama_hari,
                    total_harga,
                    status,
                    catatan
                )
                VALUES
                (
                    ?,?,?,?,?,?,?,?,?
                )
            ");

            $insert->execute([
                $idUser,
                $cat_id,
                $paket,
                $checkin,
                $checkout,
                $lama_hari,
                $total_harga,
                'Menunggu',
                $catatan
            ]);

            $success = "Booking berhasil dibuat! Status booking anda saat ini adalah Menunggu.";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tambah Booking | MeowStay</title>

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
            font-size: 28px;
            font-weight: 900;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            margin-left: 10px;
        }

        .nav-link:hover {
            color: #F4A460 !important;
        }

        .page-header {
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');

            background-size: cover;
            background-position: center;

            padding-top: 150px;
            padding-bottom: 80px;
            text-align: center;
            color: white;
        }

        .page-header h1 {
            font-size: 55px;
            font-weight: 900;
        }

        .page-header span {
            color: #F4A460;
        }

        .booking-card {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .form-label {
            font-weight: 700;
            color: #713600;
        }

        .form-control,
        .form-select {
            height: 55px;
            border-radius: 14px;
        }

        textarea.form-control {
            height: 130px;
            resize: none;
        }

        .btn-main {
            background: #E35336;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
        }

        .btn-main:hover {
            background: #C05800;
            color: white;
        }

        .btn-second {
            background: #F4A460;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
        }

        .btn-second:hover {
            background: #d98b3d;
            color: white;
        }

        .info-box {
            background: #FFF6EE;
            border-left: 5px solid #E35336;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .footer {
            background: #38240D;
            padding: 25px 0;
            margin-top: 80px;
        }

        .footer p {
            color: #FDFBD4;
            margin: 0;
        }

        .footer span {
            color: #F4A460;
            font-weight: 800;
        }

        .alert {
            border-radius: 15px;
            font-weight: 600;
        }

        @media(max-width:768px) {

            .page-header h1 {
                font-size: 38px;
            }

            .booking-card {
                padding: 25px;
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
                        <a class="nav-link active" href="bookings.php">Booking</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <section class="page-header">

        <div class="container">

            <h1>
                Tambah <span>Booking</span>
            </h1>

            <p>
                Lakukan reservasi penitipan kucing dengan mudah dan cepat.
            </p>

        </div>

    </section>

    <!-- FORM -->
    <section class="py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-9">

                    <div class="booking-card">

                        <div class="info-box">

                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-info-circle-fill"></i>
                                Informasi Booking
                            </h5>

                            <ul class="mb-0">
                                <li>Pilih data kucing yang akan dititipkan.</li>
                                <li>Isi tanggal check in dan check out dengan benar.</li>
                                <li>Total harga dihitung otomatis.</li>
                                <li>Status awal booking adalah <b>Menunggu</b>.</li>
                            </ul>

                        </div>

                        <!-- VALIDASI -->
                        <?php if ($success != "") { ?>

                            <div class="alert alert-success">

                                <i class="bi bi-check-circle-fill"></i>
                                <?php echo $success; ?>

                            </div>

                        <?php } ?>

                        <?php if ($error != "") { ?>

                            <div class="alert alert-danger">

                                <i class="bi bi-exclamation-circle-fill"></i>
                                <?php echo $error; ?>

                            </div>

                        <?php } ?>

                        <!-- FORM -->
                        <form method="POST">

                            <div class="mb-4">

                                <label class="form-label">
                                    Pilih Kucing
                                </label>

                                <select name="cat_id" class="form-select">

                                    <option value="">
                                        -- Pilih Kucing --
                                    </option>

                                    <?php foreach ($dataCats as $cat) { ?>

                                        <option value="<?php echo $cat['id']; ?>">

                                            <?php echo htmlspecialchars($cat['nama_kucing']); ?>
                                            -
                                            <?php echo htmlspecialchars($cat['jenis']); ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Pilih Paket
                                </label>

                                <select name="paket" class="form-select">

                                    <option value="">
                                        -- Pilih Paket --
                                    </option>

                                    <option value="Regular">
                                        Regular - Rp70.000 / malam
                                    </option>

                                    <option value="Premium">
                                        Premium - Rp110.000 / malam
                                    </option>

                                    <option value="VIP">
                                        VIP - Rp150.000 / malam
                                    </option>

                                </select>

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tanggal Check In
                                    </label>

                                    <input type="date" name="checkin" class="form-control">

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tanggal Check Out
                                    </label>

                                    <input type="date" name="checkout" class="form-control">

                                </div>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Catatan Tambahan
                                </label>

                                <textarea name="catatan" class="form-control"
                                    placeholder="Contoh: jadwal makan, vitamin, karakter kucing, dll"></textarea>

                            </div>

                            <div class="d-flex flex-wrap gap-3">

                                <button type="submit" name="booking" class="btn btn-main">

                                    <i class="bi bi-calendar-plus-fill"></i>
                                    Booking Sekarang

                                </button>

                                <a href="bookings.php" class="btn btn-second">

                                    <i class="bi bi-clock-history"></i>
                                    Lihat Booking

                                </a>

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
                © Copyright 2026
                <span>MeowStay</span>.
                Sistem Penitipan Kucing Berbasis Web.
            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>