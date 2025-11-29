<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekon PSB</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .navbar {
      background-color: #c62828;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .logo-container { display: flex; align-items: center; }
    .logo { height: 45px; width: auto; }

    .nav-links { list-style: none; display: flex; gap: 40px; margin: 0; padding: 0; }
    .nav-links li a { color: white; text-decoration: none; font-weight: 600; transition: 0.3s; }
    .nav-links li a:hover, .nav-links li a.active { color: #ffeb3b; }

    .logout img { height: 25px; filter: invert(1); cursor: pointer; }

    .nav { text-align: right; margin: 20px 40px; }
    .btn { background-color: #0277bd; color: white; padding: 10px 18px; text-decoration: none; border-radius: 6px; font-weight: 600; transition: 0.3s; }
    .btn:hover { background-color: #01579b; }

    .table-container {
      overflow-x: auto;
      margin: 0 30px 50px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    table { width: 100%; border-collapse: collapse; font-size: 14px; min-width: 1000px; }
    thead th { padding: 10px; background-color: #b71c1c; color: white; border: 1px solid #ccc; text-align: center; }
    .header-sub th { background-color: #263238; }
    td { padding: 8px 10px; border: 1px solid #e0e0e0; text-align: center; }
    tr:nth-child(even) { background-color: #f5f5f5; }

    .btn-edit, .btn-delete {
      display: inline-block;
      padding: 6px 12px;
      font-size: 13px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
      margin: 2px;
      font-weight: 600;
    }
    .btn-edit { background-color: #0277bd; color: white; }
    .btn-edit:hover { background-color: #01579b; }
    .btn-delete { background-color: #c62828; color: white; }
    .btn-delete:hover { background-color: #a81f1f; }
    td:last-child { text-align: center; min-width: 130px; }

    a.map-link {
      color: #0277bd;
      text-decoration: none;
      font-weight: 600;
    }
    a.map-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
      <img src="telkomakses.png" alt="Telkom Akses" class="logo">
    </div>
    <ul class="nav-links">
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="form_rekon.php">Form Rekon PSB</a></li>
      <li><a href="rekon_psb.php">Rekon PSB</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><img src="logout.png" alt="Logout"></a>
    </div>
  </nav>

  <!-- Tombol Tambah -->
  <div class="nav">
    <a href="upload_excel.php" class="btn">+ Tambah Data Rekon</a>
    <a href="export_rekon.php" class="btn" style="background-color:#2e7d32; margin-left:10px;">⬇ Export ke CSV</a>
  </div>

  <!-- Tabel -->
  <div class="table-container">
    <table>
      <thead>
        <tr class="header-utama">
          <th rowspan="2">No</th>
          <th rowspan="2">Mitra</th>
          <th rowspan="2">No WO</th>
          <th rowspan="2">Jenis PSB</th>
          <th colspan="5">Barcode dan Material</th>
          <th colspan="4">Titik ODP</th>
          <th colspan="4">Titik Pelanggan</th>
          <th colspan="3">NTE</th>
          <th colspan="3">Validasi dan Hasil Ukur</th>
          <th colspan="5">Validasi & Verifikasi</th>
          <th rowspan="2">Aksi</th>
        </tr>
        <tr class="header-sub">
          <th>Barcode DC</th>
          <th>Dropcore</th>
          <th>SC</th>
          <th>SClamp</th>
          <th>Pinkso</th>
          <th>Nama ODP</th>
          <th>Koord ODP</th>
          <th>Lat</th>
          <th>Long</th>
          <th>Nama Pelanggan</th>
          <th>Koord Pelanggan</th>
          <th>Lat</th>
          <th>Long</th>
          <th>SNONT</th>
          <th>SNSTB</th>
          <th>No Reservasi</th>
          <th>Valins ID</th>
          <th>Power RX ONT</th>
          <th>Catatan Mitra</th>
          <th>SC</th>
          <th>Status PS</th>
          <th>Validasi QS2</th>
          <th>BA Material</th>
          <th>Penerima</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = $conn->query("SELECT * FROM rekons ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>".$no++."</td>";
          echo "<td>{$row['mitra']}</td>";
          echo "<td>{$row['no_wo']}</td>";
          echo "<td>{$row['jenis_psb']}</td>";

          // Barcode & Material
          echo "<td>{$row['barcode_dc']}</td>";
          echo "<td>{$row['dropcore']}</td>";
          echo "<td>{$row['sc']}</td>";
          echo "<td>{$row['sclamp']}</td>";
          echo "<td>{$row['pinkso']}</td>";

          // Titik ODP
          $lat_odp = $row['lat_odp'];
          $long_odp = $row['long_odp'];
          $map_odp = "https://www.google.com/maps?q=$lat_odp,$long_odp";
          echo "<td>{$row['nama_odp']}</td>";
          echo "<td><a class='map-link' href='$map_odp' target='_blank'> {$row['koord_odp']}</a></td>";
          echo "<td><a class='map-link' href='$map_odp' target='_blank'> $lat_odp</a></td>";
          echo "<td><a class='map-link' href='$map_odp' target='_blank'> $long_odp</a></td>";

          // Titik Pelanggan
          $lat_pel = $row['lat_pelanggan'];
          $long_pel = $row['long_pelanggan'];
          $map_pel = "https://www.google.com/maps?q=$lat_pel,$long_pel";
          echo "<td>{$row['nama_pelanggan']}</td>";
          echo "<td><a class='map-link' href='$map_pel' target='_blank'> {$row['koord_pelanggan']}</a></td>";
          echo "<td><a class='map-link' href='$map_pel' target='_blank'> $lat_pel</a></td>";
          echo "<td><a class='map-link' href='$map_pel' target='_blank'> $long_pel</a></td>";

          // NTE
          echo "<td>{$row['snont']}</td>";
          echo "<td>{$row['snstb']}</td>";
          echo "<td>{$row['no_berwarna']}</td>";

          // Validasi dan Hasil Ukur
          echo "<td>{$row['valins_id']}</td>";
          echo "<td>{$row['power_rx_ont']}</td>";
          echo "<td>{$row['catatan_mitra']}</td>";

          // Validasi & Verifikasi
          echo "<td>{$row['sc_validasi']}</td>";
          echo "<td>{$row['status_ps']}</td>";
          echo "<td>{$row['validasi_qs2']}</td>";
          echo "<td>{$row['ba_material']}</td>";
          echo "<td>{$row['penerima']}</td>";

          echo "<td>
                  <a href='edit_rekon.php?id={$row['id']}' class='btn-edit'>Edit</a>
                  <a href='delete_rekon.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>
