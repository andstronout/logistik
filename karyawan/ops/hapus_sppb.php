<?php
require '../../koneksi.php';
$koneksi = koneksi();
$id = $_GET['id'];

$hapus = $koneksi->query("DELETE FROM sppb WHERE no_sppb='$id'") or die(mysqli_error($koneksi));

echo '
<script>
alert("Data Telah Dihapus!");
window.location.href= "daftar_sppb.php";
</script>
';
