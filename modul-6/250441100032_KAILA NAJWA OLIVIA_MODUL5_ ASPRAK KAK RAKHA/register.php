<?php
include 'koneksi.php';

if(isset($_POST['register'])){

    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $role = 'user';

    $cek = $conn->prepare("SELECT id FROM users WHERE username=?");
    $cek->bind_param("s",$username);
    $cek->execute();

    $result = $cek->get_result();

    if($result->num_rows > 0){

        echo "<script>alert('Username sudah digunakan')</script>";

    } else {

        $stmt = $conn->prepare("INSERT INTO users(username,password,role) VALUES(?,?,?)");

        $stmt->bind_param("sss",$username,$password,$role);

        if($stmt->execute()){

            echo "<script>
            alert('Registrasi berhasil');
            window.location='login.php';
            </script>";

        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-100">

<div class="flex justify-center items-center h-screen">

<form method="POST"
class="bg-white p-8 rounded-xl shadow-lg w-96">

<h2 class="text-3xl font-bold text-center mb-6">
Register User
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
name="register"
class="bg-green-500 text-white w-full p-3 rounded hover:bg-green-600">

Register

</button>

</form>

</div>

</body>
</html>