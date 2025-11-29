<?php include 'db.php'; session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Akun</title>
  <style>
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
    }

    .login-container {
      background: #fff;
      padding: 40px 50px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-10px);}
      to {opacity: 1; transform: translateY(0);}
    }

    h2 {
      margin-bottom: 25px;
      color: #333;
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 8px;
      color: #555;
      font-weight: 600;
    }

    input {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
    }

    input:focus {
      border-color: #4b6cb7;
      box-shadow: 0 0 5px rgba(75,108,183,0.3);
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
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.03);
      background: linear-gradient(135deg, #5c7edc, #203a79);
    }

    .register-link {
      margin-top: 15px;
      font-size: 14px;
      color: #555;
    }

    .register-link a {
      color: #4b6cb7;
      text-decoration: none;
      font-weight: 500;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      margin-top: 15px;
      background: #ffe6e6;
      padding: 8px;
      border-radius: 5px;
      font-size: 14px;
    }

    @media (max-width: 400px) {
      .login-container {
        width: 90%;
        padding: 30px 25px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login Akun</h2>
    <form method="POST" action="login.php">
      <label>Email:</label>
      <input type="email" name="email" placeholder="Masukkan email kamu" required>

      <label>Password:</label>
      <input type="password" name="password" placeholder="Masukkan password" required>

      <button type="submit" name="login">Login</button>
    </form>

    <div class="register-link">
      Silahkan <a href="register.php">register</a> jika belum mempunyai akun
    </div>

    <?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        $user = mysqli_fetch_assoc($query);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='error'>Email atau password salah!</div>";
        }
    }
    ?>
  </div>
</body>
</html>
