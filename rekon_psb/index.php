<?php include 'db.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Rekon PSB</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #fff;
    }

    /* Navbar */
    .navbar {
      background-color: #c62828;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 30px;
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

    /* Statistik */
    .card-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 50px;
      margin: 50px 0 30px 0;
    }

    .card {
      width: 150px;
      height: 100px;
      text-align: center;
      border: 3px solid transparent;
      border-radius: 10px;
      padding-top: 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      font-size: 15px;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 22px;
      font-weight: bold;
    }

    .red { border-color: #c62828; }
    .blue { border-color: #0288d1; }
    .green { border-color: #388e3c; }
    .yellow { border-color: #fbc02d; }

    /* Rekon Terbaru */
    .rekon-terbaru {
      width: 80%;
      margin: 0 auto 60px auto;
      background: #fff;
      border: 2px solid #1976d2;
      border-radius: 5px;
      padding: 20px;
    }

    .rekon-terbaru h2 {
      text-align: center;
      margin-bottom: 15px;
      font-weight: 700;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: center;
      padding: 10px;
      font-size: 14px;
    }

    th {
      background-color: #f5f5f5;
      color: #333;
      border-bottom: 2px solid #ddd;
    }

    td {
      border-bottom: 1px solid #ddd;
      color: #555;
    }

    tr:nth-child(even) {
      background: #fafafa;
    }

    @media (max-width: 768px) {
      .card-container {
        flex-direction: column;
        gap: 15px;
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
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="form_rekon.php">Form Rekon PSB</a></li>
      <li><a href="rekon_psb.php">Rekon PSB</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><img src="logout.png" alt="Logout"></a>
    </div>
  </nav>

  <!-- Statistik -->
  <div class="card-container">
    <?php
      $total = $conn->query("SELECT COUNT(*) AS jml FROM rekons")->fetch_assoc()['jml'];
      $mitra = $conn->query("SELECT COUNT(DISTINCT mitra) AS jml FROM rekons")->fetch_assoc()['jml'];
      $selesai = $conn->query("SELECT COUNT(*) AS jml FROM rekons WHERE status_ps='Selesai'")->fetch_assoc()['jml'];
      $proses = $conn->query("SELECT COUNT(*) AS jml FROM rekons WHERE status_ps IN ('Proses','Pending')")->fetch_assoc()['jml'];
    ?>

    <div class="card red">
      <h3>Total WO</h3>
      <p><?= $total ?></p>
    </div>
    <div class="card blue">
      <h3>Mitra Aktif</h3>
      <p><?= $mitra ?></p>
    </div>
    <div class="card green">
      <h3>Selesai</h3>
      <p><?= $selesai ?></p>
    </div>
    <div class="card yellow">
      <h3>Proses</h3>
      <p><?= $proses ?></p>
    </div>
  </div>

  <!-- Rekon Terbaru -->
  <div class="rekon-terbaru">
    <h2>Rekon Terbaru</h2>
    <table>
      <thead>
        <tr>
          <th>No WO</th>
          <th>Mitra</th>
          <th>Jenis PSB</th>
          <th>Status</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $result = $conn->query("SELECT no_wo, mitra, jenis_psb, status_ps, created_at AS tanggal FROM rekons ORDER BY id DESC LIMIT 5");
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['no_wo']}</td>
                    <td>{$row['mitra']}</td>
                    <td>{$row['jenis_psb']}</td>
                    <td>{$row['status_ps']}</td>
                    <td>{$row['tanggal']}</td>
                  </tr>";
          }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>
