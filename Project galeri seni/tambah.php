<?php
// ===== PHP: KONEKSI DATABASE =====
include 'koneksi.php';

// ===== PHP: AMBIL ID TERAKHIR UNTUK PREVIEW =====
$result = mysqli_query($koneksi, "SELECT MAX(id) as max_id FROM karya_seni");
$row = mysqli_fetch_assoc($result);
$next_id = ($row['max_id'] ?? 0) + 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karya - ArtVista</title>
    <link rel="stylesheet" href="tambah.css">
</head>
<body>
    <h2>GALERI SENI</h2>
    <br/>
    <a href="dashboard.php">← kembali</a>
    <br/>
    <br/>
    <h3>Tambah Karya Baru</h3>

    <!-- ===== FORM TAMBAH ===== -->
    <form method="post" action="tambah_aksi.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>ID Karya</td>
                <!-- ===== PHP: TAMPIL ID OTOMATIS (READ-ONLY) ===== -->
                <td><input type="text" value="<?php echo $next_id; ?>" readonly style="background:#f0f0f0; cursor:not-allowed;"></td>
            </tr>
            <tr>
                <td>Nama Karya</td>
                <td><input type="text" name="nama_karya" required></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td><input type="text" name="kategori" required></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><textarea name="deskripsi"></textarea></td>
            </tr>
            <tr>
                <td>Tahun Pembuatan</td>
                <td><input type="text" name="tahun_pembuatan" placeholder="Bebas (misal: 1000, 500)"></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="number" name="harga" required></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td><input type="file" name="gambar" accept="image/*" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
    </form>

</body>
</html>