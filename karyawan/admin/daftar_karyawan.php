<?php
session_start();
require '../../koneksi.php';
$koneksi = koneksi();
// print_r($_SESSION['id_karyawan']);

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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link href="../../sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- URL Datatables -->
  <!-- dataTable URL -->
  <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet" />


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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
            <a href="tambah_karyawan.php" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a>
          </div>

          <!-- Data Table -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Karyawan</th>
                      <th>Email</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Nomor Handphone</th>
                      <th>Status</th>
                      <th width=20%>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = $koneksi->query("SELECT * FROM karyawan INNER JOIN `level` ON karyawan.id_level=`level`.id_level WHERE NOT id_karyawan='1'");
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_karyawan']; ?></td>
                        <td><?= $data['email_karyawan']; ?></td>
                        <td><?= $data['jk_karyawan']; ?></td>
                        <td><?= $data['alamat_karyawan']; ?></td>
                        <td><?= $data['tlp_karyawan']; ?></td>
                        <td><?= $data['nama_level']; ?></td>
                        <td>
                          <a href="edit_karyawan.php?id=<?= $data['id_karyawan']; ?>" class="btn btn-info btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                              <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Edit</span>
                          </a>
                          <a href="hapus_karyawan.php?id=<?= $data['id_karyawan']; ?>" class="btn btn-danger btn-icon-split btn-sm" onclick="return confirm('Are you sure you want to delete?')">
                            <span class="icon text-white-50">
                              <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus</span>
                          </a>
                        </td>
                      <?php } ?>
                      </tr>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

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
  <script src="../../sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="../../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../sbadmin/js/sb-admin-2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- URL Datatables -->
  <!-- dataTable -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: 'Data Karyawan',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6]
            }
          },
          {
            extend: 'pdfHtml5',
            title: 'Data Karyawan',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6]
            }
          }
        ]
      });
    });
  </script>

</body>

</html>