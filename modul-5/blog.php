<?php
  main
$artikelList = [
    'html-pertama' => [
        'judul'    => 'Belajar HTML Pertama Kali',
        'tanggal'  => '09 Maret 2026',
        'ikon'     => '🌐',
        'refleksi' => 'Saat pertama kali menulis tag &lt;html&gt; dan melihat teks muncul di browser, ada perasaan yang sulit dijelaskan — seperti memegang kunci sebuah dunia baru. Belajar HTML mengajarkan saya bahwa setiap halaman web yang saya kunjungi adalah karya seseorang, dibangun baris demi baris dengan penuh kesabaran dan ketelitian.',
        'gambar'   => 'kuliah-cover.png',
        'link_ref' => 'https://developer.mozilla.org/id/docs/Learn/HTML/Introduction_to_HTML',
        'ref_label'=> 'MDN: Pengenalan HTML',
    ],
    'error-pertama' => [
        'judul'    => 'Error Pertama yang Mengajarkan Banyak Pelajaran',
        'tanggal'  => '05 Maret 2025',
        'ikon'     => '🐞',
        'refleksi' => 'Bug pertama saya adalah tanda kurung yang tidak ditutup dalam sebuah fungsi JavaScript. Butuh beberapa waktu untuk saya menemukannya. Tapi justru dari situlah saya belajar membaca pesan error dengan teliti, bukan panik. Setiap error sejak itu saya anggap sebagai teman yang memberi petunjuk, bukan musuh.',
        'gambar'   => 'kuliah-cover.png',
        'link_ref' => 'https://developer.mozilla.org/en-US/docs/Tools/Browser_Console',
        'ref_label'=> 'MDN: Browser Console',
    ],
    'proyek-pertama' => [
        'judul'    => 'Menyelesaikan Proyek Pertama',
        'tanggal'  => '30 Maret 2026',
        'ikon'     => '🚀',
        'refleksi' => 'Website portofolio pertama saya tampilannya sangat sederhana, tapi saat melihatnya live di browser untuk pertama kali, rasanya seperti berlari melewati garis finish. Menyelesaikan sesuatu — meskipun tidak sempurna — jauh lebih berharga daripada mengejar kesempurnaan tanpa pernah selesai.',
        'link_ref' => 'https://pages.github.com/',
        'gambar'   => 'kuliah-cover.png',
        'ref_label'=> 'GitHub Pages: Deploy Gratis',
    ],
    'php-dan-database' => [
        'judul'    => 'Petualangan PHP dan Database',
        'tanggal'  => '26 April 2026',
        'ikon'     => '🗄️',
        'refleksi' => 'Menghubungkan PHP dengan MySQL pertama kali terasa seperti sihir. Data yang saya simpan melalui form benar-benar tersimpan dan bisa diambil lagi! Saya mulai memahami mengapa backend itu penting — ia adalah otak di balik tampilan cantik sebuah aplikasi.',
        'gambar'   => 'kuliah-cover.png',
        'link_ref' => 'https://www.php.net/manual/en/book.mysqli.php',
        'ref_label'=> 'PHP: MySQLi Extension',
    ],
    'magang-dev' => [
        'judul'    => 'Pengalaman Pertama Kali Masuk Kuliah',
        'tanggal'  => '25 Agustus 2025',
        'ikon'     => '💼',
        'refleksi' => 'Pengalaman pertama kali masuk kuliah menjadi momen yang penuh kesan dan tantangan karena saya harus beradaptasi dengan lingkungan baru yang lebih mandiri. Awalnya saya merasa gugup dan canggung saat bertemu dosen serta teman-teman baru. Saya juga mulai belajar bertanggung jawab terhadap waktu dan tugas tanpa selalu diingatkan. Dari pengalaman ini, saya menyadari pentingnya disiplin, inisiatif, dan keberanian untuk bertanya. Meskipun tidak mudah, hal ini membantu saya menjadi lebih mandiri dan percaya diri.',
        'gambar'   => 'kuliah-cover.png',
        'link_ref' => 'https://git-scm.com/book/en/v2',
        'ref_label'=> 'Pro Git Book (Free)',
    ],
];

