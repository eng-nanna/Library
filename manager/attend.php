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

$date = date('l j -  n - Y');

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
        <?php include("includes/hr_nav.php"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span><?php echo $date; ?></span>
    </h1>

    <div class="padding-1em">
           <form class="material-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <table width="100%">
        <thead>
          <th>Name</th>
          <th>Status</th>
        </thead>
        <tbody>
          <?php
		  $query="SELECT * FROM staff";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <input type="hidden" name="id[]" value="<?php echo $row['id'];?>"/>
                  <td>
                    <select name="status[]">
                      <option value="present">Present</option>
                      <option value="absent">Absent </option>
                    </select>
                  </td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
      <button class="button expanded" name="submit" value="submit">Confirm</button>
          </form>
    </div>
    
   <?php
 if (isset($_POST['submit'])){
	 $id=$_POST['id'];
	 $status=$_POST['status'];
	 $newDate = date("Y-m-d", strtotime($date));
	 $count=count($status);
	 for($i=0;$i<$count;$i++){
	 $query = mysqli_query($db_conn,"INSERT INTO attendence (employee_id,dates,status) VALUES ('$id[$i]',NOW(),'$status[$i]')");
	 }
	 if ($query) echo "Thanks";
     else echo "Error: " . $query . "<br>" . mysqli_error($db_conn);  
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
