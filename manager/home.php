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
      <span>Admins</span>
      <a data-open="addAdmin" class="button">add admin</a>
    </h1>

    <div class="padding-1em">
    <!-- search box -->
        <form  method="post" action="f_search.php"  id="searchform">
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
          <th>Type</th>
          <th>Branch</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM admin";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['username'];?></td>
            <td><?php echo $row['type'];?></td>
            <td><?php echo $row['branch'];?></td>
            <td class="text-center editRow"><a href="update_admin.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_admin.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addAdmin" data-reveal>
      <h3 class="">
        <span>Add Admin</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="addName">Username:</label>
        <input type="text" id="addName" name="addName" placeholder="Admin Name">
        <label for="password">Password:</label>
        <input type="password" id="password" name="addPass" placeholder="Admin Password">
        <label for="type">Type:</label>
        <select id="type" class="" name="addType">
          <option value="" disabled selected>Type</option>
          <option>Administrator</option>
          <option>Librarian</option>
           <option>HR</option>
          <option>Borrowing</option>
          <option>Selling</option>
          <option>Financial</option>
        </select>
        
        <label for="branch">Branch:</label>
        <select id="branch" class="" name="branch">
          <option value="" disabled selected>Branch</option>
          <option>ALL</option>
          <?php
		  $sql="SELECT * FROM branch";
		  $res= mysqli_query($db_conn, $sql) or die("Invalid query");
		  while($rowing = mysqli_fetch_array($res)){
		  ?>
          <option><?php echo $rowing['name']; ?></option>
          <?php } ?>
        </select>
        
        <div id="hr">
        <label for="role">Role:</label>
        <input type="checkbox" name="privilage[]" value="employee"> Employee <br>
        <input type="checkbox" name="privilage[]" value="jobs"> Jobs<br>
        <input type="checkbox" name="privilage[]" value="attend"> Attendence<br>
        </div>
        
        <div id="finance">
        <label for="role">Role:</label>
        <input type="checkbox" name="privilage[]" value="salary"> Salaries <br>
        <input type="checkbox" name="privilage[]" value="income"> Income<br>
        <input type="checkbox" name="privilage[]" value="outcome"> Outcome<br>
        </div>
        
        <input class="button expanded" type="submit" name="submit" value="Add Admin">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    <?php
	 if (isset($_POST['submit'])){
	   $u_name = mysqli_real_escape_string($db_conn,$_POST['addName']);
	   $pass = md5($_POST['addPass']);
	   $type = $_POST['addType'];
	   if (isset($_POST['privilage'])){
	   	   $checkbox = implode(',', $_POST['privilage']);
	   }else{
		   $checkbox = "ALL";
	   }
	   $query = mysqli_query($db_conn,"INSERT INTO admin (username,password,type) 
			  VALUES ('$u_name','$pass','$type')");
	   $query1 = mysqli_query($db_conn,"INSERT INTO privilege (username,privilege) 
			  VALUES ('$u_name','$checkbox')");
	   if ($query && $query1) echo "New admin has been added.";
			else{
				$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
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
