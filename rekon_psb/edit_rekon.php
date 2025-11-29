<?php
include 'db.php'; // koneksi ke database kamu

// Ambil id dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID tidak ditemukan!");
}

// Ambil data rekon berdasarkan id
$query = "SELECT * FROM rekons WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan!");
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Rekon PSB</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #fafafa;
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

    .logo {
      height: 45px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 40px;
      margin: 0;
      padding: 0;
    }

    .nav-links li a {
      color: white;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .nav-links li a.active {
      color: #ffeb3b;
    }

    .container {
      width: 80%;
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #c62828;
      margin-bottom: 25px;
    }

    label {
      font-weight: 500;
      display: block;
      margin-top: 15px;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 6px;
    }

    textarea {
      resize: none;
      height: 80px;
    }

    .btn {
      background-color: #c62828;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      margin-top: 25px;
      width: 100%;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #a81f1f;
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
      <li><a href="index.php">Home</a></li>
      <li><a class="active" href="rekon_psb.php">Edit Rekon PSB</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </nav>

  <div class="container">
    <h2>Edit Data Rekon PSB</h2>

    <form action="update_rekon.php" method="POST">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">

      <label>Mitra:</label>
      <input type="text" name="mitra" value="<?= htmlspecialchars($data['mitra']) ?>">

      <label>No WO:</label>
      <input type="text" name="no_wo" value="<?= htmlspecialchars($data['no_wo']) ?>">

      <label>Jenis PSB:</label>
      <select name="jenis_psb">
        <option value="PSB Baru" <?= $data['jenis_psb']=='PSB Baru'?'selected':'' ?>>PSB Baru</option>
        <option value="PSB Migrasi" <?= $data['jenis_psb']=='PSB Migrasi'?'selected':'' ?>>PSB Migrasi</option>
      </select>

      <h3>Barcode dan Material</h3>
      <input type="text" name="barcode_dc" value="<?= $data['barcode_dc'] ?>">
      <input type="text" name="dropcore" value="<?= $data['dropcore'] ?>">
      <input type="text" name="sc" value="<?= $data['sc'] ?>">
      <input type="text" name="sclamp" value="<?= $data['sclamp'] ?>">
      <input type="text" name="pinkso" value="<?= $data['pinkso'] ?>">

      <h3>Titik ODP</h3>
      <input type="text" name="nama_odp" value="<?= $data['nama_odp'] ?>">
      <input type="text" name="koord_odp" value="<?= $data['koord_odp'] ?>">
      <input type="text" name="lat_odp" value="<?= $data['lat_odp'] ?>">
      <input type="text" name="long_odp" value="<?= $data['long_odp'] ?>">

      <h3>Titik Pelanggan</h3>
      <input type="text" name="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>">
      <input type="text" name="koord_pelanggan" value="<?= $data['koord_pelanggan'] ?>">
      <input type="text" name="lat_pelanggan" value="<?= $data['lat_pelanggan'] ?>">
      <input type="text" name="long_pelanggan" value="<?= $data['long_pelanggan'] ?>">

      <h3>NTE</h3>
      <input type="text" name="snont" value="<?= $data['snont'] ?>">
      <input type="text" name="snstb" value="<?= $data['snstb'] ?>">
      <input type="text" name="no_berwarna" value="<?= $data['no_berwarna'] ?>">

      <h3>Validasi dan Hasil Ukur</h3>
      <input type="text" name="valins_id" value="<?= $data['valins_id'] ?>">
      <input type="text" name="power_rx_ont" value="<?= $data['power_rx_ont'] ?>">
      <textarea name="catatan_mitra"><?= $data['catatan_mitra'] ?></textarea>
      <input type="text" name="sc_validasi" value="<?= $data['sc_validasi'] ?>">
      <input type="text" name="status_ps" value="<?= $data['status_ps'] ?>">

      <h3>Validasi & Verifikasi</h3>
      <input type="text" name="validasi_qs2" value="<?= $data['validasi_qs2'] ?>">
      <input type="text" name="ba_material" value="<?= $data['ba_material'] ?>">
      <input type="text" name="penerima" value="<?= $data['penerima'] ?>">

      <button type="submit" class="btn">Update Data</button>
    </form>
  </div>
</body>
</html>
