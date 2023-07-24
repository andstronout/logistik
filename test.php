<?php
require 'koneksi.php';
$koneksi = koneksi();
$a = '00004';
$b = 3;
// $sql = "SELECT id_joborder FROM pib WHERE id_joborder='$a'";
// $cari = $koneksi->query($sql);
// $dapet = $cari->fetch_assoc();

// var_dump($dapet);

if ($a == $b) {
  echo 'sama';
} else {
  echo 'ga';
}
