<?php
require_once "config.php";
session_start();
if (!isset($_SESSION['konsumen'])) {
  header("location:index.php");
}
$username = $_SESSION['konsumen'];
$id_konsumen = $_SESSION['konsumen'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= deskripsi; ?>">
  <meta name="author" content="<?= admin; ?>">

  <title><?= nama; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>
  <?php include "navbar.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Dashboard
      <small><?= nama; ?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        Home
      </li>
      <li class="breadcrumb-item"><a href="history.php">History Pemesanan</a></li>
      <li class="breadcrumb-item"><a href="ubah.php">Ubah Password</a></li>
      <li class="breadcrumb-item"><a href="edit.php">Edit Profil</a></li>
      <li class="breadcrumb-item"><a href="contact.php">Contact</a></li>
    </ol>

    <h2>Your Booking</h2>
    <hr>
    <?php
    $cektiket = $koneksi->query("SELECT * FROM transaksi  where (cek_in >= CURRENT_TIMESTAMP) AND id_konsumen ='$id_konsumen'");
    if ($cektiket->num_rows < 1) {
      echo "Tidak ada kartu Booking...";
    } else { ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Plat Mobil</th>
              <th>Tanggal Pemesanan</th>
              <th>Cek In</th>
              <th>Lama Pakai</th>
              <th>Total Biaya</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = $cektiket->fetch_assoc()) {
              ?>
              <tr>
                <td><?php echo $row['plat_mobil']; ?></td>
                <td><?php echo $row['tanggal_transaksi']; ?></td>
                <td><?php echo $row['cek_in']; ?></td>
                <td><?php echo $row['lama_pakai']; ?></td>
                <td>Rp. <?php echo number_format($row['total_biaya']); ?>,-</td>
                <td>
                  <a href="<?php echo "detail_transaksi.php?id=" . $row['id_transaksi'] . ""; ?>" class="btn btn-md btn-info">Detail</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <a href="laporan.php?id_konsumen='<?php echo $id_konsumen; ?>" target="blank" class="btn btn-warning">Cetak Kartu</a>
      </div>
    <?php } ?>
  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>