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
      <span>Contracts</span>
      <a data-open="addAdmin" class="button">add Contract</a>
    </h1>

    <div class="padding-1em">

      <table width="100%">
        <thead>
          <th>Contract Name</th>
          <th>Contract Type</th>
          <th>Contract Date</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM contracts";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['type'];?></td>
            <td><?php echo $row['contract_date'];?></td>
            <td class="text-center editRow"><a href="update_contract.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_contract.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addAdmin" data-reveal>
      <h3 class="">
        <span>Add Contract</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
      <label for="addName">Contract Name:</label>
        <input type="text" id="name" name="name" value="" placeholder="Contract Name">
        
        <label for="addName">Contract Type:</label>
        <select name="type">
        <option disabled selected> Contract Type </option>
        <option>Publishing house</option>
        <option>Author</option>
        <option>Maintainance</option>
        <option>Insurance</option>
        </select>
        
        <label for="addName">Contract First side:</label>
        <input type="text" id="first" name="first">
        
        <label for="addName">Contract Second side:</label>
        <input type="text" id="second" name="second">
        
        <label for="addName">Contract Date:</label>
        <input type="text" id="datepicker" name="c_date">
        
        <input type="file" name="file1" id="file" class="inputfile" />
        <label for="file">Upload Contract attach</label> <br>
        
        <input class="button expanded" type="submit" name="submit" value="Add Contract">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    <?php
	$valid_books = array("jpg", "png", "gif", "bmp","doc", "docx", "pdf", "txt");
        $max_file_size = 1048576000;
        $dir = "contracts/"; // Upload directory
		/*****************************************************/
	 if (isset($_POST['submit'])){
		 $name = mysqli_real_escape_string($db_conn,$_POST['name']);
		 $type = mysqli_real_escape_string($db_conn,$_POST['type']);
		 $first = mysqli_real_escape_string($db_conn,$_POST['first']);
		 $second = mysqli_real_escape_string($db_conn,$_POST['second']);
		 $c_date =date("Y-m-d", strtotime($_POST['c_date']));
	     $link = mysqli_real_escape_string($db_conn,$_FILES['file1']['name']);
				if ($_FILES['file1']['error'] == 4) {
                continue; // Skip file if any error found
            }	       
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
								 $res = mysqli_query($db_conn,"INSERT INTO contracts (name,type,contract_date,first,second,attach) VALUES ('$name','$type','$c_date','$first','$second','$link')");
								 if ($res) echo "New contract has been added.";
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

<script src="js/jquery-ui.min.js"></script>
<script>
              $("#datepicker").datepicker({
                inline: true
              });
</script>
</body>
</html>
