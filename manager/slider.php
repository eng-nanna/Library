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
      <span>Add Slider Images</span>
      <a data-open="addAdmin" class="button">Add Image</a>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>PC Image</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
        <?php
		  $query="SELECT * FROM slider";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><img src="../img/slider/<?php echo $row['pic'];?>" style="width:100px; height:100px"></td>
            <td class="text-center removeRow"><a href="delete_slider.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>         
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addAdmin" data-reveal>
      <h3 class="">
        <span>Add Image</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file1" id="file" class="inputfile" />
        <label for="file">Choose PC Image</label> <br>
        
        <input class="button expanded" type="submit" name="submit" value="UPLOAD">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button" name="submit">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    
     <?php
	 $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
        $min_pc_h = 440;
		$max_pc_h = 460;
		$min_pc_w = 740;
		$max_pc_w = 760;
				
        $path = "../img/slider/"; // Upload directory
		/*****************************************************/
        if (isset($_POST['submit'])){
				$img1 = mysqli_real_escape_string($db_conn,$_FILES['file1']['name']);
				if ($_FILES['file1']['error'] == 4) {
                continue; // Skip file if any error found
            }	       
            if ($_FILES['file1']['error'] == 0) {
                list($width,$height) = getimagesize($_FILES["file1"]["tmp_name"]);	           
                if ($height < $min_pc_h || $width < $min_pc_w) {
					$message = "$img1 is too small!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }elseif ($height > $max_pc_h || $width > $max_pc_w) {
					$message = "$img1 is too big!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }
                elseif( ! in_array(pathinfo($img1, PATHINFO_EXTENSION), $valid_formats) ){
					$message = "$img1 is not a valid format";
					echo "<script type='text/javascript'>alert('$message');</script>";
                    }
            	else{ // No error found! Move uploaded files 
				    if(move_uploaded_file($_FILES["file1"]["tmp_name"], $path.$img1)) {
						$query = mysqli_query($db_conn,"INSERT INTO slider (pic) 
										VALUES ('$img1')");
						if ($query) echo "Success";
						else{
							$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
				}  
			else {
				// Failure
				$message = "Try again uploading PC image";
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
</body>
</html>
