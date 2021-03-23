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
      <span>Categories</span>
      <a data-open="addUser" class="button">add Job</a>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Title</th>
          <th>Advertise End Date</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM vacancies";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['deadline'];?></td>
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
        <span>Add Job</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="addName">Job Title:</label>
        <input type="text" id="title" name="title" value="" placeholder="Job Title">
        
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" value="" placeholder="Salary">
        
        <label for="desc">Description:</label>
        <textarea name="desc" cols="50" rows="5" placeholder="Job Description"></textarea>
        
        <label for="date">Advertise End Date:</label>
        <input type="text" id="datepicker" name="deadline" placeholder="Date">
        
        <input class="button expanded" type="submit" name="submit" value="Add Vacancy">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    
    <?php
        
		if (isset($_POST['submit'])){
            $name = $_POST['title'];
			if (isset($_POST['salary'])) $salary = $_POST['salary'];
			else $salary = NULL;
			$desc = $_POST['desc'];
			$end = date("Y-m-d", strtotime($_POST['deadline']));
			$result = mysqli_query($db_conn,"INSERT INTO vacancies (title,desciption,salary,deadline) VALUES ('$name','$desc','$salary','$end')");
			if ($result) echo "New vacancy has been added.";
			else{
				$message = "Error: " . $result . "<br>" . mysqli_error($db_conn);
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

<script src="js/jquery-ui.min.js"></script>
<script>
              $(document).foundation();
              $("#datepicker,#datepicker1").datepicker({
                inline: true
              });
</script>

</body>
</html>
