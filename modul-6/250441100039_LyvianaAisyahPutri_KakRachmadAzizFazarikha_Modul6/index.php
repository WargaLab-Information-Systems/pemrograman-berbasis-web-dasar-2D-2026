<?php
include 'auth.php';
include 'koneksi.php';

// --- LOGOUT ---
if (isset($_GET['aksi']) && $_GET['aksi'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}

// --- BAGIAN LOGIN & REGISTER ---
if (!is_login()) {
    $msg = "";
    if (isset($_POST['reg'])) {
        $u = htmlspecialchars($_POST['username']);
        $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $st = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $st->bind_param("ss", $u, $p);
        if ($st->execute()) {
            $msg = "<p class='text-orange-600 font-bold mb-4 text-center'>Sukses! Silakan Login.</p>";
        } else {
            $msg = "<p class='text-red-500 font-bold mb-4 text-center'>Username sudah dipakai!</p>";
        }
    }
    if (isset($_POST['lgn'])) {
        $st = $conn->prepare("SELECT * FROM users WHERE username=?");
        $st->bind_param("s", $_POST['username']);
        $st->execute();
        $d = $st->get_result()->fetch_assoc();
        if ($d && password_verify($_POST['password'], $d['password'])) {
            $_SESSION['user_id'] = $d['id'];
            $_SESSION['username'] = $d['username'];
            $_SESSION['role'] = $d['role'];
            header("Location: index.php");
            exit;
        } else {
            $msg = "<p class='text-red-500 font-bold mb-4 text-center'>Login Gagal!</p>";
        }
    }
    
    // Tampilan Form Login
    echo '<!DOCTYPE html>
    <html lang="id">
    <head><title>Cafe Login</title><script src="https://cdn.tailwindcss.com"></script></head>
    <body class="bg-orange-50 flex items-center justify-center h-screen font-sans">
        <div class="bg-white p-10 rounded-3xl shadow-xl w-96 border-4 border-orange-100">
            <h2 class="text-3xl font-black text-orange-400 text-center mb-6">Drink Shop☕</h2>
            '.$msg.'
            <form method="POST" class="space-y-4">
                <input type="text" name="username" placeholder="Username" required class="w-full border-2 border-orange-50 p-3 rounded-xl focus:border-orange-300 outline-none">
                <input type="password" name="password" placeholder="Password" required class="w-full border-2 border-orange-50 p-3 rounded-xl focus:border-orange-300 outline-none">
                <button type="submit" name="lgn" class="w-full bg-orange-400 text-white font-bold py-3 rounded-xl hover:bg-orange-500 transition">MASUK</button>
                <button type="submit" name="reg" class="w-full bg-orange-100 text-orange-600 font-bold py-3 rounded-xl hover:bg-orange-200 transition">DAFTAR</button>
            </form>
        </div>
    </body>
    </html>';
    exit;
}

// --- BAGIAN CRUD ADMIN ---
if (is_admin()) {
    if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
        $st = $conn->prepare("DELETE FROM produk_minuman WHERE id=?");
        $st->bind_param("i", $_GET['id']);
        $st->execute();
        header("Location: index.php");
        exit;
    }
    if (isset($_POST['simpan'])) {
        $n = $_POST['nama']; 
        $k = $_POST['kat']; 
        $h = $_POST['harga']; 
        $v = $_POST['vol']; 
        $t = $_POST['avail'];
        
        if (!empty($_POST['id'])) {
            $st = $conn->prepare("UPDATE produk_minuman SET nama_minuman=?, kategori=?, harga=?, volume_ml=?, tersedia=? WHERE id=?");
            $st->bind_param("ssidsi", $n, $k, $h, $v, $t, $_POST['id']);
        } else {
            $st = $conn->prepare("INSERT INTO produk_minuman (nama_minuman, kategori, harga, volume_ml, tersedia) VALUES (?, ?, ?, ?, ?)");
            $st->bind_param("ssids", $n, $k, $h, $v, $t);
        }
        $st->execute();
        header("Location: index.php");
        exit;
    }
}

