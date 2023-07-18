<?php
require '../../koneksi.php';
$koneksi = koneksi();
$id = $_GET['id'];

$sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id'";
$koneksi->query($sql);

echo
"<script>
    alert('Akun telah dihapus!');
    window.location.href = 'daftar_pelanggan.php';
</script>";
