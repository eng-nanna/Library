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
      <span>Books</span>
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
          <th>Name</th>
          <th>Author</th>
          <th>Publisher</th>
          <th>Category</th>
          <th>Copies for selling</th>
          <th>Copies for borrowing</th>
        </thead>
        <tbody>
        <?php
		  $num_rec_per_page=10;
		  if (isset($_GET["page"])){
		      $page  = $_GET["page"];
		  }else{
			  $page=1;
		  } 
		  $start_from = ($page-1) * $num_rec_per_page;
		  
		  $query="SELECT * FROM books LIMIT $start_from, $num_rec_per_page";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
			  $query1="SELECT * FROM book_4mat Where book_name = '$row[name]'";
			  $res= mysqli_query($db_conn, $query1) or die("Invalid query");
			  $rows = mysqli_fetch_array($res);
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['author'];?></td>
            <td><?php echo $row['publisher'];?></td>
            <td><?php echo $row['category'];?></td>
            <td><?php echo $rows['sell_copies'];?></td>
            <td><?php echo $rows['borrow_copies'];?></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>
    <!-- padding-1em -->

    <ul class="pagination" role="navigation" aria-label="Pagination">
		<?php 
    $sql = "SELECT * FROM books"; 
    $rs_result = mysqli_query($db_conn, $sql); //run the query
    $total_records = mysqli_num_rows($rs_result);  //count number of records
    $total_pages = ceil($total_records / $num_rec_per_page); 
    
    echo "<li class='pagination-previous disabled'><a href='books_view.php?page=1'>".'First'."</a><span class='show-for-sr'>page</span></li> "; // Goto 1st page  
    
    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='books_view.php?page=".$i."'>".$i."</a></li> "; 
    }; 
    echo "<li class='pagination-next'><a href='books_view.php?page=$total_pages'>".'Last'."</a><span class='show-for-sr'>page</span></a></li> "; // Goto last page
    ?>
    </ul>

   

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
