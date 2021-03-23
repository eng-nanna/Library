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
      <span>Books</span>
    </h1>

    <div class="padding-1em">

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      Choose how to filter :<select id="filter" name="filter">
                <option >-Select Your Filteration-</option>
                <option value="cat">Category</option>
                <option value="pub">Publish Year</option>
            </select>
                <div id="div1">
        <select id="filter" name="filter" onchange="fetch_select(this.value);">
          <option>Show All</option>
                      <?php
						$query="SELECT * FROM category";
						$result= mysqli_query($db_conn, $query) or die("Invalid query");
						while($row = mysqli_fetch_array($result)){
						?>
                        <option><?php echo $row['name'];?></option>
                        <?php
                }
         ?>
        </select>
        </div><div id="div2">
        <select id="filter" name="filter" onchange="fetch_select(this.value);">
          <option>Show All</option>
                      <?php
					  $cur_year =  date("Y");
						for($x=1900;$x<=$cur_year;$x++){
						?>
                        <option><?php echo $x;?></option>
                        <?php
                }
         ?>
        </select>
        </div>
        
      </form>

		<div  id="DisplayDiv">
      <div class="row small-up-1 medium-up-2 large-up-4 images-grid">
       <?php
	 	  $num_rec_per_page=20;
		  if (isset($_GET["page"])){
		      $page  = $_GET["page"];
		  }else{
			  $page=1;
		  } 
		  $start_from = ($page-1) * $num_rec_per_page;
		  
		  $query="SELECT * FROM books";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
			  ?>
        <div class="column">
          <a  href="borrow_form.php?id=<?php echo $row['id'];?>"><img src="../img/books/<?php echo $row['pic'];?>" class="thumbnail" alt="<?php echo $row['name'];?>" style="height:200px; width:150px"></a>
        </div>
        <?php
			  }
         ?>
      </div>
    </div>
    </div>
    <!-- padding-1em -->

    <ul class="pagination" role="navigation" aria-label="Pagination">
		<?php 
    $sql = "SELECT * FROM books"; 
    $rs_result = mysqli_query($db_conn, $sql); //run the query
    $total_records = mysqli_num_rows($rs_result);  //count number of records
    $total_pages = ceil($total_records / $num_rec_per_page); 
    
    echo "<li class='pagination-previous disabled'><a href='borrow.php?page=1'>".'First'."</a><span class='show-for-sr'>page</span></li> "; // Goto 1st page  
    
    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='borrow.php?page=".$i."'>".$i."</a></li> "; 
    }; 
    echo "<li class='pagination-next'><a href='borrow.php?page=$total_pages'>".'Last'."</a><span class='show-for-sr'>page</span></a></li> "; // Goto last page
    ?>
    </ul>

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

 <script src="https://code.jquery.com/jquery-1.7.2.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
    $('#div1').hide();
	$('#div2').hide(); 
    $('#filter').change(function(){
        if($('#filter').val() == 'cat') {
            $('#div1').show();
			$('#div2').hide(); 
        } else if ($('#filter').val() == 'pub') {
			$('#div2').show();
            $('#div1').hide(); 
        }
    });
});
	</script>

 <script>
	function fetch_select(val)
{
	
   $.ajax({
     type: 'post',
     url: 'test.php',
     data: {
       selected:val
     },
     success: function (response) {
       document.getElementById("DisplayDiv").innerHTML=response; 
     }
   });
}
	</script>
</body>
</html>
