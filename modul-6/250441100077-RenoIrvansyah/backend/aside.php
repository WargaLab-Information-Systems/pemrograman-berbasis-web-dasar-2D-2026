<?php
if (isset($_GET["logout"])) {
    session_destroy();
    $script = "<script> window.location = '../auth/login.php' ;</script>";
    echo $script;
}
?>

<aside class="sticky top-0 h-screen">
    <div class="w-64 h-full bg-gray-200 p-4">
        <div class="h-full">
            <div class="">
                <h2 class="text-4xl font-bold"><a href="dashboard.php">Dashboard</a></h2>
            </div>
            <div class="w-full h-0.5 bg-gray-400 mb-4"></div>
            <div class="h-3/4 mt-5">
                <ul class="text-xl grid gap-8">
                    <li><a class="" href="lihatData.php">Lihat Data</a></li>
                    <li><a class="" href="tambahData.php">Tambah Data</a></li>
                </ul>
            </div>
            <div class="h-35 place-content-end items-end-safe">
                <div class="w-full h-0.5 bg-gray-400 mt-4"></div>
                <div class="flex justify-between">
                    <a href="../index.php" class="text-lg text-blue-500 hover:text-blue-700">Lihat Website</a>
                    |
                    <a href="?logout" class="text-lg text-red-500 hover:text-red-700">Logout</a>
                </div>
            </div>
        </div>
    </div>
</aside>