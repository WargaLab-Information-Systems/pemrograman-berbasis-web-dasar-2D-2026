<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])){

    header("Location: login.php");
    exit;

}


if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    $stmt = $conn->prepare(
        "DELETE FROM pesanan WHERE id=?"
    );

    $stmt->bind_param("i",$id);

    $stmt->execute();

    header("Location: admin.php");
    exit;

}

# TAMBAH DATA
if(isset($_POST['tambah'])){

    $nama = $_POST['nama'];
    $menu = $_POST['menu'];
    $jumlah = $_POST['jumlah'];

    $stmt = $conn->prepare(
        "INSERT INTO pesanan(nama,menu,jumlah)
        VALUES (?,?,?)"
    );

    $stmt->bind_param(
        "ssi",
        $nama,
        $menu,
        $jumlah
    );

    $stmt->execute();

    header("Location: admin.php");
    exit;

}


if(isset($_POST['edit'])){

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $menu = $_POST['menu'];
    $jumlah = $_POST['jumlah'];

    $stmt = $conn->prepare(
        "UPDATE pesanan
        SET nama=?, menu=?, jumlah=?
        WHERE id=?"
    );

    $stmt->bind_param(
        "ssii",
        $nama,
        $menu,
        $jumlah,
        $id
    );

    $stmt->execute();

    header("Location: admin.php");
    exit;

}


$edit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $stmt = $conn->prepare(
        "SELECT * FROM pesanan WHERE id=?"
    );

    $stmt->bind_param("i",$id);

    $stmt->execute();

    $result = $stmt->get_result();

    $edit = $result->fetch_assoc();

}

$data = $conn->query(
    "SELECT * FROM pesanan"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-orange-100 p-10">

<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg">

<div class="flex justify-between mb-6">

<h2 class="text-3xl font-bold text-orange-500">
Data Pesanan
</h2>

<a
href="login.php"
class="bg-red-500 text-white px-4 py-2 rounded"
>
Logout
</a>

</div>

<!-- FORM -->

<form method="POST" class="grid grid-cols-4 gap-4 mb-8">

<input
type="hidden"
name="id"
value="<?= $edit['id'] ?? ''; ?>"
>

<input
type="text"
name="nama"
placeholder="Nama"
required
value="<?= $edit['nama'] ?? ''; ?>"
class="border p-2 rounded"
>

<select
name="menu"
class="border p-2 rounded"
>

<option>Mie Ayam Biasa</option>
<option>Mie Ayam Bakso</option>
<option>Mie Ayam Ceker</option>

</select>

<input
type="number"
name="jumlah"
placeholder="Jumlah"
required
value="<?= $edit['jumlah'] ?? ''; ?>"
class="border p-2 rounded"
>

<?php if($edit) : ?>

<button
type="submit"
name="edit"
class="bg-blue-500 text-white rounded"
>
Update
</button>

<?php else : ?>

<button
type="submit"
name="tambah"
class="bg-green-500 text-white rounded"
>
Tambah
</button>

<?php endif; ?>

</form>

<!-- TABLE -->

<table class="w-full border">

<tr class="bg-orange-500 text-white">

<th class="p-3">No</th>
<th>Nama</th>
<th>Menu</th>
<th>Jumlah</th>
<th>Aksi</th>

</tr>

<?php while($row = $data->fetch_assoc()) : ?>

<tr class="text-center border-b">

<td class="p-3">
<?= $row['id']; ?>
</td>

<td>
<?= htmlspecialchars($row['nama']); ?>
</td>

<td>
<?= htmlspecialchars($row['menu']); ?>
</td>

<td>
<?= htmlspecialchars($row['jumlah']); ?>
</td>

<td class="space-x-2">

<a
href="?edit=<?= $row['id']; ?>"
class="bg-blue-500 text-white px-3 py-1 rounded"
>
Edit
</a>

<a
href="?hapus=<?= $row['id']; ?>"
onclick="return confirm('Yakin hapus?')"
class="bg-red-500 text-white px-3 py-1 rounded"
>
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>