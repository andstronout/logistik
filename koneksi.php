<?php
function koneksi()
{
  $conn = new mysqli("localhost", "root", "", "logistik") or die("Koneksi Gagal");
  return $conn;
}
