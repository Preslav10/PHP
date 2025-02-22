<?php
include "conn.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    $ad_email = mysqli_real_escape_string($conn, $_POST['ad_email']);
    $ad_pass = mysqli_real_escape_string($conn, $_POST['ad_pass']);
    $check = mysqli_query($conn, "SELECT * FROM admin WHERE ad_email='$ad_email' AND ad_password='$ad_pass'");
    $check_fetch = mysqli_fetch_array($check);

    if ($check_fetch['ad_id'] != '') {
        $_SESSION['ad_id'] = $check_fetch['ad_id'];
        header('location:index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="noindex" />
  <title>AdminLTE 3 | Log in</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Admin</b>Login</a>
  </div>
 
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" name="ad_email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="ad_pass" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
         </div>
         <div class="row pt-1">
         <div class="col-12 text-center">
            <div class="icheck-primary">
             <a href="forgot-password.php">Forgot Password</a>
            </div>
            </div>
          </div>
      </form>
    </div>
   
  </div>
</div>



<script src="plugins/jquery.min.js"></script>

<script src="plugins/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
