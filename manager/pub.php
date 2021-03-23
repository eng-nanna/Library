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
      <span>Publishers</span>
      <a data-open="addUser" class="button">add Publisher</a>
    </h1>

    <div class="padding-1em">
      <table width="100%">
        <thead>
          <th>Publisher</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM publisher";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td class="text-center editRow"><a href="#" data-open="editForm" data-id="<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_pub.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addUser" data-reveal>
      <h3 class="">
        <span>Add Publisher</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="addName">Publisher:</label>
        <input type="text" id="pub" name="pub" value="" placeholder="Publisher Name">
        <input class="button expanded" type="submit" name="submit" value="Add Publisher">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    
    <?php
        if (isset($_POST['submit'])){
            $name = $_POST['pub'];
			/***************************************/
			$result = mysqli_query($db_conn,"INSERT INTO publisher (name) VALUES ('$name')");
			if ($result) echo "New publisher has been added.";
			else{
				$message = "Error: " . $result . "<br>" . mysqli_error($db_conn);
				echo "<script type='text/javascript'>alert('$message');</script>";
			}	
        }
        ?>
        
        <div class="reveal" id="editForm" data-reveal>
        <h3 class="">
          <span>Edit Form</span>
        </h3>
        <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
          <input type="text" name="publisher" value="">
          <input type="hidden" id="id-value" name="p_id" value="">
          <input class="button expanded" type="submit" name="edit" value="UPDATE">
        </form>
        <button class="close-button" data-close aria-label="Close reveal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- reveal -->
      
      <?php
	 if (isset($_POST['edit'])){
	   $pub = $_POST['publisher'];
	   $id = $_POST['p_id'];
	   $query="SELECT * FROM publisher WHERE id=$id";
		$result= mysqli_query($db_conn, $query) or die("Invalid query");
		$row = mysqli_fetch_array($result);
		$name = $row['name'];
		
		$sql = "UPDATE books SET publisher = '$pub' WHERE publisher='$name'";
		$res= mysqli_query($db_conn, $sql) or die("Invalid query");
		
	   $query1 = mysqli_query($db_conn,"Update publisher SET name='$pub' where id='$id'");
	   if ($sql && $query1) echo "Publisher Name has been updated";
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
