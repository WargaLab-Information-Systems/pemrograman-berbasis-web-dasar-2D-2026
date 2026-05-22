<?php
// logout.php — Hancurkan session lalu redirect ke login

session_start();
session_unset();
session_destroy();

header("Location: login.php");
exit;