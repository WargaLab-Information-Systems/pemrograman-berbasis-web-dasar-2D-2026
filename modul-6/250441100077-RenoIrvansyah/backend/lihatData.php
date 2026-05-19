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

if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];
    $sql = "DELETE FROM concerts WHERE id = '$id' ";

    if ($conn->query($sql)) {
        echo "Data berhasil dihapus";
        header("Location: lihatData.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Konser</title>
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
                    <h3 class="text-xl font-bold mb-4">Data Konser</h3>
                    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <?php
                        $sql = "SELECT * FROM concerts";
                        $stmt = $conn->query($sql);

                        $stmt->execute();
                        $concerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead class="bg-neutral-secondary-soft border-b border-default">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-50 font-medium">
                                        Nama Konser
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Artis
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Poster
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($concerts as $concert): ?>
                                    <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default">
                                        <td scope="row" class="px-6 py-4" hidden>
                                            <?php echo htmlspecialchars($concert['id']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo htmlspecialchars($concert['nama_konser']); ?>
                                        </td>
                                        <td scope="row" class="px-6 py-4">
                                            <?php echo htmlspecialchars($concert['artis']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo htmlspecialchars($concert['lokasi']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo htmlspecialchars($concert['tanggal']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo "Rp" . number_format($concert['harga']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="../database/img/<?php echo htmlspecialchars($concert['poster']); ?>" class="w-50" alt="">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="ubahData.php?id=<?= $concert['id']; ?>" class="font-medium text-fg-brand hover:underline">Edit</a>
                                                |
                                                <a href="?hapus=<?= $concert['id']; ?>" onclick="return confirm('Yakin mau hapus data ini?')" class="font-medium text-fg-danger hover:underline">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

        </main>
    </div>



    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>