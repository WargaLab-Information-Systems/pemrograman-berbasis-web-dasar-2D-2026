<!-- Halaman 3 : Blog Reflektif Developer (blog.php) -->

<?php

$artikel = array(

    1 => array(
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "1 Februari 2026",
        "gambar" => "img/Belajar HTML Pertama Kali.png",
        "link" => "https://www.w3schools.com/html/",
        "isi" => "Saat pertama kali mempelajari HTML, saya merasa sangat tertarik karena akhirnya mulai memahami bagaimana sebuah website dibangun dari struktur dasar. Saya belajar mengenai heading, paragraf, gambar, tabel, hyperlink, form, dan berbagai tag penting lainnya. Awalnya saya mengira membuat website merupakan hal yang rumit, namun setelah mencoba menuliskan tag satu per satu di Visual Studio Code, saya mulai memahami bahwa semuanya dapat dipelajari secara bertahap. Momen pertama kali melihat hasil tulisan sendiri tampil di browser memberikan rasa bangga tersendiri. Dari pengalaman tersebut saya belajar bahwa dasar yang kuat sangat penting, karena HTML menjadi fondasi utama dalam pembuatan website."
    ),

    2 => array(
        "judul" => "Berkali-kali Error Saat Coding, Tapi Tidak Menyerah",
        "tanggal" => "15 Februari 2026",
        "gambar" => "img/Berkali-kali Error Saat Coding, Tapi Tidak Menyerah.png",
        "link" => "https://www.w3schools.com/js/js_errors.asp",
        "isi" => "Dalam proses belajar coding, saya sering mengalami berbagai error yang datang berulang kali. Terkadang error muncul karena tanda titik koma yang lupa ditulis, nama variabel yang salah, kurung yang tidak lengkap, atau penulisan syntax yang kurang tepat. Pada awalnya hal tersebut membuat saya bingung dan merasa kesal, tetapi lama-kelamaan saya memahami bahwa error adalah bagian penting dari proses belajar. Justru dari error saya belajar menjadi lebih teliti, sabar, dan terbiasa membaca pesan kesalahan yang muncul. Setiap masalah yang berhasil diperbaiki memberikan pengalaman baru. Saya menyadari bahwa programmer yang hebat bukanlah yang tidak pernah error, tetapi yang mau terus mencari solusi sampai berhasil."
    ),

    3 => array(
        "judul" => "Saat CSS Membuat Website Lebih Menarik",
        "tanggal" => "10 Maret 2026",
        "gambar" => "img/Saat CSS Membuat Website Lebih Menarik.png",
        "link" => "https://www.w3schools.com/css/",
        "isi" => "Setelah memahami HTML, saya mulai mempelajari CSS dan langsung merasakan perubahan besar pada tampilan website. Jika HTML berfungsi sebagai kerangka, maka CSS adalah bagian yang memperindah keseluruhan desain. Saya belajar mengatur warna, background, font, border, margin, padding, hover effect, dan layout modern. Saat pertama kali melihat halaman sederhana berubah menjadi lebih menarik setelah diberi CSS, saya merasa sangat senang. Dari sini saya memahami bahwa desain yang baik dapat meningkatkan kenyamanan pengguna. CSS juga mengajarkan bahwa detail kecil seperti warna dan jarak antar elemen memiliki pengaruh besar terhadap tampilan akhir."
    ),

    4 => array(
        "judul" => "Belajar PHP dan Dunia Website Dinamis",
        "tanggal" => "25 Maret 2026",
        "gambar" => "img/Belajar PHP dan Dunia Website Dinamis.png",
        "link" => "https://www.w3schools.com/php/",
        "isi" => "Ketika mulai belajar PHP, saya merasa masuk ke tahap baru karena website tidak lagi hanya menampilkan tampilan statis, tetapi sudah bisa memproses data secara dinamis. Saya belajar mengenai variabel, array, percabangan if else, perulangan foreach, method GET dan POST, serta fungsi sederhana. Dari PHP saya memahami bagaimana form input dapat diproses, data dapat ditampilkan otomatis, dan halaman website menjadi lebih interaktif. Pada awalnya memang terasa menantang karena harus menggabungkan HTML dan PHP, namun semakin sering mencoba saya semakin memahami alurnya. PHP membuat saya sadar bahwa coding bukan hanya tentang tampilan, tetapi juga logika sistem di belakang layar."
    ),

    5 => array(
        "judul" => "Mengenal Framework CSS dengan Bootstrap",
        "tanggal" => "5 April 2026",
        "gambar" => "img/Mengenal Framework CSS dengan Bootstrap.png",
        "link" => "https://getbootstrap.com/",
        "isi" => "Saat mulai mempelajari Bootstrap, saya merasa pekerjaan membuat tampilan website menjadi lebih cepat dan rapi. Bootstrap menyediakan banyak class siap pakai seperti navbar, button, card, grid system, dan form yang memudahkan proses desain. Saya tidak perlu menulis CSS dari awal untuk setiap bagian. Selain itu, Bootstrap juga mempermudah pembuatan website responsive agar tampilan tetap baik di laptop maupun handphone. Dari pengalaman belajar Bootstrap, saya memahami bahwa framework sangat membantu developer dalam menghemat waktu sekaligus menjaga kerapian desain website."
    ),

    6 => array(
        "judul" => "Membuat Tampilan Modern dengan Tailwind CSS",
        "tanggal" => "12 April 2026",
        "gambar" => "img/Membuat Tampilan Modern dengan Tailwind CSS.png",
        "link" => "https://tailwindcss.com/",
        "isi" => "Setelah mengenal Bootstrap, saya juga belajar Tailwind CSS yang memiliki pendekatan berbeda. Tailwind menggunakan utility class sehingga desain bisa dibuat lebih fleksibel dan detail langsung di dalam HTML. Awalnya saya merasa class yang digunakan cukup banyak, namun setelah terbiasa saya justru menyukai kecepatannya. Dengan Tailwind, saya bisa membuat desain modern, bersih, elegan, dan responsive dengan lebih mudah. Pengalaman ini menambah wawasan saya bahwa setiap framework memiliki keunggulan masing-masing, dan developer perlu memilih tools sesuai kebutuhan project."
    ),

    7 => array(
        "judul" => "Harapan Menjadi Developer Masa Depan",
        "tanggal" => "1 Mei 2026",
        "gambar" => "img/Harapan Menjadi Developer Masa Depan.png",
        "link" => "https://roadmap.sh/",
        "isi" => "Perjalanan belajar coding yang saya jalani saat ini masih berada di tahap awal, namun saya memiliki harapan besar untuk terus berkembang di masa depan. Saya ingin memperdalam kemampuan di bidang frontend, backend, database, serta memahami proses pembuatan aplikasi secara utuh. Saya juga ingin membuat project yang bermanfaat bagi banyak orang, baik di bidang pendidikan, bisnis, maupun pelayanan masyarakat. Saya percaya bahwa kemampuan teknis harus disertai kedisiplinan, konsistensi, dan semangat belajar tanpa henti. Menjadi developer bukan hanya tentang menulis kode, tetapi tentang menciptakan solusi dari sebuah masalah."
    )

);

