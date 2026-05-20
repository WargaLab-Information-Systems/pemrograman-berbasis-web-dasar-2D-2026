<?php
include 'auth.php';
include 'koneksi.php';

$menu = mysqli_query($conn,"SELECT * FROM menu");

if(isset($_POST['pesan'])){

    $nama = htmlspecialchars($_POST['nama']);
    $menus = $_POST['menu'];
    $jumlah = $_POST['jumlah'];

    if(empty($menus)){

        echo "<script>
        alert('Pilih menu terlebih dahulu!');
        </script>";

    } else {

        foreach($menus as $id_menu){

            $ambil = mysqli_query($conn,
            "SELECT * FROM menu WHERE id_menu='$id_menu'");

            $data = mysqli_fetch_assoc($ambil);

            $stok = $data['stok'];

            if($jumlah > $stok){

                echo "<script>
                alert('Stok ".$data['nama_menu']." tidak cukup!');
                window.location='pesanan.php';
                </script>";

                exit;
            }

            $total = $data['harga'] * $jumlah;

            mysqli_query($conn,"INSERT INTO pesanan(
            nama_pemesan,
            menu_pesan,
            jumlah,
            total_harga
            ) VALUES(
            '$nama',
            '".$data['nama_menu']."',
            '$jumlah',
            '$total'
            )");

            $sisa = $stok - $jumlah;

            mysqli_query($conn,
            "UPDATE menu SET stok='$sisa'
            WHERE id_menu='$id_menu'");
        }

        echo "<script>
        alert('Pesanan berhasil!');
        window.location='dashboard.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-orange-200 via-orange-100 to-amber-50 overflow-y-auto">

<div class="fixed top-0 left-0 w-80 h-80 bg-orange-300/20 rounded-full blur-3xl"></div>
<div class="fixed bottom-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl"></div>

<div class="flex justify-center items-center min-h-screen relative z-10 p-6">

    <div class="bg-white/40 backdrop-blur-2xl rounded-[40px] shadow-2xl overflow-hidden max-w-3xl w-full border border-white/40">

        <div class="bg-gradient-to-r from-orange-500 to-orange-700 p-10 text-white text-center relative overflow-hidden">

            <div class="absolute -top-10 -right-10 w-52 h-52 bg-white/10 rounded-full"></div>

            <div class="w-24 h-24 bg-white text-orange-500 rounded-3xl flex items-center justify-center text-5xl mx-auto shadow-2xl mb-5 relative z-10">
                ☕
            </div>

            <h1 class="text-5xl font-black relative z-10">
                Pesanan Cafe
            </h1>

            <p class="mt-3 text-orange-100 text-lg relative z-10">
                Pilih beberapa menu cafe favoritmu
            </p>

        </div>

        <div class="bg-white p-10">

            <form method="POST" class="space-y-6">

                <div>
                    <label class="font-bold text-gray-700">
                        Nama Pemesan
                    </label>

                    <input type="text"
                    name="nama"
                    placeholder="Masukkan nama"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <div>
                    <label class="font-bold text-gray-700 mb-3 block">
                        Pilih Menu
                    </label>

                    <div class="grid grid-cols-1 gap-4 max-h-72 overflow-y-auto p-2 border-2 border-orange-100 rounded-2xl bg-orange-50">

                    <?php
                    mysqli_data_seek($menu,0);
                    while($m = mysqli_fetch_assoc($menu)){
                    ?>

                    <label class="flex items-center justify-between bg-white p-4 rounded-2xl shadow hover:scale-[1.02] duration-300 cursor-pointer">

                        <div>

                            <h1 class="font-bold text-lg text-orange-600">
                                <?= $m['nama_menu']; ?>
                            </h1>

                            <p class="text-gray-500">
                                Rp <?= number_format($m['harga']); ?>
                            </p>

                            <p class="text-sm text-gray-400">
                                Stok : <?= $m['stok']; ?>
                            </p>

                        </div>

                        <input
                        type="checkbox"
                        name="menu[]"
                        value="<?= $m['id_menu']; ?>"
                        data-harga="<?= $m['harga']; ?>"
                        onchange="hitungTotal()"
                        class="w-6 h-6 accent-orange-500">

                    </label>

                    <?php } ?>

                    </div>

                </div>

                <div>
                    <label class="font-bold text-gray-700">
                        Jumlah Pesanan
                    </label>

                    <input type="number"
                    name="jumlah"
                    id="jumlah"
                    value=""
                    onkeyup="hitungTotal()"
                    placeholder="Masukkan jumlah"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <div>
                    <label class="font-bold text-gray-700">
                        Total Pesanan
                    </label>

                    <input type="text"
                    id="totalPesanan"
                    placeholder="Total otomatis"
                    class="w-full mt-2 bg-gray-100 border-2 border-gray-200 outline-none p-4 rounded-2xl font-bold text-orange-600"
                    readonly>
                </div>

                <button type="submit"
                name="pesan"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-700 hover:scale-105 duration-300 text-white font-black p-4 rounded-2xl shadow-2xl text-lg">

                    Pesan Sekarang

                </button>

            </form>

            <a href="dashboard.php"
            class="block text-center mt-6 text-orange-600 font-bold hover:underline">

                ← Kembali ke Dashboard

            </a>

        </div>

    </div>

</div>

<script>

function hitungTotal(){

    let checkboxes =
    document.querySelectorAll('input[name="menu[]"]:checked');

    let jumlah =
    document.getElementById('jumlah').value;

    let total = 0;

    checkboxes.forEach((item) => {

        let harga = item.getAttribute('data-harga');

        total += harga * jumlah;

    });

    document.getElementById('totalPesanan').value =
    'Rp ' + total.toLocaleString('id-ID');
}

</script>

</body>
</html>