<?php
// ===== PHP: SESSION CHECK & KONEKSI =====
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ArtVista - Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="home.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">
        <img src="gambar/logo.png" alt="ArtVista">
        <span class="visually-hidden">ArtVista</span>
    </a>
     <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="about_us.php"><i class="fas fa-info-circle me-1"></i>About</a></li>
      </ul>
    </div>
    <div class="d-flex align-items-center ms-auto">
      <!-- ===== PHP: TAMPIL USERNAME ===== -->
      <span class="me-3 text-primary"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?></span>
      <a class="btn btn-sm btn-outline-secondary me-2" href="dashboard.php">Admin</a>
      <a class="btn btn-sm btn-danger" href="index.php">Logout</a>
    </div>
  </div>
</nav>

<section class="container mt-5">
  <div class="row g-4">
    <?php
    // ===== PHP: QUERY AMBIL DATA =====
    $data = mysqli_query($koneksi, "SELECT * FROM karya_seni ORDER BY id DESC");
    
    // ===== PHP: LOOP TAMPIL DATA =====
    while ($d = mysqli_fetch_array($data)) {
    ?>
    <div class="col-md-4">
      <div class="card">
        <!-- ===== PHP: TAMPIL GAMBAR ===== -->
        <?php if (!empty($d['gambar']) && file_exists('gambar/'.$d['gambar'])): ?>
          <img src="gambar/<?php echo $d['gambar']; ?>" class="card-img-top" alt="<?php echo $d['nama_karya']; ?>">
        <?php else: ?>
          <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">No Image</div>
        <?php endif; ?>
        <div class="card-body">
          <!-- ===== PHP: TAMPIL DATA KARYA ===== -->
          <h5 class="card-title"><?php echo $d['nama_karya']; ?></h5>
          <p class="card-text text-muted"><?php echo $d['kategori']; ?></p>
          <p class="card-text">Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></p>
          <!-- ===== PHP: LINK DENGAN ID ===== -->
          <a href="detail.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-primary">Lihat Detail</a>
          <a href="update.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="mt-5 py-4 bg-light text-center">
  <div class="container">
    <!-- ===== PHP: TAMPIL TAHUN CURRENT ===== -->
    <small class="text-muted">© <?php echo date('Y'); ?> ArtVista. Galeri Publik.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>