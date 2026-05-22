<?php
main
/* ===== LOGIKA PHP (±20%) — Data & fungsi badge ===== */
$riwayat = [
    ['tahun'=>'2025','judul'=>'Masuk Kuliah Sistem Informasi','desk'=>'Memulai perjalanan di dunia teknologi. Belajar algoritma, logika pemrograman, dan dasar-dasar komputer dari nol.',      'kat'=>'Pendidikan','hl'=>false],
    ['tahun'=>'2026','judul'=>'Mulai Belajar HTML & CSS',              'desk'=>'Pertama kali berkenalan dengan pemrograman web. Membuat halaman statis pertama dan belajar layout dengan CSS Flexbox.',      'kat'=>'Frontend', 'hl'=>false],
    ['tahun'=>'2026','judul'=>'Proyek Pertama: Website Portofolio', 'desk'=>'Menyelesaikan proyek pertama secara mandiri — website portofolio personal dengan HTML, CSS, dan sedikit JavaScript.',            'kat'=>'Proyek', 'hl'=>true],
    ['tahun'=>'2026','judul'=>'Belajar PHP & MySQL', 'desk'=>'Masuk ke dunia backend. Membangun sistem login, CRUD sederhana, dan menghubungkan PHP ke database MySQL.', 'kat'=>'Backend', 'hl'=>false],
    ['tahun'=>'2026','judul'=>'Bergabung Dengan Organisasi Di Kampus', 'desk'=>'Mengikuti organisasi atau kegiatan kampus Mengembangkan soft skill seperti komunikasi dan kerja sama tim melalui keterlibatan aktif dalam kegiatan organisasi kampus.',                                              'kat'=>'Karier', 'hl'=>true],
    ['tahun'=>'2025','judul'=>'Mengikuti praktikum pertama di lab komputer','desk'=>'Mengikuti praktikum pertama di lab komputer Mulai mengenal lingkungan praktikum dan memahami dasar penggunaan tools pemrograman secara langsung di laboratorium.','kat'=>'Fullstack','hl'=>false],
];

$tahunHl = ['2025', '2026'];

