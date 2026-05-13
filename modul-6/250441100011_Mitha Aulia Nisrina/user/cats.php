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

// AMBIL DATA KUCING USER
$stmt = $conn->prepare("
    SELECT *
    FROM cats
    WHERE user_id=?
    ORDER BY id DESC
");
$stmt->execute([$idUser]);
$dataKucing = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Kucing | MeowStay</title>

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
            line-height: 1.2;
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

        .btn-main {
            background: #E35336;
            border: none;
            color: white;
            padding: 13px 28px;
            border-radius: 50px;
            font-weight: 700;
            transition: .3s;
            box-shadow: 0 8px 20px rgba(227, 83, 54, .3);
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
            transition: .3s;
            box-shadow: 0 8px 20px rgba(244, 164, 96, .3);
        }

        .btn-second:hover {
            background: #d98b3d;
            color: white;
            transform: translateY(-2px);
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
            margin-bottom: 35px;
        }

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

        .cat-name {
            font-weight: 800;
            color: #713600;
        }

        .badge-gender {
            padding: 10px 14px;
            border-radius: 30px;
            font-size: 13px;
        }

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

            .hero-page {
                text-align: center;
            }

            .hero-page h1 {
                font-size: 38px;
            }

            .section-title {
                font-size: 33px;
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
                        <a class="nav-link active" href="cats.php">
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

    <!-- HERO -->
    <section class="hero-page">

        <div class="container">

            <div class="row">

                <div class="col-lg-8">

                    <h1>
                        Data <span>Kucing</span>
                    </h1>

                    <p>
                        Kelola seluruh data anabul milik anda pada sistem MeowStay.
                        Data ini akan digunakan saat melakukan booking penitipan.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4">

                        <a href="tambah_kucing.php" class="btn btn-main">

                            <i class="bi bi-plus-circle-fill"></i>

                            Tambah Kucing

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
                    Daftar <span>Anabul</span>
                </h2>

                <p class="section-sub">
                    Seluruh data kucing yang telah didaftarkan pengguna.
                </p>

            </div>

            <?php if (count($dataKucing) > 0) { ?>

                <div class="table-responsive table-wrapper">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Nama Kucing</th>
                                <th>Jenis</th>
                                <th>Gender</th>
                                <th>Umur</th>
                                <th>Warna</th>
                                <th>Berat</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            foreach ($dataKucing as $kucing) {
                                ?>

                                <tr>

                                    <td>
                                        <?php echo $no++; ?>
                                    </td>

                                    <td>

                                        <div class="cat-name">
                                            <?php echo htmlspecialchars($kucing['nama_kucing']); ?>
                                        </div>

                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($kucing['catatan']); ?>
                                        </small>

                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($kucing['jenis']); ?>
                                    </td>

                                    <td>

                                        <?php
                                        if ($kucing['gender'] == "Jantan") {
                                            echo "<span class='badge bg-primary badge-gender'>Jantan</span>";
                                        } else {
                                            echo "<span class='badge bg-danger badge-gender'>Betina</span>";
                                        }
                                        ?>

                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($kucing['umur']); ?> Tahun
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($kucing['warna']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($kucing['berat']); ?> Kg
                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="edit_kucing.php?id=<?php echo $kucing['id']; ?>"
                                                class="action-btn btn-edit d-flex align-items-center justify-content-center text-decoration-none">

                                                <i class="bi bi-pencil-fill"></i>

                                            </a>

                                            <a href="hapus_kucing.php?id=<?php echo $kucing['id']; ?>"
                                                class="action-btn btn-delete d-flex align-items-center justify-content-center text-decoration-none"
                                                onclick="return confirm('Yakin ingin menghapus data kucing ini?')">

                                                <i class="bi bi-trash-fill"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } else { ?>

                <div class="empty-box">

                    <i class="bi bi-heartbreak-fill"></i>

                    <h3>
                        Belum Ada Data Kucing
                    </h3>

                    <p class="mt-3 mb-4">
                        Anda belum menambahkan data anabul.
                        Tambahkan data kucing terlebih dahulu sebelum melakukan booking penitipan.
                    </p>

                    <a href="tambah_kucing.php" class="btn btn-main">

                        <i class="bi bi-plus-circle-fill"></i>

                        Tambah Data Kucing

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