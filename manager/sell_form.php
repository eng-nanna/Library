<?php
session_start();
include ("includes/config.php");
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Selling")
	header("Location: index.php");
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Selling")
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
       <?php include("includes/sell_nav.html"); ?>
    </nav>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span>Selling Book</span>
    </h1>

    <div class="padding-1em">
    <?php
	$id = $_GET['id'];
	$query="SELECT * FROM books where id='$id'";
	$result= mysqli_query($db_conn, $query) or die("Invalid query");
	$row = mysqli_fetch_array($result);
	
	$queries="SELECT * FROM prices where book_name='$row[name]'";
	$res= mysqli_query($db_conn, $queries) or die("Invalid query");
	$rowing = mysqli_fetch_array($res);
	
	$sql = "SELECT * FROM book_4mat where book_name='$row[name]'";
	$res1 = mysqli_query($db_conn, $sql) or die("Invalid query");
	$rows = mysqli_fetch_array($res1);
	
	$sql1 = "SELECT * FROM s_copies where book_name='$row[name]'";
	$res1 = mysqli_query($db_conn, $sql1) or die("Invalid query");
	$rows1 = mysqli_fetch_array($res1);
	
	if ($rows1['current_copies']==0 && $rows['type'] != 's'){
	?>
    No Copies Available Now
    <?php
	}elseif ($rows['type'] == 's' && $rows['soft_type'] != 'r'){
		?>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="bookName">book name:</label>
        <b> <?php echo $row['name']; ?></b>
        
        <input type="hidden" id="type" name="type" value="soft">
                
        <label for="price">book Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $rowing['soft_price']; ?>">
                        
        <label for="user">User Name:</label>
        <select class="" id="user" name="addUser">
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

        <label for="date">Sell Date:</label>
        <input type="text" id="datepicker" name="b_date" placeholder="Date">
        <input class="button expanded" type="submit" name="submit" value="Confirm">
      </form>
      <?php
                }elseif ($rows['type'] == 'h' || $rows['soft_type'] == 'r'){
         ?>
          <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="bookName">book name:</label>
        <b> <?php echo $row['name']; ?></b>
        
        <input type="hidden" id="type" name="type" value="hard">
                
        <label for="price">book Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $rowing['hard_price']; ?>">
        
        <label for="copies">No. of Copies:</label>
        <select class="" id="copies" name="copies">
         <option disabled selected>--No. of Copies--</option>
                      <?php
						$quer="SELECT * FROM s_copies WHERE book_name = '$row[name]'";
						$results= mysqli_query($db_conn, $quer) or die("Invalid query");
						$rows = mysqli_fetch_array($results);
						for ($i=1 ; $i<=$rows['copies'];$i++){
						?>
                        <option><?php echo $i;?></option>
                        <?php
                }
         ?>
        </select>
                
        <label for="user">User Name:</label>
        <select class="" id="user" name="addUser">
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
        <label for="date">Sell Date:</label>
        <input type="text" id="datepicker" name="b_date" placeholder="Date">
        <input class="button expanded" type="submit" name="submit" value="Confirm">
      </form>
      <?php }elseif ($rows['type'] == 'b' && $rows['soft_type'] != 'r'){
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
         
        <div id="soft"><label for="price">book Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $rowing['soft_price']; ?>"></div>
       
        <div id="hard"><label for="price">book Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $rowing['hard_price']; ?>">
        
        <label for="copies">No. of Copies:</label>
        <select class="" id="copies" name="copies">
         <option disabled selected>--No. of Copies--</option>
                      <?php
						$quer="SELECT * FROM s_copies WHERE book_name = '$row[name]'";
						$results= mysqli_query($db_conn, $quer) or die("Invalid query");
						$rows = mysqli_fetch_array($results);
						for ($i=1 ; $i<=$rows['copies'];$i++){
						?>
                        <option><?php echo $i;?></option>
                        <?php
                }
         ?>
        </select></div>
        
        <label for="user">User Name:</label>
        <select class="" id="user" name="addUser">
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

        <label for="date">Sell Date:</label>
        <input type="text" id="datepicker" name="b_date" placeholder="Date">
        <input class="button expanded" type="submit" name="submit" value="Confirm">
      </form>
      <?php } ?>
    </div>
    <!-- padding-1em -->
<?php
if (isset($_POST['submit'])){
	$copies = 1;
	   $current_copies = $rows1['current_copies'];
	   $u_name = $_POST['addUser'];
	   $price = $_POST['price'];
	   $type = $_POST['type'];
	   if (isset($_POST['copies'])){
		   $copies = $_POST['copies'];
		   $current_copies -= $copies;
	   }
	   $total = $price * $copies;
	   $b_date = date("Y-m-d", strtotime($_POST['b_date']));
	   $query = mysqli_query($db_conn,"INSERT INTO selling (book_name,username,price,copies,sell_date,type) 
          VALUES ('$row[name]','$u_name','$total','$copies','$b_date','$type')");
	   $query1 = mysqli_query($db_conn,"Update s_copies SET current_copies='$current_copies' where book_name='$row[name]'");
	   if ($query && $query1){
		   header("Location: sell.php");
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
              $("#datepicker").datepicker({
                inline: true
              });
</script>

<script src="js/jquery-1.7.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#hard').hide();
	$('#soft').hide(); 
    $('#type').change(function(){
        if($('#type').val() == 'hard') {
            $('#hard').show();
			$('#soft').hide(); 
        } else if ($('#type').val() == 'soft') {
			$('#soft').show();
            $('#hard').hide(); 
        }
    });
});
</script>
</body>
</html>
