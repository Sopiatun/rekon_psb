<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Rekon PSB</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* === GLOBAL === */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #fafafa;
      color: #333;
    }

    /* === NAVBAR === */
    .navbar {
      background-color: #c62828;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .logo-container {
      display: flex;
      align-items: center;
    }

    .logo {
      height: 45px;
      width: auto;
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

    .nav-links li a:hover,
    .nav-links li a.active {
      color: #ffeb3b;
    }

    .logout img {
      height: 25px;
      width: auto;
      filter: invert(1);
      cursor: pointer;
    }

    /* === FORM CONTAINER === */
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
      font-weight: 700;
      margin-bottom: 25px;
    }

    h3 {
      color: #444;
      border-left: 5px solid #c62828;
      padding-left: 10px;
      margin-top: 30px;
      margin-bottom: 10px;
      font-size: 17px;
    }

    /* === INPUT STYLING === */
    form label {
      font-weight: 500;
      display: block;
      margin-top: 15px;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      box-sizing: border-box;
      transition: border 0.3s, box-shadow 0.3s;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
      border-color: #c62828;
      box-shadow: 0 0 4px rgba(198,40,40,0.4);
      outline: none;
    }

    textarea {
      height: 80px;
      resize: none;
    }

    /* === BUTTON === */
    .btn {
      background-color: #c62828;
      color: white;
      font-size: 15px;
      font-weight: 600;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 25px;
      display: block;
      width: 100%;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #a81f1f;
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 20px;
      }

      h2 {
        font-size: 20px;
      }

      .nav-links {
        gap: 20px;
      }
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
      <li><a class="active" href="form_rekon.php">Form Rekon PSB</a></li>
      <li><a href="rekon_psb.php">Rekon PSB</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><img src="logout.png" alt="Logout"></a>
    </div>
  </nav>

  <div class="container">
    <h2>Form Input Rekon PSB</h2>
    <form action="save_rekon.php" method="POST">

      <label>Mitra:</label>
      <input type="text" name="mitra" required>

      <label>No WO:</label>
      <input type="text" name="no_wo" required>

      <label>Jenis PSB:</label>
      <select name="jenis_psb">
        <option value="PSB Baru">PSB Baru</option>
        <option value="PSB Migrasi">PSB Migrasi</option>
      </select>

      <h3>Barcode dan Material</h3>
      <input type="text" name="barcode_dc" placeholder="Barcode DC">
      <input type="text" name="dropcore" placeholder="Dropcore">
      <input type="text" name="sc" placeholder="SC">
      <input type="text" name="sclamp" placeholder="SClamp">
      <input type="text" name="pinkso" placeholder="Pinkso">

      <h3>Titik ODP</h3>
      <input type="text" name="nama_odp" placeholder="nama ODP">
      <input type="text" name="koord_odp" placeholder="Koord ODP">
      <input type="text" name="lat_odp" placeholder="Latitude">
      <input type="text" name="long_odp" placeholder="Longitude">

      <h3>Titik Pelanggan</h3>
      <input type="text" name="nama_pelanggan" placeholder="nama Pelanggan">
      <input type="text" name="koord_pelanggan" placeholder="Koord Pelanggan">
      <input type="text" name="lat_pelanggan" placeholder="Latitude">
      <input type="text" name="long_pelanggan" placeholder="Longitude">

      <h3>NTE</h3>
      <input type="text" name="snont" placeholder="SN ONT">
      <input type="text" name="snstb" placeholder="SN STB">
      <input type="text" name="no_berwarna" placeholder="No Reservasi">

      <h3>Validasi dan Hasil Ukur</h3>
      <input type="text" name="valins_id" placeholder="Valins ID">
      <input type="text" name="power_rx_ont" placeholder="Power RX ONT">
      <textarea name="catatan_mitra" placeholder="Catatan Mitra"></textarea>
      

      <h3>Validasi & Verifikasi</h3>
      <input type="text" name="sc_validasi" placeholder="SC">
      <input type="text" name="status_ps" placeholder="Status PS">
      <input type="text" name="validasi_qs2" placeholder="Validasi QS2">
      <input type="text" name="ba_material" placeholder="BA Material">
      <input type="text" name="penerima" placeholder="Penerima">

      <button type="submit" class="btn">Simpan Data</button>
    </form>
  </div>
</body>
</html>
