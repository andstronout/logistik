<?php
session_start();
require 'koneksi.php';
$koneksi = koneksi();
$sq = $koneksi->query("SELECT * FROM karyawan INNER JOIN `level` ON karyawan.id_level=level.id_level") or die(mysqli_error($koneksi));
$cek = $sq->fetch_assoc();
$level = $cek['level'];
// var_dump($cek);

if (isset($_SESSION['login_pelanggan'])) {
  header("location:pelanggan/index.php");
} elseif (isset($_SESSION['login_karyawan'])) {
  header("location:karyawan/$level/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #eaeaea;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-4">Login </h2>
        <div class="card my-3">
          <form class="card-body cardbody-color p-lg-5" method="post">
            <div class="text-center">
              <img src="img/logoonly.jpg" class="img-fluid profile-image-pic img-thumbnail rounded-circle mb-3" width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukan Email" name="email" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" placeholder="Masukan Password" name="password" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-outline-info px-5 mb-3 w-100" name="submit">Login</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['submit'])) {
    // Ambil dari form
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    var_dump($email, $password);

    // ambil dari DB
    $sql = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND `password`='$password'");
    $pelanggan = $sql->fetch_assoc();

    $query = $koneksi->query("SELECT * FROM karyawan INNER JOIN `level` ON karyawan.id_level=level.id_level WHERE email_karyawan='$email' AND `password`='$password'") or die(mysqli_error($koneksi));
    while ($hasil = $query->fetch_assoc()) {
      $karyawan = $hasil;
    }
    echo '<pre>';
    print_r($karyawan);
    echo '</pre>';
    $level = $karyawan['level'];


    if ($email == $pelanggan['email_pelanggan'] && $password == $pelanggan['password']) {
      $_SESSION['login_pelanggan'] = true;
      $_SESSION['id_pelanggan'] = $pelanggan['id_pelanggan'];
      header("location:pelanggan/index.php");
    } elseif ($email == $karyawan['email_karyawan'] && $password == $karyawan['password']) {
      $_SESSION['login_karyawan'] = true;
      $_SESSION['id_karyawan'] = $karyawan['id_karyawan'];
      $_SESSION['level'] = $karyawan['level'];

      header("location:karyawan/$level/index.php");
    } else {
      echo "
    <script>
    alert('Email atau Password salah');
    document.location.href = 'login.php';
    </script>
    ";
    }
  }

  ?>


  <script src="<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>