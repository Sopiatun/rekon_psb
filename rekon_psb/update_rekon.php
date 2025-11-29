<?php
include 'db.php';

$id = $_POST['id'];

$query = "
UPDATE rekons SET
  mitra = '{$_POST['mitra']}',
  no_wo = '{$_POST['no_wo']}',
  jenis_psb = '{$_POST['jenis_psb']}',
  barcode_dc = '{$_POST['barcode_dc']}',
  dropcore = '{$_POST['dropcore']}',
  sc = '{$_POST['sc']}',
  sclamp = '{$_POST['sclamp']}',
  pinkso = '{$_POST['pinkso']}',
  nama_odp = '{$_POST['nama_odp']}',
  koord_odp = '{$_POST['koord_odp']}',
  lat_odp = '{$_POST['lat_odp']}',
  long_odp = '{$_POST['long_odp']}',
  nama_pelanggan = '{$_POST['nama_pelanggan']}',
  koord_pelanggan = '{$_POST['koord_pelanggan']}',
  lat_pelanggan = '{$_POST['lat_pelanggan']}',
  long_pelanggan = '{$_POST['long_pelanggan']}',
  snont = '{$_POST['snont']}',
  snstb = '{$_POST['snstb']}',
  no_berwarna = '{$_POST['no_berwarna']}',
  valins_id = '{$_POST['valins_id']}',
  power_rx_ont = '{$_POST['power_rx_ont']}',
  catatan_mitra = '{$_POST['catatan_mitra']}',
  sc_validasi = '{$_POST['sc_validasi']}',
  status_ps = '{$_POST['status_ps']}',
  validasi_qs2 = '{$_POST['validasi_qs2']}',
  ba_material = '{$_POST['ba_material']}',
  penerima = '{$_POST['penerima']}'
WHERE id = '$id'
";

if (mysqli_query($conn, $query)) {
  echo "<script>alert('Data berhasil diupdate!');window.location='rekon_psb.php';</script>";
} else {
  echo "Gagal update data: " . mysqli_error($conn);
}
?>
