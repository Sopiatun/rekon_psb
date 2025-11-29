<?php
include 'db.php'; // koneksi ke database

// Ambil id dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID tidak ditemukan!");
}

// Pastikan tabelnya sesuai dengan tabel kamu di database
$query = "DELETE FROM rekons WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location='rekon_psb.php';
          </script>";
} else {
    echo "<div class='error-box'>
            <h3>❌ Gagal menghapus data</h3>
            <p>" . mysqli_error($conn) . "</p>
          </div>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus Data Rekon PSB</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
    }

    /* Navbar */
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

    .nav-links li a:hover {
      color: #ffeb3b;
    }

    .nav-links li a.active {
      color: #ffeb3b;
    }

    .container {
      width: 70%;
      margin: 60px auto;
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      text-align: center;
    }

    .success {
      color: #2e7d32;
      font-weight: 600;
    }

    .error-box {
      background-color: #ffebee;
      color: #c62828;
      border: 1px solid #c62828;
      border-radius: 8px;
      padding: 15px;
      margin: 50px auto;
      width: 70%;
      text-align: center;
    }

    .btn {
      display: inline-block;
      background-color: #c62828;
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      margin-top: 20px;
      transition: background 0.3s;
      font-weight: 600;
    }

    .btn:hover {
      background-color: #a81f1f;
    }

    footer {
      text-align: center;
      padding: 20px;
      color: #777;
      font-size: 14px;
      margin-top: 40px;
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
      <li><a href="form_rekon.php">Form Rekon PSB</a></li>
      <li><a class="active" href="rekon_psb.php">Rekon PSB</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </nav>

  <div class="container">
    <h2>Hapus Data Rekon PSB</h2>
    <p>Data sedang dihapus... tunggu sebentar.</p>
    <a href="rekon_psb.php" class="btn">Kembali ke Rekon PSB</a>
  </div>

  <footer>
    &copy; 2025 Telkom Akses | Rekon PSB System
  </footer>
</body>
</html>
