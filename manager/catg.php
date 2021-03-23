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
      <span>Categories</span>
      <a data-open="addUser" class="button">add Category</a>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Category</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM category";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td class="text-center editRow"><a href="#" data-open="editForm" data-id="<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_cat.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addUser" data-reveal>
      <h3 class="">
        <span>Add Category</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="addName">Category:</label>
        <input type="text" id="cat" name="cat" value="" placeholder="Category Name">
        
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">Choose Category Cover</label>
        
        <input class="button expanded" type="submit" name="submit" value="Add Category">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    
    <?php
        $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
        $min_file_w = 1590;
		$max_file_w = 1610;
		
		$min_file_h = 225;
		$max_file_h = 245;
        $path = "../img/cover/"; // Upload directory
		/*****************************************************/
		if (isset($_POST['submit'])){
            $name = $_POST['cat'];
			/***************************************/
			$pic = $_FILES['files']['name'];
            if ($_FILES['files']['error'] == 4) {
                continue; // Skip file if any error found
            }	       
            if ($_FILES['files']['error'] == 0) {
                list($width,$height) = getimagesize($_FILES["files"]["tmp_name"]);	           
                if ($height < $min_file_h || $width < $min_file_w) {
					$message = "$pic is too small!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }elseif ($height > $max_file_h || $width > $max_file_w) {
					$message = "$pic is too big!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }
                elseif( ! in_array(pathinfo($pic, PATHINFO_EXTENSION), $valid_formats) ){
					$message = "$pic is not a valid format";
					echo "<script type='text/javascript'>alert('$message');</script>";
                    }
            else{ // No error found! Move uploaded files 
                  if(move_uploaded_file($_FILES["files"]["tmp_name"], $path.$pic)) {
				 $result = mysqli_query($db_conn,"INSERT INTO category (name,pic) VALUES ('$name','$pic')");
			if ($result) echo "New category has been added.";
			else{
				$message = "Error: " . $result . "<br>" . mysqli_error($db_conn);
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

        
        <div class="reveal" id="editForm" data-reveal>
        <h3 class="">
          <span>Edit Form</span>
        </h3>
        <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
          <input type="text" name="category" value="">
          <input type="hidden" id="id-value" name="c_id" value="">
          <input class="button expanded" type="submit" name="edit" value="UPDATE">
        </form>
        <button class="close-button" data-close aria-label="Close reveal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- reveal -->
      
      <?php
	 if (isset($_POST['edit'])){
	   $c_name = $_POST['category'];
	   $id = $_POST['c_id'];
	   
	   $query="SELECT * FROM category WHERE id = $id";
		$result= mysqli_query($db_conn, $query) or die("Invalid query");
		$row = mysqli_fetch_array($result);
		$name = $row['name'];
		
		$sql = "UPDATE books SET category = '$c_name' WHERE category='$name'";
		$res= mysqli_query($db_conn, $sql) or die("Invalid query");

	   $query1 = mysqli_query($db_conn,"Update category SET name='$c_name' where id='$id'");
	   if ($sql && $query1) echo "Category Name has been updated";
			else{
				$message = "Error: " . $query1 . "<br>" . mysqli_error($db_conn);
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

</body>
</html>
