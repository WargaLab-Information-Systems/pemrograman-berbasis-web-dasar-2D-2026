<?php
session_start();
session_unset();
session_destroy();

// Kembali ke login setelah logout
header("Location: index.php");
exit;
