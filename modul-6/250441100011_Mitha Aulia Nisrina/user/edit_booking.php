<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

// CEK ROLE
if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$idUser = $_SESSION['id_user'];

$success = "";
$error = "";

// CEK ID BOOKING
if (!isset($_GET['id'])) {
    header("Location: bookings.php");
    exit;
}

$idBooking = $_GET['id'];

// AMBIL DATA BOOKING
$stmt = $conn->prepare("
    SELECT bookings.*, cats.nama_kucing
    FROM bookings
    JOIN cats ON bookings.cat_id = cats.id
    WHERE bookings.id=? AND bookings.user_id=?
");
$stmt->execute([$idBooking, $idUser]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// JIKA DATA TIDAK ADA
if (!$data) {
    header("Location: bookings.php");
    exit;
}

// JIKA STATUS SUDAH DITERIMA / SELESAI / DITOLAK
if (
    $data['status'] == 'Diterima' ||
    $data['status'] == 'Selesai' ||
    $data['status'] == 'Ditolak'
) {
    $error = "Booking ini sudah diproses admin dan tidak bisa diedit lagi.";
}

// AMBIL DATA KUCING USER
$stmtCats = $conn->prepare("
    SELECT *
    FROM cats
    WHERE user_id=?
    ORDER BY id DESC
");
$stmtCats->execute([$idUser]);
$dataCats = $stmtCats->fetchAll(PDO::FETCH_ASSOC);


// PROSES UPDATE
if (isset($_POST['update']) && $error == "") {

    $cat_id = htmlspecialchars(trim($_POST['cat_id']));
    $paket = htmlspecialchars(trim($_POST['paket']));
    $checkin = htmlspecialchars(trim($_POST['checkin']));
    $checkout = htmlspecialchars(trim($_POST['checkout']));
    $catatan = htmlspecialchars(trim($_POST['catatan']));

    // VALIDASI
    if (
        empty($cat_id) ||
        empty($paket) ||
        empty($checkin) ||
        empty($checkout)
    ) {

        $error = "Semua data wajib diisi!";

    } else {

        $tanggal1 = strtotime($checkin);
        $tanggal2 = strtotime($checkout);

        $selisih = $tanggal2 - $tanggal1;

        $lama_hari = $selisih / (60 * 60 * 24);

        if ($lama_hari <= 0) {

            $error = "Tanggal check out harus lebih besar dari check in!";

        } else {

            // HARGA
            if ($paket == "Regular") {
                $harga = 70000;
            } elseif ($paket == "Premium") {
                $harga = 110000;
            } else {
                $harga = 150000;
            }

            $total_harga = $harga * $lama_hari;

            // UPDATE
            $update = $conn->prepare("
                UPDATE bookings
                SET
                    cat_id=?,
                    paket=?,
                    checkin=?,
                    checkout=?,
                    lama_hari=?,
                    total_harga=?,
                    catatan=?
                WHERE id=? AND user_id=?
            ");

            $update->execute([
                $cat_id,
                $paket,
                $checkin,
                $checkout,
                $lama_hari,
                $total_harga,
                $catatan,
                $idBooking,
                $idUser
            ]);

            $success = "Booking berhasil diperbarui!";

            // REFRESH DATA
            $stmt = $conn->prepare("
                SELECT bookings.*, cats.nama_kucing
                FROM bookings
                JOIN cats ON bookings.cat_id = cats.id
                WHERE bookings.id=? AND bookings.user_id=?
            ");
            $stmt->execute([$idBooking, $idUser]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Booking | MeowStay</title>

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

        .page-header {
            padding-top: 140px;
            padding-bottom: 70px;
            text-align: center;
            color: white;
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
        }

        .page-header h1 {
            font-size: 52px;
            font-weight: 900;
        }

        .page-header span {
            color: #F4A460;
        }

        .form-section {
            padding: 80px 0;
        }

        .form-card {
            background: white;
            border-radius: 30px;
            padding: 45px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .form-title {
            font-size: 38px;
            font-weight: 900;
            color: #713600;
        }

        .form-title span {
            color: #E35336;
        }

        .form-sub {
            color: #6c4b2a;
            margin-bottom: 35px;
        }

        .form-label {
            font-weight: 700;
            color: #713600;
        }

        .form-control,
        .form-select {
            height: 55px;
            border-radius: 15px;
        }

        textarea.form-control {
            height: 140px;
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
        }

        .btn-second {
            background: #713600;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
        }

        .btn-second:hover {
            background: #5c2d00;
        }

        .alert {
            border-radius: 15px;
            font-weight: 600;
        }

        .footer {
            background: #38240D;
            padding: 25px 0;
            margin-top: 50px;
        }

        .footer p {
            margin: 0;
            color: #FDFBD4;
        }

        .footer span {
            color: #F4A460;
            font-weight: 800;
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


    <!-- HEADER -->
    <section class="page-header">

        <div class="container">

            <h1>Edit <span>Booking</span></h1>

            <p>
                Silakan ubah data booking penitipan anda.
            </p>

        </div>

    </section>


    <!-- FORM -->
    <section class="form-section">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-9">

                    <div class="form-card">

                        <h2 class="form-title">
                            Edit <span>Booking</span>
                        </h2>

                        <p class="form-sub">
                            Perbarui data booking sesuai kebutuhan anda.
                        </p>


                        <!-- ALERT -->
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


                        <form method="POST">

                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Pilih Kucing
                                    </label>

                                    <select name="cat_id" class="form-select">

                                        <?php foreach ($dataCats as $cat) { ?>

                                            <option value="<?php echo $cat['id']; ?>" <?php if ($data['cat_id'] == $cat['id'])
                                                   echo "selected"; ?>>

                                                <?php echo $cat['nama_kucing']; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Pilih Paket
                                    </label>

                                    <select name="paket" class="form-select">

                                        <option value="Regular" <?php if ($data['paket'] == "Regular")
                                            echo "selected"; ?>>
                                            Regular
                                        </option>

                                        <option value="Premium" <?php if ($data['paket'] == "Premium")
                                            echo "selected"; ?>>
                                            Premium
                                        </option>

                                        <option value="VIP" <?php if ($data['paket'] == "VIP")
                                            echo "selected"; ?>>
                                            VIP
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Check In
                                    </label>

                                    <input type="date" name="checkin" class="form-control"
                                        value="<?php echo $data['checkin']; ?>">

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Check Out
                                    </label>

                                    <input type="date" name="checkout" class="form-control"
                                        value="<?php echo $data['checkout']; ?>">

                                </div>

                                <div class="col-12 mb-4">

                                    <label class="form-label">
                                        Catatan Tambahan
                                    </label>

                                    <textarea name="catatan"
                                        class="form-control"><?php echo $data['catatan']; ?></textarea>

                                </div>

                            </div>

                            <div class="d-flex gap-3 flex-wrap">

                                <?php if ($error == "" || $success != "") { ?>

                                    <button type="submit" name="update" class="btn btn-main">

                                        <i class="bi bi-pencil-square"></i>
                                        Update Booking

                                    </button>

                                <?php } ?>

                                <a href="bookings.php" class="btn btn-second">

                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                    Kembali

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
                © Copyright 2026 <span>MeowStay</span>.
                Sistem Penitipan Kucing Berbasis Web.
            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>