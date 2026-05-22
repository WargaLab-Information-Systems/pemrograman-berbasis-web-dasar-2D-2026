<?php
// fungsi CRUD reusable untuk Data Mahasiswa

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'koneksi.php';

function isAdmin(): bool {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function setFlash(string $type, string $msg): void {
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}

function getFlash(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function createMahasiswa(array $data): array {
    global $conn;

    $nim      = trim($data['nim'] ?? '');
    $nama     = trim($data['nama'] ?? '');
    $jurusan  = trim($data['jurusan'] ?? '');
    $semester = (int)($data['semester'] ?? 1);
    $ipk      = (float)($data['ipk'] ?? 0);
    $status   = $data['status'] ?? 'aktif';

    if ($nim === '' || $nama === '' || $jurusan === '') {
        return ['success' => false, 'msg' => 'NIM, Nama, dan Jurusan wajib diisi.'];
    }

    $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, jurusan, semester, ipk, status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        return ['success' => false, 'msg' => 'Gagal menyiapkan query.'];
    }

    $stmt->bind_param('sssids', $nim, $nama, $jurusan, $semester, $ipk, $status);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        return ['success' => true, 'msg' => 'Data mahasiswa berhasil ditambahkan.'];
    }

    return ['success' => false, 'msg' => 'NIM sudah terdaftar atau terjadi kesalahan.'];
}

function updateMahasiswa(int $id, array $data): array {
    global $conn;

    $nim      = trim($data['nim'] ?? '');
    $nama     = trim($data['nama'] ?? '');
    $jurusan  = trim($data['jurusan'] ?? '');
    $semester = (int)($data['semester'] ?? 1);
    $ipk      = (float)($data['ipk'] ?? 0);
    $status   = $data['status'] ?? 'aktif';

    if ($id <= 0 || $nim === '' || $nama === '' || $jurusan === '') {
        return ['success' => false, 'msg' => 'Data tidak valid.'];
    }

    $stmt = $conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ?, semester = ?, ipk = ?, status = ? WHERE id = ?");
    if (!$stmt) {
        return ['success' => false, 'msg' => 'Gagal menyiapkan query.'];
    }

    $stmt->bind_param('sssidsi', $nim, $nama, $jurusan, $semester, $ipk, $status, $id);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        return ['success' => true, 'msg' => 'Data mahasiswa berhasil diperbarui.'];
    }

    return ['success' => false, 'msg' => 'Terjadi kesalahan saat memperbarui data.'];
}

function deleteMahasiswa(int $id): array {
    global $conn;

    if ($id <= 0) {
        return ['success' => false, 'msg' => 'ID tidak valid.'];
    }

    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
    if (!$stmt) {
        return ['success' => false, 'msg' => 'Gagal menyiapkan query.'];
    }

    $stmt->bind_param('i', $id);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        return ['success' => true, 'msg' => 'Data mahasiswa berhasil dihapus.'];
    }

    return ['success' => false, 'msg' => 'Terjadi kesalahan saat menghapus data.'];
}

function getMahasiswaById(int $id): ?array {
    global $conn;

    if ($id <= 0) {
        return null;
    }

    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    if (!$stmt) {
        return null;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    return $data ?: null;
}

function getMahasiswaList(string $search = '', string $filterStatus = ''): array {
    global $conn;

    $sql    = "SELECT * FROM mahasiswa WHERE 1=1";
    $params = [];
    $types  = '';

    if ($search !== '') {
        $sql .= " AND (nim LIKE ? OR nama LIKE ? OR jurusan LIKE ?)";
        $like = "%$search%";
        $params = array_merge($params, [$like, $like, $like]);
        $types .= 'sss';
    }

    if ($filterStatus !== '') {
        $sql .= " AND status = ?";
        $params[] = $filterStatus;
        $types .= 's';
    }

    $sql .= " ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return [];
    }

    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $data;
}

function getMahasiswaStats(): array {
    global $conn;

    $statsRes = $conn->query("SELECT status, COUNT(*) AS jml FROM mahasiswa GROUP BY status");
    $stats = ['aktif' => 0, 'cuti' => 0, 'lulus' => 0, 'dropout' => 0];
    if ($statsRes) {
        while ($r = $statsRes->fetch_assoc()) {
            $stats[$r['status']] = $r['jml'];
        }
    }

    return $stats;
}
