<?php
$submitted = false;
$errors = [];
$formData = [];
$pesanFramework = '';
$frameworkList = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;

    if (empty(trim($_POST['nama'] ?? ''))) {
      $errors[] = 'Nama wajib diisi.';
    }

    if (empty(trim($_POST['id_dev'] ?? ''))) {
      $errors[] = 'ID Developer wajib diisi.';
    }

    if (empty(trim($_POST['kota_tgl'] ?? ''))) {
      $errors[] = 'Kota / Tgl Lahir wajib diisi.';
    }

    if (empty(trim($_POST['email'] ?? ''))) {
      $errors[] = 'Email wajib diisi.';
    }

    if (empty(trim($_POST['whatsapp'] ?? ''))) {
      $errors[] = 'No. WhatsApp wajib diisi.';
    }
    
    if (empty(trim($_POST['frameworks']))) {
      $errors[] = 'Framework / Tools wajib diisi.';
    }

    if (empty(trim($_POST['pengalaman'] ?? ''))) {
      $errors[] = 'Cerita pengalaman wajib diisi.';
    }

    if (empty(trim($_POST['minat'] ?? ''))) {
      $errors[] = 'Minat bidang wajib dipilih.';
    }

    if (empty(trim($_POST['skill_level'] ?? ''))) {
      $errors[] = 'Tingkat skill wajib dipilih.';
    }

    if (empty($errors)) {
    // Memecah framework berdasarkan koma
      $frameworkList = preg_split('/[\s,]+/', trim($_POST['frameworks'] ?? ''));
      $frameworkList = array_filter($frameworkList);
      $frameworkList = array_map('trim', $frameworkList);
      
      $totalFramework = count($frameworkList);
    
      if ($totalFramework > 2) {
        $pesanFramework = 'Skill Anda cukup luas di bidang development!';
      }
        $submitted = true;
      }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profil Developer</title>

<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap" rel="stylesheet">

<style>

:root {
  --bg: #0a0a0f;
  --surf: #12121a;
  --card: #1a1a26;
  --bdr: #2a2a3d;
  --acc: #f0c040;
  --a2: #60d0ff;
  --a3: #ff6060;
  --txt: #e8e8f0;
  --muted: #6868a0;
  --sub: #b0b0cc;
  --r: 12px;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

body{
  background:var(--bg);
  color:var(--txt);
  font-family:'Syne',sans-serif;
  min-height:100vh;
}

.wrapper{
  max-width:860px;
  margin:auto;
  padding:40px 20px 80px;
}

header{
  display:flex;
  align-items:center;
  gap:16px;
  margin-bottom:48px;
  border-bottom:1px solid var(--bdr);
  padding-bottom:24px;
}

.logo-badge{
  width:52px;
  height:52px;
  background:var(--acc);
  color:#000;
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:20px;
  font-weight:700;
}

header h1{
  font-size:1.6rem;
  font-weight:800;
}

header h1 span{
  color:var(--acc);
}

header p{
  color:var(--muted);
  font-size:.88rem;
}

nav{
  display:flex;
  gap:10px;
  margin-bottom:36px;
}

nav a{
  padding:8px 18px;
  border:1px solid var(--bdr);
  border-radius:50px;
  text-decoration:none;
  color:var(--muted);
}

nav a.active,
nav a:hover{
  background:var(--acc);
  color:#000;
}

.section-label{
  font-size:.75rem;
  color:var(--acc);
  margin-bottom:12px;
  letter-spacing:2px;
}

.section-title{
  font-size:1.4rem;
  margin-bottom:24px;
  font-weight:800;
}

.table-wrapper,
.form-card,
.result-card{
  background:var(--card);
  border:1px solid var(--bdr);
  border-radius:var(--r);
}

.table-wrapper{
  overflow:hidden;
  margin-bottom:48px;
}

table{
  width:100%;
  border-collapse:collapse;
}

thead th{
  background:var(--acc);
  color:#000;
  padding:14px 20px;
  text-align:left;
}

tbody td{
  padding:13px 20px;
  border-bottom:1px solid var(--bdr);
}

.form-card{
  padding:32px;
  margin-bottom:40px;
}

.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:20px;
}

@media(max-width:600px){
  .form-grid{
    grid-template-columns:1fr;
  }
}

.form-group{
  display:flex;
  flex-direction:column;
  gap:7px;
}

.form-group.full{
  grid-column:1/-1;
}

label{
  font-size:.8rem;
  color:var(--muted);
}

