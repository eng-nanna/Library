<?php
session_start();
include ("includes/config.php");
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "HR")
	header("Location: index.php");
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "HR")
	header("Location: index.php");
}else{
    header("Location: index.php");
}

$id = $_GET['id'];
$sql="SELECT * FROM staff where id='$id'";
$res= mysqli_query($db_conn, $sql) or die("Invalid query");
$rows = mysqli_fetch_array($res);
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
        <?php include("includes/hr_nav.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span><?php echo $rows['name']; ?></span>
    </h1>

    <div class="padding-1em">
    <form class="material-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                
        <label for="overtime">Overtime days:</label>
        <select id="overtime" class="" name="overtime">
          <option value="" disabled selected>No. of Days</option>
           <?php
						for($x=1;$x<=31;$x++){
						?>
                        <option><?php echo $x;?></option>
                        <?php
                }
         ?>
        </select>
        <label for="ot_bonus">OverTime Bounce:</label>
        <input type="number" id="otb" name="otb" placeholder="overtime bonus per day">
        
        <label for="extra">Extra Bounce:</label>
        <input type="number" id="bouns" name="bouns" placeholder="Extra Bounce">
        <label for="good">Why extra bounce:</label>
        <textarea name="extra_b" cols="50" rows="5"></textarea>
        
        <label for="discount">Discount:</label>
        <input type="number" id="discount" name="discount" placeholder="Discount">
        <label for="bad">penalties:</label>
        <textarea name="penalty" cols="50" rows="5"></textarea>
        
      <button class="button expanded" name="submit" value="submit">Confirm</button>
    </form>
    </div>
    
   <?php
 if (isset($_POST['submit'])){
	 $date = date('Y-m-d');
	 if (isset($_POST['overtime'])){
		 $over_days = $_POST['overtime'];
		 $otb = $_POST['otb'];
		 $bouns = $over_days * $otb;
		 $query1 = mysqli_query($db_conn,"INSERT INTO overtime (emp_id,overtime_days,bonus,overtime_date) VALUES ('$id',$over_days,'$bouns','$date')");
	 if ($query1) echo "Thanks";
     else echo "Error1: " . $query1 . "<br>" . mysqli_error($db_conn);
	 }
	 
	 if (isset($_POST['bouns'])){
		 $bouns = $_POST['bouns'];
	 	 $extra = mysqli_real_escape_string($db_conn,$_POST['extra_b']);
		 $query2 = mysqli_query($db_conn,"INSERT INTO extra_bonus (emp_id,bonus,reason,bonus_date) VALUES ('$id',$bonus,'$extra','$date')");
	 if ($query2) echo "Thanks";
     else echo "Error2: " . $query2 . "<br>" . mysqli_error($db_conn);
	 }
	 
	 if (isset($_POST['discount'])){
		 $discount = $_POST['discount'];
	 	 $penalty = mysqli_real_escape_string($db_conn,$_POST['penalty']);
		 $query3 = mysqli_query($db_conn,"INSERT INTO penalty (emp_id,discount,penalty,penalty_date) VALUES ('$id',$discount,'$penalty','$date')");
	 if ($query3) echo "Thanks";
     else echo "Error3: " . $query3 . "<br>" . mysqli_error($db_conn);
	 }
 }
 ?>   

  </div> <!--moduleContainer -->
  <!-- ==== End Modules Contaner ==== -->


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
