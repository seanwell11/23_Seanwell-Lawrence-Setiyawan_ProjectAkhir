<?php
// ===== PHP: KONEKSI DATABASE =====
include 'koneksi.php';

// ===== PHP: AMBIL ID DARI URL =====
$id = $_GET['id'];

// ===== PHP: QUERY AMBIL DATA BERDASARKAN ID =====
$data = mysqli_query($koneksi, "SELECT * FROM karya_seni WHERE id='$id'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karya</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <h2>GALERI SENI</h2>
    <a href="dashboard.php">← KEMBALI</a>
    <br/>
    <br/>

    <?php
    // ===== PHP: LOOP TAMPIL FORM EDIT =====
    while ($d = mysqli_fetch_array($data)) {
    ?>
        <!-- ===== FORM EDIT ===== -->
        <form method="post" action="ubah.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama Karya</td>
                    <td>
                        <!-- ===== PHP: HIDDEN INPUT ID ===== -->
                        <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                        <input type="text" name="nama_karya" value="<?php echo $d['nama_karya']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><input type="text" name="kategori" value="<?php echo $d['kategori']; ?>" required></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><textarea name="deskripsi"><?php echo $d['deskripsi']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Tahun Pembuatan</td>
                    <td><input type="text" name="tahun_pembuatan" value="<?php echo $d['tahun_pembuatan']; ?>"></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="number" name="harga" value="<?php echo $d['harga']; ?>"></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td>
                        <!-- ===== PHP: INPUT FILE UPLOAD GAMBAR ===== -->
                        <input type="file" name="gambar" accept="image/*">
                        <br/><small>Biarkan kosong jika tidak ingin ubah gambar</small>
                        <!-- ===== PHP: TAMPIL GAMBAR LAMA ===== -->
                        <?php if (!empty($d['gambar']) && file_exists('gambar/'.$d['gambar'])): ?>
                            <br/><img src="gambar/<?php echo $d['gambar']; ?>" alt="gambar" style="max-width:80px; max-height:60px; margin-top:8px;">
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="SIMPAN"></td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>

</body>
</html>