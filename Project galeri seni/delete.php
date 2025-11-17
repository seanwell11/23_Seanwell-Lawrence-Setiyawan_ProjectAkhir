<?php

include 'koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Ambil data untuk mendapatkan nama file gambar
    $res = mysqli_query($koneksi, "SELECT gambar FROM karya_seni WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    
    if ($row) {
        // Hapus file gambar jika ada
        $folder = 'gambar/';
        if (!empty($row['gambar']) && file_exists($folder . $row['gambar'])) {
            @unlink($folder . $row['gambar']);
        }
        
        // Hapus data dari database
        $query = "DELETE FROM karya_seni WHERE id = $id";
        if (mysqli_query($koneksi, $query)) {
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($koneksi);
            exit;
        }
    } else {
        echo "Data tidak ditemukan. <a href='dashboard.php'>Kembali</a>";
        exit;
    }
} else {
    echo "ID tidak valid. <a href='dashboard.php'>Kembali</a>";
    exit;
}
?>