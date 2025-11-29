<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Akun</title>
  <style>
    /* ====== Reset Dasar ====== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: linear-gradient(135deg, #4b6cb7, #182848);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .register-container {
      background: #fff;
      padding: 40px 50px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      width: 420px;
      text-align: center;
      animation: fadeIn 0.8s ease;
      overflow-y: auto;
      max-height: 90vh;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-10px);}
      to {opacity: 1; transform: translateY(0);}
    }

    h2 {
      margin-bottom: 25px;
      color: #333;
      font-size: 24px;
    }

    form {
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #555;
      font-weight: 600;
      font-size: 14px;
    }

    input, textarea {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
      font-size: 14px;
    }

    input:focus, textarea:focus {
      border-color: #4b6cb7;
      box-shadow: 0 0 5px rgba(75,108,183,0.3);
    }

    textarea {
      resize: vertical;
      min-height: 60px;
    }

    button {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #4b6cb7, #182848);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.03);
      background: linear-gradient(135deg, #5a7edc, #203a79);
    }

    .note {
      margin-top: 15px;
      font-size: 14px;
      color: #555;
      text-align: center;
    }

    .note a {
      color: #4b6cb7;
      text-decoration: none;
      font-weight: 500;
    }

    .note a:hover {
      text-decoration: underline;
    }

    p.success {
      background: #e7f8e3;
      color: #2e7d32;
      padding: 10px;
      border-radius: 6px;
      text-align: center;
      margin-top: 10px;
    }

    p.error {
      background: #fbeaea;
      color: #c0392b;
      padding: 10px;
      border-radius: 6px;
      text-align: center;
      margin-top: 10px;
    }

    /* ====== Scroll & Responsif ====== */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 10px;
    }

    @media (max-width: 450px) {
      .register-container {
        width: 100%;
        padding: 30px 25px;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Form Registrasi</h2>

    <form method="POST" action="register.php" enctype="multipart/form-data">
      <label>Nama:</label>
      <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>

      <label>Email:</label>
      <input type="email" name="email" placeholder="Masukkan email aktif" required>

      <label>Password:</label>
      <input type="password" name="password" placeholder="Masukkan password" required>

      <label>No. Telepon:</label>
      <input type="text" name="no_telepon" placeholder="08xxxxxxxxxx">

      <label>Alamat:</label>
      <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>

      <label>Mitra:</label>
      <input type="text" name="mitra" value="PT. Telkom Akses">

      <label>Divisi:</label>
      <input type="text" name="divisi" value="Rekon PSB">

      <label>Jabatan:</label>
      <input type="text" name="jabatan" value="Teknisi Lapangan">

      <label>Status Pekerjaan:</label>
      <input type="text" name="status_pekerjaan" value="Aktif">

      <label>Foto Profil:</label>
      <input type="file" name="foto_profil">

      <button type="submit" name="register">Daftar</button>
    </form>

    <div class="note">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>

    <?php
    if (isset($_POST['register'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];
        $mitra = $_POST['mitra'];
        $divisi = $_POST['divisi'];
        $jabatan = $_POST['jabatan'];
        $status = $_POST['status_pekerjaan'];

        // Upload foto profil
        $foto = "default.jpg";
        if (!empty($_FILES['foto_profil']['name'])) {
            $foto = basename($_FILES['foto_profil']['name']);
            $target = "uploads/" . $foto;
            move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target);
        }

        $sql = "INSERT INTO users (nama, email, password, no_telepon, alamat, mitra, divisi, jabatan, status_pekerjaan, foto_profil)
                VALUES ('$nama','$email','$password','$no_telepon','$alamat','$mitra','$divisi','$jabatan','$status','$foto')";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Pendaftaran berhasil! <a href='login.php'>Login di sini</a></p>";
        } else {
            echo "<p class='error'>Terjadi kesalahan: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
  </div>
</body>
</html>
