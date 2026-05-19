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
    <title>Ubah Data Konser</title>
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

            <?php
            $id = $_GET['id'];

            if (!isset($_GET['id'])) {
                die("ID tidak ditemukan!");
            }

            $sql = "SELECT * FROM concerts WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $concert = $stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($_POST['ubahData'])) {
                $id = htmlspecialchars($_POST['id']);
                $nama_konser = htmlspecialchars($_POST['nama_konser']);
                $artis = htmlspecialchars($_POST['artis']);
                $lokasi = htmlspecialchars($_POST['lokasi']);
                $tanggal = htmlspecialchars($_POST['tanggal']);
                $harga = htmlspecialchars($_POST['harga']);

                if ($_FILES['poster']['name'] != "") {

                    $poster = $_FILES['poster']['name'];
                    $tmpName = $_FILES['poster']['tmp_name'];

                    $upload = '../database/img/' . $poster;

                    move_uploaded_file($tmpName, $upload);
                } else {
                    $poster = $concert['poster'];
                }

                $queryUpdate = "UPDATE concerts SET nama_konser = :nama_konser, artis = :artis, lokasi = :lokasi, tanggal = :tanggal, harga = :harga, poster = :poster
                                WHERE id = :id";
                $stmtUpdate = $conn->prepare($queryUpdate);

                $stmtUpdate->bindParam(':nama_konser', $nama_konser);
                $stmtUpdate->bindParam(':artis', $artis);
                $stmtUpdate->bindParam(':lokasi', $lokasi);
                $stmtUpdate->bindParam(':tanggal', $tanggal);
                $stmtUpdate->bindParam(':harga', $harga);
                $stmtUpdate->bindParam(':poster', $poster);
                $stmtUpdate->bindParam(':id', $id);

                if ($stmtUpdate->execute()) {
                    echo "<script>alert('Data berhasil diubah!');window.location.href = 'lihatData.php'; </script>";
                } else {
                    echo "<script>alert('Data gagal diubah!'); </script>";
                }
            }
            ?>
            <section class="flex-1 p-8">
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="text-xl font-bold mb-4">Ubah Data Konser</h3>
                    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <form action="ubahData.php?id=<?php echo $concert['id']; ?>" method="POST" id="submit" class="mx-5 space-y-4" enctype="multipart/form-data">
                            <div class="grid grid-cols-3 gap-10">
                                <div class="my-5">
                                    <input type="hidden" name="id" value="<?php echo $concert['id']; ?>">
                                    <label for="nama_konser" class="block mb-2.5 text-sm font-medium text-heading">Nama Konser</label>
                                    <input type="text" name="nama_konser" value="<?php echo $concert['nama_konser']; ?>" id="nama_konser" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan nama konser" required />
                                </div>
                                <div class="my-5">
                                    <label for="artis" class="block mb-2.5 text-sm font-medium text-heading">Nama Artis</label>
                                    <input type="text" name="artis" value="<?php echo $concert['artis']; ?>" id="artis" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan nama artis" required />
                                </div>
                                <div class="my-5">
                                    <label for="lokasi" class="block mb-2.5 text-sm font-medium text-heading">Lokasi Konser</label>
                                    <input type="text" name="lokasi" value="<?php echo $concert['lokasi']; ?>" id="lokasi" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan alamat konser" required />
                                </div>
                                <div class="my-5">
                                    <label for="tanggal" class="block mb-2.5 text-sm font-medium text-heading">Tanggal Konser</label>
                                    <input type="date" name="tanggal" value="<?php echo $concert['tanggal']; ?>" id="tanggal" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan alamat konser" required />
                                </div>
                                <div class="my-5">
                                    <label for="harga" class="block mb-2.5 text-sm font-medium text-heading">Harga Tiket Konser</label>
                                    <input type="number" name="harga" value="<?php echo $concert['harga']; ?>" id="harga" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan harga tiket" required />
                                </div>
                                <div class="my-5">
                                    <label for="poster" class="block mb-2.5 text-sm font-medium text-heading">Upload Poster Konser</label>
                                    <input type="file" name="poster" value="<?php echo $concert['poster']; ?>" id="poster" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 shadow-xs placeholder:text-body" placeholder="" />
                                    <div class="w-full h-0.5 bg-gray-400 mb-4"></div>
                                    <label for="" class="block mb-2.5 text-sm font-medium text-heading">Poster Saat Ini</label>
                                    <img src="../database/img/<?php echo htmlspecialchars($concert['poster']); ?>" class="w-50" alt="">
                                </div>
                            </div>
                            <div class="flex justify-between mb-5">
                                <a href="lihatData.php"
                                    class="bg-red-500 w-40 hover:bg-red-800 transition px-6 py-3 rounded-xl font-semibold shadow-lg text-white text-center">
                                    Batal
                                </a>
                                <button type="submit" name="ubahData" id="ubahData"
                                    class="bg-blue-500 w-40 hover:bg-blue-800 transition px-6 py-3 rounded-xl font-semibold shadow-lg text-white">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </main>
    </div>



    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>