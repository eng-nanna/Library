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
      <span>Job Title</span>
      <a data-open="addUser" class="button">add Job</a>
    </h1>

    <div class="padding-1em">
    
      <table width="100%">
        <thead>
          <th>Job Title</th>
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
		  
		  $query="SELECT * FROM job LIMIT $start_from, $num_rec_per_page";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['title'];?></td>
            <td class="text-center editRow"><a href="#" data-open="editForm" data-id="<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_quote.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
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
    $sql = "SELECT * FROM job"; 
    $rs_result = mysqli_query($db_conn, $sql); //run the query
    $total_records = mysqli_num_rows($rs_result);  //count number of records
    $total_pages = ceil($total_records / $num_rec_per_page); 
    
    echo "<li class='pagination-previous disabled'><a href='jobs.php?page=1'>".'First'."</a><span class='show-for-sr'>page</span></li> "; // Goto 1st page  
    
    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='jobs.php?page=".$i."'>".$i."</a></li> "; 
    }; 
    echo "<li class='pagination-next'><a href='jobs.php?page=$total_pages'>".'Last'."</a><span class='show-for-sr'>page</span></a></li> "; // Goto last page
    ?>
    </ul>

    <div class="reveal" id="addUser" data-reveal>
      <h3 class="">
        <span>Add Job Title</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
      	
        <label for="addName">Job Title:</label>
        <input type="text" id="title" name="title" value="" placeholder="Job Title">
        
        <label for="quote">Job Description:</label>
        <textarea name="desc" cols="50" rows="5"></textarea>

        <input class="button expanded" type="submit" name="submit" value="Add Job">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->

  </div> <!--moduleContainer -->
  <!-- ==== End Modules Contaner ==== -->

<?php
        if (isset($_POST['submit'])){
            $job = mysqli_real_escape_string($db_conn,$_POST['title']);
            $desc = mysqli_real_escape_string($db_conn,$_POST['desc']);
								
				 $result = mysqli_query($db_conn,"INSERT INTO job (title,description) VALUES ('$job','$desc')");
					if ($result) echo "New Job Title has been added.";
					else{
						$message = "Error: ". $result . mysqli_error($db_conn);
						echo "<script type='text/javascript'>alert('$message');</script>";
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
</body>
</html>
