<?php
require_once __DIR__ . '/../model/users.php';

if (isset($_SESSION['full_name'])) {
  echo "<script>
    alert('Anda sudah login');
    window.location.href = 'index.php';
    </script>";
}

$Users = new Users();
if (isset($_POST['submit'])) {
  $datas = [
    "post" => $_POST,
    "files" => $_FILES

  ];

  $result = $Users->register($datas);
  if (gettype($result)  == 'string') {
    echo "<script>alert('{$result}');
        window.location.href = 'register.php';
        </script>";
  } else {
    echo "<script>
        alert('Register akun berhasil');
        window.location.href = 'login.php';
        </script>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(to right, #4facfe, #9b59b6);
      font-family: 'Arial', sans-serif;
      padding: 20px 0;
    }

    .register-card {
      border-radius: 15px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }

    .register-header {
      background: linear-gradient(to right, #4facfe, #9b59b6);
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    .register-brand img {
      width: 80px;
      animation: bounceInDown 1s;
    }

    .register-body {
      padding: 20px;
    }

    .form-control:focus {
      border-color: #4facfe;
      box-shadow: 0 0 5px #4facfe;
    }

    .custom-file-label::after {
      content: "Browse";
    }

    .btn-primary {
      background: linear-gradient(to right, #4facfe, #9b59b6);
      border: none;
    }

    .btn-primary:hover {
      background: linear-gradient(to left, #4facfe, #9b59b6);
    }
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="register-card">
              <div class="register-header">
                <div class="register-brand">
                  <img src="../dist/assets/img/stisla-fill.svg" alt="logo" class="rounded-circle">
                </div>
                <h4 class="mt-2 animate__animated animate__fadeInDown">Register</h4>
              </div>

              <div class="register-body">
                <form method="post" action="" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="full_name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                  </div>
                  <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                      <option value="l">Laki-laki</option>
                      <option value="p">Perempuan</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="avatar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                  </div>
                  <div class="mb-3">
                    <label for="bio" class="form-label">Biografi</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                  </div>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                    <label class="form-check-label" for="remember-me">Remember Me</label>
                  </div>
                  <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>
                <div class="mt-4 text-center">
                  <p>Have an account? <a href="login.php" class="text-decoration-none">Login</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>