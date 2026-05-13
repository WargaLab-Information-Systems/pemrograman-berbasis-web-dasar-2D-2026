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
        DELETE FROM bookings
        WHERE id=?
    ");

    $hapus->execute([$id]);

    header("Location: bookings.php");
    exit;
}

if (isset($_POST['update_status'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $update = $conn->prepare("
        UPDATE bookings
        SET status=?
        WHERE id=?
    ");

    $update->execute([$status, $id]);

    header("Location: bookings.php");
    exit;
}

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$filter = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "
SELECT
bookings.*,
users.nama_lengkap,
cats.nama_kucing,
cats.catatan
FROM bookings
LEFT JOIN users ON bookings.user_id = users.id
LEFT JOIN cats ON bookings.cat_id = cats.id
WHERE 1=1
";

$params = [];

if ($cari != '') {
    $sql .= " AND (
        users.nama_lengkap LIKE ?
        OR cats.nama_kucing LIKE ?
        OR bookings.paket LIKE ?
    ) ";
    $params[] = "%$cari%";
    $params[] = "%$cari%";
    $params[] = "%$cari%";
}

if ($filter != '') {
    $sql .= " AND bookings.status=? ";
    $params[] = $filter;
}

$sql .= " ORDER BY bookings.id DESC ";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$dataBooking = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalBooking = $conn->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
$totalMenunggu = $conn->query("SELECT COUNT(*) FROM bookings WHERE status='Menunggu'")->fetchColumn();
$totalDiterima = $conn->query("SELECT COUNT(*) FROM bookings WHERE status='Diterima'")->fetchColumn();
$totalSelesai = $conn->query("SELECT COUNT(*) FROM bookings WHERE status='Selesai'")->fetchColumn();
$totalUang = $conn->query("SELECT SUM(total_harga) FROM bookings WHERE status='Selesai'")->fetchColumn();

$namaAdmin = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Premium | MeowStay</title>

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
            color: #fff !important;
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
            min-height: 340px;
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

        .card-box {
            background: white;
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            height: 100%;
        }

        .card-box h3 {
            font-size: 38px;
            font-weight: 900;
            color: #713600;
        }

        .section-title {
            font-size: 42px;
            font-weight: 900;
            color: #713600;
        }

        .section-title span {
            color: #E35336;
        }

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

        .badge1 {
            background: #ffc107;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 700;
        }

        .badge2 {
            background: #198754;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 700;
        }

        .badge3 {
            background: #dc3545;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 700;
        }

        .badge4 {
            background: #0d6efd;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 700;
        }

        .btn-main {
            background: #E35336;
            color: white;
            border: none;
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

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="dashboard.php">MeowStay</a>

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

    <section class="hero">
        <div class="container">
            <h1>Booking <span>Premium</span></h1>
            <p>Kelola seluruh reservasi penitipan kucing MeowStay.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h5>Total Booking</h5>
                        <h3>
                            <?php echo $totalBooking; ?>
                        </h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h5>Menunggu</h5>
                        <h3>
                            <?php echo $totalMenunggu; ?>
                        </h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h5>Diterima</h5>
                        <h3>
                            <?php echo $totalDiterima; ?>
                        </h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h5>Uang Masuk</h5>
                        <h3>Rp
                            <?php echo number_format($totalUang); ?>
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <div class="card-box">

                <form method="GET" class="row g-3">

                    <div class="col-md-5">
                        <input type="text" name="cari" class="form-control" placeholder="Cari pemilik / kucing / paket"
                            value="<?php echo htmlspecialchars($cari); ?>">
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-main">Filter</button>
                    </div>

                    <div class="col-md-2 d-grid">
                        <a href="bookings.php" class="btn btn-secondary">Reset</a>
                    </div>

                </form>

            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">

            <h2 class="section-title mb-4">
                Data <span>Booking</span>
            </h2>

            <div class="table-responsive table-box">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemilik</th>
                            <th>Kucing</th>
                            <th>Paket</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Hari</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($dataBooking as $row) {

                            $pemilik = $row['nama_lengkap'];

                            if (!empty($row['catatan']) && strpos($row['catatan'], 'Milik ') !== false) {
                                $pecah = explode('Milik ', $row['catatan']);
                                $pemilik = trim(end($pecah));
                            }
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
                                    <?php echo $row['paket']; ?>
                                </td>

                                <td>
                                    <?php echo date('d-m-Y', strtotime($row['checkin'])); ?>
                                </td>

                                <td>
                                    <?php echo date('d-m-Y', strtotime($row['checkout'])); ?>
                                </td>

                                <td>
                                    <?php echo $row['lama_hari']; ?>
                                </td>

                                <td>Rp
                                    <?php echo number_format($row['total_harga']); ?>
                                </td>

                                <td>

                                    <?php if ($row['status'] == 'Menunggu') { ?>
                                        <span class="badge1">Menunggu</span>

                                    <?php } elseif ($row['status'] == 'Diterima') { ?>
                                        <span class="badge2">Diterima</span>

                                    <?php } elseif ($row['status'] == 'Ditolak') { ?>
                                        <span class="badge3">Ditolak</span>

                                    <?php } else { ?>
                                        <span class="badge4">Selesai</span>
                                    <?php } ?>

                                </td>

                                <td>

                                    <form method="POST" class="mb-2">

                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                        <select name="status" class="form-select form-select-sm mb-2">
                                            <option>Menunggu</option>
                                            <option>Diterima</option>
                                            <option>Ditolak</option>
                                            <option>Selesai</option>
                                        </select>

                                        <button type="submit" name="update_status" class="btn btn-sm btn-main w-100">
                                            Update
                                        </button>

                                    </form>

                                    <a href="bookings.php?hapus=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Yakin hapus data booking?')"
                                        class="btn btn-danger btn-sm w-100">
                                        Hapus
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>
    </section>

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