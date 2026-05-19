<?php
session_start();
if (is_null($_SESSION["login"])) {
    header("Location: auth/login.php");
    exit;
}
include_once("../database/koneksi.php");

if ($_SESSION['role'] !== 'admin') {
    $script = "<script> window.location = '../index.php' ;</script>";
    echo $script;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Konser</title>
    <link rel="stylesheet" href="../src/output.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="">

    <div class="flex min-h-screen">
        <?php
        include('aside.php');
        ?>

        <main class="flex-1 flex flex-col">

            <?php
            include('nav.php')
            ?>

            <section class="flex-1 p-8">
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="text-xl font-bold mb-4">Tambah Data Konser</h3>
                    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <form action="tambahData.php" name="tambahData" method="POST" id="submit" class="mx-5 space-y-4" enctype="multipart/form-data">
                            <div class="grid grid-cols-3 gap-10">
                                <div class="my-5">
                                    <label for="nama_konser" class="block mb-2.5 text-sm font-medium text-heading">Nama Konser</label>
                                    <input type="text" name="nama_konser" id="nama_konser" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan nama konser" required />
                                </div>
                                <div class="my-5">
                                    <label for="artis" class="block mb-2.5 text-sm font-medium text-heading">Nama Artis</label>
                                    <input type="text" name="artis" id="artis" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan nama artis" required />
                                </div>
                                <div class="my-5">
                                    <label for="lokasi" class="block mb-2.5 text-sm font-medium text-heading">Lokasi Konser</label>
                                    <input type="text" name="lokasi" id="lokasi" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan alamat konser" required />
                                </div>
                                <div class="my-5">
                                    <label for="tanggal" class="block mb-2.5 text-sm font-medium text-heading">Tanggal Konser</label>
                                    <input type="date" name="tanggal" id="tanggal" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan alamat konser" required />
                                </div>
                                <div class="my-5">
                                    <label for="harga" class="block mb-2.5 text-sm font-medium text-heading">Harga Tiket Konser</label>
                                    <input type="number" name="harga" id="harga" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan harga tiket" required />
                                </div>
                                <div class="my-5">
                                    <label for="poster" class="block mb-2.5 text-sm font-medium text-heading">Upload Poster Konser</label>
                                    <input type="file" name="poster" id="poster" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 shadow-xs placeholder:text-body" placeholder="" required />
                                </div>
                            </div>
                            <div class="flex justify-end mb-5">
                                <button type="submit" name="tambahData" id="tambahData"
                                    class="bg-blue-500 w-40 hover:bg-blue-800 transition px-6 py-3 rounded-xl font-semibold shadow-lg text-white">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['tambahData'])) {
                            $nama_konser = htmlspecialchars($_POST['nama_konser']);
                            $artis = htmlspecialchars($_POST['artis']);
                            $lokasi = htmlspecialchars($_POST['lokasi']);
                            $tanggal = htmlspecialchars($_POST['tanggal']);
                            $harga = htmlspecialchars($_POST['harga']);

                            $poster = $_FILES['poster']['name'];
                            // $tmpName = $_FILES['poster']['tmp_name'];
                            $image_format = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);

                            $check_format_image = array("png", "jpg", "jpeg");

                            // $upload = '../database/img/' . $poster;
                            // move_uploaded_file($image_format, $upload);

                            if (!in_array($image_format, $check_format_image)) {
                                echo "<script>alert('File harus format jpg, png!');</script>";
                                exit();
                            } else {
                                $target = "../database/img/" . basename($_FILES["poster"]["name"]);
                                if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target)) {
                                }
                            }

                            $query = "INSERT INTO concerts (id, nama_konser, artis, lokasi, tanggal, harga, poster)
                                        VALUES (null, :nama_konser, :artis, :lokasi, :tanggal, :harga, :poster)";

                            $stmt = $conn->prepare($query);

                            $stmt->bindParam(':nama_konser', $nama_konser);
                            $stmt->bindParam(':artis', $artis);
                            $stmt->bindParam(':lokasi', $lokasi);
                            $stmt->bindParam(':tanggal', $tanggal);
                            $stmt->bindParam(':harga', $harga);
                            $stmt->bindParam(':poster', $poster);

                            if ($stmt->execute()) {
                                echo "<script>alert('Data berhasil ditambahkan!');
                                window.location.href = 'lihatData.php'; </script>";
                            } else {
                                echo "<script>alert('Data gagal ditambahkan!');</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>