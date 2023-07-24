<?php
session_start();
require '../../koneksi.php';
$id = $_GET['id'];
$koneksi = koneksi();
if (!isset($_SESSION['login_karyawan'])) {
  header('location:../../login.php');
} else if ($_SESSION['level'] !== 'admin_ops') {
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

    <?php include('../../layout/siderbar_admin_ops.php'); ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Cari Data PIB -->
          <?php
          $sql = $koneksi->query("SELECT * FROM do INNER JOIN pelanggan ON do.id_pelanggan=pelanggan.id_pelanggan WHERE no_do='$id'") or die(mysqli_error($koneksi));
          $hasil = $sql->fetch_assoc();
          // var_dump($hasil);
          ?>
          <!-- End Cari Data PIB -->

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Ubah Data PIB</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputno1" class="form-label">Nomor Delivery Order</label>
                  <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" name="no_do" value="<?= $hasil['no_do']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputno1" class="form-label">Nomor Job Order</label>
                  <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" name="id_joborder" value="<?php echo 'SLI-' . str_pad($hasil['id_joborder'], 4, '0', STR_PAD_LEFT); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputpelanggan1" class="form-label">Nama Pelanggan</label>
                  <input type="text" class="form-control" id="exampleInputpelanggan1" aria-describedby="pelangganHelp" name="id_pelanggan" value="<?= $hasil['nama_pelanggan']; ?>" readonly>
                </div>
                <div class="mb-3 ">
                  <label for="exampleInputpengajuan1" class="form-label">Asal Logistik</label>
                  <input type="text" class="form-control" id="exampleInputpengajuan1" aria-describedby="pengajuanHelp" name="from" value="<?= $hasil['from']; ?>" readonly>
                </div>
                <button type="submit" class="btn btn-success col-2 " name="simpan">Approve</button>
              </form>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <?php
    if (isset($_POST['simpan'])) {
      $ambil = $_POST['id_joborder'];
      $cek = explode('-', $ambil);
      $cekid = $cek[1];
      // var_dump($_POST['id_joborder']);
      $update = $koneksi->query("UPDATE do SET status_do='Disetujui' WHERE no_do='$id'") or die(mysqli_error($koneksi));
      $ganti = $koneksi->query("UPDATE job_order SET `validasi`= 'Proses kirim' WHERE id_joborder='$cekid'") or die(mysqli_error($koneksi));
      echo "
          <script>
          alert('Data Telah Disetujui');
          document.location.href = 'daftar_do.php';
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