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

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $mitra = $_POST['mitra'];
    $divisi = $_POST['divisi'];
    $jabatan = $_POST['jabatan'];
    $status_pekerjaan = $_POST['status_pekerjaan'];

    // Proses upload foto profil baru
    $foto = $user['foto_profil'];
    if (!empty($_FILES['foto_profil']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $foto = time() . "_" . basename($_FILES['foto_profil']['name']);
        $targetFile = $targetDir . $foto;
        move_uploaded_file($_FILES['foto_profil']['tmp_name'], $targetFile);
    }

    // Update data
    $query = "UPDATE users SET 
                nama='$nama',
                email='$email',
                no_telepon='$no_telepon',
                alamat='$alamat',
                mitra='$mitra',
                divisi='$divisi',
                jabatan='$jabatan',
                status_pekerjaan='$status_pekerjaan',
                foto_profil='$foto'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: profile.php");
        exit;
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Profil</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
    }

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

    .form-container {
      max-width: 700px;
      margin: 40px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #c60000;
    }

    label {
      font-weight: 600;
      display: block;
      margin-top: 15px;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-top: 5px;
      font-family: 'Poppins', sans-serif;
    }

    button {
      background: #c60000;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      margin-top: 20px;
      cursor: pointer;
    }

    button:hover {
      background: #a00000;
    }

    .preview {
      text-align: center;
      margin-bottom: 20px;
    }

    .preview img {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      object-fit: cover;
      border: 2px solid #ccc;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #c60000;
      font-weight: 500;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="img/logo-telkom.png" alt="Telkom Akses">
  </div>
  <nav>
    <a href="index.php">Home</a>
    <a href="form_rekon.php">Form Rekon PSB</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">🚪 Logout</a>
  </nav>
</header>

<div class="form-container">
  <h2>Edit Profil</h2>
  <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="preview">
      <img id="fotoPreview" src="uploads/<?php echo htmlspecialchars($user['foto_profil']); ?>" alt="Foto Profil">
    </div>

    <label>Foto Profil</label>
    <input type="file" name="foto_profil" accept="image/*" onchange="previewImage(event)">

    <label>Nama</label>
    <input type="text" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

    <label>No. Telepon</label>
    <input type="text" name="no_telepon" value="<?php echo htmlspecialchars($user['no_telepon']); ?>">

    <label>Alamat</label>
    <textarea name="alamat"><?php echo htmlspecialchars($user['alamat']); ?></textarea>

    <label>Mitra</label>
    <input type="text" name="mitra" value="<?php echo htmlspecialchars($user['mitra']); ?>">

    <label>Divisi</label>
    <input type="text" name="divisi" value="<?php echo htmlspecialchars($user['divisi']); ?>">

    <label>Jabatan</label>
    <input type="text" name="jabatan" value="<?php echo htmlspecialchars($user['jabatan']); ?>">

    <label>Status Pekerjaan</label>
    <input type="text" name="status_pekerjaan" value="<?php echo htmlspecialchars($user['status_pekerjaan']); ?>">

    <button type="submit" name="update">Simpan Perubahan</button>
    <br>
    <a href="profile.php" class="back-link">← Kembali ke Profil</a>
  </form>
</div>

<script>
function previewImage(event) {
  const reader = new FileReader();
  reader.onload = function(){
    const output = document.getElementById('fotoPreview');
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
