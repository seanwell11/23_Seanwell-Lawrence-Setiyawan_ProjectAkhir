
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Galeri Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .brand-logo { height:36px; width:auto; margin-right:8px; }
        .hero { padding:40px 0; background:linear-gradient(135deg,#f7f7fb,#eef2ff); }
        .content { max-width:900px; margin:0 auto; font-size:16px; color:#333; line-height:1.7; }
        footer { padding:18px 0; text-align:center; color:#666; }
    </style>
    <link href="about_us.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="gambar/logo.png" alt="logo" class="brand-logo">
      <span>Home</span>
    </a>
    <div class="ms-auto">
      <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="container content">
    <h1 class="mb-3">Selamat datang di Galeri Seni ArtVista</h1>
    <p>
      Selamat datang di galeri seni publik kami—sebuah platform yang dibangun untuk merayakan kreativitas dan memperluas wawasan tentang dunia seni. Di sini, pengunjung dapat menemukan berbagai karya mulai dari lukisan tradisional hingga seni modern, lengkap dengan informasi detail seperti proses pembuatan, latar belakang ide, hingga teknik yang digunakan oleh senimannya.
    </p>
    <p>
      Kami juga menyediakan fitur pelelangan yang memungkinkan para pengguna untuk menampilkan, berbagi, dan menjual karya seni mereka. Tujuan kami adalah menciptakan ekosistem seni yang terbuka, edukatif, dan mendukung perkembangan seniman dari berbagai kalangan.
    </p>
  </div>
</section>

<footer>
  <div class="container text-center">
    <small class="text-muted">© <?php echo date('Y'); ?> ArtVista. Galeri Publik.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>