<?php
// ===== PHP: KONEKSI DATABASE =====
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Galeri Seni</title>
</head>
<body>
    <h2>ArtVista - DASHBOARD</h2>
    <a href="tambah.php">+ TAMBAH KARYA</a>
    <br/>
    <a href="Home.php">Kembali ke Home</a>
    <br/>
    <br/>
    
    <!-- ===== TABEL DATA ===== -->
    <table border="1" cellpadding="10">
        <tr>
            <th>NO</th>
            <th>ID</th>
            <th>NAMA KARYA</th>
            <th>KATEGORI</th>
            <th>TAHUN</th>
            <th>HARGA</th>
            <th>GAMBAR</th>
            <th>OPSI</th>
        </tr>
        <?php
        // ===== PHP: QUERY AMBIL DATA =====
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM karya_seni ORDER BY id DESC");
        
        // ===== PHP: LOOP TAMPIL DATA =====
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['nama_karya']; ?></td>
                <td><?php echo $d['kategori']; ?></td>
                <td><?php echo $d['tahun_pembuatan']; ?></td>
                <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                <td>
                    <?php if (!empty($d['gambar']) && file_exists('gambar/'.$d['gambar'])): ?>
                        <img src="gambar/<?php echo $d['gambar']; ?>" width="60" height="60" alt="Gambar">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <!-- ===== PHP: LINK EDIT & HAPUS DENGAN ID ===== -->
                    <a href="update.php?id=<?php echo $d['id']; ?>">EDIT</a> |
                    <a href="delete.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Yakin hapus?')">HAPUS</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>