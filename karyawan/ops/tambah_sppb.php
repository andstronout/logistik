<?php
session_start();
require '../../koneksi.php';
$koneksi = koneksi();
if (!isset($_SESSION['login_karyawan'])) {
  header('location:../../login.php');
} else if ($_SESSION['level'] !== 'ops') {
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

    <?php include('../../layout/siderbar_ops.php'); ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Tambah Data SPPB</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputno1" class="form-label">Nomor PIB</label>
                  <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" name="no_pib" placeholder="Masukan nomor PIB">
                </div>
                <button type="submit" class="btn btn-success col-2 " name="cek">Check</button>
                <hr>

                <!-- Cek PIB -->
                <?php
                if (isset($_POST['cek'])) {
                  $cekid = $_POST['no_pib'];
                  $sq = $koneksi->query("SELECT * FROM pib INNER JOIN pelanggan ON pelanggan.id_pelanggan=pib.id_pelanggan WHERE no_pib='$cekid'") or die(mysqli_error($koneksi));
                  $sql = $sq->fetch_assoc();
                  $_SESSION['no_pib'] = $sql['no_pib'];
                  $_SESSION['id_pel'] = $sql['id_pelanggan'];
                  // var_dump($sql);
                  if ($sql != null) {
                ?>
                    <!-- End Cek PIB -->

                    <div class="after cek">
                      <div class="mb-3">
                        <label for="exampleInputno1" class="form-label">Nomor PIB</label>
                        <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" name="no_pib" value="<?= $_POST['no_pib'] ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputpelanggan1" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="exampleInputpelanggan1" aria-describedby="pelangganHelp" name="id_pelanggan" value="<?= $sql['nama_pelanggan']; ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputsppb1" class="form-label">Nomor SPPB</label>
                        <input type="text" class="form-control" id="exampleInputsppb1" name="no_sppb" placeholder="Masukan Nomor SPPB">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputbiaya1" class="form-label">Biaya PIB</label>
                        <input type="text" class="form-control" id="exampleInputbiaya1" name="biaya" placeholder="Masukan Biaya">
                      </div>
                      <button type="submit" class="btn btn-success col-2 " name="simpan">Simpan</button>
                    </div>
                <?php
                  } else {
                    echo '
                      <script>
                      alert("Nomor PIB tidak boleh kosong!");
                      window.location.href= "tambah_sppb.php";
                      </script>                    
                      ';
                  }
                } ?>

              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


      <?php
      if (isset($_POST['simpan'])) {
        $tanggalsppb = date('Y-m-d');

        $cari = $koneksi->query("SELECT no_pib FROM sppb WHERE no_pib='$_SESSION[no_pib]'");
        $dapet = $cari->fetch_assoc();

        if ($dapet != null) {
          echo '
          <script>
          alert("Nomor PIB sudah dipakai!");
          window.location.href= "tambah_sppb.php";
          </script>                    
          ';
        } else {
          $insert = $koneksi->query("INSERT INTO sppb (no_sppb, no_pib,tgl_sppb,id_pelanggan,biaya_sppb) VALUES ('$_POST[no_sppb]','$_SESSION[no_pib]','$tanggalsppb','$_SESSION[id_pel]','$_POST[biaya]')") or die(mysqli_error($koneksi));
          echo "
            <script>
            alert('Data Berhasil Ditambah');
            document.location.href = 'daftar_sppb.php';
            </script>
            ";
          session_unset($_SESSION['no_pib'], $_SESSION['id_pel']);
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