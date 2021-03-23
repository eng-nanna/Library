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
              <?php include("../cpanel/includes/navigator.html"); ?>
  </div><!-- subMenu -->
  <!-- ==== end nav ===== -->

  <!-- ==== Modules Contaner ==== -->
  <div class="medium-9 column moduleContainer">
    <div class="headerBtns">
      <a href="signout.php" class="button">logout</a>
    </div>

    <h1 class="pageTitle">
      <span>Search Results</span>
    </h1>

    <div class="padding-1em">
    <table width="100%">
        <thead>
          <th>Name</th>
          <th>ISBN</th>
          <th>Author</th>
          <th>Publisher</th>
          <th>Category</th>
        </thead>
        <tbody>
    <?php 
	  if(isset($_POST['submit'])){ 
			   $name=$_POST['name']; 
			   $sql="SELECT  * FROM books WHERE name LIKE '%" . $name .  "%' OR ISBN LIKE '%" . $name ."%' OR category LIKE '%" . $name ."%' OR author LIKE '%" . $name ."%' OR publisher LIKE '%" . $name ."%'"; 
		  //-run  the query against the mysql query function 
		  $result=mysqli_query($db_conn,$sql); 
		  //-create  while loop and loop through result set 
		  while($row=mysqli_fetch_array($result)){ 
				  $id = $row['id'];
				  $book  = $row['name']; 
				  $isbn = $row['ISBN']; 
				  $author = $row['author'];
				  $publisher = $row['publisher'];
				  $cat = $row['category'];
				  //-display the result of the array 
				  	echo" <tr>";
					if ($name == $book)
						echo "<td><strong>$book</strong></td>";
					else echo "<td>$book</td>";
					if ($name == $isbn)
						echo "<td><strong>$isbn</strong></td>";
					else echo "<td>$isbn</td>";
					if ($name == $author)
						echo "<td><strong>$author</strong></td>";
					else echo "<td>$author</td>";
					if ($name == $publisher)
						echo "<td><strong>$publisher</strong></td>";
					else echo "<td>$publisher</td>";
					if ($name == $cat)
						echo "<td><strong>$cat</strong></td>";
					else echo "<td>$cat</td>";
					echo "</tr>"; 
			  }
	  }else{ 
	  echo  "<p>Please enter a search query</p>"; 
		  }
	?> 
    </tbody>
   </table>
    </div>

  </div> <!--moduleContainer -->
  <!-- ==== End Modules Contaner ==== -->


</div>

<script src="js/vendor.min.js"></script>
<script src="js/app.js"></script>
<script>
$(document).foundation();
</script>
</body>
</html>
