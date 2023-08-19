<?php
session_start();
require '../koneksi.php';
$koneksi = koneksi();
$id_pelanggan = $_SESSION['id_pelanggan'];
$tanggal = date('y-m-d');
$sql = $koneksi->query("SELECT * FROM job_order");
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
          <h1 class="h4 mb-4 text-gray-800">Tambah Job Order Baru</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <?php
                  $cari = $koneksi->query("SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
                  $dapet = $cari->fetch_assoc();
                  ?>
                  <label for="exampleInputdeskripsi" class="form-label">Nama Pelanggan</label>
                  <input type="text" class="form-control" id="exampleInputdeskripsi" aria-describedby="deksripsiHelp" value="<?= $dapet['nama_pelanggan']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputdeskripsi" class="form-label">Deskripsi Barang</label>
                  <input type="text" class="form-control" id="exampleInputdeskripsi" aria-describedby="deksripsiHelp" name="deskripsi" placeholder="Masukan nomor packing list" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputpacking_list1" class="form-label">Packing List</label>
                  <input type="text" class="form-control" id="exampleInputpacking_list1" aria-describedby="packing_listHelp" name="no_packing_list" placeholder="Masukan nomor packing list" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputno_faktur1" class="form-label">Nomor Faktur</label>
                  <input type="text" class="form-control" id="exampleInputno_faktur1" aria-describedby="no_fakturHelp" name="no_faktur" placeholder="Masukan Nomor Faktur" required>
                </div>
                <input type="hidden" name="validasi">
                <input type="hidden" name="tgl_order">
                <button type="submit" class="btn btn-success col-2 " name="simpan">Simpan</button>

              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        <?php
        if (isset($_POST['simpan'])) {
          $nopacking = $_POST['no_packing_list'];
          $faktur = $_POST['no_faktur'];
          $deskripsi = $_POST['deskripsi'];
          // var_dump($nobl, $nopacking, $faktur);

          if ($hasil['no_packing_list'] == $nopacking) {
            echo '
              <script>
              alert("Nomor Packing List tidak boleh sama!");
              </script>            
            ';
          } elseif ($hasil['no_faktur'] == $faktur) {
            echo '
              <script>
              alert("Nomor Faktur tidak boleh sama!");
              </script>            
            ';
          } else {
            $insert = $koneksi->query("INSERT INTO job_order (id_pelanggan, deskripsi, no_packing_list, no_faktur,validasi, tgl_order) VALUES ('$id_pelanggan','$deskripsi','$nopacking','$faktur','Pengajuan','$tanggal')") or die(mysqli_error($koneksi));
            echo '
              <script>
              alert("Pengajuan Job Order Berhasil!");
              window.location.href= "daftar_joborder.php";
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