<?php
session_start();
require '../../koneksi.php';
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

          <!-- Page Heading -->
          <h1 class="h4 mb-4 text-gray-800">Tambah Data PIB</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <label for="exampleInputno1" class="form-label">Nomor Job Order</label>
                  <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" name="id_job" placeholder="Masukan nomor Job Order">
                </div>
                <button type="submit" class="btn btn-success col-2 " name="cek">Check</button>
                <hr>

                <!-- Cek Job Order -->
                <?php
                if (isset($_POST['cek'])) {
                  $ambil = $_POST['id_job'];
                  $cek = explode('-', $ambil);
                  $cekid = $cek[1];
                  $sq = $koneksi->query("SELECT * FROM job_order INNER JOIN pelanggan ON pelanggan.id_pelanggan=job_order.id_pelanggan WHERE id_joborder='$cekid'");
                  $sql = $sq->fetch_assoc();
                  // ini data dapet dari cek
                  $_SESSION['id_job'] = $sql['id_joborder'];
                  $_SESSION['id_pel'] = $sql['id_pelanggan'];
                  if ($sql != null) { ?>
                    <!-- End Cek Job Order -->

                    <div class="after cek">
                      <div class="mb-3">
                        <label for="exampleInputno1" class="form-label">Nomor Job Order</label>
                        <input type="text" class="form-control" id="exampleInputno1" aria-describedby="noHelp" name="id_joborder" value="<?= $_POST['id_job'] ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputpelanggan1" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="exampleInputpelanggan1" aria-describedby="pelangganHelp" name="id_pelanggan" value="<?= $sql['nama_pelanggan']; ?>" readonly>
                      </div>
                      <div class="mb-3 ">
                        <label for="exampleInputnopib1" class="form-label">Nomor PIB</label>
                        <input type="text" class="form-control" id="exampleInputnopib1" aria-describedby="nopibHelp" name="no_pib" placeholder="Masukan nomor pib" required>
                      </div>
                      <div class="mb-3 ">
                        <label for="exampleInputpengajuan1" class="form-label">Nomor Pengajuan</label>
                        <input type="text" class="form-control" id="exampleInputpengajuan1" aria-describedby="pengajuanHelp" name="no_pengajuan" placeholder="Masukan nomor pengajuan">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputbiaya1" class="form-label">Biaya PIB</label>
                        <input type="text" class="form-control" id="exampleInputbiaya1" name="biaya" placeholder="Masukan Biaya">
                      </div>
                      <button type="submit" class="btn btn-success col-2 " name="simpan" onclick="return confirm('Apakah sudah benar?')">Simpan</button>
                    </div>
                <?php } else {
                    echo '
                    <script>
                    alert("Job Order tidak boleh kosong!");
                    window.location.href= "tambah_pib.php";
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
        $idjob = $_POST['id_joborder'];
        $idpel = $_POST['id_pelanggan'];
        $ck = explode('-', $idpel);
        $idpelanggan = $ck[1];
        // var_dump($idjob, $idpelanggan);
        $tanggalpib = date('Y-m-d');

        $cari = $koneksi->query("SELECT id_joborder FROM pib WHERE id_joborder='$_SESSION[id_job]'");
        $dapet = $cari->fetch_assoc();

        if ($dapet != null) {
          echo '
          <script>
          alert("Job Order sudah dipakai!");
          window.location.href= "tambah_pib.php";
          </script>                    
          ';
        } else {
          $insert = $koneksi->query("INSERT INTO pib (no_pib,id_joborder,no_pengajuan,id_pelanggan,tgl_pib,biaya_pib) VALUES ('$_POST[no_pib]','$_SESSION[id_job]','$_POST[no_pengajuan]','$_SESSION[id_pel]','$tanggalpib','$_POST[biaya]')") or die(mysqli_error($koneksi));
          echo "
            <script>
            alert('Data Berhasil Ditambah');
            document.location.href = 'daftar_pib.php';
            </script>
            ";
          session_unset($_SESSION['id_job'], $_SESSION['id_pel']);
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