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
      <span>Borrow Book</span>
    </h1>

    <div class="padding-1em">
    <?php
	$id = $_GET['id'];
	$query="SELECT * FROM books where id='$id'";
	$result= mysqli_query($db_conn, $query) or die("Invalid query");
	$row = mysqli_fetch_array($result);
	$book = $row['name'];
	
	$sql = "SELECT * FROM book_4mat where book_name='$book'";
	$res = mysqli_query($db_conn, $sql) or die("Invalid query");
	$rows = mysqli_fetch_array($res);
	
	$sql1 = "SELECT * FROM b_copies where book_name='$book'";
	$res1 = mysqli_query($db_conn, $sql1) or die("Invalid query");
	$rows1 = mysqli_fetch_array($res1);
	
	if ($rows1['current_copies']==0 && $rows['type'] != 's'){
	?>
    No Copies Available Now
    <?php
	}elseif ($rows['type'] == 's'){
		if ($rows['soft_type'] == 's'){
		?>
		No Copies Available Now
		<?php
		}elseif($rows['soft_type'] == 'r' || $rows['soft_type'] == 'b'){
		?>
        <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="bookName">book name:</label>
       <b> <?php echo $row['name']; ?></b>
       <input type="hidden" id="type" name="type" value="soft">
        <label for="user">User Name:</label>
        <select class="" id="user" name="user">
         <option disabled selected>Users</option>
                      <?php
						$query1="SELECT * FROM users";
						$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
						while($row1 = mysqli_fetch_array($result1)){
						?>
                        <option><?php echo $row1['username'];?></option>
                        <?php
                }
         ?>
        </select>

        <label for="date">Borrowing Date:</label>
        <input type="text" id="datepicker" name="b_date" placeholder="Date">
        
        <label for="date">Return Date:</label>
        <input type="text" id="datepicker1" name="r_date" placeholder="Date">
        
        <input class="button expanded" type="submit" name="submit" value="Add Details">
      </form>
        <?php
		}}elseif ($rows['type'] == 'b'){
		?>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <label for="bookName">book name:</label>
       <b> <?php echo $row['name']; ?></b>
       
      <label for="type">Book Type:</label>
        <select class="" id="type" name="type">
         <option disabled selected>Type</option>
         <option value="soft">Soft Copy</option>
         <option value="hard">Hard Copy</option>
         </select>
                      
        <label for="user">User Name:</label>
        <select class="" id="user" name="user">
         <option disabled selected>Users</option>
                      <?php
						$query1="SELECT * FROM users";
						$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
						while($row1 = mysqli_fetch_array($result1)){
						?>
                        <option><?php echo $row1['username'];?></option>
                        <?php
                }
         ?>
        </select>

        <label for="date">Borrowing Date:</label>
        <input type="text" id="datepicker" name="b_date" placeholder="Date">
        
        <label for="date">Return Date:</label>
        <input type="text" id="datepicker1" name="r_date" placeholder="Date">
        
        <input class="button expanded" type="submit" name="submit" value="Add Details">
      </form>
      <?php
	}else{
		?>
        <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="bookName">book name:</label>
        <b> <?php echo $row['name']; ?></b>
        
        <input type="hidden" id="type" name="type" value="hard">
        <label for="user">User Name:</label>
        <select class="" id="user" name="user">
         <option disabled selected>Users</option>
                      <?php
						$query1="SELECT * FROM users";
						$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
						while($row1 = mysqli_fetch_array($result1)){
						?>
                        <option><?php echo $row1['username'];?></option>
                        <?php
                }
         ?>
        </select>

        <label for="date">Borrowing Date:</label>
        <input type="text" id="datepicker" name="b_date" placeholder="Date">
        <label for="date">Return Date:</label>
        <input type="text" id="datepicker1" name="r_date" placeholder="Date">
        <input class="button expanded" type="submit" name="submit" value="Add Details">
      </form>
    </div>
    <!-- padding-1em -->
	
    <?php
	}
	 if (isset($_POST['submit'])){
	   $type = $_POST['type'];
	   $u_name = $_POST['user'];
	   $borrow = date("Y-m-d", strtotime($_POST['b_date']));
	   $return = date("Y-m-d", strtotime($_POST['r_date']));
	   $query = mysqli_query($db_conn,"INSERT INTO borrows (book_name,username,type,b_date,book_return) 
          VALUES ('$book','$u_name','$type','$borrow','$return')");
	   if ($query){
		   if($type == 'hard'){
			   $current_copies = $rows1['current_copies'];
			   $current_copies -= 1;
			    $resulting = mysqli_query($db_conn,"Update b_copies SET current_copies='$current_copies' where book_name = '$book'");
				if($resulting)
					header("Location: borrow.php");
		   }else header("Location: borrow.php");
	   }else{
				$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
				echo "<script type='text/javascript'>alert('$message');</script>";
			} 
	 }
	 ?>  
    
  </div> <!--moduleContainer -->
  <!-- ==== End Modules Contaner ==== -->


</div>

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
