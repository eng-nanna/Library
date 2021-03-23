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
      <span>Branches</span>
      <a data-open="addAdmin" class="button">add branch</a>
    </h1>

    <div class="padding-1em">

      <table width="100%">
        <thead>
          <th>Branch</th>
          <th>Username</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM branch";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['username'];?></td>
            <td class="text-center editRow"><a href="update_branch.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_branch.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addAdmin" data-reveal>
      <h3 class="">
        <span>Add Branch</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <label for="addName">Branch:</label>
        <input type="text" id="branch" name="branch" value="" placeholder="Branch">
        <label for="addName">Username:</label>
        <input type="text" id="addName" name="addName" placeholder="Branch Admin Name">
        <label for="password">Password:</label>
        <input type="password" id="password" name="addPass" placeholder="Branch Admin Password">
        
        <input class="button expanded" type="submit" name="submit" value="Add Branch">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    <?php
	 if (isset($_POST['submit'])){
	   $u_name = mysqli_real_escape_string($db_conn,$_POST['addName']);
	   $pass = md5($_POST['addPass']);
	   $branch = $_POST['branch'];
	   
	   $query = mysqli_query($db_conn,"INSERT INTO branch (username,password,name) 
			  VALUES ('$u_name','$pass','$branch')");
	   $query1 = mysqli_query($db_conn,"INSERT INTO admin (username,password,type) 
			  VALUES ('$u_name','$pass','Branch')");
	   $query2 = mysqli_query($db_conn,"INSERT INTO privilege (username,privilege) 
			  VALUES ('$u_name','ALL')");
	   if ($query && $query1 && $query2) echo "New branch has been added.";
			else{
				$message = "Error: <br>" . mysqli_error($db_conn);
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
    $('#hr').hide();
	$('#finance').hide(); 
    $('#type').change(function(){
        if($('#type').val() == 'HR') {
            $('#hr').show();
			$('#finance').hide(); 
        } else if ($('#type').val() == 'Financial') {
			$('#finance').show();
            $('#hr').hide(); 
        }
    });
});
</script>
</body>
</html>
