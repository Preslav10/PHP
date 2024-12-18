<?php
include('conn.php');
$m = $_GET['m'];
if(isset($_POST['submit'])){
	extract($_POST);
	if($ad_pass == $ad_pass2){
	$insertdata = mysqli_query($con,"UPDATE admin SET ad_password='$ad_pass' where ad_id='$m'");
	if($insertdata){
    echo "<script>alert('Updated Successfully');</script>
	<script>window.location.href = 'login.php'</script>";
	}
	}
	else{
	    echo 'Password not Match!!';
	}
	
	} 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <a href="/"><b>Change</b>Password</a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form method="post">
        
        <div class="input-group mb-3">
          <input type="password" name="ad_pass" class="form-control" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         <div class="input-group mb-3">
          <input type="password" name="ad_pass2" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
             
            </div>
          </div>
          
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
         
        </div>
      </form>
    </div>
   
  </div>
</div>



<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