/* Badge style map — nilai langsung, bukan CSS relative-color */
$badgeStyle = [
    'Pendidikan' => 'background:rgba(240,192,64,.15);border:1px solid rgba(240,192,64,.35);color:#f0c040',
    'Frontend'   => 'background:rgba(96,208,255,.15);border:1px solid rgba(96,208,255,.35);color:#60d0ff',
    'Proyek'     => 'background:rgba(192,96,255,.15);border:1px solid rgba(192,96,255,.35);color:#c060ff',
    'Backend'    => 'background:rgba(96,255,144,.15);border:1px solid rgba(96,255,144,.35);color:#60ff90',
    'Karier'     => 'background:rgba(255,144,96,.15);border:1px solid rgba(255,144,96,.35);color:#ff9060',
    'Fullstack'  => 'background:rgba(255,96,144,.15);border:1px solid rgba(255,96,144,.35);color:#ff6090',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timeline Belajar Coding</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    /* ===== RESET & TOKEN ===== */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg:     #0a0a0f;
      --surf:   #12121a;
      --card:   #1a1a26;
      --bdr:    #2a2a3d;
      --acc:    #f0c040;
      --a2:     #60d0ff;
      --a3:     #ff5f5f;
      --txt:    #e8e8f0;
      --muted:  #6868a0;
      --sub:    #b0b0cc;
      --r:      12px;
      --mono:   'Space Mono', monospace;
      --sans:   'Syne', sans-serif;
    }

    body {
      background: var(--bg);
      color: var(--txt);
      font-family: var(--sans);
      min-height: 100vh;
      background-image:
        radial-gradient(ellipse 50% 40% at 20% 15%, rgba(240,192,64,.06) 0%, transparent 60%),
        radial-gradient(ellipse 40% 50% at 80% 85%, rgba(192,96,255,.06) 0%, transparent 60%);
    }

    /* ===== LAYOUT ===== */
    .wrap { max-width: 760px; margin: 0 auto; padding: 44px 20px 80px; }

    /* ===== HEADER ===== */
    header {
      display: flex; align-items: center; gap: 18px;
      padding-bottom: 28px; margin-bottom: 36px;
      border-bottom: 1px solid var(--bdr);
    }
    .logo {
      width: 52px; height: 52px; border-radius: 10px;
      background: var(--acc); color: #000;
      display: flex; align-items: center; justify-content: center;
      font-size: 24px; flex-shrink: 0;
    }
    header h1 { font-size: 1.65rem; font-weight: 800; letter-spacing: -.4px; line-height: 1.2; }
    header h1 span { color: var(--acc); }
    header p  { color: var(--muted); font-size: .85rem; margin-top: 5px; }

    /* ===== NAV ===== */
    nav { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 40px; }
    nav a {
      padding: 8px 20px; border-radius: 50px;
      border: 1px solid var(--bdr);
      color: var(--muted); text-decoration: none; font-size: .85rem;
      transition: background .18s, color .18s, border-color .18s;
    }
    nav a:hover, nav a.on { background: var(--acc); color: #000; border-color: var(--acc); font-weight: 700; }

    /* ===== SECTION META ===== */
    .slabel { font-family: var(--mono); font-size: .68rem; letter-spacing: 3px; text-transform: uppercase; color: var(--acc); margin-bottom: 10px; }
    .stitle  { font-size: 1.4rem; font-weight: 800; letter-spacing: -.3px; margin-bottom: 42px; }

    /* ===== TIMELINE ===== */
    .timeline { position: relative; padding-left: 56px; }
    .timeline::before {
      content: '';
      position: absolute; left: 20px; top: 0; bottom: 0; width: 2px;
      background: linear-gradient(to bottom, var(--acc) 0%, var(--bdr) 55%, transparent 100%);
    }

    .tl-item {
      position: relative;
      margin-bottom: 34px;
      animation: slideIn .5s ease both;
    }
    .tl-item:nth-child(1){animation-delay:.05s}
    .tl-item:nth-child(2){animation-delay:.13s}
    .tl-item:nth-child(3){animation-delay:.21s}
    .tl-item:nth-child(4){animation-delay:.29s}
    .tl-item:nth-child(5){animation-delay:.37s}
    .tl-item:nth-child(6){animation-delay:.45s}
    @keyframes slideIn {
      from { opacity:0; transform:translateX(-14px); }
      to   { opacity:1; transform:translateX(0); }
    }

    /* Titik */
    .dot {
      position: absolute; left: -44px; top: 19px;
      width: 15px; height: 15px; border-radius: 50%;
      background: var(--surf); border: 2px solid var(--bdr);
      transition: all .2s;
    }
    .hl .dot {
      background: var(--acc); border-color: var(--acc);
      box-shadow: 0 0 0 4px rgba(240,192,64,.18);
    }

    /* Card */
    .tl-card {
      background: var(--card); border: 1px solid var(--bdr);
      border-radius: var(--r); padding: 20px 22px;
      transition: border-color .2s, transform .2s;
    }
    .tl-card:hover { border-color: rgba(240,192,64,.3); transform: translateX(4px); }
    .hl .tl-card {
      border-color: rgba(240,192,64,.4);
      background: linear-gradient(135deg, rgba(240,192,64,.055) 0%, var(--card) 100%);
    }

    .tl-top { display: flex; align-items: center; gap: 11px; margin-bottom: 9px; flex-wrap: wrap; }

    .tl-year {
      font-family: var(--mono); font-size: 1.05rem; font-weight: 700;
      color: var(--acc); min-width: 50px;
    }
    .hl .tl-year { font-size: 1.2rem; text-shadow: 0 0 10px rgba(240,192,64,.4); }

    .tl-judul { font-size: .97rem; font-weight: 800; flex: 1; }
    .hl .tl-judul { color: #fff; }

    .badge {
      display: inline-block; padding: 3px 11px; border-radius: 50px;
      font-family: var(--mono); font-size: .7rem; letter-spacing: 1px;
    }

    .hl-flag {
      display: inline-flex; align-items: center; gap: 4px;
      background: rgba(240,192,64,.12); border: 1px solid rgba(240,192,64,.3);
      color: var(--acc); border-radius: 6px; padding: 3px 10px;
      font-family: var(--mono); font-size: .7rem; margin-left: auto; white-space: nowrap;
    }

    .tl-desk { color: var(--sub); font-size: .89rem; line-height: 1.65; }

    /* ===== BUTTONS ===== */
    .btn, .btnout {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 11px 22px; border-radius: 9px;
      font-family: var(--sans); font-size: .9rem; font-weight: 700;
      cursor: pointer; text-decoration: none; border: none;
      transition: transform .15s, box-shadow .15s;
    }
    .btn    { background: var(--acc); color: #000; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(240,192,64,.24); }
    .btnout { background: transparent; color: var(--txt); border: 1px solid var(--bdr); }
    .btnout:hover { border-color: var(--a2); color: var(--a2); transform: none; }
    .bnav { display: flex; gap: 12px; margin-top: 48px; flex-wrap: wrap; }

    /* ===== FOOTER ===== */
    footer {
      text-align: center; color: var(--muted);
      font-family: var(--mono); font-size: .73rem;
      margin-top: 64px; letter-spacing: 1px;
    }
  </style>
</head>
<body>
<div class="wrap">

  <!-- ═══ HEADER ═══ -->
  <header>
    <div class="logo">📅</div>
    <div>
      <h1>Dev<span>Timeline</span></h1>
      <p>Perjalanan Belajar Coding — Riwayat Lengkap</p>
    </div>
  </header>

  <!-- ═══ NAV ═══ -->
  <nav>
    <a href="index.php">👤 Profil</a>
    <a href="timeline.php" class="on">📅 Timeline</a>
    <a href="blog.php">✍️ Blog</a>
  </nav>

  <!-- ═══ SECTION LABEL ═══ -->
  <div class="slabel">// 02 — Riwayat Belajar</div>
  <div class="stitle">Timeline Perjalanan Belajar Coding</div>

  <!-- ═══ TIMELINE ═══ -->
  <div class="timeline">
    <?php foreach ($riwayat as $item):
      $isHl  = in_array($item['tahun'], $tahunHl);
      $cls   = $isHl ? 'tl-item hl' : 'tl-item';
      $bstyle = $badgeStyle[$item['kat']] ?? 'background:rgba(136,136,136,.15);border:1px solid rgba(136,136,136,.3);color:#888';
    ?>
    <div class="<?= $cls ?>">
      <div class="dot"></div>
      <div class="tl-card">
        <div class="tl-top">
          <span class="tl-year"><?= $item['tahun'] ?></span>
          <span class="tl-judul"><?= htmlspecialchars($item['judul']) ?></span>
          <span class="badge" style="<?= $bstyle ?>"><?= $item['kat'] ?></span>
          <?php if ($item['hl']): ?>
          <span class="hl-flag">⭐ Milestone</span>
          <?php endif; ?>
        </div>
        <p class="tl-desk"><?= htmlspecialchars($item['desk']) ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- ═══ BOTTOM NAV ═══ -->
  <div class="bnav">
    <a href="index.php" class="btn">← Kembali ke Profil</a>
    <a href="blog.php"  class="btnout">Menuju Blog →</a>
  </div>

  <footer>&copy; <?= date('Y') ?> &nbsp;·&nbsp; Tugas Praktikum Pemrograman Web Dasar — PHP</footer>
</div>
</body>
</html>

function highlight($tahun, $target)
{
    if ($tahun == $target) {
        return "<span class='bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold'>$tahun</span>";
    }
    return "<span class='bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm'>$tahun</span>";
}

$data = [
    [
        "tahun" => "2025",
        "kegiatan" => "Masuk Kuliah",
        "deskripsi" => "Mengikuti ospek, beradaptasi dengan lingkungan kampus, dan mulai mengenal dunia perkuliahan."
    ],
    [
        "tahun" => "2025",
        "kegiatan" => "Awal Belajar Pemrograman Dasar",
        "deskripsi" => "Mulai memahami logika dasar seperti variabel, percabangan, dan perulangan."
    ],
    [
        "tahun" => "2025",
        "kegiatan" => "Belajar HTML",
        "deskripsi" => "Membuat struktur website menggunakan elemen dasar HTML seperti heading dan paragraf."
    ],
    [
        "tahun" => "2026",
        "kegiatan" => "Belajar CSS",
        "deskripsi" => "Mempercantik tampilan website dengan warna, layout, dan desain responsive."
    ],
    [
        "tahun" => "2026",
        "kegiatan" => "Belajar JavaScript",
        "deskripsi" => "Mulai membuat website menggunakan JavaScript dan mengolah data dari user."
    ],
    [
        "tahun" => "2026",
        "kegiatan" => "Belajar PHP",
        "deskripsi" => "Mulai membuat website dinamis menggunakan PHP dan mengolah data dari user."
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 min-h-screen">

<div class="max-w-3xl mx-auto px-4 mt-10">

    <div class="text-center text-white mb-8">
        <h2 class="text-3xl font-bold ">Timeline Belajar Coding</h2>
        <p class="opacity-80">Perjalanan dari awal sampai sekarang</p>
    </div>

    
    <div class="relative border-l-4 border-white/40 pl-6 space-y-6">

        <?php foreach ($data as $item): ?>
            <div class="relative">
                <div class="absolute -left-3 top-2 w-5 h-5 bg-white rounded-full border-4 border-purple-500"></div>
                <div class="bg-white/80 backdrop-blur rounded-xl p-4 shadow-md">
                    <div class="mb-2">
                        <?= highlight($item['tahun'], "2026"); ?>
                    </div>

                    <h3 class="font-bold text-lg text-gray-800">
                        <?= $item['kegiatan']; ?>
                    </h3>

                    <p class="text-gray-600 text-sm mt-1">
                        <?= $item['deskripsi']; ?>
                    </p>Masuk Kuliah

                </div>

            </div>
        <?php endforeach; ?>

    </div>

    <div class="text-center mt-10 text-white space-x-4 mb-10">
        <a href="index.php" class="hover:underline">← Kembali ke Profil</a>
        <a href="blog.php" class="hover:underline">Menuju Blog →</a>
    </div>

</div>

</body>
</html>
 main
