<?php
include 'db.php';

// Tentukan nama file download
$filename = "data_rekon_" . date('Ymd_His') . ".csv";

// Set header agar browser langsung download file
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

// Buka output ke browser
$output = fopen("php://output", "w");

// Tulis judul kolom sesuai tampilan tabel
fputcsv($output, [
  'No', 'Mitra', 'No WO', 'Jenis PSB', 
  'Barcode DC', 'Dropcore', 'SC', 'SClamp', 'Pinkso',
  'Koord ODP', 'Lat ODP', 'Long ODP',
  'Koord Pelanggan', 'Lat Pelanggan', 'Long Pelanggan',
  'SNONT', 'SNSTB', 'No Berwarna',
  'Valins ID', 'Power RX ONT', 'Catatan Mitra',
  'SC Validasi', 'Status PS', 'Validasi QS2',
  'BA Material', 'Penerima'
]);

// Ambil data dari database
$result = $conn->query("SELECT * FROM rekons ORDER BY id ASC");
$no = 1;
while ($row = $result->fetch_assoc()) {
  fputcsv($output, [
    $no++,
    $row['mitra'],
    $row['no_wo'],
    $row['jenis_psb'],
    $row['barcode_dc'],
    $row['dropcore'],
    $row['sc'],
    $row['sclamp'],
    $row['pinkso'],
    $row['koord_odp'],
    $row['lat_odp'],
    $row['long_odp'],
    $row['koord_pelanggan'],
    $row['lat_pelanggan'],
    $row['long_pelanggan'],
    $row['snont'],
    $row['snstb'],
    $row['no_berwarna'],
    $row['valins_id'],
    $row['power_rx_ont'],
    $row['catatan_mitra'],
    $row['sc_validasi'],
    $row['status_ps'],
    $row['validasi_qs2'],
    $row['ba_material'],
    $row['penerima']
  ]);
}

fclose($output);
exit;
?>
