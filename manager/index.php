<?php
session_start();
include ("includes/config.php");
if(isset($_SESSION["username"]) || isset($_COOKIE["username"])) {
    header("Location: redirect.php");
	exit;
}
if (isset($_POST['submit'])){
	$username = $_POST['name'];
	$password = md5($_POST['pass']);
	////////////////////////////////////////////////////////////
	$result=mysqli_query($db_conn,"SELECT * FROM admin WHERE username='$username' and password='$password'");
	$count=mysqli_num_rows($result);
	if ($count==1){ 
		if (isset($_POST['autologin'])) {
			setcookie('username', $username,time()+60*60*24*30 );
		}else{
			$_SESSION['username'] = $username;
		}
		header("Location: redirect.php");
		exit;
		}
	else{
		$message = "Invalid username or password";
		echo "<script type='text/javascript'>alert('$message');</script>";
		}
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LIBRARY MANAGEMENT SYSTEM</title>
  <link rel="icon" href="../favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/fonts/opensans_regular/stylesheet.css" />
  <link rel="stylesheet" href="css/fonts/opensans_bold/stylesheet.css" />
  <link rel="stylesheet" href="css/icons-style/font-awesome.min.css" />

  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <div class="row login-container">
    <div class="login-form">
      <div class="form-logo">
        <a href="#">
          <img src="img/logo.png" alt="logo" width="230">
        </a>
      </div><!-- form-logo -->
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label> <i class="fa fa-user"></i> Username<input type="text" name="name"></label>
        <label><i class="fa fa-key"></i> Password<input type="password" name="pass"></label>
        <p><label><input type="checkbox" name="autologin" value="1">Remember Me</label></p>
        <input type="submit" name="submit"  value="Login" class="success button expanded">
      </form>
    </div>
  </div>


   <?php
              include("includes/footer.html");
   ?>
   
  <script src="js/vendor.min.js"></script>
  <script src="js/app.js"></script>
  <script>
  $(document).foundation();
  </script>
</body>
</html>