$quotes = array(
    "Tidak perlu langsung mahir, cukup terus mencoba dan belajar, karena kemampuan besar selalu dibangun dari langkah pertama.",
    "Programmer hebat bukan mereka yang tidak pernah salah, tetapi mereka yang tidak menyerah saat memperbaiki kesalahan.",
    "Website yang baik bukan hanya berfungsi dengan benar, tetapi juga mampu memberikan pengalaman visual yang nyaman.",
    "Error hanyalah bagian dari proses belajar, sedangkan menyerah adalah satu-satunya kegagalan yang sebenarnya.",
    "Dalam dunia pemrograman, setiap error adalah pelajaran, setiap proses adalah pengalaman, dan setiap baris kode adalah langkah menuju kemampuan yang lebih besar.",
    "Pemrograman mengajarkan bahwa kesabaran, logika, dan konsistensi dapat mengubah ide sederhana menjadi sesuatu yang luar biasa.",
    "Programmer sejati bukan dinilai dari seberapa sedikit error yang dibuat, tetapi dari seberapa besar kemauan untuk terus belajar dan memperbaikinya."
);

$randomQuote = $quotes[array_rand($quotes)];

if (isset($_GET['artikel'])) {
    $id = $_GET['artikel'];
} else {
    $id = 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif Developer</title>

    <style>
        body {
            margin: 0;
            padding: 30px;
            font-family: Verdana;
            background: linear-gradient(135deg, #DFD9D8, #FC8F8F, #DFD9D8);
            color: #64242F;
        }

        .container {
            max-width: 1100px;
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
            line-height: 1.9;
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

        .wrap {
            display: flex;
            gap: 25px;
            align-items: flex-start;
        }

        .sidebar {
            width: 30%;
        }

        .content {
            width: 70%;
        }

        .judulbagian {
            background: #64242F;
            color: white;
            padding: 14px;
            border-radius: 14px;
            border: 2px solid white;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
            transition: 0.3s;
        }

        .judulbagian:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(100, 36, 47, 0.18);
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 25px;
            border: 2px solid #f3b6b7;
            box-shadow: 0 12px 30px rgba(100, 36, 47, 0.10);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(100, 36, 47, 0.18);
        }

        .menu {
            display: block;
            text-decoration: none;
            color: #64242F;
            padding: 14px 16px;
            margin-bottom: 12px;
            background: #fff6f6;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
            border: 2px solid #f3c7c7;
            line-height: 1.6;
        }

        .menu:hover {
            background: #64242F;
            color: white;
            transform: translateX(6px);
            border: 2px solid #f3b6b7;
        }

        .active {
            background: #64242F;
            color: white;
            border: 2px solid #f3b6b7;
            transform: translateX(6px);
        }

        img {
            width: 100%;
            border-radius: 16px;
            margin: 15px 0;
            border: 2px solid #64242F;
        }

        .tanggal {
            color: #B44446;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .isi {
            line-height: 1.9;
            text-align: justify;
        }

        .quote {
            background: #64242F;
            color: white;
            padding: 20px;
            border-radius: 14px;
            margin-top: 22px;
            font-style: italic;
            font-weight: bold;
            text-align: justify;
            line-height: 1.9;
            border: 2px solid #f3c7c7;
            transition: 0.3s;
        }

        .quote:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 18px rgba(100, 36, 47, 0.20);
        }

        .linkref {
            margin-top: 20px;
        }

        .linkref a {
            color: #B44446;
            font-weight: bold;
            text-decoration: none;
        }

        .linkref a:hover {
            text-decoration: underline;
        }

        .nav {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
            margin-top: 25px;
        }

        .nav a {
            text-decoration: none;
            background: linear-gradient(135deg, #B44446, #64242F);
            color: white;
            padding: 13px 20px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-weight: bold;
            transition: 0.3s;
            width: 450px;
            min-height: 15px;
        }

        .nav a:hover {
            opacity: 0.9;
            transform: translateY(-3px);
            box-shadow: 0 10px 18px rgba(100, 36, 47, 0.20);
        }

        .penutup {
            background: #64242F;
            border: 2px solid #f3b6b7;
            color: white;
            border-radius: 18px;
            padding: 22px;
            margin-top: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 24px rgba(100, 36, 47, 0.08);
            transition: 0.3s;
        }

        .penutup:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 32px rgba(100, 36, 47, 0.15);
        }

        .penutup h3 {
            margin-top: 0;
            color: white;
        }

        .penutup p {
            margin-bottom: 0;
            line-height: 1.9;
            text-align: justify;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Blog Reflektif Developer</h1>

        <div class="intro">
            <b>Catatan Perjalanan Belajar Coding</b><br>
            Halaman ini berisi kumpulan artikel refleksi mengenai pengalaman saya selama mempelajari dunia coding, mulai
            dari mengenal HTML, menghadapi error, belajar CSS, framework, hingga PHP. Setiap proses memberikan pelajaran
            berharga dan motivasi untuk terus berkembang menjadi developer yang lebih baik.
        </div>

        <div class="wrap">

            <div class="sidebar">
                <div class="judulbagian">
                    Judul Artikel
                </div>
                <div class="card">

                    <?php
                    foreach ($artikel as $key => $data) {

                        $kelas = "menu";

                        if ($id == $key) {
                            $kelas .= " active";
                        }

                        echo "<a class='$kelas' href='blog.php?artikel=$key#detail'>" . $data['judul'] . "</a>";

                    }
                    ?>

                </div>
            </div>

            <div class="content" id="detail">
                <div class="judulbagian">
                    Detail Artikel
                </div>
                <div class="card">

                    <h2><?php echo $artikel[$id]['judul']; ?></h2>

                    <div class="tanggal">
                        Tanggal Posting: <?php echo $artikel[$id]['tanggal']; ?>
                    </div>

                    <img src="<?php echo $artikel[$id]['gambar']; ?>">

                    <div class="isi">
                        <?php echo $artikel[$id]['isi']; ?>
                    </div>

                    <div class="quote">
                        <?php echo $randomQuote; ?>
                    </div>

                    <div class="linkref">
                        Link Referensi Tambahan:
                        <a href="<?php echo $artikel[$id]['link']; ?>" target="_blank">Klik di sini</a>
                    </div>

                </div>

                <div class="penutup">
                    <h3>Perjalanan Belajar Saya Masih Berlanjut !</h3>
                    <p>
                        Setiap artikel di halaman ini adalah bagian dari proses saya mengenal dunia coding.
                        Dari HTML hingga PHP, dari error hingga solusi, semua menjadi pengalaman berharga.
                        Perjalanan ini belum selesai, dan saya akan terus belajar, berkembang, serta
                        menciptakan karya yang lebih baik di masa depan.
                    </p>
                </div>

                <div class="nav">
                    <a href="index.php">Kembali ke Profil Interaktif Developer</a>
                    <a href="timeline.php">Kembali ke Timeline Perjalanan Belajar Coding</a>
                </div>
            </div>

</body>

</html>