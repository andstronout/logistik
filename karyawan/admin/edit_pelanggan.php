<?php
session_start();
$id = $_GET['id'];
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
          <?php
          $sql = $koneksi->query("SELECT * FROM pelanggan");
          $query = $sql->fetch_assoc();

          ?>
          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Tambah Data Pelanggan</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputName1" class="form-label">Nama Perusahaan</label>
                  <input type="nama" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" name="nama_pelanggan" value="<?= $query['nama_pelanggan']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputemail1" class="form-label">Email Perusahaan</label>
                  <input type="email_pelanggan" class="form-control" id="exampleInputemail1" aria-describedby="emailHelp" name="email_pelanggan" value="<?= $query['email_pelanggan']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat_pelanggan" required><?= $query['alamat_pelanggan']; ?></textarea>
                </div>
                <div class="mb-3">
                  <label for="exampleInputtlp_pelanggan1" class="form-label">Nomor Telephone</label>
                  <input type="tlp_pelanggan" class="form-control" id="exampleInputtlp_pelanggan1" name="tlp_pelanggan" value="<?= $query['tlp_pelanggan']; ?>" required>
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
        $sq = "UPDATE pelanggan SET nama_pelanggan='$_POST[nama_pelanggan]',email_pelanggan='$_POST[email_pelanggan]',alamat_pelanggan='$_POST[alamat_pelanggan]',tlp_pelanggan='$_POST[tlp_pelanggan]' WHERE id_pelanggan='$id'";
        if ($update = $koneksi->query($sq) == true) {
          echo "
                <script>
                alert('Data Berhasil Ditambah');
                document.location.href = 'daftar_pelanggan.php';
                </script>
                ";
        } else {
          echo "
                <script>
                alert('Data Gagal Ditambah');
                document.location.href = 'daftar_pelanggan.php';
                </script>
                ";
        }
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