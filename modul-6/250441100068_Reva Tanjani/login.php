<?php

session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_admin = "admin";
    $pass_admin = "123";
    if(
        $username == $user_admin &&
        $password == $pass_admin
    ){
        $_SESSION['login'] = true;

        header("Location: admin.php");
        exit;
    }
    else{

        $error = "Username atau Password salah";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-orange-100 flex justify-center items-center h-screen">

<form
method="POST"
class="bg-white p-8 rounded-xl shadow-lg w-80"
>

<h2 class="text-3xl font-bold text-center text-orange-500 mb-6">
Login Admin
</h2>

<?php if(isset($error)) : ?>

<p class="text-red-500 text-center mb-4">
<?= $error; ?>
</p>

<?php endif; ?>

<input
type="text"
name="username"
placeholder="Username"
required
class="w-full border p-2 rounded mb-4"
>

<input
type="password"
name="password"
placeholder="Password"
required
class="w-full border p-2 rounded mb-4"
>

<button
type="submit"
name="login"
class="w-full bg-orange-500 text-white p-2 rounded"
>
Login
</button>

</form>

</body>
</html>