<?php
include 'db.php';

if (isset($_POST['upload'])) {
    $fileName = $_FILES['excel']['tmp_name'];

    if ($_FILES['excel']['type'] != 'text/csv' && pathinfo($_FILES['excel']['name'], PATHINFO_EXTENSION) != 'csv') {
        echo "<script>alert('Harap upload file CSV.');window.history.back();</script>";
        exit;
    }

    $handle = fopen($fileName, "r");
    $row = 0;

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row == 0) { $row++; continue; } // lewati header

        // === SESUAIKAN URUTAN DENGAN FILE CSV KAMU ===
        $mitra             = $data[0];
        $no_wo             = $data[1];
        $jenis_psb         = $data[2];
        $barcode_dc        = $data[3];
        $dropcore          = $data[4];
        $sc                = $data[5];
        $sclamp            = $data[6];
        $pinkso            = $data[7];
        $koord_odp         = $data[8];
        $lat_odp           = $data[9];
        $long_odp          = $data[10];
        $koord_pelanggan   = $data[11];
        $lat_pelanggan     = $data[12];
        $long_pelanggan    = $data[13];
        $snont             = $data[14];
        $snstb             = $data[15];
        $no_berwarna       = $data[16];
        $valins_id         = $data[17];
        $power_rx_ont      = $data[18];
        $catatan_mitra     = $data[19];
        $sc_validasi       = $data[20];
        $status_ps         = $data[21];
        $validasi_qs2      = $data[22];
        $ba_material       = $data[23];
        $penerima          = $data[24];

        $sql = "INSERT INTO rekons (
                    mitra, no_wo, jenis_psb, barcode_dc, dropcore, sc, sclamp, pinkso,
                    koord_odp, lat_odp, long_odp, koord_pelanggan, lat_pelanggan, long_pelanggan,
                    snont, snstb, no_berwarna, valins_id, power_rx_ont, catatan_mitra,
                    sc_validasi, status_ps, validasi_qs2, ba_material, penerima
                ) VALUES (
                    '$mitra', '$no_wo', '$jenis_psb', '$barcode_dc', '$dropcore', '$sc', '$sclamp', '$pinkso',
                    '$koord_odp', '$lat_odp', '$long_odp', '$koord_pelanggan', '$lat_pelanggan', '$long_pelanggan',
                    '$snont', '$snstb', '$no_berwarna', '$valins_id', '$power_rx_ont', '$catatan_mitra',
                    '$sc_validasi', '$status_ps', '$validasi_qs2', '$ba_material', '$penerima'
                )";
        mysqli_query($conn, $sql);
        $row++;
    }
    fclose($handle);

    echo "<script>alert('Data Rekon berhasil diimport!');window.location='rekon_psb.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Upload Data Rekon CSV</title>
  <style>
    body { font-family: 'Poppins', sans-serif; background: #f9f9f9; text-align: center; padding: 60px; }
    .container { background: white; padding: 30px; border-radius: 10px; display: inline-block; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
    input[type=file] { padding: 10px; margin: 20px 0; }
    button { background: #0277bd; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
    button:hover { background: #01579b; }
  </style>
</head>
<body>

<div class="container">
  <h2>Upload Data Rekon (CSV)</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="excel" accept=".csv" required>
    <br>
    <button type="submit" name="upload">Upload</button>
  </form>
  <br>
  <a href="rekon_psb.php">⬅ Kembali</a>
</div>

</body>
</html>
