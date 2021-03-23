<?php
session_start();
include ("includes/config.php");
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Librarian")
	header("Location: index.php");
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] != "Librarian")
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
      <span>Update Book Details</span>
    </h1>

    <div class="padding-1em">
    <?php
			$id = $_GET['id'];
			$query="SELECT * FROM books where id='$id'";
			$result= mysqli_query($db_conn, $query) or die("Invalid query");
			$row = mysqli_fetch_array($result);
			
			$book = $row['name'];
			$query1="SELECT * FROM book_4mat where book_name='$book'";
			$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
			$row1 = mysqli_fetch_array($result1);
			
			$query2="SELECT * FROM b_copies where book_name='$book'";
			$result2= mysqli_query($db_conn, $query2) or die("Invalid query");
			$row2 = mysqli_fetch_array($result2);
			
			$query3="SELECT * FROM s_copies where book_name='$book'";
			$result3= mysqli_query($db_conn, $query3) or die("Invalid query");
			$row3 = mysqli_fetch_array($result3);
			
			$query4="SELECT * FROM prices where book_name='$book'";
			$result4= mysqli_query($db_conn, $query4) or die("Invalid query");
			$row4 = mysqli_fetch_array($result4);
			
			$query5="SELECT * FROM upload where name='$book'";
			$result5= mysqli_query($db_conn, $query5) or die("Invalid query");
			$row5 = mysqli_fetch_array($result5);
	  ?>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="bookName">book name:</label>
        <input type="text" id="bookName" name="bookName" value="<?php echo $row['name']; ?>">
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo $row['ISBN']; ?>">
        <select class="" id="Author" name="addAuthor">
         <option disabled selected>Author</option>
                      <?php
						$que="SELECT * FROM author";
						$resu= mysqli_query($db_conn, $que) or die("Invalid query");
						while($rowings = mysqli_fetch_array($resu)){
						?>
                        <option <?php if ($row['author'] == $rowings['author']) echo 'selected="selected"' ?>><?php echo $rowings['author'];?></option>
                        <?php
                }
         ?>
		</select>
        
        <label for="Publisher">Publisher Name:</label>
        <select class="" id="Publisher" name="addPub">
         <option disabled selected>Publisher</option>
                      <?php
						$querys="SELECT * FROM publisher";
						$resulting= mysqli_query($db_conn, $querys) or die("Invalid query");
						while($rowing = mysqli_fetch_array($resulting)){
						?>
                        <option <?php if ($row['publisher'] == $rowing['name']) echo 'selected="selected"' ?>><?php echo $rowing['name'];?></option>
                        <?php
                }
         ?>
        </select>
        
        <label for="year">Publish Year:</label>
        <select class="" id="p_year" name="p_year">
        <option disabled selected>Publish Year</option>
                      <?php
					  $cur_year =  date("Y");
						for($x=1900;$x<=$cur_year;$x++){
						?>
                        <option <?php if ($row['p_year'] == $x) echo 'selected="selected"' ?>><?php echo $x;?></option>
                        <?php
                }
         ?>
         </select>
        
        <label for="bookCat">Category:</label>
        <select class="" id="bookCat" name="bookCat">
         <option disabled selected>Category</option>
                      <?php
						$query="SELECT * FROM category";
						$result= mysqli_query($db_conn, $query) or die("Invalid query");
						while($rowing = mysqli_fetch_array($result)){
						?>
                        <option <?php if ($row['category'] == $rowing['name']) echo 'selected="selected"' ?>><?php echo $rowing['name'];?></option>
                        <?php
                }
         ?>
        </select>
        
        <label for="desc">Book Description:</label>
        <textarea name="desc" cols="50" rows="5"><?php echo $row['description'];?></textarea>

        <label for="bookType">Type:</label>
        <select class="" id="bookType" name="bookType">
          <option disabled selected>Type</option>
                <option <?php if ($row1['type'] == "h") echo 'selected="selected"' ?> value="h">Hard Copy</option>
                <option <?php if ($row1['type'] == "s") echo 'selected="selected"' ?> value="s">Soft Copy</option>
                <option <?php if ($row1['type'] == "b") echo 'selected="selected"' ?> value="b">Both</option>
        </select>
        
      
         <div id="hard">
         <div id="hard">
        <label for="addName">Branch:</label>
        <select class="" id="branch" name="branch">
         <option disabled selected>Branch</option>
                      <?php
						$query0="SELECT * FROM branch";
						$result0= mysqli_query($db_conn, $query0) or die("Invalid query");
						while($row0 = mysqli_fetch_array($result0)){
						?>
                        <option><?php if ($row2['branch'] == $row0['name']) echo 'selected="selected"' ?>><?php echo $row0['name'];?></option>
                        <?php
                }
         ?>
        </select>
        
        <label for="copies">No. of Borrowing Copies:</label>
        <input type="text" id="b_copies" name="b_copies" value="<?php echo $row2['copies']; ?>">
        
        <label for="copies">No. of Selleing Copies:</label>
        <input type="text" id="s_copies" name="s_copies" value="<?php echo $row3['copies']; ?>">
        <label for="price">Hard Copy Price:</label>
        <input type="text" id="hard_price" name="hard_price" value="<?php echo $row4['hard_price']; ?>">
        </div>
        </div>
       
        <div id="soft">
        <label for="link">Soft Copy link:</label>
        <select class="" id="link" name="link">
          <option disabled selected>Type</option>
                <option value="url">External URL Copy</option>
                <option value="upload">Upload</option>
        </select>
        
        <div id="url">
         <label for="url">Book URL:</label>
         <input type="text" id="bookURL" name="bookURL" value="<?php echo $row1['url']; ?>">
         </div>
         
         <div id="upload">
         <input type="file" name="files1" id="file1" class="inputfile" /><?php echo $row5['book']; ?>
         <label for="file1">Upload book</label>
		 </div>
         
         <label for="softType">Soft Copy available for:</label>
         <select class="" id="softType" name="softType">
          <option disabled selected>Available For</option>
                <option <?php if ($row1['soft_type'] == "r") echo 'selected="selected"' ?> value="r">Reading</option>
                <option <?php if ($row1['soft_type'] == "s") echo 'selected="selected"' ?> value="s">Selling</option>
                <option <?php if ($row1['soft_type'] == "b") echo 'selected="selected"' ?> value="b">Both</option>
        </select>
        
        <label for="price">Soft Copy Price:</label>
        <input type="text" id="soft_price" name="soft_price" value="0" placeholder="Soft Copy Price">
        
        </div>
       
        <img src="../img/books/<?php echo $row['pic']; ?>" style="width:150px; height:150px">
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">Choose a Book Cover</label>

        <input class="button expanded" type="submit" name="submit" value="UPDATE">
      </form>
    </div>
    <!-- padding-1em -->

