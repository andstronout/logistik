<?php
session_start();
require '../../koneksi.php';
$koneksi = koneksi();
$id = $_GET['id'];

$sql = "DELETE FROM karyawan WHERE id_karyawan='$id'"; 
$koneksi->query($sql);

echo 
"<script>
    alert('Akun telah dihapus!');
    window.location.href = 'daftar_karyawan.php';
</script>";
