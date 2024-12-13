<?php
require_once __DIR__ . "/../model/model.php";
require_once __DIR__ . "/../model/users.php";

if (isset($_SESSION['full_name'])) {
  echo "<script>
    alert('Anda sudah login!');
    window.location.href = 'index.php';
    </script>";
}

$User = new Users();
if (isset($_POST['submit'])) {
  $result = $User->login($_POST['email'], $_POST['password']);
  if (gettype($result) == 'string') {
    echo "<script>
        alert('{$result}');
        </script>";
  } else {
    echo "<script>
        alert('Login Berhasil');
        window.location.href = 'index.php';
        </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Blog News</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../dist/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../dist/assets/css/animated-login.css">
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .login-container {
      background: white;
      border-radius: 10px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      animation: fadeIn 1.5s;
      padding: 40px;
      max-width: 400px;
      text-align: center;
    }

    .login-brand img {
      animation: bounceInDown 1.5s;
    }

    .btn-primary {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      border: none;
      transition: background 0.5s;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #2575fc, #6a11cb);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes bounceInDown {
      0% {
        opacity: 0;
        transform: translateY(-2000px);
      }

      60% {
        opacity: 1;
        transform: translateY(30px);
      }

      80% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-brand">
      <img src="../dist/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>

    <h4 class="mb-4">Welcome Back!</h4>

    <form method="post" action="" class="needs-validation" novalidate="">
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
        <div class="invalid-feedback">
          Please fill in your email
        </div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="none">
        <div class="invalid-feedback">
          Please fill in your password
        </div>
      </div>

      <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
        Login
      </button>
    </form>

    <div class="mt-3">
      <a href="register.php">Don't have an account? Create One</a>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../dist/assets/modules/jquery.min.js"></script>
  <script src="../dist/assets/modules/popper.js"></script>
  <script src="../dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/assets/js/stisla.js"></script>
</body>

</html>