<?php
		$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
        $min_file_w = 240;
		$max_file_w = 260;
		
		$min_file_h = 355;
		$max_file_h = 375;
        $path = "../img/books/"; // Covers Upload directory
		/*****************************************************/
		$valid_books = array("jpg", "png", "gif", "bmp","doc", "docx", "pdf", "txt");
        $max_file_size = 1048576000;
        $dir = "doc/"; // Upload directory
		/*****************************************************/
        if (isset($_POST['submit'])){
            $b_name = mysqli_real_escape_string($db_conn,$_POST['bookName']);
            $isbn = $_POST['isbn'];
			$author = mysqli_real_escape_string($db_conn,$_POST['addAuthor']);
			$publish = mysqli_real_escape_string($db_conn,$_POST['addPub']);
			$pub_year = $_POST['p_year'];
			$category = mysqli_real_escape_string($db_conn,$_POST['bookCat']);
			$desc = mysqli_real_escape_string($db_conn,$_POST['desc']);
			$link = "";
			$type = $_POST['bookType'];
			if (isset($_POST['softType'])){
				$softType = $_POST['softType'];
				if (isset($_POST['bookURL'])){
				$link = mysqli_real_escape_string($db_conn,$_POST['bookURL']);
				}else{
					$link = mysqli_real_escape_string($db_conn,$_FILES['files1']['name']);
				}
			}else 
				$softType = "";
			if (isset($_POST['branch']))
				$branch = mysqli_real_escape_string($db_conn,$_POST['branch']);
			else 
				$branch = "";
			$b_copies = $_POST['b_copies'];
			$s_copies = $_POST['s_copies'];
			$h_price = $_POST['hard_price'];
			$s_price = $_POST['soft_price'];
            /***********************************************/
			if (!empty($_FILES['files']['name'])){
			$pic = mysqli_real_escape_string($db_conn,$_FILES['files']['name']);	       
				if ($_FILES['files']['error'] == 0) {
                list($width,$height) = getimagesize($_FILES["files"]["tmp_name"]);	           
                if ($height < $min_file_h || $width < $min_file_w) {
					$message = "$pic is too small!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }elseif ($height > $max_file_h || $width > $max_file_w) {
					$message = "$pic is too big!.";
					echo "<script type='text/javascript'>alert('$message');</script>";
                }
                elseif( ! in_array(pathinfo($pic, PATHINFO_EXTENSION), $valid_formats) ){
					$message = "$pic is not a valid format";
					echo "<script type='text/javascript'>alert('$message');</script>";
                    }
            else{ // No error found! Move uploaded files 
                  if(move_uploaded_file($_FILES["files"]["tmp_name"], $path.$pic)) {
								 $result = mysqli_query($db_conn,"Update books SET name='$b_name', ISBN='$isbn', author='$author', publisher='$publish', p_year='$pub_year', category='$category', description='$desc', pic='$pic' where id = '$id'");
								 $result1 = mysqli_query($db_conn,"Update book_4mat SET book_name='$b_name', type='$type', url='$link', soft_type='$softType' where book_name = '$book'");
								 $result2 = mysqli_query($db_conn,"Update prices SET book_name='$b_name', soft_price='$s_price', hard_price='$h_price' where book_name = '$book'");
								 $result3 = mysqli_query($db_conn,"Update b_copies SET book_name='$b_name', branch='$branch', copies='$b_copies' , current_copies='$b_copies' where book_name = '$book'");
								 $result4 = mysqli_query($db_conn,"Update s_copies SET book_name='$b_name', branch='$branch', copies='$s_copies' where book_name = '$book'");
									if ($result && $result1 && $result2 && $result3 && $result4) echo "Book Information has been updated.";
									else{
										$message = "Error: " . mysqli_error($db_conn);
										echo "<script type='text/javascript'>alert('$message');</script>";
									}
								}  
							else {
								// Failure
								$message = "Try again";
								echo "<script type='text/javascript'>alert('$message');</script>";
							}        
							}
							}
					  }else{
			
				$result = mysqli_query($db_conn,"Update books SET name='$b_name', ISBN='$isbn', author='$author', publisher='$publish', p_year='$pub_year', category='$category', description='$desc' where id = '$id'");
								 $result1 = mysqli_query($db_conn,"Update book_4mat SET book_name='$b_name', type='$type', url='$link', soft_type='$softType' where book_name = '$book'");
								 $result2 = mysqli_query($db_conn,"Update prices SET book_name='$b_name', soft_price='$s_price', hard_price='$h_price' where book_name = '$book'");
								 $result3 = mysqli_query($db_conn,"Update b_copies SET book_name='$b_name', branch='$branch', copies='$b_copies' , current_copies='$b_copies' where book_name = '$book'");
								 $result4 = mysqli_query($db_conn,"Update s_copies SET book_name='$b_name', branch='$branch', copies='$s_copies' where book_name = '$book'");
					if ($result && $result1 && $result2 && $result3 && $result4) echo "Book Information has been updated.";
					else{
						$message = "Error: ". $result . mysqli_error($db_conn);
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				} 
				  }
        ?>

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
	$('#url').hide();
	$('#upload').hide();
    $('#bookType').change(function(){
        if($('#bookType').val() == 'h') {
            $('#hard').show();
			$('#soft').hide(); 
        } else if ($('#bookType').val() == 's') {
			$('#soft').show();
            $('#hard').hide(); 
        } else if ($('#bookType').val() == 'b') {
			$('#hard').show();
            $('#soft').show(); 
        }
    }).trigger('change');
	$('#link').change(function(){
        if($('#link').val() == 'url') {
            $('#url').show();
			$('#upload').hide(); 
        } else if ($('#link').val() == 'upload') {
			$('#upload').show();
            $('#url').hide(); 
        }
    });
});
</script>
</body>
</html>
