<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Timeline Belajar Developer</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans p-6">

  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
      <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
    Timeline Belajar Developer
  </h2>

<?php
$riwayat = [
  ["tahun" => 2025, "kegiatan" => "Tahun masuk kuliah"],
  ["tahun" => 2026, "kegiatan" => "Mulai belajar HTML & CSS"],
  ["tahun" => 2026, "kegiatan" => "Proyek pertama: Membuat Website"],
  ["tahun" => 2026, "kegiatan" => "Belajar JavaScript & Tailwind CSS"],
  ["tahun" => 2026, "kegiatan" => "Mengerjakan aplikasi akademik dengan PHP & SQL"],
];

function highlightTahun($tahun, $teks) {
    $target = "Tahun masuk kuliah";

    if ($teks == $target) {
        return "<span class='text-blue-600 font-semibold'>$tahun - $teks </span>";
    }

    return "$tahun - $teks";
}
?>

<div class="relative border-l-2 border-blue-400 pl-6 space-y-6">

<?php foreach ($riwayat as $item): ?>
  <div class="relative">
    
    <span class="absolute -left-[9px] top-2 w-4 h-4 bg-blue-500 rounded-full"></span>

    <div class="bg-blue-100 p-4 rounded-lg shadow hover:shadow-md transition">
      <?= highlightTahun($item['tahun'], $item['kegiatan']); ?>
    </div>

  </div>
<?php endforeach; ?>

</div>
<div class="mt-10 text-center space-x-4">
  <a href="index.php" class="text-blue-600 hover:underline"> Profil</a>
  <a href="blog.php" class="text-blue-600 hover:underline">Blog Developer</a>
</div>

</div>

</body>
</html>