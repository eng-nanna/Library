<?php
session_start();
include ("includes/config.php");
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Borrowing")
	header("Location: index.php");
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Borrowing")
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
      <?php include("includes/borrow_nav.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span>Borrowers</span>
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
          <th class="text-center">Name</th>
          <th class="text-center">No of borrowed books</th>
          <th class="text-center">Status</th>
        </thead>
        <tbody>
         <?php
		  
			  $query="SELECT * FROM borrows GROUP BY username";
			  $result= mysqli_query($db_conn, $query) or die("Invalid query");
			  while($row = mysqli_fetch_array($result)){
			  $sql="SELECT * FROM borrows WHERE username = '$row[username]'";
			  $res= mysqli_query($db_conn, $sql) or die("Invalid query");
			  $count=mysqli_num_rows($res);
			  $sql1="SELECT * FROM borrows WHERE username = '$row[username]' and status = 'delay'";
			  $res1= mysqli_query($db_conn, $sql1) or die("Invalid query");
			  $count1=mysqli_num_rows($res1);
			  if ($count1 >= ($count/2))
				  $user_update = mysqli_query($db_conn,"Update users SET status='Uncommitted' where username='$row[username]'");
			  else
			  	$user_update = mysqli_query($db_conn,"Update users SET status='Active' where username='$row[username]'");
		  ?>
          <tr class="text-center">
            <td><a href="b_details.php?id=<?php echo $row['id'];?>"><?php echo $row['username'];?></a></td>
            <td><?php echo $count; ?></td>
            <?php
				$query1="SELECT * FROM users WHERE username='$row[username]'";
			  	$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
			  	$row1 = mysqli_fetch_array($result1)
			?>
            <td><?php echo $row1['status']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

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
