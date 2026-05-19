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

$sql = "SELECT COUNT(*) FROM concerts";
$totalDataKonser = $conn->query($sql)->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
                    <h2 class="text-xl font-bold mb-4">
                        Informasi Konser
                    </h2>

                    <p class="text-gray-500">
                        Jumlah Konser Tersedia : <?php echo $totalDataKonser; ?>
                    </p>
                </div>
            </section>

        </main>
    </div>



    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>