<?php
include("auth.php");
include("koneksi.php");

$nim = $nama = $alamat = $fakultas = $sukses = $error = "";

// Delete 
if (isset($_GET['op']) && $_GET['op'] == 'delete' && $_SESSION['role'] == 'admin') {
    $id = (int)$_GET['id'];
    $stmt = $koneksi->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) $sukses = "Data berhasil dihapus";
    else $error = "Gagal menghapus data";
    header("refresh:4;url=index.php");
    
}

// Edit
if (isset($_GET['op']) && $_GET['op'] == 'edit') {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $r1 = $result->fetch_assoc();
    if ($r1) {
        $nim = $r1['nim']; $nama = $r1['nama']; $alamat = $r1['alamat']; $fakultas = $r1['fakultas'];
    }
}

// Update
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim']; $nama = $_POST['nama']; $alamat = $_POST['alamat']; $fakultas = $_POST['fakultas'];

    if ($nim && $nama && $alamat && $fakultas) {
        if (isset($_GET['op']) && $_GET['op'] == 'edit') {
            $stmt = $koneksi->prepare("UPDATE mahasiswa SET nim=?, nama=?, alamat=?, fakultas=? WHERE id=?");
            $stmt->bind_param("ssssi", $nim, $nama, $alamat, $fakultas, $_GET['id']);
        } else {
            $stmt = $koneksi->prepare("INSERT INTO mahasiswa (nim, nama, alamat, fakultas) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nim, $nama, $alamat, $fakultas);
        }
        
        if ($stmt->execute()) {
            $sukses = "Data berhasil disimpan";
            $nim = $nama = $alamat = $fakultas = "";
            header("refresh:4;url=index.php");
        } else {
            $error = "Gagal menyimpan data (NIM mungkin sudah ada)";
        }
    } else {
        $error = "Harap isi semua kolom";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Mahasiswa</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo $_SESSION['role']; ?>)</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container" style="max-width: 900px;">
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">Input Data Mahasiswa</div>
            <div class="card-body">
                <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                
                <?php if($sukses) echo "<div class='alert alert-success'>$sukses</div>"; ?>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>NIM</label><input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($nim) ?>" required></div>
                        <div class="col-md-6 mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" required></div>
                    </div>
                    <div class="mb-3"><label>Alamat</label><input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($alamat) ?>" required></div>
                    <div class="mb-3">
                        <label>Fakultas</label>
                        <select name="fakultas" class="form-select" required>
                            <option value="">- Pilih -</option>
                            <option value="Saintek" <?= $fakultas == 'Saintek' ? 'selected' : '' ?>>Saintek</option>
                            <option value="Soshum" <?= $fakultas == 'Soshum' ? 'selected' : '' ?>>Soshum</option>
                        </select>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">Daftar Mahasiswa</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th><th>NIM</th><th>Nama</th><th>Alamat</th><th>Fakultas</th>
                            <?php if ($_SESSION['role'] == 'admin') echo "<th>Aksi</th>"; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id DESC");
                        $no = 1;
                        while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['fakultas']) ?></td>
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                            <td>
                                <a href="index.php?op=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?op=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>