$kutipan = [
    '"Setiap programmer besar pernah menjadi programmer pemula." — Remez Sasson',
    '"Code is like humor. When you have to explain it, it\'s bad." — Cory House',
    '"Programming isn\'t about what you know; it\'s about what you can figure out." — Chris Pine',
    '"Make it work, make it right, make it fast." — Kent Beck',
    '"Belajar pemrograman itu seperti belajar berjalan — jatuh itu bagian dari prosesnya." — Anonim',
];
$kutipanHariIni = $kutipan[array_rand($kutipan)];

$key  = $_GET['artikel'] ?? null;
$art  = ($key && isset($artikelList[$key])) ? $artikelList[$key] : null;
$keys = array_keys($artikelList);
$ci   = $art ? array_search($key, $keys) : -1;
$prev = ($ci > 0) ? $keys[$ci - 1] : null;
$next = ($ci < count($keys) - 1 && $ci >= 0) ? $keys[$ci + 1] : null;

$artikel = [
    "html" => [
        "judul"   => "Belajar HTML Pertama Kali",
        "tanggal" => "2023-01-01",
        "isi"     => "Saat belajar html untuk pertamakalinya saya membuat cv tentang diri saya dan itu cukup menarik 
        karena disitu saya pertamakali membuat web",
        "gambar"  => "belajar html pertamakali.png",
        "link"    => [
            "https://www.w3schools.com",
        ]
    ],
    "error" => [
        "judul"   => "Error Pertama",
        "tanggal" => "2023-02-01",
        "isi"     => "Saya mengalami error pertama kali saat membuat tugas yang dimana saya lupa memberi tanda kutip sehingga membuat 
        1 blok tabel menjadi acak",
        "gambar"  => "error..png",
        "link"    => [
            "https://stackoverflow.com",
        ]
    ]
];

$quotes = [
    "diam menyusun logika bergerak error semua",
    "Error adalah guru terbaik ",
    "Debugging itu seni ",
    "Coding itu butuh latihan "
];

shuffle($quotes);
$randomQuote = $quotes[0];
main
?>

