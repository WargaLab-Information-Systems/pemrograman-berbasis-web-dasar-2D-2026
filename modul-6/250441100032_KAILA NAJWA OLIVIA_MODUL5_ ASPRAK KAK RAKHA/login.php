<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if(password_verify($password,$row['password'])){

            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            header("Location: dashboard.php");

        } else {
            echo "<script>alert('Password salah')</script>";
        }

    } else {
        echo "<script>alert('Username tidak ditemukan')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-100">

<div class="flex justify-center items-center h-screen">

<form method="POST"
class="bg-white p-8 rounded-xl shadow-lg w-96">

<h2 class="text-3xl font-bold text-center mb-6">
Login
</h2>

<input type="text"
name="username"
placeholder="Username"
required
class="w-full border p-3 rounded mb-4">

<input type="password"
name="password"
placeholder="Password"
required
class="w-full border p-3 rounded mb-4">

<button type="submit"
name="login"
class="bg-blue-500 text-white w-full p-3 rounded hover:bg-blue-600">

Login

</button>

</form>

</div>

</body>
</html>