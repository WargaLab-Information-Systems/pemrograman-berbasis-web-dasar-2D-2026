<?php
include 'koneksi.php';

$stmtTesti = $conn->prepare("SELECT * FROM testimonials WHERE status='Tampil' ORDER BY id DESC");
$stmtTesti->execute();
$testimonials = $stmtTesti->fetchAll(PDO::FETCH_ASSOC);

$stmtGaleri = $conn->prepare("SELECT * FROM gallery WHERE status='Aktif' ORDER BY urutan ASC LIMIT 12");
$stmtGaleri->execute();
$gallery = $stmtGaleri->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MeowStay | Hotel dan Penitipan Kucing Premium</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
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
            font-weight: 800;
            color: #fff !important;
            letter-spacing: 1px;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 600;
            margin-left: 10px;
            transition: .3s;
        }

        .nav-link:hover {
            color: #F4A460 !important;
        }

        .hero {
            min-height: 100vh;
            background:
                linear-gradient(rgba(56, 36, 13, .78), rgba(56, 36, 13, .78)),
                url('assets/images/hero-cat.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding-top: 120px;
            padding-bottom: 80px;
        }

        .hero h1 {
            font-size: 64px;
            font-weight: 900;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .hero h1 .text-one {
            color: #fff;
        }

        .hero h1 .text-two {
            color: #F4A460;
        }

        .hero h1 .text-three {
            color: #E35336;
        }

        .hero p {
            font-size: 20px;
            color: #F5F5DC;
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .btn-main {
            background: #E35336;
            color: white;
            border: none;
            padding: 14px 34px;
            font-weight: 700;
            border-radius: 50px;
            transition: .3s;
            box-shadow: 0 8px 20px rgba(227, 83, 54, .3);
        }

        .btn-main:hover {
            background: #C05800;
            color: white;
            transform: translateY(-3px);
        }

        .btn-second {
            padding: 14px 34px;
            border-radius: 50px;
            font-weight: 700;
        }

        .section-title {
            font-size: 42px;
            font-weight: 900;
            color: #713600;
            margin-bottom: 15px;
        }

        .section-title span {
            color: #E35336;
        }

        .section-sub {
            color: #6c4b2a;
            margin-bottom: 50px;
            font-size: 17px;
        }

        .card-custom {
            border: none;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            transition: .4s;
            height: 100%;
            background: white;
        }

        .card-custom:hover {
            transform: translateY(-10px);
        }

        .about-icon {
            width: 75px;
            height: 75px;
            background: #FDF1E2;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: auto;
            margin-bottom: 20px;
            font-size: 32px;
            color: #E35336;
        }

        .card-custom h5 {
            font-weight: 800;
            margin-bottom: 15px;
        }

        .package-card {
            position: relative;
        }

        .package-regular {
            border: 4px solid #E35336;
        }

        .package-premium {
            border: 4px solid #F4A460;
        }

        .package-vip {
            border: 4px solid #713600;
        }

        .package-title {
            font-size: 30px;
            font-weight: 900;
        }

        .package-price {
            font-size: 38px;
            font-weight: 900;
            color: #E35336;
        }

        .package-card ul {
            padding-left: 0;
            list-style: none;
            margin-top: 25px;
        }

        .package-card ul li {
            margin-bottom: 12px;
            font-weight: 500;
        }

        .package-card ul li i {
            color: #E35336;
            margin-right: 8px;
        }

        .gallery-img {
            height: 250px;
            object-fit: cover;
            transition: .4s;
        }

        .card-custom:hover .gallery-img {
            transform: scale(1.05);
        }

        .gallery-title {
            font-weight: 800;
            font-size: 22px;
        }

        .testi-card {
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
            min-height: 390px;
        }

        .testi-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #F4A460;
        }

        .testi-name {
            font-weight: 900;
            font-size: 26px;
            margin-top: 15px;
        }

        .star {
            color: #E35336;
            font-size: 20px;
        }

        .cta {
            background: linear-gradient(90deg, #E35336, #713600);
            padding: 70px 30px;
            border-radius: 30px;
            color: white;
        }

        .cta h2 {
            font-size: 46px;
            font-weight: 900;
        }

        .cta h2 span {
            color: #FDFBD4;
        }

        .cta p {
            font-size: 18px;
            margin-top: 18px;
        }

        footer {
            background: #38240D;
            padding: 25px 0;
        }

        .footer-text {
            color: #FDFBD4;
            font-size: 16px;
            margin: 0;
        }

        .footer-text span {
            color: #F4A460;
            font-weight: 800;
        }

        @media(max-width:768px) {

            .hero {
                text-align: center;
                padding-top: 140px;
                padding-bottom: 80px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero p {
                font-size: 17px;
            }

            .section-title {
                font-size: 33px;
            }

            .cta h2 {
                font-size: 34px;
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
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#paket">Paket</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Daftar</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7">

                    <h1>
                        <span class="text-one">Hotel dan</span><br>
                        <span class="text-two">Penitipan Kucing</span><br>
                        <span class="text-three">Premium</span>
                    </h1>

                    <p>
                        MeowStay hadir sebagai tempat penitipan kucing yang aman, bersih,
                        nyaman, dan penuh kasih sayang. Cocok untuk owner yang ingin bepergian
                        tanpa khawatir meninggalkan anabul tercinta.
                    </p>

                    <div class="mt-4">
                        <a href="https://wa.me/6282220004944" class="btn btn-main me-3">
                            Booking Sekarang !
                        </a>

                        <a href="#paket" class="btn btn-light btn-second">
                            Lihat Paket
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section class="py-5" id="tentang">
        <div class="container text-center">

            <h2 class="section-title">
                Kenapa Memilih <span>MeowStay</span> ?
            </h2>

            <p class="section-sub">
                Kami memahami bahwa setiap kucing memiliki karakter unik.
                Karena itu setiap tamu mendapatkan perhatian personal.
            </p>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card card-custom p-4">
                        <div class="about-icon">
                            <i class="bi bi-house-heart"></i>
                        </div>
                        <h5>Ruangan Bersih</h5>
                        <p>
                            Kandang dibersihkan rutin dan sirkulasi udara terjaga.
                            Area penitipan nyaman dan aman untuk setiap anabul.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom p-4">
                        <div class="about-icon">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <h5>Jadwal Makan Teratur</h5>
                        <p>
                            Pemberian makan tiga kali sehari sesuai kebutuhan.
                            Makanan dan minuman selalu diperhatikan setiap hari.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom p-4">
                        <div class="about-icon">
                            <i class="bi bi-camera"></i>
                        </div>
                        <h5>Update Harian</h5>
                        <p>
                            Foto dan laporan kondisi kucing dikirim ke owner.
                            Membuat owner tetap tenang selama bepergian.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PAKET -->
    <section class="py-5 bg-white" id="paket">
        <div class="container text-center">

            <h2 class="section-title">
                Paket <span>Penitipan</span>
            </h2>

            <p class="section-sub">
                Pilih layanan terbaik sesuai kebutuhan anabul.
            </p>

            <div class="row g-4">

                <div class="col-lg-4">
                    <div class="card card-custom package-card package-regular p-4">
                        <h4 class="package-title">Regular</h4>
                        <div class="package-price">Rp70.000</div>
                        <p>/ malam</p>

                        <hr>

                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i>Makan 3x sehari</li>
                            <li><i class="bi bi-check-circle-fill"></i>Minum bersih selalu tersedia</li>
                            <li><i class="bi bi-check-circle-fill"></i>Pembersihan kandang rutin</li>
                            <li><i class="bi bi-check-circle-fill"></i>Monitoring dasar</li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-custom package-card package-premium p-4">
                        <h4 class="package-title">Premium</h4>
                        <div class="package-price">Rp110.000</div>
                        <p>/ malam</p>

                        <hr>

                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i>Semua fasilitas Regular</li>
                            <li><i class="bi bi-check-circle-fill"></i>Playtime terjadwal</li>
                            <li><i class="bi bi-check-circle-fill"></i>Grooming basic</li>
                            <li><i class="bi bi-check-circle-fill"></i>Vitamin ringan</li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-custom package-card package-vip p-4">
                        <h4 class="package-title">VIP</h4>
                        <div class="package-price">Rp150.000</div>
                        <p>/ malam</p>

                        <hr>

                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i>Private room nyaman</li>
                            <li><i class="bi bi-check-circle-fill"></i>Semua fasilitas Premium</li>
                            <li><i class="bi bi-check-circle-fill"></i>Report foto harian</li>
                            <li><i class="bi bi-check-circle-fill"></i>Prioritas perhatian staff</li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- GALERI -->
    <section class="py-5" id="galeri">
        <div class="container text-center">

            <h2 class="section-title">
                Galeri <span>MeowStay</span>
            </h2>

            <p class="section-sub">
                Beberapa suasana dan fasilitas terbaik kami.
            </p>

            <div class="row g-4">

                <?php foreach ($gallery as $g) { ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="card card-custom">

                            <img src="assets/images/<?php echo htmlspecialchars($g['gambar']); ?>"
                                class="gallery-img w-100">

                            <div class="p-4">
                                <h5 class="gallery-title">
                                    <?php echo htmlspecialchars($g['judul']); ?>
                                </h5>

                                <p>
                                    <?php echo htmlspecialchars($g['deskripsi']); ?>
                                </p>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>

    <!-- TESTIMONI -->
    <section class="py-5 bg-white" id="testimoni">
        <div class="container text-center">

            <h2 class="section-title">
                Testimoni <span>Pelanggan</span>
            </h2>

            <p class="section-sub">
                Kepercayaan owner adalah prioritas utama kami.
            </p>

            <div id="carouselTesti" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">

                <div class="carousel-inner">

                    <?php
                    $no = 1;
                    foreach ($testimonials as $t) {
                        ?>

                        <div class="carousel-item <?php if ($no == 1) {
                            echo 'active';
                        } ?>">
                            <div class="row justify-content-center">

                                <div class="col-lg-8">

                                    <div class="testi-card">

                                        <img src="assets/images/<?php echo htmlspecialchars($t['foto']); ?>"
                                            class="testi-img mb-3">

                                        <h4 class="testi-name">
                                            <?php echo htmlspecialchars($t['nama']); ?>
                                        </h4>

                                        <p class="text-muted fw-semibold">
                                            <?php echo htmlspecialchars($t['pekerjaan']); ?>
                                        </p>

                                        <p class="mt-4">
                                            <?php echo htmlspecialchars($t['isi']); ?>
                                        </p>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <?php $no++;
                    } ?>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTesti"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselTesti"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
                </button>

            </div>

        </div>
    </section>

    <!-- CTA -->
    <section class="py-5">
        <div class="container">

            <div class="cta text-center">

                <h2>
                    Siap Menitipkan <span>Kucing Kesayanganmu</span> ?
                </h2>

                <p>
                    Hubungi admin sekarang dan dapatkan tempat terbaik untuk anabulmu.
                </p>

                <a href="https://wa.me/6282220004944" class="btn btn-light btn-lg mt-3 fw-bold">
                    Chat WhatsApp Sekarang !
                </a>

            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center">
        <div class="container">

            <p class="footer-text">
                © Copyright 2026 <span>MeowStay</span>.
                Sistem Penitipan Kucing Berbasis Web.
            </p>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.history.scrollRestoration = "manual";

        window.onload = function () {
            window.scrollTo(0, 0);
        };
    </script>

</body>

</html>