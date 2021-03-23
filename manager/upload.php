<?php
session_start();
include ("includes/config.php");
if(!isset($_SESSION["username"]))
{
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
      <?php include("includes/navigator.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span>Users</span>
      <a data-open="addUser" class="button">Upload Book</a>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Name</th>
          <th>URL</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM upload";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['book'];?></td>
            <td class="text-center removeRow"><a href="delete_user.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addUser" data-reveal>
      <h3 class="">
        <span>Add User</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="addName">Book Name:</label>
        <input type="text" id="addName" name="addName" value="" placeholder="Book Name">
     
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">upload book</label>

        <input class="button expanded" type="submit" name="submit" value="Upload">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    
    <?php
		$valid_formats = array("doc", "docx", "pdf", "txt", "odt");
		$max_file_size = 1048576000;
        $path = "doc/"; // Upload directory
		
		/*****************************************************/
        if (isset($_POST['submit'])){
            $user = $_POST['addName'];
			$pic = $_FILES['files']['name'];
            /***********************************************/
            if ($_FILES['files']['error'] == 4) {
                continue; // Skip file if any error found
            }	       
            if ($_FILES['files']['error'] == 0) {
                $file_size = $_FILES["files"]["size"];	           
                if ($file_size > $max_file_size) {
					$message = "$pic is too large!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }
				if( ! in_array(pathinfo($pic, PATHINFO_EXTENSION), $valid_formats) ){
					$message = "$pic is not a valid format";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }else{ // No error found! Move uploaded files 
                  if(move_uploaded_file($_FILES["files"]["tmp_name"], $path.$pic)) {
				 $result = mysqli_query($db_conn,"INSERT INTO upload (name,book) VALUES ('$user','$pic')");
					if ($result) echo "New book has been upload.";
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