<!DOCTYPE html>
<html lang="id">
<head>
 main
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Developer</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    /* RESET & TOKEN */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg:     #0a0a0f;
      --surf:   #12121a;
      --card:   #1a1a26;
      --bdr:    #2a2a3d;
      --acc:    #f0c040;
      --a2:     #60d0ff;
      --a3:     #ff5f5f;
      --a4:     #c060ff;
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
        radial-gradient(ellipse 50% 35% at 90% 12%, rgba(192,96,255,.07) 0%, transparent 60%),
        radial-gradient(ellipse 45% 40% at 5%  85%, rgba(96,208,255,.06) 0%, transparent 60%);
    }

    /* LAYOUT */
    .wrap { max-width: 960px; margin: 0 auto; padding: 44px 20px 80px; }

    /* HEADER */
    header {
      display: flex; align-items: center; gap: 18px;
      padding-bottom: 28px; margin-bottom: 36px;
      border-bottom: 1px solid var(--bdr);
    }
    .logo {
      width: 52px; height: 52px; border-radius: 10px;
      background: var(--a4); color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-size: 24px; flex-shrink: 0;
    }
    header h1 { font-size: 1.65rem; font-weight: 800; letter-spacing: -.4px; line-height: 1.2; }
    header h1 span { color: var(--a4); }
    header p  { color: var(--muted); font-size: .85rem; margin-top: 5px; }

    /* NAV */
    nav { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 36px; }
    nav a {
      padding: 8px 20px; border-radius: 50px;
      border: 1px solid var(--bdr);
      color: var(--muted); text-decoration: none; font-size: .85rem;
      transition: background .18s, color .18s, border-color .18s;
    }
    nav a:hover, nav a.on { background: var(--acc); color: #000; border-color: var(--acc); font-weight: 700; }

    /* KUTIPAN */
    .qbar {
      display: flex; align-items: flex-start; gap: 14px;
      background: rgba(192,96,255,.08); border: 1px solid rgba(192,96,255,.25);
      border-radius: var(--r); padding: 18px 22px; margin-bottom: 36px;
    }
    .qi { font-size: 1.4rem; flex-shrink: 0; line-height: 1; }
    .qlabel { font-family: var(--mono); font-size: .65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--a4); margin-bottom: 6px; }
    .qtxt   { font-style: italic; font-size: .92rem; line-height: 1.65; color: #c0b0e8; }

    /* SECTION META */
    .slabel { font-family: var(--mono); font-size: .68rem; letter-spacing: 3px; text-transform: uppercase; color: var(--acc); margin-bottom: 10px; }
    .stitle  { font-size: 1.35rem; font-weight: 800; letter-spacing: -.3px; margin-bottom: 26px; }

    /* BLOG GRID */
    .bgrid { display: grid; grid-template-columns: 260px 1fr; gap: 24px; align-items: start; }
    @media(max-width:680px){ .bgrid{ grid-template-columns: 1fr; } }

    /* SIDEBAR DAFTAR */
    .sidebar {
      background: var(--card); border: 1px solid var(--bdr);
      border-radius: var(--r); overflow: hidden; position: sticky; top: 20px;
    }
    .sidebar-hdr {
      background: var(--surf); padding: 13px 18px;
      font-family: var(--mono); font-size: .7rem; letter-spacing: 2px;
      text-transform: uppercase; color: var(--acc); border-bottom: 1px solid var(--bdr);
    }
    .sidebar a {
      display: flex; align-items: flex-start; gap: 10px;
      padding: 13px 18px; border-bottom: 1px solid var(--bdr);
      text-decoration: none; color: var(--txt); font-size: .87rem; line-height: 1.4;
      transition: padding-left .18s, background .18s, color .18s;
    }
    .sidebar a:last-child { border-bottom: none; }
    .sidebar a:hover { background: rgba(240,192,64,.06); color: var(--acc); padding-left: 22px; }
    .sidebar a.on  {
      background: rgba(240,192,64,.1); color: var(--acc); font-weight: 700;
      border-left: 3px solid var(--acc);
    }
    .artno { font-family: var(--mono); font-size: .68rem; color: var(--muted); margin-top: 2px; flex-shrink: 0; }

    /* KONTEN ARTIKEL */
    .artikel {
      background: var(--card); border: 1px solid var(--bdr);
      border-radius: var(--r); overflow: hidden;
      animation: fadeUp .4s ease both;
    }
    @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }

    /* Banner ikon besar */
    .art-banner {
      height: 180px; width: 100%;
      background: linear-gradient(135deg, #0f0f1e 0%, #131328 50%, #0c1535 100%);
      display: flex; align-items: center; justify-content: center;
      font-size: 4rem;
    }

    .art-body { padding: 26px 28px; }

    .art-meta {
      display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
      font-family: var(--mono); font-size: .73rem; color: var(--muted); margin-bottom: 12px;
    }
    .art-meta span + span::before { content: '·'; margin-right: 10px; color: var(--bdr); }

    .art-judul { font-size: 1.35rem; font-weight: 800; letter-spacing: -.3px; margin-bottom: 18px; }

    .refleksi {
      background: var(--surf); border-left: 3px solid var(--a4);
      border-radius: 0 8px 8px 0; padding: 16px 18px;
      font-size: .92rem; line-height: 1.75; color: var(--sub); margin-bottom: 22px;
    }

    .art-kutipan {
      display: flex; gap: 10px; align-items: flex-start;
      background: rgba(192,96,255,.08); border: 1px solid rgba(192,96,255,.25);
      border-radius: 9px; padding: 15px 18px;
      font-style: italic; font-size: .9rem; color: #c0aaee; margin-bottom: 20px;
    }
    .art-kutipan .qi { font-style: normal; font-size: 1.2rem; }

    .ref-label { font-family: var(--mono); font-size: .67rem; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); margin-bottom: 10px; }
    .ref-link {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(96,208,255,.08); border: 1px solid rgba(96,208,255,.25);
      border-radius: 8px; padding: 9px 16px;
      color: var(--a2); text-decoration: none;
      font-family: var(--mono); font-size: .83rem;
      transition: background .18s, transform .15s;
    }
    .ref-link:hover { background: rgba(96,208,255,.14); transform: translateY(-1px); }

    /* EMPTY STATE */
    .empty {
      background: var(--card); border: 1px dashed var(--bdr);
      border-radius: var(--r); padding: 52px 28px; text-align: center;
    }
    .empty-ico { font-size: 2.8rem; margin-bottom: 14px; }
    .empty h3  { font-size: 1.05rem; font-weight: 800; margin-bottom: 8px; }
    .empty p   { color: var(--muted); font-size: .88rem; }

    /* NAV ARTIKEL */
    .art-nav { display: flex; gap: 12px; margin-top: 16px; flex-wrap: wrap; }

    /* BUTTONS  */
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
    .bnav { display: flex; gap: 12px; margin-top: 40px; flex-wrap: wrap; }

    /* FOOTER */
    footer {
      text-align: center; color: var(--muted);
      font-family: var(--mono); font-size: .73rem;
      margin-top: 64px; letter-spacing: 1px;
    }
  </style>
