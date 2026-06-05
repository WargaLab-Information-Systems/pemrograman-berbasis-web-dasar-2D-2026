<?php

include 'auth.php';
include 'koneksi.php';

$id = (int) $_GET['id'];

if ($_SESSION['user']['role'] == 'admin') {

    $stmt = $conn->prepare(
        "DELETE FROM makanan WHERE id=?"
    );

    $stmt->bind_param("i", $id);

    $stmt->execute();

} else {

    $stmt = $conn->prepare(
        "DELETE FROM makanan
        WHERE id=? AND user_id=?"
    );

    $stmt->bind_param(
        "ii",
        $id,
        $_SESSION['user']['id']
    );

    $stmt->execute();
}

header("Location: index.php");

?>