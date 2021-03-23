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
      <span>Books</span>
      <a data-open="addUser" class="button">add Book</a>
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
          <th>Publish Year</th>
          <th class="text-center">Quotes</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
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
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['author'];?></td>
            <td><?php echo $row['publisher'];?></td>
            <td><?php echo $row['p_year'];?></td>
            <td class="text-center editRow"><a href="quotes.php?id=<?php echo $row['id'];?>"><i class="fa fa-plus-circle"></i></a></td>
            <td class="text-center editRow"><a href="update_book.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_book.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
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
    
    echo "<li class='pagination-previous disabled'><a href='books.php?page=1'>".'First'."</a><span class='show-for-sr'>page</span></li> "; // Goto 1st page  
    
    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='books.php?page=".$i."'>".$i."</a></li> "; 
    }; 
    echo "<li class='pagination-next'><a href='books.php?page=$total_pages'>".'Last'."</a><span class='show-for-sr'>page</span></a></li> "; // Goto last page
    ?>
    </ul>

    <div class="reveal" id="addUser" data-reveal>
      <h3 class="">
        <span>Add Book</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label for="bookName">book name:</label>
        <input type="text" id="bookName" name="bookName" value="" placeholder="Your Name">
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="" placeholder="ISBN">
        <label for="author">Author Name:</label>
        <select class="" id="Author" name="addAuthor">
         <option disabled selected>Author</option>
                      <?php
						$querys="SELECT * FROM Author";
						$results= mysqli_query($db_conn, $querys) or die("Invalid query");
						while($rowing = mysqli_fetch_array($results)){
						?>
                        <option><?php echo $rowing['author'];?></option>
                        <?php
                }
         ?>
		</select>
        
        <label for="Publisher">Publisher Name:</label>
        <select class="" id="Publisher" name="addPub">
         <option disabled selected>Publisher</option>
                      <?php
						$querys="SELECT * FROM publisher";
						$results= mysqli_query($db_conn, $querys) or die("Invalid query");
						while($rowing = mysqli_fetch_array($results)){
						?>
                        <option><?php echo $rowing['name'];?></option>
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
                        <option><?php echo $x;?></option>
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
						while($row = mysqli_fetch_array($result)){
						?>
                        <option><?php echo $row['name'];?></option>
                        <?php
                }
         ?>
        </select>
        
        <label for="desc">Book Description:</label>
        <textarea name="desc" cols="50" rows="5"></textarea>

        <label for="bookType">Type:</label>
        <select class="" id="bookType" name="bookType">
          <option disabled selected>Type</option>
                <option value="h">Hard Copy</option>
                <option value="s">Soft Copy</option>
                <option value="b">Both</option>
        </select>
        
        <div id="hard">
        <label for="addName">Branch:</label>
        <select class="" id="branch" name="branch">
         <option disabled selected>Branch</option>
                      <?php
						$query="SELECT * FROM branch";
						$result= mysqli_query($db_conn, $query) or die("Invalid query");
						while($row = mysqli_fetch_array($result)){
						?>
                        <option><?php echo $row['name'];?></option>
                        <?php
                }
         ?>
        </select>
        
        <label for="copies">No. of Borrowing Copies:</label>
        <input type="text" id="b_copies" name="b_copies" value="0" placeholder="Num. of Copies">
        
        <label for="copies">No. of Selleing Copies:</label>
        <input type="text" id="s_copies" name="s_copies" value="0" placeholder="Num. of Copies">
        
        <label for="price">Hard Copy Price:</label>
        <input type="text" id="hard_price" name="hard_price" value="" placeholder="Hard Copy Price">
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
         <input type="text" id="bookURL" name="bookURL" value="" placeholder="Book URL">
         </div>
         
         <div id="upload">
         <input type="file" name="files1" id="file1" class="inputfile" />
         <label for="file1">Upload book</label>
		 </div>
         
         <label for="softType">Soft Copy available for:</label>
         <select class="" id="softType" name="softType">
          <option disabled selected>Available For</option>
                <option value="r">Reading</option>
                <option value="s">Selling</option>
                <option value="b">Both</option>
        </select>
        
        <label for="price">Soft Copy Price:</label>
        <input type="text" id="soft_price" name="soft_price" value="0" placeholder="Soft Copy Price">
        
         </div>
         
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">Choose a Book Cover</label>

        <input class="button expanded" type="submit" name="submit" value="Add Book">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->

  </div> <!--moduleContainer -->
  <!-- ==== End Modules Contaner ==== -->

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
			$pic = mysqli_real_escape_string($db_conn,$_FILES['files']['name']);
			$b_copies = $_POST['b_copies'];
			$s_copies = $_POST['s_copies'];
			$h_price = $_POST['hard_price'];
			$s_price = $_POST['soft_price'];
            /***********************************************/
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
					  if(!empty($_FILES['files1']['name'])){
						   if ($_FILES['files1']['error'] == 0) {
								$file_size = $_FILES["files1"]["size"];
								$link = $_FILES["files1"]["name"];           
								if ($file_size > $max_file_size) {
									$message = "$link is too large!.";
									echo "<script type='text/javascript'>alert('$message');</script>";
								}
								if( ! in_array(pathinfo($link, PATHINFO_EXTENSION), $valid_books) ){
									$message = "$link is not a valid format";
									echo "<script type='text/javascript'>alert('$message');</script>";
								}else{ // No error found! Move uploaded files 
								  if(move_uploaded_file($_FILES["files1"]["tmp_name"], $dir.$link)) {
								 $res = mysqli_query($db_conn,"INSERT INTO upload (name,book) VALUES ('$b_name','$link')");
								 $result = mysqli_query($db_conn,"INSERT INTO books (name,isbn,author,publisher,p_year,category,description,pic) VALUES ('$b_name','$isbn','$author','$publish','$pub_year','$category','$desc','$pic')");
								 $result1 = mysqli_query($db_conn,"INSERT INTO book_4mat (book_name,type,url,soft_type) VALUES ('$b_name','$type','$link','$softType')");
								 $result2 = mysqli_query($db_conn,"INSERT INTO prices (book_name,soft_price,hard_price) VALUES ('$b_name','$s_price','$h_price')");
								 $result3 = mysqli_query($db_conn,"INSERT INTO b_copies (book_name,branch,copies,current_copies) VALUES ('$b_name','$branch','$b_copies','$b_copies')");
								 $result4 = mysqli_query($db_conn,"INSERT INTO s_copies (book_name,branch,copies) VALUES ('$b_name','$branch','$s_copies')");
									if ($result && $result1 && $result2 && $result3 && $result4 && $res) echo "New book has been uploaded.";
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
			
				 $result = mysqli_query($db_conn,"INSERT INTO books (name,isbn,author,publisher,p_year,category,description,pic) VALUES ('$b_name','$isbn','$author','$publish','$pub_year','$category','$desc','$pic')");
				 $result1 = mysqli_query($db_conn,"INSERT INTO book_4mat (book_name,type,url,soft_type) VALUES ('$b_name','$type','$link','$softType')");
				 $result2 = mysqli_query($db_conn,"INSERT INTO prices (book_name,soft_price,hard_price) VALUES ('$b_name','$s_price','$h_price')");
				 $result3 = mysqli_query($db_conn,"INSERT INTO b_copies (book_name,branch,copies,current_copies) VALUES ('$b_name','$branch','$b_copies','$b_copies')");
				 $result4 = mysqli_query($db_conn,"INSERT INTO s_copies (book_name,branch,copies) VALUES ('$b_name','$branch','$s_copies')");
					if ($result && $result1 && $result2 && $result3 && $result4) echo "New book has been added.";
					else{
						$message = "Error: ". $result . mysqli_error($db_conn);
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				} 
				  }
			else {
				// Failure
				$message = "Try again";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}        
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
    $('#hard').hide();
	$('#soft').hide(); 
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
    });
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
