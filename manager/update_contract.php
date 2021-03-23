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
  
  <!-- datepicker style -->
  <link rel="stylesheet" href="css/jquery-ui.css">
  
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
      <span>Update Contract Details</span>
    </h1>

    <div class="padding-1em">
    <?php
			$id = $_GET['id'];
			$query="SELECT * FROM contracts where id='$id'";
			$result= mysqli_query($db_conn, $query) or die("Invalid query");
			$row = mysqli_fetch_array($result);
	  ?>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="bookName">Contract name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
        
        <label for="addName">Contract Type:</label>
        <select name="type">
        <option disabled selected> Contract Type </option>
        <option <?php if ($row['type'] == 'Publishing house') echo 'selected="selected"' ?>>Publishing house</option>
        <option <?php if ($row['type'] == 'Publishing house') echo 'selected="selected"' ?>>Publishing house</option>
        <option <?php if ($row['type'] == 'Author') echo 'selected="selected"' ?>>Author</option>
        <option <?php if ($row['type'] == 'Maintainance') echo 'selected="selected"' ?>>Maintainance</option>
        <option <?php if ($row['type'] == 'Insurance') echo 'selected="selected"' ?>>Insurance</option>
        </select>
        
        <label for="bookName">Contract First side:</label>
        <input type="text" id="first" name="first" value="<?php echo $row['first']; ?>">
        
        <label for="bookName">Contract Second side:</label>
        <input type="text" id="second" name="second" value="<?php echo $row['second']; ?>">
               
        <label for="addName">Contract Date:</label>
        <input type="text" id="datepicker" name="c_date" value="<?php echo $row['contract_date']; ?>">
        
        
         <div id="upload">
         <input type="file" name="files" id="file1" class="inputfile" /><?php echo $row['attach']; ?>
         <label for="file1">Upload Contract Attachment</label>
		 </div>

        <input class="button expanded" type="submit" name="submit" value="UPDATE">
      </form>
    </div>
    <!-- padding-1em -->

<?php
		$valid_books = array("jpg", "png", "gif", "bmp","doc", "docx", "pdf", "txt");
        $max_file_size = 1048576000;
        $dir = "doc/"; // Upload directory
		/*****************************************************/
        if (isset($_POST['submit'])){
		 $name = mysqli_real_escape_string($db_conn,$_POST['name']);
		 $type = mysqli_real_escape_string($db_conn,$_POST['type']);
		 $first = mysqli_real_escape_string($db_conn,$_POST['first']);
		 $second = mysqli_real_escape_string($db_conn,$_POST['second']);
		 $c_date =date("Y-m-d", strtotime($_POST['c_date']));
		 $link = "";
            /***********************************************/
			if (!empty($_FILES['files']['name'])){
			$link = mysqli_real_escape_string($db_conn,$_FILES['file1']['name']);
			if ($_FILES['file1']['error'] == 0) {
								$file_size = $_FILES["file1"]["size"];
								if ($file_size > $max_file_size) {
									$message = "$link is too large!.";
									echo "<script type='text/javascript'>alert('$message');</script>";
								}
								if( ! in_array(pathinfo($link, PATHINFO_EXTENSION), $valid_books) ){
									$message = "$link is not a valid format";
									echo "<script type='text/javascript'>alert('$message');</script>";
								}else{ // No error found! Move uploaded files 
								  if(move_uploaded_file($_FILES["file1"]["tmp_name"], $dir.$link)) {
								 $result = mysqli_query($db_conn,"Update contracts SET name='$name', type='$type', contract_date='$c_date', first='$first', second='$second', attach='$link' where id = '$id'");
								 if ($result) echo "Contract has been edited";
									else{
										$message = "Error: " . mysqli_error($db_conn);
										echo "<script type='text/javascript'>alert('$message');</script>";
									}
				}  
			else {
				// Failure
				$message = "Try again uploading the file";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}        
			}
			}	       
			}else{
				$result = mysqli_query($db_conn,"Update contracts SET name='$name', type='$type', contract_date='$c_date', first='$first', second='$second' where id = '$id'");
								 if ($result) echo "Contract has been edited.";
									else{
										$message = "Error: " . mysqli_error($db_conn);
										echo "<script type='text/javascript'>alert('$message');</script>";
									}
			}
		}
        ?>

</div>

<?php
              include("includes/footer.html");
?>

<script src="js/vendor.min.js"></script>
<script src="js/app.js"></script>
<script>
$(document).foundation();
</script>

<script src="js/jquery-ui.min.js"></script>
<script>
              $("#datepicker").datepicker({
                inline: true
              });
</script>

</body>
</html>
