<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../user/dashboard.php");
    exit;
}

if (isset($_GET['hapus'])) {

    $id = $_GET['hapus'];

    $hapus = $conn->prepare("
        DELETE FROM cats
        WHERE id=?
    ");

    $hapus->execute([$id]);

    header("Location: cats.php");
    exit;
}

$stmt = $conn->prepare("
    SELECT cats.*, users.nama_lengkap
    FROM cats
    LEFT JOIN users ON cats.user_id = users.id
    ORDER BY cats.id DESC
");

$stmt->execute();
$dataCats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$namaAdmin = $_SESSION['nama'];

function ambilPemilik($row)
{
    if (!empty($row['catatan'])) {

        if (preg_match('/Milik (.*)$/i', $row['catatan'], $match)) {
            return trim($match[1]);
        }
    }

    return $row['nama_lengkap'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Kucing | Admin MeowStay</title>

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

        /* HERO */
        .hero {
            min-height: 360px;
            background:
                linear-gradient(rgba(56, 36, 13, .82), rgba(56, 36, 13, .82)),
                url('../assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding-top: 110px;
            color: white;
        }

        .hero h1 {
            font-size: 55px;
            font-weight: 900;
        }

        .hero span {
            color: #F4A460;
        }

        .hero p {
            font-size: 18px;
            margin-top: 18px;
            color: #FDFBD4;
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

        /* TABLE */
        .table-box {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .table thead {
            background: #713600;
            color: white;
        }

        /* BADGE */
        .badge-jantan {
            background: #ff9800;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .badge-betina {
            background: #e91e63;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        /* BUTTON */
        .btn-hapus {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
        }

        .btn-hapus:hover {
            background: #bb2d3b;
            color: white;
        }

        /* FOOTER */
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
                Data <span>Kucing</span>
            </h1>

            <p>
                Kelola seluruh data anabul pelanggan MeowStay dengan mudah.
            </p>

        </div>

    </section>

    <!-- DATA -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    Daftar <span>Kucing</span>
                </h2>

                <p>
                    Halo Admin,
                    <?php echo htmlspecialchars($namaAdmin); ?>
                </p>

            </div>

            <div class="table-responsive table-box">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemilik</th>
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

                        foreach ($dataCats as $row) {

                            $pemilik = ambilPemilik($row);
                            ?>

                            <tr>

                                <td>
                                    <?php echo $no++; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($pemilik); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['nama_kucing']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['jenis']); ?>
                                </td>

                                <td>

                                    <?php if ($row['gender'] == 'Jantan') { ?>

                                        <span class="badge-jantan">
                                            Jantan
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge-betina">
                                            Betina
                                        </span>

                                    <?php } ?>

                                </td>

                                <td>
                                    <?php echo $row['umur']; ?> Tahun
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['warna']); ?>
                                </td>

                                <td>
                                    <?php echo $row['berat']; ?> Kg
                                </td>

                                <td>

                                    <a href="cats.php?hapus=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Yakin hapus data ini?')" class="btn-hapus">

                                        <i class="bi bi-trash-fill"></i> Hapus

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                        <?php if (count($dataCats) == 0) { ?>

                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    Belum ada data kucing.
                                </td>
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