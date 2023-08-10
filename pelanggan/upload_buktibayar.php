<?php
session_start();
require '../koneksi.php';
$id = $_GET['id'];
$koneksi = koneksi();
$id_pelanggan = $_SESSION['id_pelanggan'];
$tanggal = date('y-m-d');
$sql = $koneksi->query("SELECT * FROM invoice INNER JOIN job_order ON invoice.id_joborder=job_order.id_joborder WHERE invoice.id_tagihan='$id'");
$hasil = $sql->fetch_assoc();
// var_dump($hasil);
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
  <link href="../sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- dataTable URL -->
  <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet" />

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('../layout/siderbar_pelanggan.php') ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Upload bukti pembayaran</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputno_bl1" class="form-label">ID Job Order</label>
                  <input type="text" class="form-control" id="exampleInputno_bl1" aria-describedby="no_blHelp" value="<?php echo 'SLI-' . str_pad($hasil['id_joborder'], 4, "0", STR_PAD_LEFT); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputpacking_list1" class="form-label">Total Biaya</label>
                  <input type="text" class="form-control" id="exampleInputpacking_list1" aria-describedby="packing_listHelp" value="<?php echo 'Rp. ' . number_format($hasil['biaya_joborder']); ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputno_bukti1" class="form-label">Nomor Transaksi</label>
                  <input type="text" class="form-control" id="exampleInputno_bukti1" aria-describedby="no_buktiHelp" name="bukti_bayar" <?php if ($hasil['bukti_bayar'] == null) { ?> placeholder="Masukan Nomor Bukti Transaksi Pembayaran" required <?php } else { ?> value="<?= $hasil['bukti_bayar']; ?>" readonly> <?php } ?>
                </div>
                <div class="mb-3">
                  <label for="exampleInputno_bukti1" class="form-label">Tanggal Bayar</label>
                  <input type="date" class="form-control" id="exampleInputno_bukti1" aria-describedby="no_buktiHelp" name="tgl_bayar" <?php if ($hasil['tgl_bayar'] == null) { ?> placeholder="Masukan Nomor Bukti Transaksi Pembayaran" required <?php } else { ?> value="<?= $hasil['tgl_bayar']; ?>"> <?php } ?>
                </div>
                <input type="hidden" name="validasi">
                <input type="hidden" name="tgl_order">
                <?php
                if ($hasil['bukti_bayar'] == null) { ?>
                  <button type="submit" class="btn btn-success col-2 " name="simpan">Simpan</button>
                <?php } else { ?>
                  <a href="daftar_invoice.php" class="btn btn-primary col-2">Kembali</a>
                <?php } ?>

              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        <?php
        if (isset($_POST['simpan'])) {
          $sql = ("UPDATE invoice SET bukti_bayar='$_POST[bukti_bayar]',tgl_bayar='$_POST[tgl_bayar]' WHERE id_tagihan='$id'") or die(mysqli_error($koneksi));
          if ($koneksi->query($sql)) {
            echo '
            <script>
            alert("Bukti berhasil di upload");
            window.location.href="daftar_invoice.php";
            </script>
            ';
          }
        }
        ?>
      </div>
      <!-- End of Main Content -->

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
  <script src="../sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../sbadmin/js/sb-admin-2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>