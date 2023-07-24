<?php
$id = $_GET['id'];
require '../../koneksi.php';
$koneksi = koneksi();
$delete = $koneksi->query("DELETE FROM pib WHERE no_pib=$id");
echo
"<script>
    alert('Data telah dihapus!');
    window.location.href = 'daftar_pib.php';
</script>";
