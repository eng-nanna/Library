<?php
session_start();
include ("manager/includes/config.php");
include ("manager/includes/login.php");
$category = $_GET['cat'];
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Bookstore</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" />
  <link rel="stylesheet" href="css/app.css">
</head>

<body>

  <div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
      <div class="off-canvas position-left" id="offCanvas" data-off-canvas>
          <nav>
            <ul class="menu vertical">
              <li><a href="#">Home Links</a></li>
              <li><a href="#">Home Links</a></li>
              <li><a href="#">Home Links</a></li>
              <li><a href="#">Home Links</a></li>
              <li><a href="#">Home Links</a></li>
            </ul>
          </nav>
      </div>
      <!-- off-canvas-menu -->
      <div class="off-canvas-content" data-off-canvas-content>
        <header id="mainHeader">
          <div class="logoContainer">
            <div class="row">
              <div class="small-12 medium-2 column">
                <div id="logoWrap">
                  <a id="logo" href="/" title="Home Page"><img src="img/logo.png" alt="Bookstore Logo"></a>
                  <div class="mobile-icons show-for-small-only">

                    <a class="mobile-search" data-toggle="loginSection">
                      <i class="fa fa-search"></i>
                    </a>

                    <a href="#" class="cart">
                      <span class="alert badge">6</span>
                      <i class="fa fa-shopping-basket"></i>
                    </a>

                    <a href="#" data-toggle="offCanvas" class="show-menu">
                      <i class="fa fa-navicon"></i>
                    </a>

                  </div>
                </div>
                <!-- logowrap -->
              </div>
              <div class="small-12 medium-10 column">
                <div class="loginSection" id="loginSection" data-toggler=".show">
                  <form id="search-form" name="search-form" action="">
                    <input type="search" placeholder="Search Title, Author and more" />
                    <button type="button" name="search-submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </form>

                  <?php
					if (isset($_SESSION['user'])){
						$query="SELECT * FROM users WHERE mail = '$_SESSION[user]'";
						$result= mysqli_query($db_conn, $query) or die("Invalid query");
						$row = mysqli_fetch_array($result);
						$queries="SELECT * FROM cart WHERE user_id = '$row[id]'";
						$res= mysqli_query($db_conn, $queries) or die("Invalid query");
						$count=mysqli_num_rows($res);
						?>
              <span class="alert badge"><?php echo $count; ?></span>
              <i class="fa fa-shopping-basket"></i>
              <?php } ?>
            </a>

            <?php
			  if (!isset($_SESSION['user'])){
			?>
            <a href="#" class="hollow small button user-logIn" data-toggle="login-dropdown">
              <i class="fa fa-sign-in"></i> Login
            </a>
            <div class="dropdown-pane" id="login-dropdown" data-options="closeOnClick: true;" data-dropdown data-auto-focus="false">

              <div class="facebook-login">
                <a href="#" class="hollow small button expanded"> <i class="fa fa-facebook"></i> Facebook Login</a>
              </div>

              <span class="or"><strong>OR</strong></span>

              <form name="login-form" action="<?php $_SERVER['PHP_SELF']?>" method="post" data-abide novalidate>
                      <div class="row">
                        <div class="small-12 columns">
                          <label for="login-username">
                            Email
                          </label>
                          <input id="login-username" type="email" name="mail" required pattern="email">
                          <span class="form-error">
                            Type Your Email
                          </span>
                        </div>

                        <div class="small-12 columns">
                          <label for="login-password">Password</label>
                          <input id="login-password" type="password" name="pass" required pattern="password">
                          <span class="form-error">
                            Type Your Password
                          </span>
                        </div>

                       <div class="groupInputs">
                    <input type="submit" name="login" value="Login" class="tiny button">
                    <input type="submit" name="signup" value="Register" class="hollow tiny button">
                  </div>

                      </div>
                    </form>
            </div>
            <?php
				}else{
					$query="SELECT * FROM users where mail='$_SESSION[user]'";
					$result= mysqli_query($db_conn, $query) or die("Invalid query");
					$row = mysqli_fetch_array($result);
			  ?>

             <a href="#" class="user-logged" data-toggle="logout-dropdown">
                <span><?php echo $row['username'];?></span>
                <img src="http://placehold.it/40x40" alt="user avatar">
                <i class="fa fa-angle-down"></i>
              </a>
              <div class="dropdown-pane" id="logout-dropdown" data-dropdown data-auto-focus="false" data-options="closeOnClick:true;">
                <?php include("includes/user_menu.html"); ?>
              </div> 
          </div>
          <!-- loginSection -->
           <?php } ?>
            
                </div>
              </div>
            </div>
            <div class="menuContainer show-for-medium">
              <div class="row">
                <?php include("includes/main_nav.html"); ?>
              </div>
            </div>
          </header>
          <?php
			$quer="SELECT * FROM category WHERE name = '$category'";
			$res1= mysqli_query($db_conn, $quer) or die("Invalid query");
			$rows1=mysqli_fetch_array($res1);
			?>
        <div class="bookSection-image" style="background-image: url('img/cover/<?php echo $rows1['pic']; ?>')">
          <h1>
            <?php echo $category; ?>
            <?php
			$queries="SELECT * FROM books WHERE category = '$category'";
			$res= mysqli_query($db_conn, $queries) or die("Invalid query");
			$count=mysqli_num_rows($res);
			?>
            <span><?php echo $count; ?></span>
          </h1>
        </div>
        <!-- booksection-image -->

        <!-- breadcrumbs -->
        <div class="row">
          <div class="small-12 column">
            <nav aria-label="You are here:" role="navigation">
              <ul class="breadcrumbs">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="cat.php">Categories</a></li>
                <li class="disabled"><?php echo $category; ?></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- breadcrumbs -->

        <div class="row">
         <?php
		 $num_rec_per_page=10;
		  if (isset($_GET["page"])){
		      $page  = $_GET["page"];
		  }else{
			  $page=1;
		  } 
		  $start_from = ($page-1) * $num_rec_per_page;
		 
					  $sql="SELECT * FROM books WHERE category = '$category'";
					  $results= mysqli_query($db_conn, $sql) or die("Invalid query");
					  while($rows = mysqli_fetch_array($results)){
						  $book_name = $rows['name'];
						  $sql1="SELECT * FROM prices where book_name = '$book_name'";
						  $res= mysqli_query($db_conn, $sql1) or die("Invalid query");
						  $rowing = mysqli_fetch_array($res);
					  ?>
              <div class="small-12 medium-3 column">
                <div class="book-item">
                 <a href="book.php?id=<?php echo $rows['id']; ?>" class="item-bookcover">
                  <img src="img/books/<?php echo $rows['pic']; ?>" style="width:150px; height:220px" alt="book cover">
                </a>
                      <h1><a href="book.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></a></h1>
                <span class="by">by:
                    <strong><?php echo $rows['author']; ?></strong>
                  </span>
                <span class="rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                <div class="cta-button">
                  <?php if($rowing['hard_price'] != 0){ ?>
                        <div class="price"><?php echo $rowing['hard_price']; ?><small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                        <?php }else echo "<div class='borrow'><a href='#' style='color:#EF0000'>BORROW</a></div>"; ?>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->
				<?php } ?>
        </div>
        <!-- row -->
         <ul class="pagination text-center" role="navigation" aria-label="Pagination">
		<?php 
    $sql = "SELECT * FROM books WHERE category = '$category'"; 
    $rs_result = mysqli_query($db_conn, $sql); //run the query
    $total_records = mysqli_num_rows($rs_result);  //count number of records
    $total_pages = ceil($total_records / $num_rec_per_page); 
    
    echo "<li class='pagination-previous disabled'><a href='book-section.php?cat=".$category."&page=1'>".'First'."</a><span class='show-for-sr'>page</span></li> "; // Goto 1st page  
    
    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='book-section.php?cat=".$category."&page=".$i."'>".$i."</a></li> "; 
    }; 
    echo "<li class='pagination-next'><a href='book-section.php?cat=".$category."&page=$total_pages'>".'Last'."</a><span class='show-for-sr'>page</span></a></li> "; // Goto last page
    ?>
    </ul>

        <footer class="main-footer">
          <div class="row">
            <div class="medium-7 show-for-medium column">
              <div class="row">
                <div class="medium-6 column">
                  <nav class="footer-links">
                    <h4>About Us</h4>
                    <ul class="menu vertical">
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
                <div class="medium-6 column">
                  <nav class="footer-links">
                    <h4>Extras</h4>
                    <ul class="menu vertical">
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                      <li>
                        <a href="#" title="">
                          <i class="fa fa-angle-right"></i> Careers
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <!-- col -->
            <div class="small-12 medium-5 column">
              <div class="newsletters">
                <h4>Don't Miss Out</h4>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <form class="newsletters" action="" method="post" data-abide>
                  <div class="input-group">
                    <input required pattern="email" placeholder="Your Email" class="input-group-field" type="email">
                    <div class="input-group-button">
                      <input type="submit" class="button" value="Sign Up">
                    </div>
                  </div>
                  <!-- input-group -->
                </form>
              </div>
              <!-- newsletters -->
            </div>
            <!-- col -->
          </div>
          <!-- row -->
        </footer>
        <!-- main-footer -->

        <div class="copyright">
          <i class="fa fa-copyright "></i>
          Alef Library All Rights Reserved
        </div>
      </div>
      <!-- data-off-canvas-content -->
    </div>
  </div>
  <!-- off-canvas-wrapper -->



  <script src="js/vendor.min.js"></script>
  <script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
  <script src="js/app.js"></script>
</body>

</html>
