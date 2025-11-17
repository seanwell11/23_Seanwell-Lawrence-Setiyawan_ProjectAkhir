<?php
include 'koneksi.php';
session_start();

// Ambil id dari query string dan pastikan integer
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}
$id = (int) $_GET['id'];

// Query data karya dari tabel karya_seni
$query = "SELECT id, nama_karya, kategori, deskripsi, tahun_pembuatan, harga, gambar, tanggal_input FROM karya_seni WHERE id = $id LIMIT 1";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    $not_found = true;
} else {
    $karya = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Detail Karya - Galeri Seni</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        :root{--accent:#667eea}
        *{margin:0;padding:0;box-sizing:border-box}
        body{
            font-family:Arial,Helvetica,sans-serif;
            background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            color:#222;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:24px;
        }
        .card{
            max-width:900px;
            width:100%;
            background:#fff;
            border-radius:10px;
            padding:32px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
            display:flex;
            gap:30px;
            align-items:flex-start;
        }
        .media{flex:1;min-width:260px}
        .media img{width:100%;height:auto;border-radius:8px;display:block;object-fit:cover}
        .placeholder{background:#f4f4f4;border-radius:8px;padding:100px 20px;text-align:center;color:#999;font-size:14px}
        .meta{flex:1.2}
        h1{margin:0 0 12px 0;color:var(--accent);font-size:28px}
        .info-row{display:flex;gap:20px;margin:16px 0;font-size:14px}
        .info-item{flex:1}
        .info-label{color:#999;font-size:12px;text-transform:uppercase;margin-bottom:4px}
        .info-value{color:#333;font-weight:600;font-size:16px}
        .desc{white-space:pre-wrap;color:#555;line-height:1.6;margin:20px 0;padding:16px;background:#f9f9f9;border-left:4px solid var(--accent);border-radius:4px}
        .actions{display:flex;gap:10px;margin-top:24px;flex-wrap:wrap}
        a.button{display:inline-block;padding:12px 18px;background:var(--accent);color:#fff;border:none;border-radius:6px;text-decoration:none;font-weight:700;cursor:pointer;transition:0.3s}
        a.button:hover{background:#5568d3;transform:translateY(-2px);box-shadow:0 4px 12px rgba(102,126,234,0.4)}
        a.button.secondary{background:#6c757d}
        a.button.secondary:hover{background:#5a6268}
        a.button.danger{background:#e74c3c}
        a.button.danger:hover{background:#c0392b}
        a.button.success{background:#4caf50}
        a.button.success:hover{background:#45a049}
        .not-found{text-align:center;padding:40px 20px}
        .not-found h1{font-size:24px;margin-bottom:10px}
        @media(max-width:720px){
            .card{flex-direction:column;padding:20px}
            h1{font-size:22px}
            .info-row{flex-direction:column;gap:12px}
            .actions{flex-direction:column}
            a.button{width:100%;text-align:center}
        }
    </style>
</head>
<body>
    <div class="card" role="main" aria-label="Detail karya seni">
        <?php if (!empty($not_found)): ?>
            <div class="not-found">
                <h1>Karya tidak ditemukan</h1>
                <p style="color:#666;margin-bottom:20px">ID Karya #<?php echo $id; ?> tidak tersedia di database.</p>
                <a class="button secondary" href="dashboard.php">← Kembali ke Dashboard</a>
            </div>
        <?php else: ?>
            <div class="media">
                <?php if (!empty($karya['gambar']) && file_exists(__DIR__ . '/gambar/' . $karya['gambar'])): ?>
                    <img src="<?php echo 'gambar/' . htmlspecialchars($karya['gambar']); ?>" alt="<?php echo htmlspecialchars($karya['nama_karya']); ?>">
                <?php else: ?>
                    <div class="placeholder">📷 Gambar tidak tersedia</div>
                <?php endif; ?>
            </div>

            <div class="meta">
                <h1><?php echo htmlspecialchars($karya['nama_karya']); ?></h1>
                
                <div class="info-row">
                    <div class="info-item">
                        <div class="info-label">Kategori</div>
                        <div class="info-value"><?php echo htmlspecialchars($karya['kategori'] ?: '-'); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tahun Pembuatan</div>
                        <div class="info-value"><?php echo htmlspecialchars($karya['tahun_pembuatan'] ?: '-'); ?></div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <div class="info-label">Harga</div>
                        <div class="info-value">Rp <?php echo number_format($karya['harga'], 0, ',', '.'); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">ID Karya</div>
                        <div class="info-value">#<?php echo (int)$karya['id']; ?></div>
                    </div>
                </div>

                <div>
                    <div class="info-label">Deskripsi</div>
                    <div class="desc"><?php echo nl2br(htmlspecialchars($karya['deskripsi'] ?: 'Tidak ada deskripsi')); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <div class="info-label">Tanggal Input</div>
                        <div class="info-value"><?php echo htmlspecialchars($karya['tanggal_input'] ?: '-'); ?></div>
                    </div>
                </div>

                <div class="actions">
                    <a class="button secondary" href="dashboard.php">← Kembali</a>
                    <a class="button success" href="update.php?id=<?php echo (int)$karya['id']; ?>">✎ Edit</a>
                    <a class="button danger" href="delete.php?id=<?php echo (int)$karya['id']; ?>" onclick="return confirm('Yakin ingin menghapus karya ini?');">🗑 Hapus</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>