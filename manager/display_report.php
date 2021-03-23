<?php
session_start();
include ("includes/config.php");
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Administrator")
	header("Location: index.php");
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Administrator")
	header("Location: index.php");
}else{
    header("Location: index.php");
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LIBRARY MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/fonts/opensans_regular/stylesheet.css" />
  <link rel="stylesheet" href="css/fonts/opensans_bold/stylesheet.css" />
  <link rel="stylesheet" href="css/icons-style/font-awesome.min.css" />

  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!--<header class="mainHeader">
  <div class="row">
  <div class="medium-3 column logoSection">logo</div>
  <div class="medium-9 column headerBtns">login</div>
</div>
</header> mainHeader -->



<div class="row">
  <!-- nav section -->
  <div class="medium-3 column subMenuContainer">
    <div class="logo-container">
      <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <nav>
      <?php include("includes/admin_nav.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>
    
    <?php
	  if (isset($_POST['submit'])){
		  $type = $_POST['r_type'];
		  $month = $_POST['month'];
		  if ($type == "attendence"){
	  ?>

    <h1 class="pageTitle">
      <span><?php echo " Staff Attendence - $month"; ?></span>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Name</th>
          <th>Attendence</th>
        </thead>
        <tbody>
        <?php
				  $query="SELECT * FROM staff";
				  $result= mysqli_query($db_conn, $query) or die("Invalid query");
				  while($row = mysqli_fetch_array($result)){
				  ?>
        <tr>
        <td><?php echo $row['name'];?></td>
        <?php
				  $query1="SELECT * FROM attendence WHERE employee_id='$row[id]' AND  DATE_FORMAT(dates,'%M') ='$month' AND status='present'";
				  $result1= mysqli_query($db_conn, $query1) or die("Invalid query");
				  $count=mysqli_num_rows($result1);
				  ?>
        <td><?php echo $count." days";?></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>
    <?php
}elseif ($type == "performance"){
	  ?>
      
      <h1 class="pageTitle">
      <span><?php echo " Staff Performance - $month"; ?></span>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Name</th>
          <th>Performance</th>
        </thead>
        <tbody>
        <?php
				  $query="SELECT * FROM staff";
				  $result= mysqli_query($db_conn, $query) or die("Invalid query");
				  while($row = mysqli_fetch_array($result)){
				  ?>
        <tr>
        <td><?php echo $row['name'];?></td>
        <td></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>
    <?php
}elseif ($type == "b_books"){
	  ?>
      
      <h1 class="pageTitle">
      <span><?php echo " Borrowed Books - $month"; ?></span>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Branch</th>
          <th>No. of borrowed books</th>
        </thead>
        <tbody>
        <?php
				  $query="SELECT * FROM branch";
				  $result= mysqli_query($db_conn, $query) or die("Invalid query");
				  while($row = mysqli_fetch_array($result)){
				  ?>
        <tr>
        <td><?php echo $row['name'];?></td>
        <td></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>
    <?php
}elseif ($type == "s_books"){
	  ?>
      
      <h1 class="pageTitle">
      <span><?php echo " Borrowed Books - $month"; ?></span>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Branch</th>
          <th>No. of sold books</th>
        </thead>
        <tbody>
        <?php
				  $query="SELECT * FROM branch";
				  $result= mysqli_query($db_conn, $query) or die("Invalid query");
				  while($row = mysqli_fetch_array($result)){
				  ?>
        <tr>
        <td><?php echo $row['name'];?></td>
        <td></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>
    <?php
}
}
	  ?>
    
    
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
