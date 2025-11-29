<?php
include 'db.php';
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
  <title>Profil Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc8Aj6N+Yw1Y4M9WZ9Z4m1n+QGJc7z1f0Xq7y3OB0wzPv/N88x5Vgr7bMu6ZQ1yJ84iZC6vnXlY5QXyRlgEjrA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #fff;
    }

    /* HEADER NAV */
    header {
      background-color: #c60000;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 40px;
    }

    header img {
      height: 45px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: 500;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .profile-container {
      max-width: 800px;
      margin: 50px auto;
      background: #fff;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border: 1px solid #ddd;
    }

    .profile-container img {
      display: block;
      margin: 0 auto;
      border-radius: 50%;
      border: 2px solid #ccc;
      object-fit: cover;
      width: 120px;
      height: 120px;
    }

    .profile-container h2 {
      text-align: center;
      color: #c60000;
      margin-top: 10px;
    }

    .profile-container p.sub {
      text-align: center;
      color: #555;
      margin-bottom: 30px;
    }

    h3 {
      border-left: 4px solid #c60000;
      padding-left: 10px;
      color: #000;
    }

    .info p {
      margin: 6px 0;
      font-size: 15px;
    }

    .info b {
      width: 150px;
      display: inline-block;
      color: #333;
    }

    .edit-btn {
      display: block;
      background-color: #c60000;
      color: white;
      text-decoration: none;
      text-align: center;
      padding: 10px 25px;
      border-radius: 8px;
      margin: 20px auto 0;
      width: 120px;
      font-weight: 600;
      transition: 0.2s;
    }

    .edit-btn:hover {
      background-color: #a00000;
    }
    
  </style>
</head>
<body>

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
      <a href="logout.php"><img src="logout.png" alt="Logout" height="25"></a>
    </div>
  </nav>

  <div class="profile-container">
    <img src="uploads/<?php echo htmlspecialchars($user['foto_profil']); ?>" alt="Foto Profil">
    <h2><?php echo htmlspecialchars($user['nama']); ?></h2>
    <p class="sub">Mitra Lapangan - <?php echo htmlspecialchars($user['mitra']); ?></p>

    <div class="info">
      <h3>Data Pribadi</h3>
      <p><b>Nama:</b> <?php echo htmlspecialchars($user['nama']); ?></p>
      <p><b>Email:</b> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><b>No. Telepon:</b> <?php echo htmlspecialchars($user['no_telepon']); ?></p>
      <p><b>Alamat:</b> <?php echo htmlspecialchars($user['alamat']); ?></p>

      <h3>Data Pekerjaan</h3>
      <p><b>Mitra:</b> <?php echo htmlspecialchars($user['mitra']); ?></p>
      <p><b>Divisi:</b> <?php echo htmlspecialchars($user['divisi']); ?></p>
      <p><b>Jabatan:</b> <?php echo htmlspecialchars($user['jabatan']); ?></p>
      <p><b>Status:</b> <?php echo htmlspecialchars($user['status_pekerjaan']); ?></p>
    </div>

    <a href="edit_profile.php" class="edit-btn">Edit Profil</a>
  </div>

</body>
</html>
