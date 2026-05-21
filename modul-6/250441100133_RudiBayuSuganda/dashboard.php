<?php
session_start();
require 'koneksi.php'; // Mengambil koneksi dari koneksi.php

// 1. Proteksi Halaman: Jika belum login atau bukan role 'user', tendang ke index.php
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit;
}

// 2. Mengambil data member dari tabel 'members' berdasarkan user yang sedang login
// Menggunakan user_id yang disimpan di session saat login tadi
$stmt = $pdo->prepare("SELECT * FROM members WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$member = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Member Dashboard - Gym System</title>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-xl font-bold">Gym System</span>
            <div class="flex items-center space-x-4">
                <span class="text-sm">Halo, <?= htmlspecialchars($_SESSION['user_email']) ?></span>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm transition font-semibold">Logout</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-10 px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-blue-50 px-8 py-6 border-b border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 text-center">Profil Member Gym</h1>
            </div>

            <div class="p-8">
                <?php if ($member): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="text-gray-500 text-sm font-medium">Nama Lengkap</label>
                                <p class="text-xl font-bold text-gray-800 border-b-2 border-blue-100 pb-2">
                                    <?= htmlspecialchars($member['nama_lengkap']) ?>
                                </p>
                            </div>
                            <div>
                                <label class="text-gray-500 text-sm font-medium">Paket Layanan</label>
                                <p class="text-lg font-semibold text-gray-700 bg-blue-50 px-3 py-1 rounded-md inline-block">
                                    <?= $member['paket_layanan'] ?>
                                </p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="text-gray-500 text-sm font-medium">Berat Badan</label>
                                <p class="text-lg font-semibold text-gray-700">
                                    <?= $member['berat_badan'] ?> <span class="text-sm font-normal">kg</span>
                                </p>
                            </div>
                            <div>
                                <label class="text-gray-500 text-sm font-medium">Status Keanggotaan</label>
                                <div class="mt-1">
                                    <?php if ($member['is_active']): ?>
                                        <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wide">Aktif</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wide">Non-Aktif</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 p-4 bg-gray-50 rounded-lg text-center">
                        <p class="text-sm text-gray-500">Tanggal Daftar: <span class="font-medium text-gray-700"><?= $member['tanggal_daftar'] ?></span></p>
                    </div>

                <?php else: ?>
                    <div class="text-center py-10">
                        <div class="bg-orange-100 text-orange-700 p-6 rounded-xl inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-lg font-bold">Data Member Belum Tersedia</p>
                            <p class="text-sm opacity-90 mt-1">Harap hubungi Admin untuk menginput data profil Anda.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <p class="text-center text-gray-400 text-xs mt-8">&copy; 2024 Gym System Management. All rights reserved.</p>
    </div>
</body>

</html>