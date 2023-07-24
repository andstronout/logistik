<?php
$id = $_GET['id'];
require '../../koneksi.php';
$koneksi = koneksi();
$delete = $koneksi->query("DELETE FROM do WHERE no_do=$id");
echo
"<script>
    alert('Data telah dihapus!');
    window.location.href = 'daftar_do.php';
</script>";
