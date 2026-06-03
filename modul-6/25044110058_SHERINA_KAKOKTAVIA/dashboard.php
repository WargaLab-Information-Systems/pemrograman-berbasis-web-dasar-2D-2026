<?php 
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'] ?? 'user';
$username = $_SESSION['username'] ?? 'Guest';
$user_id = $_SESSION['user_id'];

$data = [];
$revenue = 0;
$msg = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'tambah') {
        
        $input_user = ($role === 'admin') ? trim($_POST['user_id'] ?? '') : $user_id;
        $input_price = trim($_POST['total_price'] ?? '');
        
        if ($input_user !== '' && $input_price !== '') {
            $pdo->exec("SET sql_mode = ''");
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

            $stmt_add = $pdo->prepare("INSERT INTO reservations (user_id, total_price) VALUES (?, ?)");
            $stmt_add->execute([$input_user, $input_price]);

            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
            header("Location: " . $_SERVER['PHP_SELF'] . "?status=sukses");
            exit();
        }
    }

    if ($role === 'admin') {
        if (isset($_GET['aksi_hapus'])) {
            $id_hapus = $_GET['aksi_hapus'];
            $stmt_del = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt_del->execute([$id_hapus]);
            header("Location: " . $_SERVER['PHP_SELF'] . "?status=hapus_sukses");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM reservations ORDER BY id DESC");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resRevenue = $pdo->query("SELECT SUM(total_price) FROM reservations");
        $revenue = $resRevenue ? $resRevenue->fetchColumn() : 0;
        if (!$revenue) $revenue = 0;

        include 'dashboard_admin.php';
        
    } else {
        $stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY id DESC");
        $stmt->execute([$user_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'dashboard_user.php';
    }
} catch (PDOException $e) {
    echo "<h3>Error Database:</h3>";
    echo $e->getMessage();
    exit();
} catch (Exception $e) {
    echo "<h3>Error Umum:</h3>";
    echo $e->getMessage();
    exit();
}
?>