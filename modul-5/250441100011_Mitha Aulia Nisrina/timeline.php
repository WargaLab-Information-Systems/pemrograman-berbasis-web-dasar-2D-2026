<!-- Halaman 2 : Timeline Perjalanan Belajar Coding (timeline.php) -->

<?php

$timeline = array(

    "2025 - Awal Masuk Kuliah" =>
        "Resmi menjadi mahasiswi Universitas Trunojoyo Madura Program Studi Sistem Informasi. Mulai beradaptasi dengan dunia perkuliahan, mengikuti kegiatan ospek, makrab, serta mengenal lingkungan kampus baru. Semester awal menjadi pengalaman berharga karena berhasil memperoleh IP 4.0.",

    "2025 - Mulai Belajar Python" =>
        "Mulai mempelajari dasar pemrograman Python menggunakan Visual Studio Code. Belajar dari modul 1 sampai modul 7 seperti variabel, tipe data, input output, operator, percabangan, perulangan, function, list, tuple, dictionary, hingga pembuatan program sederhana untuk melatih logika berpikir.",

    "2026 - Mulai Belajar HTML" =>
        "Mulai mengenal dasar pembuatan website menggunakan HTML. Belajar membuat heading, paragraf, tabel, form, gambar, link, dan struktur halaman website sederhana.",

    "2026 - Mulai Belajar CSS" =>
        "Setelah memahami HTML, mulai mempelajari CSS untuk mempercantik tampilan website. Belajar warna, background, font, margin, padding, border, hover effect, card design, dan layout modern.",

    "2026 - Mulai Belajar Framework CSS" =>
        "Mulai mengenal framework CSS seperti Bootstrap dan Tailwind CSS. Belajar membuat tampilan website lebih cepat, rapi, responsive, dan elegan menggunakan class siap pakai.",

    "2026 - Mulai Belajar JavaScript" =>
        "Mulai memahami JavaScript untuk membuat website interaktif. Belajar validasi form, dark mode, light mode, button click, alert, dan manipulasi elemen website.",

    "2026 - Mulai Belajar PHP" =>
        "Mulai mempelajari PHP sebagai bahasa pemrograman server side. Belajar variabel, array, percabangan if else, perulangan foreach, fungsi, form method post, dan pengolahan data input.",

    "2026 - Belajar Database Dasar" =>
        "Mulai mengenal konsep database seperti tabel, field, record, primary key, query dasar SQL, insert data, update data, delete data, dan select data.",

    "Project - Personal Profile Website" =>
        "Membuat website pribadi berbasis HTML yang berisi curriculum vitae, pengalaman kuliah, dan koleksi buku dengan navigasi antar halaman menggunakan hyperlink.",

    "Project - Landing Page MITHÉLIA Moisture Glow" =>
        "Membuat landing page produk skincare dengan desain elegan berisi deskripsi produk, keunggulan, alasan memilih produk, dan visual menarik.",

    "Project - Website Portofolio Pribadi" =>
        "Membuat website portofolio menggunakan Tailwind CSS yang menampilkan profil, skill, pengalaman, dan daftar project yang pernah dibuat.",

    "Project - Landing Page Profil Kota Cirebon" =>
        "Membuat website informatif mengenai Kota Cirebon yang berisi profil daerah, wisata, kuliner, dan layanan masyarakat.",

    "Project - Login Page & Homepage Education" =>
        "Membuat halaman login dan homepage online course disertai JavaScript untuk validasi form, fitur dark mode, dan light mode.",

    "Project Terbaru - Website PHP 3 Halaman" =>
        "Sedang mengembangkan website berbasis PHP yang terdiri dari halaman Profil Developer, Timeline Belajar Coding, dan Blog Developer."

);

