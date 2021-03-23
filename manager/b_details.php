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

$id = $_GET['id'];
$query="SELECT * FROM borrows where id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
$user = $row['username'];
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
      <span><?php echo $user; ?></span>
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
          <th class="text-center">Book Name</th>
           <th class="text-center">Return</th>
        </thead>
        <tbody>
         <?php
		  $sql="SELECT * FROM borrows where username='$user'";
		  $res= mysqli_query($db_conn, $sql) or die("Invalid query");
		  while($rows = mysqli_fetch_array($res)){
		  ?>
          <tr class="text-center">
            <td><?php echo $rows['book_name'];?></td>
            <?php if ($rows['user_return']== '0000-00-00'){ ?>
            <td class="text-center editRow"><a href="return.php?id=<?php echo $rows['id'];?>"><i 
            class="fa fa-caret-left"></i></a></td>
            <?php } else{
			?>
            <td><?php echo $rows['user_return'];?></td>
            <?php } ?>
          </tr>
          <?php
                }
         ?>
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
