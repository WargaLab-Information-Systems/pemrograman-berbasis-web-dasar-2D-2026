<?php
// index.php — Dashboard & CRUD Data Mahasiswa
// Seluruh query pakai prepared statement (sesuai ketentuan modul)
// htmlspecialchars() via fungsi e() setiap output ke HTML

require_once 'auth.php';    // cek login + helper e()
require_once 'koneksi.php'; // koneksi terpisah
require_once 'fungsicrud.php';

$isAdmin = isAdmin();
$action  = $_GET['action'] ?? 'list';
$id      = (int)($_GET['id'] ?? 0);


// CREATE (POST) 
if ($action === 'store' && $isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = createMahasiswa($_POST);
    setFlash($result['success'] ? 'success' : 'error', $result['msg']);
    header("Location: index.php");
    exit;
}

// UPDATE (POST) 
if ($action === 'update' && $isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = updateMahasiswa($id, $_POST);
    setFlash($result['success'] ? 'success' : 'error', $result['msg']);
    header("Location: index.php");
    exit;
}

// DELETE (GET, khusus admin) 
if ($action === 'delete' && $isAdmin && $id > 0) {
    $result = deleteMahasiswa($id);
    setFlash($result['success'] ? 'success' : 'error', $result['msg']);
    header("Location: index.php");
    exit;
}

// Ambil data untuk form EDIT 
$editData = null;
if ($action === 'edit' && $isAdmin && $id > 0) {
    $editData = getMahasiswaById($id);
    if (!$editData) { setFlash('error', 'Data tidak ditemukan.'); header("Location: index.php"); exit; }
}

// READ — daftar dengan pencarian & filter
$search       = trim($_GET['q'] ?? '');
$filterStatus = $_GET['status'] ?? '';

$mahasiswaList = getMahasiswaList($search, $filterStatus);
$stats         = getMahasiswaStats();
$totalAll      = array_sum($stats);

$flash = getFlash();

