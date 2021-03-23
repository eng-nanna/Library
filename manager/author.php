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
      <span>Books</span>
      <a data-open="addUser" class="button">add author</a>
    </h1>

    <div class="padding-1em">
    <!-- search box -->
        <form  method="post" action="search.php"  id="searchform">
    <div class="input-group">
 <input class="input-group-field" type="text" name="name"> 
<div class="input-group-button">
 <input type="submit" class="button" value="Search" name="submit">
 </div>
 </div>
 </form> <!-- search box -->
 
      <table width="100%">
        <thead>
          <th>Name</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
        <?php
		  $num_rec_per_page=10;
		  if (isset($_GET["page"])){
		      $page  = $_GET["page"];
		  }else{
			  $page=1;
		  } 
		  $start_from = ($page-1) * $num_rec_per_page;
		  
		  $query="SELECT * FROM author LIMIT $start_from, $num_rec_per_page";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['author'];?></td>
            <td class="text-center editRow"><a href="update_author.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_author.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>
    <!-- padding-1em -->

    <ul class="pagination" role="navigation" aria-label="Pagination">
		<?php 
    $sql = "SELECT * FROM author"; 
    $rs_result = mysqli_query($db_conn, $sql); //run the query
    $total_records = mysqli_num_rows($rs_result);  //count number of records
    $total_pages = ceil($total_records / $num_rec_per_page); 
    
    echo "<li class='pagination-previous disabled'><a href='author.php?page=1'>".'First'."</a><span class='show-for-sr'>page</span></li> "; // Goto 1st page  
    
    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='author.php?page=".$i."'>".$i."</a></li> "; 
    }; 
    echo "<li class='pagination-next'><a href='author.php?page=$total_pages'>".'Last'."</a><span class='show-for-sr'>page</span></a></li> "; // Goto last page
    ?>
    </ul>

    <div class="reveal" id="addUser" data-reveal>
      <h3 class="">
        <span>Add Author</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="Name">Author name:</label>
        <input type="text" id="authorName" name="authorName" value="" placeholder="Author Name">
        <label for="desc">Description:</label>
        <textarea name="desc" cols="50" rows="5" placeholder="Author Description"></textarea>
        
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">Choose a Profile Picture</label>

        <input class="button expanded" type="submit" name="submit" value="Add Author">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->

  </div> <!--moduleContainer -->
  <!-- ==== End Modules Contaner ==== -->

<?php
		$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
        $min_file_dim = 200;
		$max_file_dim = 550;
        $path = "../img/authors/"; // Upload directory
		/*****************************************************/
        if (isset($_POST['submit'])){
            $author = $_POST['authorName'];
            $desc = $_POST['desc'];
            /***********************************************/
			if (empty($_FILES['files']['name'])){
				$pic = "avatar.png";
				$result = mysqli_query($db_conn,"INSERT INTO author (author,description,pic) VALUES ('$author','$desc','$pic')");
				if ($result) echo "New author has been added.";
				else{
					$message = "Error: " . $result . "<br>" . mysqli_error($db_conn);
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
			else{
				$pic = $_FILES['files']['name'];
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
					 $result = mysqli_query($db_conn,"INSERT INTO author (author,description,pic) VALUES ('$author','$desc','$pic')");
						if ($result) echo "New author has been added.";
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
    $('#hard').hide();
	$('#soft').hide(); 
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
    });
});
</script>
</body>
</html>
