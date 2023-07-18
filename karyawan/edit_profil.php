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
        <h2 class="text-center text-dark mt-4">Edit Profile</h2>
        <div class="card my-3">
          <form class="card-body cardbody-color p-lg-5" method="post">
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle mb-3" width="150px" alt="profile" style="margin-top: -30px;">
            </div>

            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" aria-describedby="namaHelp" name="nama_karyawan" value="<?= $query['nama_karyawan']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= $query['email_karyawan']; ?>" readonly>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" aria-describedby="alamatHelp" name="alamat_karyawan" value="<?= $query['alamat_karyawan']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Jenis Kelamin</label>
              <select class="form-select" aria-label="Default select example" name="jk_karyawan">
                <option selected value="<?= $query['jk_karyawan']; ?>"><?= $query['jk_karyawan']; ?></option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="tlp" class="form-label">Nomor Handphone</label>
              <input type="tel" class="form-control" id="tlp" aria-describedby="tlpHelp" name="tlp_karyawan" value="<?= $query['tlp_karyawan']; ?>" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-outline-info px-5 mb-3 w-100" name="submit">Edit Profil</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['submit'])) {
    $update = ("UPDATE karyawan SET nama_karyawan='$_POST[nama_karyawan]', jk_karyawan='$_POST[jk_karyawan]', alamat_karyawan='$_POST[alamat_karyawan]', tlp_karyawan='$_POST[tlp_karyawan]' WHERE id_karyawan='$id'");
    if ($koneksi->query($update) == true) {
      echo "
      <script>
      alert('Data Profile berhasil diubah!');
      window.location.href='$level/index.php';
      </script>
      ";
    } else {
      echo '
      <scrpit>
      alert("Data Profile gagal diubah!");
      </scrpit>
      ';
    }
  }

  ?>


  <script src="<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>