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

// CEK ID
if (!isset($_GET['id'])) {

    header("Location: cats.php");
    exit;

}

$idKucing = $_GET['id'];

// AMBIL DATA KUCING
$stmt = $conn->prepare("
    SELECT *
    FROM cats
    WHERE id=? AND user_id=?
");

$stmt->execute([
    $idKucing,
    $idUser
]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);

// JIKA DATA TIDAK ADA
if (!$data) {

    header("Location: cats.php");
    exit;

}

// PROSES UPDATE
if (isset($_POST['update'])) {

    $namaKucing = htmlspecialchars(trim($_POST['nama_kucing']));
    $jenis = htmlspecialchars(trim($_POST['jenis']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $umur = htmlspecialchars(trim($_POST['umur']));
    $warna = htmlspecialchars(trim($_POST['warna']));
    $berat = htmlspecialchars(trim($_POST['berat']));
    $catatan = htmlspecialchars(trim($_POST['catatan']));

    // VALIDASI
    if (
        empty($namaKucing) ||
        empty($jenis) ||
        empty($gender) ||
        empty($umur)
    ) {

        $error = "Data wajib harus diisi!";

    } else {

        $update = $conn->prepare("
            UPDATE cats
            SET
                nama_kucing=?,
                jenis=?,
                gender=?,
                umur=?,
                warna=?,
                berat=?,
                catatan=?
            WHERE id=? AND user_id=?
        ");

        $update->execute([
            $namaKucing,
            $jenis,
            $gender,
            $umur,
            $warna,
            $berat,
            $catatan,
            $idKucing,
            $idUser
        ]);

        $success = "Data kucing berhasil diperbarui!";

        // REFRESH DATA
        $stmt = $conn->prepare("
            SELECT *
            FROM cats
            WHERE id=? AND user_id=?
        ");

        $stmt->execute([
            $idKucing,
            $idUser
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Kucing | MeowStay</title>

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
            color: white !important;
            font-size: 28px;
            font-weight: 900;
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

        .page-header {
            padding-top: 140px;
            padding-bottom: 70px;
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        }

        .page-header h1 {
            font-size: 52px;
            font-weight: 900;
        }

        .page-header h1 span {
            color: #F4A460;
        }

        .page-header p {
            font-size: 18px;
            color: #FDFBD4;
            margin-top: 20px;
        }

        .form-section {
            padding: 80px 0;
        }

        .form-card {
            background: white;
            border: none;
            border-radius: 30px;
            padding: 45px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .form-title {
            font-size: 38px;
            font-weight: 900;
            color: #713600;
            margin-bottom: 10px;
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
            margin-bottom: 10px;
        }

        .form-control,
        .form-select {
            height: 55px;
            border-radius: 15px;
            border: 1px solid #ddd;
        }

        textarea.form-control {
            height: 140px;
            resize: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #E35336;
            box-shadow: none;
        }

        .btn-main {
            background: #E35336;
            border: none;
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
            transition: .3s;
            box-shadow: 0 8px 20px rgba(227, 83, 54, .3);
        }

        .btn-main:hover {
            background: #C05800;
            transform: translateY(-2px);
        }

        .btn-second {
            background: #713600;
            border: none;
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
            transition: .3s;
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

        @media(max-width:768px) {

            .page-header h1 {
                font-size: 38px;
            }

            .form-card {
                padding: 30px 22px;
            }

            .form-title {
                font-size: 30px;
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
                        <a class="nav-link" href="bookings.php">
                            Booking
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

    <!-- HEADER -->
    <section class="page-header">

        <div class="container">

            <h1>
                Edit <span>Data Kucing</span>
            </h1>

            <p>
                Perbarui informasi anabul anda dengan lengkap dan benar.
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
                            Edit <span>Kucing</span>
                        </h2>

                        <p class="form-sub">
                            Silakan ubah data anabul sesuai kebutuhan anda.
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

                        <!-- FORM -->
                        <form method="POST">

                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Nama Kucing
                                    </label>

                                    <input type="text" name="nama_kucing" class="form-control"
                                        value="<?php echo htmlspecialchars($data['nama_kucing']); ?>" required>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Jenis Kucing
                                    </label>

                                    <input type="text" name="jenis" class="form-control"
                                        value="<?php echo htmlspecialchars($data['jenis']); ?>" required>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Gender
                                    </label>

                                    <select name="gender" class="form-select" required>

                                        <option value="Jantan" <?php if ($data['gender'] == "Jantan") {
                                            echo "selected";
                                        } ?>>
                                            Jantan
                                        </option>

                                        <option value="Betina" <?php if ($data['gender'] == "Betina") {
                                            echo "selected";
                                        } ?>>
                                            Betina
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Umur Kucing
                                    </label>

                                    <input type="number" name="umur" class="form-control"
                                        value="<?php echo htmlspecialchars($data['umur']); ?>" required>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Warna Kucing
                                    </label>

                                    <input type="text" name="warna" class="form-control"
                                        value="<?php echo htmlspecialchars($data['warna']); ?>">

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Berat Kucing (Kg)
                                    </label>

                                    <input type="number" step="0.1" name="berat" class="form-control"
                                        value="<?php echo htmlspecialchars($data['berat']); ?>">

                                </div>

                                <div class="col-12 mb-4">

                                    <label class="form-label">
                                        Catatan Tambahan
                                    </label>

                                    <textarea name="catatan"
                                        class="form-control"><?php echo htmlspecialchars($data['catatan']); ?></textarea>

                                </div>

                            </div>

                            <div class="d-flex gap-3 flex-wrap">

                                <button type="submit" name="update" class="btn btn-main">

                                    <i class="bi bi-pencil-square"></i>

                                    Update Data Kucing

                                </button>

                                <a href="cats.php" class="btn btn-second">

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