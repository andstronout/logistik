<?php
session_start();
$id = $_GET['id'];
require '../../koneksi.php';
$koneksi = koneksi();
$sql = $koneksi->query("SELECT * FROM job_order INNER JOIN pelanggan ON job_order.id_pelanggan=pelanggan.id_pelanggan WHERE id_joborder='$id'");
$hasil = $sql->fetch_assoc();
if (!isset($_SESSION['login_karyawan'])) {
  header('location:../../login.php');
} else if ($_SESSION['level'] !== 'admin_ops') {
  header('location:../404.php');
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

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Persetujuan Dokumen Job Order</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputid1" class="form-label">ID Job Order</label>
                  <input type="text" class="form-control" id="exampleInputid1" aria-describedby="idHelp" value="<?php echo 'JOB-' . $hasil['tgl_order'] . '-' . $hasil['id_joborder']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputemail1" class="form-label">Nama Customer</label>
                  <input type="text" class="form-control" id="exampleInputemail1" aria-describedby="emailHelp" value="<?= $hasil['nama_pelanggan']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputtgl1" class="form-label">Tanggal Order</label>
                  <input type="text" class="form-control" id="exampleInputtgl1" aria-describedby="tglHelp" value="<?= ($hasil['tgl_order']); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputtgl1" class="form-label"> Bill of Landing</label>
                  <input type="text" class="form-control" id="exampleInputtgl1" aria-describedby="tglHelp" value="<?= ($hasil['no_bl']); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputtgl1" class="form-label"> Packing List</label>
                  <input type="text" class="form-control" id="exampleInputtgl1" aria-describedby="tglHelp" value="<?= ($hasil['no_packing_list']); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputtgl1" class="form-label"> No Faktur</label>
                  <input type="text" class="form-control" id="exampleInputtgl1" aria-describedby="tglHelp" value="<?= ($hasil['no_faktur']); ?>" readonly>
                </div>


                <?php
                if ($hasil['validasi'] == 'Ditolak') { ?>
                  <a href="daftar_joborder.php" class="btn btn-primary">Kembali Daftar Job order</a>
                <?php } elseif ($hasil['validasi'] == 'Selesai') { ?>
                  <a href="daftar_joborder.php" class="btn btn-primary">Kembali Daftar Job order</a>
                <?php } elseif ($hasil['validasi'] == 'Proses') { ?>
                  <button type="submit" class="btn btn-danger col-2 " name="tolak">Tolak</button>
                  <a href="daftar_joborder.php" class="btn btn-primary">Kembali Daftar Job order</a>
                <?php } else { ?>
                  <button type="submit" class="btn btn-success col-2 " name="simpan">Approve</button>
                  <button type="submit" class="btn btn-danger col-2 " name="tolak">Tolak</button>
                <?php }
                ?>

              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php
      if (isset($_POST['simpan'])) {
        $tanggal_approve = date('Y-m-d');
        $sql = ("UPDATE job_order SET id_karyawan='$_SESSION[id_karyawan]', validasi='Proses',tgl_approve='$tanggal_approve' WHERE id_joborder='$id'") or die(mysqli_error($koneksi));
        if ($koneksi->query($sql) == true) {
          echo "
          <script>
          alert('Data Telah Disetujui!');
          window.location.href='daftar_joborder.php';
          </script>
          ";
        }
      }
      if (isset($_POST['tolak'])) {
        $tanggal_aprove = date('Y-m-d');
        $sql = ("UPDATE job_order SET id_karyawan='$_SESSION[id_karyawan]', validasi='Ditolak',tgl_approve='$tanggal_approve' WHERE id_joborder='$id'") or die(mysqli_error($koneksi));
        if ($koneksi->query($sql) == true) {
          echo "
          <script>
          alert('Data Telah Ditolak!');
          window.location.href='daftar_joborder.php';
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