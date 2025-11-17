<?php
// ===== PHP: KONEKSI DATABASE =====
include 'koneksi.php';

// ===== PHP: MENANGKAP DATA DARI FORM =====
$id = $_POST['id'];
$nama_karya = $_POST['nama_karya'];
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];
$tahun_pembuatan = $_POST['tahun_pembuatan'];
$harga = !empty($_POST['harga']) ? $_POST['harga'] : 0;

// ===== PHP: SIAPKAN QUERY UPDATE (tanpa gambar dulu) =====
$sql = "UPDATE karya_seni SET nama_karya='$nama_karya', kategori='$kategori', deskripsi='$deskripsi', tahun_pembuatan= $tahun_pembuatan, harga='$harga'";

// ===== PHP: JIKA ADA UPLOAD GAMBAR BARU =====
if (!empty($_FILES['gambar']['name'])) {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    
    // buat folder jika belum ada
    if (!is_dir('gambar')) {
        mkdir('gambar', 0755, true);
    }
    
    // pindahkan file ke folder gambar
    if (move_uploaded_file($tmp, 'gambar/'.$gambar)) {
        $sql .= ", gambar='$gambar'";
    }
}

// ===== PHP: TAMBAHKAN WHERE CLAUSE =====
$sql .= " WHERE id='$id'";

// ===== PHP: JALANKAN QUERY UPDATE =====
mysqli_query($koneksi, $sql);

// ===== PHP: ALIHKAN HALAMAN KE DASHBOARD =====
header("location:dashboard.php");
?>