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
      <?php include("includes/admin_nav.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span>Update Admin Information</span>
    </h1>

    <div class="padding-1em">
     <?php
			$id = $_GET['id'];
			$query="SELECT * FROM admin where id=$id";
			$result= mysqli_query($db_conn, $query) or die("Invalid query");
			$row = mysqli_fetch_array($result);
	  ?>
		<form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="addName">Username:</label>
        <input type="text" id="addName" name="addName" value="<?php echo $row['username']; ?>">
        <input type="hidden" id="hide" name="hide" value="<?php echo $row['username']; ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="addPass" placeholder="Re-enter admin password">
        <label for="type">Type:</label>
        <select id="type" class="" name="addType">
          <option value="" disabled>Type</option>
          <option value="Administrator" <?php if ($row['type'] == "Administrator") echo 'selected="selected"' ?>>Administrator</option>
          <option value="Librarian" <?php if ($row['type'] == "Librarian") echo 'selected="selected"' ?>>Librarian</option>
          <option value="HR" <?php if ($row['type'] == "HR") echo 'selected="selected"' ?>>HR</option>
          <option value="Borrowing" <?php if ($row['type'] == "Borrowing") echo 'selected="selected"' ?>>Borrowing</option>
          <option value="Selling" <?php if ($row['type'] == "Selling") echo 'selected="selected"' ?>>Selling</option>
          <option value="Financial" <?php if ($row['type'] == "Financial") echo 'selected="selected"' ?>>Financial</option>
          <option value="Branch" <?php if ($row['type'] == "Branch") echo 'selected="selected"' ?>>Branch</option>
        </select>
        
         <label for="branch">Branch:</label>
        <select id="branch" class="" name="branch">
          <option <?php if ($row['branch'] == "ALL") echo 'selected="selected"' ?>>ALL</option>
          <?php
		  $sql1="SELECT * FROM branch";
		  $res1= mysqli_query($db_conn, $sql1) or die("Invalid query");
		  while($rowing1 = mysqli_fetch_array($res1)){
		  ?>
          <option <?php if ($row['branch'] == $rowing1['name']) echo 'selected="selected"' ?>><?php echo $rowing1['name']; ?></option>
          <?php } ?>
        </select>
        
        <?php
			$query1="SELECT * FROM privilege where username='$row[username]'";
			$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
			while($row1 = mysqli_fetch_array($result1)){
				$privilege = explode(',',$row1['privilege']);
			}
	  ?>
        
         <div id="hr">
        <label for="role">Role:</label>
        <input type="checkbox" name="privilage[]" value="employee" <?php if(in_array("employee",$privilege)) echo 'checked="checked"' ?>> Employee <br>
        <input type="checkbox" name="privilage[]" value="jobs" <?php if(in_array("jobs",$privilege)) echo 'checked="checked"' ?>> Jobs<br>
        <input type="checkbox" name="privilage[]" value="attend" <?php if(in_array("attend",$privilege)) echo 'checked="checked"' ?>> Attendence<br>
        </div>
        
        <div id="finance">
        <label for="role">Role:</label>
        <input type="checkbox" name="privilage[]" value="salary"> Salaries <br>
        <input type="checkbox" name="privilage[]" value="income"> Income<br>
        <input type="checkbox" name="privilage[]" value="outcome"> Outcome<br>
        </div>
        <input class="button expanded" type="submit" name="submit" value="UPDATE">
      </form>
    </div>

    
    <?php
	 if (isset($_POST['submit'])){
	   $hidden_name = $_POST['hide'];
	   $u_name = $_POST['addName'];
	   $pass = md5($_POST['addPass']);
	   $type = $_POST['addType'];
	   $branch = $_POST['branch'];
	   $sql = TRUE;
	   if (isset($_POST['privilage'])){
	   	   $checkbox = implode(',', $_POST['privilage']);
	   }else{
		   $checkbox = "ALL";
	   }
	   if ($type == "Branch"){
	   	   $sql = mysqli_query($db_conn,"Update branch SET username='$u_name' ,password='$pass' where username='$hidden_name'");
	   }
	   $query = mysqli_query($db_conn,"Update admin SET username='$u_name' ,password='$pass' ,type='$type' ,branch='$branch' where id='$id'");
	   $query1 = mysqli_query($db_conn,"Update privilege SET username='$u_name' ,privilege='$checkbox' where username='$hidden_name'");
	   if ($sql && $query && $query1) echo "Information has been updated";
			else{
				$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
				echo "<script type='text/javascript'>alert('$message');</script>";
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
<script src="js/jquery-1.7.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    if($('#type').val() == 'HR') {
            $('#hr').show();
			$('#finance').hide(); 
        } else if ($('#type').val() == 'Financial') {
			$('#finance').show();
            $('#hr').hide(); 
        }else {
			$('#finance').hide();
            $('#hr').hide(); 
        } 
    $('#type').change(function(){
        if($('#type').val() == 'HR') {
            $('#hr').show();
			$('#finance').hide(); 
        } else if ($('#type').val() == 'Financial') {
			$('#finance').show();
            $('#hr').hide(); 
        }else {
			$('#finance').hide();
            $('#hr').hide(); 
        }
    });
});
</script>
</body>
</html>