input[type="text"],
input[type="email"],
textarea,
select{
  width:100%;
  background:var(--surf);
  border:1px solid var(--bdr);
  border-radius:8px;
  color:var(--txt);
  padding:11px 14px;
}

textarea{
  min-height:100px;
  resize:vertical;
}

.check-group{
  display:flex;
  flex-wrap:wrap;
  gap:10px;
}

.check-item{
  display:flex;
  align-items:center;
  gap:7px;
  background:var(--surf);
  border:1px solid var(--bdr);
  border-radius:8px;
  padding:8px 14px;
}

.btn{
  background:var(--acc);
  color:#000;
  border:none;
  border-radius:8px;
  padding:13px 28px;
  font-weight:700;
  cursor:pointer;
}

.error-box{
  background:rgba(255,96,96,.1);
  border:1px solid rgba(255,96,96,.35);
  padding:16px 20px;
  border-radius:10px;
  margin-bottom:24px;
}

.result-card{
  padding:28px;
  margin-bottom:20px;
}

.result-card h3{
  margin-bottom:16px;
  color:var(--a2);
}

.tag-list{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
}

.tag{
  padding:4px 14px;
  border-radius:50px;
  background:rgba(240,192,64,.12);
  border:1px solid rgba(240,192,64,.3);
  color:var(--acc);
  font-size:.82rem;
}

.tag-blue{
  background:rgba(96,208,255,.1);
  border:1px solid rgba(96,208,255,.3);
  color:var(--a2);
}

.pengalaman-box{
  background:var(--surf);
  border-left:3px solid var(--acc);
  padding:16px 20px;
  line-height:1.7;
}

footer{
  text-align:center;
  color:var(--muted);
  margin-top:60px;
}

</style>
</head>

<body>

<div class="wrapper">

<header>
  <div class="logo-badge">&lt;/&gt;</div>

  <div>
    <h1>Dev<span>Profile</span>.io</h1>
    <p>Sistem Profil Interaktif Developer</p>
  </div>
</header>

<nav>
  <a href="#" class="active">👤 Profil</a>
  <a href="timeline.php">📅 Timeline</a>
  <a href="blog.php">✍️ Blog</a>
</nav>

<div class="section-label">// 01 — IDENTITAS</div>
<div class="section-title">Profil Interaktif Developer Pemula</div>

<div class="table-wrapper">

<table>

<thead>
<tr>
<th colspan="2">📋 Data Diri</th>
</tr>
</thead>

<tbody>

<tr>
  <td>Nama</td>
  <td><?= $submitted ? htmlspecialchars($formData['nama']) : 'Belum diisi' ?></td>
</tr>

<tr>
  <td>ID Developer</td>
  <td><?= $submitted ? htmlspecialchars($formData['id_dev']) : 'Belum diisi' ?></td>
</tr>

<tr>
  <td>Kota / Tgl Lahir</td>
  <td><?= $submitted ? htmlspecialchars($formData['kota_tgl']) : 'Belum diisi' ?></td>
</tr>

<tr>
  <td>Email</td>
  <td><?= $submitted ? htmlspecialchars($formData['email']) : 'Belum diisi' ?></td>
</tr>

<tr>
  <td>No. WhatsApp</td>
  <td><?= $submitted ? htmlspecialchars($formData['whatsapp']) : 'Belum diisi' ?></td>
</tr>

</tbody>
</table>
</div>

<div class="section-label">// 02 — FORM ISIAN</div>
<div class="section-title">Lengkapi Data Developer Anda</div>

<?php if(!empty($errors)): ?>
  <div class="error-box">
    <strong>⚠️ Terdapat kesalahan:</strong>
    <ul>
      <?php foreach($errors as $e): ?>
        <li><?= $e ?></li>
        <?php endforeach; ?>
    </ul>
  </div>

<?php endif; ?>

<div class="form-card">
<form method="POST">
<div class="form-grid">

<div class="form-group">
<label>Nama Lengkap</label>
<input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
</div>

<div class="form-group">
<label>ID Developer</label>
<input type="text" name="id_dev" value="<?= htmlspecialchars($_POST['id_dev'] ?? '') ?>">
</div>

<div class="form-group">
<label>Kota / Tgl Lahir</label>
<input type="text" name="kota_tgl" value="<?= htmlspecialchars($_POST['kota_tgl'] ?? '') ?>">
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
</div>

<div class="form-group">
<label>No. WhatsApp</label>
<input type="text" name="whatsapp" value="<?= htmlspecialchars($_POST['whatsapp'] ?? '') ?>">
</div>