// Helper tampilan
function statusBadge(string $s): string {
    $map = [
        'aktif'   => 'bg-emerald-400/15 text-emerald-300 border border-emerald-400/25',
        'cuti'    => 'bg-amber-400/15 text-amber-300 border border-amber-400/25',
        'lulus'   => 'bg-sky-400/15 text-sky-300 border border-sky-400/25',
        'dropout' => 'bg-red-400/15 text-red-300 border border-red-400/25',
    ];
    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium '.($map[$s] ?? '').'">'.ucfirst($s).'</span>';
}
function ipkColor(float $ipk): string {
    if ($ipk >= 3.5) return 'text-emerald-400';
    if ($ipk >= 3.0) return 'text-sky-400';
    if ($ipk >= 2.5) return 'text-amber-400';
    return 'text-red-400';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — SIDATA Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body   { font-family:'Plus Jakarta Sans',sans-serif; background:#0b1120; }
        .sidebar { background:#0f172a; border-right:1px solid rgba(255,255,255,.06); }
        .card    { background:#131f35; border:1px solid rgba(255,255,255,.07); }
        .trow:hover { background:rgba(255,255,255,.03); }
        .input-field { background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.12); color:#fff; }
        .input-field::placeholder { color:rgba(255,255,255,.3); }
        .input-field:focus { outline:none; border-color:#38bdf8; background:rgba(255,255,255,.08); }
        .modal-bg   { background:rgba(0,0,0,.6); backdrop-filter:blur(6px); }
        .modal-card { background:#131f35; border:1px solid rgba(255,255,255,.1); }
        .btn-sky { background:linear-gradient(135deg,#0ea5e9,#2563eb); }
        .btn-sky:hover { background:linear-gradient(135deg,#38bdf8,#3b82f6); transform:translateY(-1px); }
        select.input-field option { background:#131f35; }
        ::-webkit-scrollbar { width:5px; height:5px; }
        ::-webkit-scrollbar-thumb { background:rgba(255,255,255,.15); border-radius:99px; }
    </style>
</head>
<body class="text-white min-h-screen flex">

<!-- SIDEBAR -->
<aside class="sidebar w-60 min-h-screen flex-col shrink-0 hidden md:flex">
    <div class="p-6 border-b border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-sky-500/20 border border-sky-500/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-sm leading-none">SIDATA</p>
                <p class="text-white/40 text-xs mt-0.5">Mahasiswa</p>
            </div>
        </div>
    </div>

    <nav class="p-4 flex-1">
        <p class="text-white/30 text-xs font-semibold uppercase tracking-widest mb-3 px-2">Menu</p>
        <a href="index.php" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-sky-500/15 text-sky-300 text-sm font-medium mb-1">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>
        <?php if ($isAdmin): ?>
        <button onclick="openModal('modal-add')"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:text-white hover:bg-white/5 text-sm font-medium mb-1 transition-all text-left">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Mahasiswa
        </button>
        <?php endif; ?>
    </nav>

    <div class="p-4 border-t border-white/5">
        <div class="flex items-center gap-3 px-3 py-2 mb-2">
            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-xs font-bold uppercase">
                <?= e(substr($_SESSION['username'], 0, 1)) ?>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-medium truncate"><?= e($_SESSION['username']) ?></p>
                <!-- htmlspecialchars via e() — sesuai ketentuan modul -->
                <p class="text-white/35 text-xs capitalize"><?= e($_SESSION['role']) ?></p>
            </div>
        </div>
        <a href="logout.php"
            class="flex items-center gap-2 px-3 py-2 rounded-xl text-red-400/70 hover:text-red-400 hover:bg-red-500/10 text-sm transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Logout
        </a>
    </div>
</aside>

<!-- MAIN -->
<main class="flex-1 min-h-screen flex flex-col overflow-x-hidden">

    <!-- Topbar -->
    <header class="flex items-center justify-between px-6 py-4 border-b border-white/5 bg-[#0b1120]/80 backdrop-blur sticky top-0 z-20">
        <div>
            <h2 class="font-bold text-lg">Data Mahasiswa</h2>
            <p class="text-white/35 text-xs">Kelola seluruh data akademik mahasiswa</p>
        </div>
        <?php if ($isAdmin): ?>
        <button onclick="openModal('modal-add')"
            class="btn-sky flex items-center gap-2 px-4 py-2.5 rounded-xl text-white font-semibold text-sm transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah
        </button>
        <?php endif; ?>
    </header>

    <div class="p-6 flex-1">

        <!-- Flash message -->
        <?php if ($flash): ?>
        <div class="mb-5 px-4 py-3 rounded-xl flex items-center gap-2 <?= $flash['type']==='success' ? 'bg-emerald-500/15 border border-emerald-500/25' : 'bg-red-500/15 border border-red-500/25' ?>">
            <svg class="w-4 h-4 shrink-0 <?= $flash['type']==='success' ? 'text-emerald-400' : 'text-red-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                <?php if ($flash['type']==='success'): ?>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                <?php else: ?>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                <?php endif; ?>
            </svg>
            <!-- htmlspecialchars via e() saat output ke HTML — sesuai modul -->
            <span class="text-sm <?= $flash['type']==='success' ? 'text-emerald-300' : 'text-red-300' ?>"><?= e($flash['msg']) ?></span>
        </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <?php
            $cards = [
                ['label'=>'Total', 'val'=>$totalAll, 'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'c'=>'text-sky-400', 'bg'=>'bg-sky-400/10'],
                ['label'=>'Aktif', 'val'=>$stats['aktif'], 'icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'c'=>'text-emerald-400','bg'=>'bg-emerald-400/10'],
                ['label'=>'Cuti',   'val'=>$stats['cuti'], 'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'c'=>'text-amber-400', 'bg'=>'bg-amber-400/10'],
                ['label'=>'Lulus',  'val'=>$stats['lulus'],'icon'=>'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',         'c'=>'text-purple-400','bg'=>'bg-purple-400/10'],
            ];
            foreach ($cards as $c): ?>
            <div class="card rounded-2xl p-4 flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl <?= $c['bg'] ?> flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 <?= $c['c'] ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $c['icon'] ?>"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white/40 text-xs"><?= $c['label'] ?></p>
                    <p class="text-2xl font-bold"><?= $c['val'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Search & Filter -->
        <div class="card rounded-2xl p-4 mb-4">
            <form method="GET" class="flex flex-wrap gap-3">
                <input type="text" name="q" value="<?= e($search) ?>"
                    placeholder="Cari NIM, nama, jurusan..."
                    class="input-field flex-1 min-w-48 px-4 py-2.5 rounded-xl text-sm">
                <select name="status" class="input-field px-4 py-2.5 rounded-xl text-sm">
                    <option value="">Semua Status</option>
                    <?php foreach (['aktif','cuti','lulus','dropout'] as $s): ?>
                    <option value="<?= $s ?>" <?= $filterStatus===$s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn-sky px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Cari</button>
                <?php if ($search || $filterStatus): ?>
                <a href="index.php" class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-sm transition-all">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="card rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="text-left px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide">NIM</th>
                            <th class="text-left px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide">Nama</th>
                            <th class="text-left px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide hidden md:table-cell">Jurusan</th>
                            <th class="text-center px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide hidden lg:table-cell">Sem</th>
                            <th class="text-center px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide hidden lg:table-cell">IPK</th>
                            <th class="text-center px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide">Status</th>
                            <?php if ($isAdmin): ?>
                            <th class="text-right px-5 py-3.5 text-white/40 font-semibold text-xs uppercase tracking-wide">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($mahasiswaList)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-16 text-white/25">
                                <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Data tidak ditemukan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($mahasiswaList as $mhs): ?>
                        <tr class="trow border-b border-white/4 transition-colors">
                            <td class="px-5 py-3.5 font-mono text-sky-300 text-xs"><?= e($mhs['nim']) ?></td>
                            <td class="px-5 py-3.5 font-medium"><?= e($mhs['nama']) ?></td>
                            <td class="px-5 py-3.5 text-white/60 hidden md:table-cell"><?= e($mhs['jurusan']) ?></td>
                            <td class="px-5 py-3.5 text-center hidden lg:table-cell text-white/60"><?= (int)$mhs['semester'] ?></td>
                            <td class="px-5 py-3.5 text-center hidden lg:table-cell font-bold <?= ipkColor((float)$mhs['ipk']) ?>"><?= number_format((float)$mhs['ipk'], 2) ?></td>
                            <td class="px-5 py-3.5 text-center"><?= statusBadge($mhs['status']) ?></td>
                            <?php if ($isAdmin): ?>
                            <td class="px-5 py-3.5 text-right">
                                <div class="inline-flex gap-1">
                                    <!-- Tombol Edit hanya muncul untuk admin — sesuai ketentuan role modul -->
                                    <button onclick='openEdit(<?= json_encode($mhs) ?>)'
                                        class="px-3 py-1.5 rounded-lg bg-sky-500/15 text-sky-300 hover:bg-sky-500/25 text-xs font-medium transition-all">
                                        Edit
                                    </button>
                                    <!-- Tombol Hapus hanya muncul untuk admin — validasi UI + server-side -->
                                    <a href="index.php?action=delete&id=<?= (int)$mhs['id'] ?>"
                                        onclick="return confirm('Yakin mau hapus data <?= e($mhs['nama']) ?>?')"
                                        class="px-3 py-1.5 rounded-lg bg-red-500/15 text-red-300 hover:bg-red-500/25 text-xs font-medium transition-all">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-white/5 text-white/35 text-xs">
                Menampilkan <?= count($mahasiswaList) ?> data
            </div>
        </div>

    </div><!-- /p-6 -->
</main>

<!-- MODAL TAMBAH -->
<div id="modal-add" class="modal-bg fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="modal-card rounded-2xl w-full max-w-lg p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-bold text-lg">Tambah Mahasiswa</h3>
            <button onclick="closeModal('modal-add')" class="text-white/40 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <!-- Form submit ke action=store, method POST — sesuai modul -->
        <form method="POST" action="index.php?action=store" novalidate>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">NIM *</label>
                    <input type="text" name="nim" placeholder="Contoh: 2024001" required
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Nama Lengkap *</label>
                    <input type="text" name="nama" placeholder="Nama mahasiswa" required
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Jurusan *</label>
                    <input type="text" name="jurusan" placeholder="Contoh: Teknik Informatika" required
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Semester</label>
                    <select name="semester" class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                        <?php for ($i=1; $i<=14; $i++): ?><option value="<?= $i ?>"><?= $i ?></option><?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">IPK</label>
                    <input type="number" name="ipk" step="0.01" min="0" max="4" value="0.00"
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Status</label>
                    <select name="status" class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                        <?php foreach (['aktif','cuti','lulus','dropout'] as $s): ?>
                        <option value="<?= $s ?>"><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeModal('modal-add')"
                    class="flex-1 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-sm font-semibold transition-all">Batal</button>
                <button type="submit"
                    class="flex-1 btn-sky py-2.5 rounded-xl text-white text-sm font-semibold transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="modal-edit" class="modal-bg fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="modal-card rounded-2xl w-full max-w-lg p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-bold text-lg">Edit Mahasiswa</h3>
            <button onclick="closeModal('modal-edit')" class="text-white/40 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form method="POST" id="form-edit" action="">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">NIM *</label>
                    <input type="text" name="nim" id="edit-nim" required
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Nama Lengkap *</label>
                    <input type="text" name="nama" id="edit-nama" required
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Jurusan *</label>
                    <input type="text" name="jurusan" id="edit-jurusan" required
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Semester</label>
                    <select name="semester" id="edit-semester" class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                        <?php for ($i=1; $i<=14; $i++): ?><option value="<?= $i ?>"><?= $i ?></option><?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">IPK</label>
                    <input type="number" name="ipk" id="edit-ipk" step="0.01" min="0" max="4"
                        class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wide">Status</label>
                    <select name="status" id="edit-status" class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                        <?php foreach (['aktif','cuti','lulus','dropout'] as $s): ?>
                        <option value="<?= $s ?>"><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeModal('modal-edit')"
                    class="flex-1 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-sm font-semibold transition-all">Batal</button>
                <button type="submit"
                    class="flex-1 btn-sky py-2.5 rounded-xl text-white text-sm font-semibold transition-all">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = '';
    }
    function openEdit(data) {
        document.getElementById('edit-nim').value      = data.nim;
        document.getElementById('edit-nama').value     = data.nama;
        document.getElementById('edit-jurusan').value  = data.jurusan;
        document.getElementById('edit-semester').value = data.semester;
        document.getElementById('edit-ipk').value      = data.ipk;
        document.getElementById('edit-status').value   = data.status;
        document.getElementById('form-edit').action    = 'index.php?action=update&id=' + data.id;
        openModal('modal-edit');
    }
    // Tutup modal saat klik backdrop
    ['modal-add','modal-edit'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) closeModal(id);
        });
    });
</script>
</body>
</html>