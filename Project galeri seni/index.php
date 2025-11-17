<?php
// ===== PHP: KONEKSI DATABASE =====
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- ===== CSS CUSTOM ===== -->
    <link href="index.css" rel="stylesheet">
</head>
<body>
<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">
        <img src="gambar/logo.png" alt="ArtVista">
        <span class="visually-hidden">ArtVista</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i>Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about_us.php"><i class="fas fa-info-circle me-1"></i>About us</a></li>
      </ul>
    </div>
    <div class="d-flex align-items-center ms-3">
      <a class="btn btn-sm btn-outline-primary me-2" href="login.php"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
      <a class="btn btn-sm btn-primary" href="tambah.php"><i class="fas fa-upload me-1"></i>Upload</a>
    </div>
  </div>
</nav>

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
  <div class="container">
    <h1><i class="fas fa-palette me-2"></i>ArtVista</h1>
    <p>Koleksi karya seni — telusuri dan nikmati</p>
    <a href="tambah.php" class="btn btn-tambah btn-lg"><i class="fas fa-plus me-1"></i> Upload Karya</a>
  </div>
</section>

<!-- ===== GALLERY SECTION ===== -->
<section class="container-gallery">
  <div class="container">
    <div class="row g-4">
      <?php
      // ===== PHP: AMBIL DATA KARYA =====
      $data = mysqli_query($koneksi, "SELECT * FROM karya_seni ORDER BY tanggal_input DESC");
      if ($data && mysqli_num_rows($data) > 0) {
          // ===== PHP: LOOP TAMPIL KARYA =====
          while ($d = mysqli_fetch_assoc($data)) {
              $harga = number_format($d['harga'], 0, ',', '.');
              $imgPath = !empty($d['gambar']) && file_exists(__DIR__ . '/gambar/' . $d['gambar']) ? 'gambar/'.$d['gambar'] : 'https://via.placeholder.com/600x400?text=No+Image';
      ?>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card-karya">
          <div class="img-wrap"><img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($d['nama_karya']); ?>"></div>
          <div class="card-body">
            <h5 class="card-title mb-1"><?php echo htmlspecialchars($d['nama_karya']); ?></h5>
            <div class="mb-2"><span class="card-kategori"><?php echo htmlspecialchars($d['kategori']); ?></span></div>
            <p class="text-muted small mb-2"><?php echo htmlspecialchars(substr($d['deskripsi'],0,90)); ?>...</p>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <small class="text-muted">Tahun: <?php echo $d['tahun_pembuatan']; ?></small>
              <small class="text-muted"><?php echo date('d/m/Y', strtotime($d['tanggal_input'])); ?></small>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <div class="card-harga">Rp <?php echo $harga; ?></div>
              <div>
                <a href="detail.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-outline-secondary">Lihat</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
          }
      } else {
      // ===== PHP: PESAN JIKA BELUM ADA KARYA =====
      ?>
      <div class="col-12">
        <div class="text-center text-white py-5">
          <h4>Belum ada karya seni</h4>
          <p>Mulai upload karya seni Anda sekarang.</p>
          <a href="tambah.php" class="btn btn-tambah">Tambah Karya</a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer>
  <div class="container">
    <small>© <?php echo date('Y'); ?> ArtVista. Galeri Publik.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>