</head>
<body>
<div class="wrap">

  <!-- HEADER -->
  <header>
    <div class="logo">✍️</div>
    <div>
      <h1>Dev<span>Blog</span></h1>
      <p>Blog Reflektif — Catatan Perjalanan Developer</p>
    </div>
  </header>

  <!-- NAV -->
  <nav>
    <a href="index.php">👤 Profil</a>
    <a href="timeline.php">📅 Timeline</a>
    <a href="blog.php" class="on">✍️ Blog</a>
  </nav>

  <!-- KUTIPAN MOTIVASI (array_rand) -->
  <div class="qbar">
    <span class="qi">💬</span>
    <div>
      <div class="qlabel">Kutipan Hari Ini</div>
      <div class="qtxt"><?= htmlspecialchars($kutipanHariIni) ?></div>
    </div>
  </div>

  <!-- SECTION LABEL -->
  <div class="slabel">// 03 — Blog</div>
  <div class="stitle">Artikel Reflektif Developer</div>

  <!-- BLOG LAYOUT -->
  <div class="bgrid">

    <!-- Sidebar daftar artikel (navigasi GET) -->
    <div class="sidebar">
      <div class="sidebar-hdr">📚 Daftar Artikel</div>
      <?php $no = 1; foreach ($artikelList as $k => $a): ?>
      <a href="blog.php?artikel=<?= $k ?>" class="<?= $key === $k ? 'on' : '' ?>">
        <span class="artno"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?>.</span>
        <span><?= htmlspecialchars($a['judul']) ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- Konten artikel -->
    <div>
      <?php if ($art): ?>
      <div class="artikel">
        <!-- Banner ikon -->
        <div class="art-banner"><?= $art['ikon'] ?></div>

        <div class="art-body">
          <!-- Meta -->
          <div class="art-meta">
            <span>🗓️ <?= htmlspecialchars($art['tanggal']) ?></span>
            <span>📁 /img/<?= $key ?>.png</span>
          </div>

          <!-- Judul -->
          <h2 class="art-judul"><?= htmlspecialchars($art['judul']) ?></h2>

          <!-- Refleksi -->
          <div class="refleksi"><?= $art['refleksi'] ?></div>

          <!-- Kutipan acak -->
          <div class="art-kutipan">
            <span class="qi">💡</span>
            <span><?= htmlspecialchars($kutipanHariIni) ?></span>
          </div>

          <!-- Referensi -->
          <div class="ref-label">🔗 Referensi Tambahan</div>
          <a href="<?= htmlspecialchars($art['link_ref']) ?>" target="_blank" class="ref-link">
            ↗ <?= htmlspecialchars($art['ref_label']) ?>
          </a>
        </div>
      </div>

      <!-- Navigasi artikel sebelum/sesudah -->
      <div class="art-nav">
        <?php if ($prev): ?>
        <a href="blog.php?artikel=<?= $prev ?>" class="btnout" style="flex:1;justify-content:center;">← Sebelumnya</a>
        <?php endif; ?>
        <?php if ($next): ?>
        <a href="blog.php?artikel=<?= $next ?>" class="btnout" style="flex:1;justify-content:center;">Selanjutnya →</a>
        <?php endif; ?>
      </div>

      <?php else: ?>
      <!-- Empty state -->
      <div class="empty">
        <div class="empty-ico">👈</div>
        <h3>Pilih artikel untuk dibaca</h3>
        <p>Klik salah satu judul di daftar sebelah kiri.</p>
      </div>
      <?php endif; ?>
    </div>

  </div><!-- /bgrid -->

  <!-- BOTTOM NAV -->
  <div class="bnav">
    <a href="index.php"    class="btn">← Kembali ke Profil</a>
    <a href="timeline.php" class="btnout">📅 Lihat Timeline</a>
  </div>

  <footer>&copy; <?= date('Y') ?> &nbsp;·&nbsp; Tugas Praktikum Pemrograman Web Dasar — PHP</footer>