<div class="form-group">
<label>Framework / Tools(Pisahkan dengan koma)</label>
<input type="text" name="frameworks" value="<?= htmlspecialchars($_POST['frameworks'] ?? '') ?>">
</div>

<div class="form-group full">
<label>Cerita Pengalaman</label>
<textarea name="pengalaman"><?= htmlspecialchars($_POST['pengalaman'] ?? '') ?></textarea>
</div>

<div class="form-group full">
<label>Tools Penunjang</label>

<div class="check-group">

<label class="check-item">
<input type="checkbox" name="tools[]" value="VS Code">
VS Code
</label>

<label class="check-item">
<input type="checkbox" name="tools[]" value="GitHub">
GitHub
</label>

<label class="check-item">
<input type="checkbox" name="tools[]" value="Figma">
Figma
</label>

<label class="check-item">
<input type="checkbox" name="tools[]" value="Postman">
Postman
</label>

<label class="check-item">
<input type="checkbox" name="tools[]" value="Docker">
Docker
</label>

<label class="check-item">
<input type="checkbox" name="tools[]" value="Notion">
Notion
</label>

</div>
</div>

<div class="form-group">

<label>Minat Bidang</label>

<div class="check-group">

<label class="check-item">
<input type="radio" name="minat" value="Frontend">
Frontend
</label>

<label class="check-item">
<input type="radio" name="minat" value="Backend">
Backend
</label>

<label class="check-item">
<input type="radio" name="minat" value="Fullstack">
Fullstack
</label>

</div>
</div>

<div class="form-group">

<label>Tingkat Skill Coding</label>

<select name="skill_level">

<option value="">— Pilih Tingkat —</option>
<option value="Dasar">Dasar</option>
<option value="Cukup">Cukup</option>
<option value="Profesional">Profesional</option>

</select>

</div>

</div>

<div style="margin-top:28px;">
<button type="submit" class="btn">⚡ Simpan Profil</button>
</div>

</form>

</div>

<?php if($submitted): ?>

<div class="section-label">// 03 — HASIL OUTPUT</div>
<div class="section-title">Data Profil Anda</div>

<div class="result-card">

<h3>🗂️ Data Utama</h3>

<table>

<tbody>

<tr>
<td>Nama</td>
<td><?= htmlspecialchars($formData['nama']) ?></td>
</tr>

<tr>
<td>ID Developer</td>
<td><?= htmlspecialchars($formData['id_dev']) ?></td>
</tr>

<tr>
<td>Kota / Tgl Lahir</td>
<td><?= htmlspecialchars($formData['kota_tgl']) ?></td>
</tr>

<tr>
<td>Email</td>
<td><?= htmlspecialchars($formData['email']) ?></td>
</tr>

<tr>
<td>No. WhatsApp</td>
<td><?= htmlspecialchars($formData['whatsapp']) ?></td>
</tr>

<tr>
<td>Minat Bidang</td>
<td><?= htmlspecialchars($formData['minat']) ?></td>
</tr>

<tr>
<td>Tingkat Skill</td>
<td><?= htmlspecialchars($formData['skill_level']) ?></td>
</tr>

<tr>
<td>Frameworks</td>
<td>
<div class="tag-list">
<?php foreach($frameworkList as $fw): ?>
<span class="tag"><?= htmlspecialchars($fw) ?></span>
<?php endforeach; ?>
</div>
</td>
</tr>

<?php if(!empty($pesanFramework)): ?>

<tr>
<td>Pesan Tambahan</td>
<td style="color:#60d0ff; font-weight:700;">
<?= $pesanFramework ?>
</td>
</tr>

<?php endif; ?>

<tr>
<td>Tools Penunjang</td>
<td>

<div class="tag-list">

<?php if(!empty($_POST['tools'])): ?>

<?php foreach($_POST['tools'] as $tool): ?>
<span class="tag tag-blue"><?= htmlspecialchars($tool) ?></span>
<?php endforeach; ?>

<?php endif; ?>

</div>

</td>
</tr>

</tbody>

</table>

</div>

<div class="result-card">

<h3>📝 Pengalaman</h3>

<div class="pengalaman-box">
<?= nl2br(htmlspecialchars($formData['pengalaman'])) ?>
</div>

</div>

<?php endif; ?>

<footer>
&copy; <?= date('Y') ?> · Tugas Praktikum Pemrograman Web Dasar — PHP
</footer>

</div>

</body>
</html>