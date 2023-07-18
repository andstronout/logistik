<?php
session_start();
require '../koneksi.php';
$koneksi = koneksi();
$id = $_SESSION['id_karyawan'];
$sql = $koneksi->query("SELECT * FROM karyawan INNER JOIN `level` ON karyawan.id_level=level.id_level WHERE id_karyawan='$id'");
$query = $sql->fetch_assoc();
$level = $query['level'];
// var_dump($query);
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
        <h2 class="text-center text-dark mt-4">Edit Password</h2>
        <div class="card my-3">
          <form class="card-body cardbody-color p-lg-5" method="post">
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle mb-3" width="150px" alt="profile" style="margin-top: -30px;">
            </div>

            <div class="mb-3">
              <label for="password_lama" class="form-label">Password Lama</label>
              <input type="password" class="form-control" id="password_lama" aria-describedby="password_lamaHelp" name="password_lama" required>
            </div>
            <div class="mb-3">
              <label for="password_baru" class="form-label">Password Baru</label>
              <input type="password" class="form-control" id="password_baru" aria-describedby="password_baruHelp" name="password_baru" required>
            </div>
            <div class="mb-3">
              <label for="ulang_password" class="form-label">Ulangi Password Baru</label>
              <input type="password" class="form-control" id="ulang_password" aria-describedby="ulang_passwordHelp" name="ulang_password" required>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-outline-info px-5 mb-3 w-100" name="submit">Edit Password</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['submit'])) {
    $passwordlama = md5($_POST['password_lama']);
    $passwordbaru = md5($_POST['password_baru']);
    $ulang_password = md5($_POST['ulang_password']);

    $update = ("UPDATE karyawan SET `password`='$passwordbaru' WHERE id_karyawan='$id'");
    // var_dump($passwordbaru, $passwordlama, $ulang_password);
    // Check password lama bener ga
    if ($passwordlama !== $query['password']) {
      echo '
      <script>
      alert("Masukan Password lama dengan benar!");
      </script>
      ';
      // Check password baru 2 form sama ga 
    } elseif ($passwordbaru !== $ulang_password) {
      echo '
      <script>
      alert("Masukan password baru dengan benar!");
      </script>
      ';
    } elseif ($koneksi->query($update) == true) {
      echo "
      <script>
      alert('Password berhasil diubah!');
      window.location.href='$level/index.php';
      </script>
      ";
    } else {
      echo '
      <script>
      alert("Password gagal diubah!");
      </script>
      ';
    }
  }

  ?>


  <script src="<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>