</div>
</body>
</html>

    <meta charset="UTF-8">
    <title>Blog Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 min-h-screen">

<div class="max-w-5xl mx-auto px-4 mt ">

    <div class="text-center text-white mb-8 mt-10">
        <h2 class="text-3xl font-bold">Blog Developer</h2>
        <p class="opacity-80">Catatan perjalanan belajar coding ✨</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <?php foreach ($artikel as $key => $a): ?>
            <a href="?id=<?= $key; ?>" 
               class="bg-white/80 backdrop-blur rounded-xl shadow-lg overflow-hidden hover:scale-105 transition">

                <img src="<?= $a['gambar']; ?>" 
                class="w-full h-40 object-cover">

                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-800"><?= $a['judul']; ?></h3>
                    <p class="text-sm text-gray-500"><?= $a['tanggal']; ?></p>
                    <p class="text-gray-600 mt-2"><?= substr($a['isi'], 0, 70); ?>...</p>
                </div>

            </a>
        <?php endforeach; ?>
    </div>

    <?php
    if (isset($_GET['id']) && isset($artikel[$_GET['id']])):

        $data = $artikel[$_GET['id']];
    ?>
        <div class="mt-10 bg-white/90 backdrop-blur p-6 rounded-xl shadow-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-2"><?= $data['judul']; ?></h3>
            <p class="text-gray-500 mb-4"><?= $data['tanggal']; ?></p>

            <img src="<?= $data['gambar']; ?>" 
                 class="w-full max-h-64 object-cover rounded mb-4">

            <p class="text-gray-700 mb-4"><?= $data['isi']; ?></p>

            <div class="mt-4">
                <p class="font-semibold text-gray-700 mb-2">Referensi:</p>
                <ul class="list-disc list-inside text-blue-500">
                    <?php foreach ($data['link'] as $link): ?>
                        <li>
                            <a href="<?= $link; ?>" target="_blank" class="hover:underline">
                                <?= $link; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-10 text-center">
        <div class="bg-white/80 backdrop-blur p-4 rounded-xl shadow inline-block">
            <p class="italic text-gray-700 text-lg">
                “<?= $randomQuote; ?>”
            </p>
        </div>
    </div>

    <!-- Footer Nav -->
    <div class="text-center mt-6 text-white space-x-4">
        <a href="index.php" class="hover:underline">← Profil</a>
        <a href="timeline.php" class="hover:underline">Timeline →</a>
    </div>

</div>

</body>
</html>
 main
