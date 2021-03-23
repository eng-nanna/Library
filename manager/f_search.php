<?php
session_start();
include ("includes/config.php");
if(!isset($_SESSION["username"]))
{
    header("Location: index.php");
}
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
}
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$rowing = mysqli_fetch_array($result);
if ($rowing['type'] == "Administrator")
	$nav = "admin_nav.html";
elseif ($rowing['type'] == "Borrowing")
	$nav = "borrow_nav.html";
elseif ($rowing['type'] == "Librarian")
	$nav = "lib_nav.html";
elseif ($rowing['type'] == "Selling")
	$nav = "sell_nav.html";
elseif ($rowing['type'] == "HR")
	$nav = "hr_nav.html";
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
              <?php include("includes/$nav"); ?>
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
    <?php 
	  if(isset($_POST['submit'])){ 
			   $name=$_POST['name'];
			    
			   $sql="SELECT  * FROM books WHERE name LIKE '%" . $name .  "%' OR ISBN LIKE '%" . $name ."%' OR category LIKE '%" . $name ."%' OR author LIKE '%" . $name ."%' OR publisher LIKE '%" . $name ."%'"; 
		  //-run  the query against the mysql query function 
		  $result=mysqli_query($db_conn,$sql);
		  $count=mysqli_num_rows($result);
		  if ($count!=0){
			  if ($rowing['type'] != "Librarian"){
				  echo "No result found";
			  }else{
			  echo "<table width='100%'>
					<thead>
				  <th>Book Name</th>
				  <th>ISBN</th>
				  <th>Author</th>
				  <th>Publisher</th>
				  <th>Category</th>
				</thead>
				<tbody>"; 
		  //-create  while loop and loop through result set 
		  while($row=mysqli_fetch_array($result)){ 
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
		  echo "</tbody></table>";
			  }
		  }
			  
			  $sql="SELECT  * FROM admin WHERE username LIKE '%" . $name .  "%' OR type LIKE '%" . $name ."%'"; 
		  //-run  the query against the mysql query function 
		  $result=mysqli_query($db_conn,$sql);
		  $count=mysqli_num_rows($result);
		  if ($count!=0){
			  if ($rowing['type'] != "Administrator"){
				  echo "No result found";
			  }else{
			  echo "<table width='100%'><thead>
          <th>Admin Name</th>
          <th>Type</th>
        </thead>
        <tbody>"; 
		  //-create  while loop and loop through result set 
		  while($row=mysqli_fetch_array($result)){ 
				  $admin  = $row['username']; 
				  $type = $row['type']; 
				  //-display the result of the array 
				  	echo" <tr>";
					if ($name == $admin)
						echo "<td><strong>$admin</strong></td>";
					else echo "<td>$admin</td>";
					if ($name == $type)
						echo "<td><strong>$type</strong></td>";
					else echo "<td>$type</td>";
					echo "</tr>"; 
		  }
		  echo "</tbody></table>";
		  }
		  }
		  
		  $sql="SELECT  * FROM book_4mat WHERE book_name LIKE '%" . $name .  "%' OR url LIKE '%" . $name .  "%'"; 
		  //-run  the query against the mysql query function 
		  $result=mysqli_query($db_conn,$sql);
		  $count=mysqli_num_rows($result);
		  if ($count!=0){
			  if ($rowing['type'] != "Librarian"){
				  echo "No result found";
			  }else{
			  echo "<table width='100%'><thead>
			  <th>Book Name</th>
			  <th>Book URL</th>
			</thead>
			<tbody>"; 
		  //-create  while loop and loop through result set 
		  while($row=mysqli_fetch_array($result)){ 
				  $b_name = $row['book_name'];
				  $url = $row['url']; 
				  //-display the result of the array 
				  	echo" <tr>";
					if ($name == $b_name)
						echo "<td><strong>$b_name</strong></td>";
					else echo "<td>$b_name</td>";
					if ($name == $url)
						echo "<td><strong>$url</strong></td>";
					else echo "<td>$url</td>";
					echo "</tr>"; 
		  }
		  echo "</tbody></table>";
		  }
			  }
		  
		  $sql="SELECT  * FROM users WHERE username LIKE '%" . $name .  "%'"; 
		  //-run  the query against the mysql query function 
		  $result=mysqli_query($db_conn,$sql);
		  $count=mysqli_num_rows($result);
		  if ($count!=0){
			  echo "<table width='100%'><thead>
			  <th>User Name</th>
			  <th>Password</th>
			</thead>
			<tbody>"; 
		  //-create  while loop and loop through result set 
		  while($row=mysqli_fetch_array($result)){ 
				  $u_name = $row['username'];
				  $pass  = $row['password']; 
				  //-display the result of the array 
				  	echo" <tr>";
					if ($name == $u_name)
						echo "<td><strong>$u_name</strong></td>";
					else echo "<td>$u_name</td>";
					if ($name == $pass)
						echo "<td><strong>$pass</strong></td>";
					else echo "<td>$pass</td>";
					echo "</tr>"; 
		  }
		  echo "</tbody></table>";
		  }
		  
	  }else{ 
	  echo  "<p>Please enter a search query</p>"; 
		  }
	?> 
    
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
