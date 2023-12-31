<?php
session_start();
$id = $_GET['id'];
require '../../koneksi.php';
$koneksi = koneksi();
if (!isset($_SESSION['login_karyawan'])) {
  header('location:../../login.php');
} else if ($_SESSION['level'] !== 'billing') {
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

    <?php include('../../layout/siderbar_billing.php'); ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php
        $sql = $koneksi->query("SELECT * FROM invoice INNER JOIN job_order ON invoice.id_joborder=job_order.id_joborder INNER JOIN pelanggan ON pelanggan.id_pelanggan=invoice.id_pelanggan WHERE id_tagihan='$id'");
        $hasil = $sql->fetch_assoc();
        // var_dump($hasil);
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Pengecekan Invoice</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputno1" class="form-label">Nomor Job Order</label>
                  <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" value="<?php echo 'SLI-' . str_pad($hasil['id_joborder'], 4, '0', STR_PAD_LEFT); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputpelanggan1" class="form-label">Nomor Pembayaran</label>
                  <input type="text" class="form-control" id="exampleInputpelanggan1" aria-describedby="pelangganHelp" value="<?= $hasil['bukti_bayar']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputpelanggan1" class="form-label">Nama Pelanggan</label>
                  <input type="text" class="form-control" id="exampleInputpelanggan1" aria-describedby="pelangganHelp" value="<?= $hasil['nama_pelanggan']; ?>" readonly>
                </div>
                <hr>
                <div class="mb-3">
                  <label for="exampleInputbiaya1" class="form-label">Biaya Job Order</label>
                  <input type="text" class="form-control" id="exampleInputbiaya1" value="<?= 'Rp. ' . number_format($hasil['biaya_joborder']); ?>" readonly>
                </div>
                <?php
                if ($hasil['validasi'] == 'Selesai') { ?>
                  <a href="daftar_invoice.php" class="btn btn-primary">Kembali Ke Daftar Invoice</a>
                <?php } elseif ($hasil['validasi'] == 'Paid') { ?>
                  <a href="daftar_invoice.php" class="btn btn-primary">Kembali Ke Daftar Invoice</a>
                <?php } else { ?>
                  <button type="submit" class="btn btn-success col-2 " name="simpan" onclick="return confirm('Anda yakin validasi invoice ini?')">Approve</button>
                  <a href="daftar_invoice.php" class="btn btn-primary">Kembali Ke Daftar Invoice</a>
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
        if ($hasil['bukti_bayar'] == null) {
          echo "
          <script>
          alert('Pelanggan belum melakukan pembayaran!');
          window.location.href='daftar_invoice.php';
          </script>
          ";
        } else {
          $update = "UPDATE job_order SET validasi='Paid' WHERE id_joborder ='$hasil[id_joborder]' ";
          if ($koneksi->query($update) or die(mysqli_error($koneksi)) == true) {
            echo "
          <script>
          alert('Data Telah Disetujui!');
          window.location.href='daftar_invoice.php';
          </script>
          ";
          }
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