function highlightTahun($judul)
{

    if (strpos($judul, "2025") !== false) {
        return "<span style='color:#B44446; font-weight:bold;'>$judul</span>";
    } else if (strpos($judul, "2026") !== false) {
        return "<span style='color:#64242F; font-weight:bold;'>$judul</span>";
    } else if (strpos($judul, "Project") !== false) {
        return "<span style='color:#E0115F; font-weight:bold;'>$judul</span>";
    } else {
        return "<span style='font-weight:bold;'>$judul</span>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Perjalanan Belajar Coding</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Verdana;
            background: linear-gradient(135deg, #DFD9D8, #FC8F8F, #DFD9D8);
            color: #64242F;
            padding: 30px;
        }

        .container {
            max-width: 1050px;
            margin: auto;
        }

        h1 {
            text-align: center;
            font-size: 34px;
            margin-bottom: 30px;
            color: #64242F;
            letter-spacing: 1px;
        }

        .intro {
            background: #64242F;
            padding: 18px 22px;
            border-radius: 16px;
            margin-bottom: 24px;
            border: 2px solid white;
            color: white;
            line-height: 1.8;
            text-align: justify;
            font-size: 15px;
            box-shadow: 0 10px 24px rgba(100, 36, 47, 0.08);
            transition: 0.3s ease;
        }

        .intro:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(100, 36, 47, 0.18);
        }

        .intro b {
            color: white;
            font-size: 16px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 20px;
            margin-bottom: 28px;
            border: 2px solid #f3b6b7;
            box-shadow: 0 12px 30px rgba(100, 36, 47, 0.10);
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(100, 36, 47, 0.18);
        }

        .timeline {
            position: relative;
            margin-top: 20px;
            padding-left: 35px;
            border-left: 4px solid #B44446;
        }

        .item {
            position: relative;
            margin-bottom: 28px;
            padding-left: 18px;
        }

        .item::before {
            content: "";
            position: absolute;
            left: -13px;
            top: 5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #64242F;
            border: 3px solid #FC8F8F;
        }

        .judul {
            font-size: 19px;
            margin-bottom: 8px;
        }

        .deskripsi {
            line-height: 1.8;
            text-align: justify;
            color: #5a3a40;
        }

        .nav {
            text-align: right;
            margin-top: 25px;
        }

        .nav a {
            text-decoration: none;
            background: linear-gradient(135deg, #B44446, #64242F);
            color: white;
            padding: 13px 20px;
            border-radius: 12px;
            margin-left: 10px;
            display: inline-block;
            font-weight: bold;
            transition: 0.3s;
        }

        .nav a:hover {
            opacity: 0.9;
            transform: translateY(-3px);
            box-shadow: 0 10px 18px rgba(100, 36, 47, 0.20);
        }

        .item {
            position: relative;
            margin-bottom: 28px;
            padding-left: 18px;
            transition: 0.3s;
        }

        .item:hover {
            transform: translateX(6px);
        }

        .item:hover::before {
            background: #B44446;
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Timeline Perjalanan Belajar Coding</h1>

        <div class="intro">
            <b>Perjalanan Belajar Coding Saya</b><br>
            Halaman ini menampilkan perjalanan belajar coding saya sejak awal memasuki dunia perkuliahan hingga mulai
            mengembangkan berbagai project website. Setiap tahap memberikan pengalaman baru, tantangan, serta
            peningkatan kemampuan di bidang teknologi dan pemrograman. Melalui proses ini, saya terus belajar,
            berkembang, dan berusaha menjadi developer yang lebih baik dari waktu ke waktu.
        </div>

        <div class="card">

            <div class="timeline">

                <?php

                foreach ($timeline as $judul => $isi) {

                    echo "<div class='item'>";
                    echo "<div class='judul'>" . highlightTahun($judul) . "</div>";
                    echo "<div class='deskripsi'>$isi</div>";
                    echo "</div>";

                }

                ?>

            </div>

        </div>

        <div class="nav">
            <a href="index.php">Kembali ke Profil Interaktif Developer</a>
            <a href="blog.php">Menuju Blog Reflektif Developer</a>
        </div>

    </div>

</body>

</html>