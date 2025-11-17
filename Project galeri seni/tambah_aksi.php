<?php
// ===== PHP: KONEKSI DATABASE =====
include 'koneksi.php';

// ===== PHP: MENANGKAP DATA DARI FORM =====
$nama_karya = $_POST['nama_karya'];
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];
$tahun_pembuatan = $_POST['tahun_pembuatan'];
$harga = $_POST['harga'];
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

// ===== PHP: PINDAHKAN FILE KE FOLDER GAMBAR =====
move_uploaded_file($tmp, 'gambar/'.$gambar);

// ===== PHP: SIMPAN DATA KE DATABASE (id auto increment) =====
mysqli_query($koneksi, "INSERT INTO karya_seni (nama_karya, kategori, deskripsi, tahun_pembuatan, harga, gambar) 
                        VALUES ('$nama_karya', '$kategori', '$deskripsi', $tahun_pembuatan, '$harga', '$gambar')");

// ===== PHP: ALIHKAN HALAMAN KE DASHBOARD =====
header("location:dashboard.php");
?>