$edit = null;
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && is_admin()) {
    $st = $conn->prepare("SELECT * FROM produk_minuman WHERE id=?");
    $st->bind_param("i", $_GET['id']);
    $st->execute();
    $edit = $st->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head><title>Drink Menu</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-orange-50 p-6 min-h-screen">
    <div class="max-w-6xl mx-auto">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-orange-100 flex justify-between items-center mb-10">
            <div>
                <h1 class="text-2xl font-black text-orange-500">Menu Minuman Cafe</h1>
                <p class="text-xs text-gray-400">Login: <b><?php echo htmlspecialchars($_SESSION['username']); ?></b> (<?php echo $_SESSION['role']; ?>)</p>
            </div>
            <a href="?aksi=logout" class="bg-red-400 text-white px-6 py-2 rounded-full font-bold hover:bg-red-500 transition">Keluar</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <?php if (is_admin()): ?>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-orange-100 h-fit">
                <h2 class="text-lg font-bold mb-6 text-orange-500"><?php echo $edit ? "Edit Menu" : "Tambah Menu Baru"; ?></h2>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="id" value="<?php echo isset($edit['id']) ? $edit['id'] : ''; ?>">
                    <input type="text" name="nama" placeholder="Nama Minuman" required class="w-full border p-3 rounded-xl" value="<?php echo isset($edit['nama_minuman']) ? htmlspecialchars($edit['nama_minuman']) : ''; ?>">
                    
                    <select name="kat" class="w-full border p-3 rounded-xl">
                        <option value="Kopi" <?php echo (isset($edit) && $edit['kategori'] == 'Kopi') ? 'selected' : ''; ?>>Kopi</option>
                        <option value="Teh" <?php echo (isset($edit) && $edit['kategori'] == 'Teh') ? 'selected' : ''; ?>>Teh</option>
                        <option value="Susu" <?php echo (isset($edit) && $edit['kategori'] == 'Susu') ? 'selected' : ''; ?>>Susu</option>
                        <option value="Jus" <?php echo (isset($edit) && $edit['kategori'] == 'Jus') ? 'selected' : ''; ?>>Jus</option>
                    </select>
                    
                    <input type="number" name="harga" placeholder="Harga (Rp)" required class="w-full border p-3 rounded-xl" value="<?php echo isset($edit['harga']) ? $edit['harga'] : ''; ?>">
                    <input type="number" name="vol" placeholder="Volume (ml)" required class="w-full border p-3 rounded-xl" value="<?php echo isset($edit['volume_ml']) ? $edit['volume_ml'] : ''; ?>">
                    
                    <select name="avail" class="w-full border p-3 rounded-xl">
                        <option value="ya" <?php echo (isset($edit) && $edit['tersedia'] == 'ya') ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="tidak" <?php echo (isset($edit) && $edit['tersedia'] == 'tidak') ? 'selected' : ''; ?>>Habis</option>
                    </select>
                    
                    <button type="submit" name="simpan" class="w-full bg-orange-400 text-white font-bold py-3 rounded-xl">Simpan Menu</button>
                    <?php if($edit): ?>
                        <a href="index.php" class="block text-center text-xs mt-2 text-gray-400 font-bold">Batal Edit</a>
                    <?php endif; ?>
                </form>
            </div>
            <?php endif; ?>

            <div class="<?php echo is_admin() ? 'lg:col-span-2' : 'lg:col-span-3'; ?> bg-white p-8 rounded-2xl shadow-sm border border-orange-100 overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="text-orange-400 border-b-2 border-orange-50">
                            <th class="p-4 font-black uppercase">Nama Minuman</th>
                            <th class="p-4 font-black uppercase text-center">Harga</th>
                            <th class="p-4 font-black uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-orange-50">
                        <?php 
                        $r = $conn->query("SELECT * FROM produk_minuman ORDER BY id DESC"); 
                        while ($row = $r->fetch_assoc()): 
                        ?>
                        <tr class="hover:bg-orange-50/50 transition">
                            <td class="p-4">
                                <p class="font-bold text-gray-700"><?php echo htmlspecialchars($row['nama_minuman']); ?></p>
                                <p class="text-[10px] text-orange-400 font-black uppercase mt-1 px-2 py-0.5 bg-orange-100 rounded inline-block">
                                    <?php echo $row['kategori']; ?> | <?php echo $row['volume_ml']; ?>ml
                                </p>
                            </td>
                            <td class="p-4 text-center font-bold text-orange-500">Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td class="p-4 text-center">
                                <?php if (is_admin()): ?>
                                    <a href="?aksi=edit&id=<?php echo $row['id']; ?>" class="text-blue-500 font-black text-xs mr-3 hover:underline">EDIT</a>
                                    <a href="?aksi=hapus&id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus menu?')" class="text-red-500 font-black text-xs hover:underline">HAPUS</a>
                                <?php else: ?>
                                    <?php if ($row['tersedia'] == 'ya'): ?>
                                        <button class="bg-orange-400 text-white px-4 py-1.5 rounded-full text-[10px] font-black hover:bg-orange-500 transition shadow-md" onclick="alert('Pesanan Ditambahkan!')">PESAN</button>
                                    <?php else: ?>
                                        <button class="bg-gray-300 text-gray-500 px-4 py-1.5 rounded-full text-[10px] font-black shadow-none cursor-not-allowed" onclick="alert('Pesanan Habis!')">HABIS</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>