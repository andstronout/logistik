<?php
session_start();
require '../../koneksi.php';
$koneksi = koneksi();
if (!isset($_SESSION['login_karyawan'])) {
  header('location:../../login.php');
} else if ($_SESSION['level'] !== 'admin') {
  header('location:../../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrasi</title>

  <!-- Custom fonts for this template-->
  <link href="../../sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include('../../layout/siderbar_admin.php'); ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Tambah Data Karyawan</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputName1" class="form-label">Nama Lengkap</label>
                  <input type="nama" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" name="nama_karyawan" placeholder="Masukan nama lengkap" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputemail1" class="form-label">Email</label>
                  <input type="email_karyawan" class="form-control" id="exampleInputemail1" aria-describedby="emailHelp" name="email_karyawan" placeholder="Masukan email" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputpassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputpassword1" aria-describedby="passwordHelp" name="password_karyawan" placeholder="Masukan password" required>
                </div>
                <div class="mb-3">
                  <label for="select-barang" class="form-label">Jenis Kelamin</label><br>
                  <select class="form-select" aria-label="form-select-lg example" id="select-jk_karyawan" name="jk_karyawan">
                    <option disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputtlp_karyawan1" class="form-label">Nomor Handphone</label>
                  <input type="tlp_karyawan" class="form-control" id="exampleInputtlp_karyawan1" name="tlp_karyawan" placeholder="Masukan Nomor Handphone" required>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat_karyawan"></textarea>
                </div>
                <div class="mb-3">
                  <label for="select-level" class="form-label">Status</label><br>
                  <select class="form-select" aria-label=".form-select-lg example" id="select-level" name="id_level" aria-placeholder="Masukan Level">
                    <option disabled selected>-- Pilih Level --</option>
                    <?php
                    $sq = $koneksi->query("SELECT * FROM  `level`");
                    while ($que = $sq->fetch_assoc()) { ?>
                      <option value="<?= $que['id_level']; ?>"><?= $que['nama_level']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-success col-2 " name="simpan">Simpan</button>

              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php
      if (isset($_POST['simpan'])) {
        $password = md5($_POST['password_karyawan']);
        $insert = $koneksi->query("INSERT INTO karyawan (nama_karyawan,email_karyawan,`password`,jk_karyawan,alamat_karyawan,tlp_karyawan,id_level) VALUES ('$_POST[nama_karyawan]','$_POST[email_karyawan]','$password','$_POST[jk_karyawan]','$_POST[alamat_karyawan]','$_POST[tlp_karyawan]','$_POST[id_level]')") or die(mysqli_error($koneksi));
        echo "
              <script>
              alert('Data Berhasil Ditambah');
              document.location.href = 'daftar_karyawan.php';
              </script>
              ";
      } else {
        'ga';
      }
      ?>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; PT. Speedmark Indonesia</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../../sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="../../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../sbadmin/js/sb-admin-2.min.js"></script>

  <!-- Bootstrap -->
  <script src="<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>