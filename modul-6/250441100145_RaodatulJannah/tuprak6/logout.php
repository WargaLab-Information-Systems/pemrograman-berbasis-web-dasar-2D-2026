<?php

session_start();

$_SESSION = [];

session_destroy();

?>

<!DOCTYPE html>
<html>
<head>

<title>Logout</title>

<script src="https://cdn.tailwindcss.com"></script>

<meta http-equiv="refresh" content="3;url=login.php">

</head>

<body class="bg-pink-100 flex justify-center items-center h-screen">

<div class="bg-white p-10 rounded-3xl shadow-2xl text-center">

<h1 class="text-4xl font-bold text-pink-500 mb-4">

Terima Kasih

</h1>

<p class="text-gray-600 text-lg">

Sampai jumpa lagi di Pinky Kitchen

</p>

</div>

</body>
</html>