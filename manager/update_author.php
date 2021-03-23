<?php
session_start();
include ("includes/config.php");
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Librarian")
	header("Location: index.php");
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Librarian")
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
      <?php include("includes/lib_nav.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span>Update author Details</span>
    </h1>

    <div class="padding-1em">
    <?php
			$id = $_GET['id'];
			$query="SELECT * FROM author where id='$id'";
			$result= mysqli_query($db_conn, $query) or die("Invalid query");
			$row = mysqli_fetch_array($result);
			$name = $row['author'];
			
	  ?>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="Name">Author name:</label>
        <input type="text" id="Name" name="Name" value="<?php echo $row['author']; ?>">
        <label for="desc">Description:</label>
        <textarea name="desc" cols="50" rows="5"><?php echo $row['description'];?></textarea>

        <img src="../img/authors/<?php echo $row['pic']; ?>" style="width:150px; height:150px">
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">Choose a Profile Picture</label>

        <input class="button expanded" type="submit" name="submit" value="UPDATE">
      </form>
    </div>
    <!-- padding-1em -->

<?php
		$valid_formats = array("jpg", "png", "gif", "zip", "bmp", "JPG");
        $min_file_dim = 200;
		$max_file_dim = 550;
        $path = "../img/authors/"; // Upload directory
		/*****************************************************/
        if (isset($_POST['submit'])){
            $author = $_POST['Name'];
			$desc = $_POST['desc'];
			$pic = $_FILES['files']['name'];
            /***********************************************/
			if (!empty($_FILES['files']['name'])){
			$pic = $_FILES['files']['name'];
				if ($_FILES['files']['error'] == 4) {
					continue; // Skip file if any error found
				}	       
				if ($_FILES['files']['error'] == 0) {
					list($width,$height) = getimagesize($_FILES["files"]["tmp_name"]);	           
					if ($height < $min_file_dim || $width < $min_file_dim) {
						$message = "$pic is too small!.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}elseif ($height > $max_file_dim || $width > $max_file_dim) {
						$message = "$pic is too big!.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					elseif( ! in_array(pathinfo($pic, PATHINFO_EXTENSION), $valid_formats) ){
						$message = "$pic is not a valid format";
						echo "<script type='text/javascript'>alert('$message');</script>";
						}
				else{ // No error found! Move uploaded files 
					  if(move_uploaded_file($_FILES["files"]["tmp_name"], $path.$pic)) {
					 $result = mysqli_query($db_conn,"Update author SET author='$author' ,description='$desc' ,pic='$pic' where id='$id'");
					 $res = mysqli_query($db_conn,"Update books SET author='$author' where author='$name'");
						if ($result && $res) header("Location: author.php");
						else{
						$message = "Error: " . $result ."<br>" . mysqli_error($db_conn);
						echo "<script type='text/javascript'>alert('$message');</script>";
			}
					}  
				else {
					// Failure
					$message = "Try again";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}        
				}
				}
			}else{
				$result = mysqli_query($db_conn,"Update author SET author='$author' ,description='$desc' where id='$id'");
				$res = mysqli_query($db_conn,"Update books SET author='$author' where author='$name'");
						if ($result && $res) header("Location: author.php");
						else{
						$message = "Error: " . $result ."<br>" . mysqli_error($db_conn);
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

<script src="js/jquery-1.7.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#bookType').change(function(){
        if($('#bookType').val() == 'h') {
            $('#hard').show();
			$('#soft').hide(); 
        } else if ($('#bookType').val() == 's') {
			$('#soft').show();
            $('#hard').hide(); 
        } else if ($('#bookType').val() == 'b') {
			$('#hard').show();
            $('#soft').show(); 
        }
    }).trigger('change');
});
</script>
</body>
</html>
