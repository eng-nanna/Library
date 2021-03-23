<?php
session_start();
include ("manager/includes/config.php");
include ("manager/includes/login.php");
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Bookstore | Book Name</title>
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

                  <a href="#" class="cart">
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
					$name = $row['username'];
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
        <!-- breadcrumbs start -->

        <div class="bookSection-image" style="background: #02795F">
          <h1>
            <?php echo ucwords($row['f_name'] ." ". $row['l_name'] ." Profile");?> 
          </h1>
        </div>
        <!-- booksection-image -->

        <div class="row">
          <div class="small-12 column">
            <nav aria-label="You are here:" role="navigation">
              <ul class="breadcrumbs">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="disabled">User Profile</li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- breadcrumbs end -->


        <!-- user profile start -->
        <div class="row collapse">

          <div class="medium-3 column">
            <ul class="tabs vertical admin-tabs" id="user-data" data-tabs>
              <li class="tabs-title is-active">
                <a href="#personal-info" aria-selected="true">
                  <i class="fa fa-info-circle"></i>
                   Personal Info
                </a>
              </li>
              <li class="tabs-title">
                <a href="#my-orders"><i class="fa fa-list"></i> Your Orders</a>
              </li>
              <li class="tabs-title">
                <a href="#borrow"><i class="fa fa-book"></i> Books you borrowed</a>
              </li>
            </ul>
          </div><!-- medium-3 -->


          <div class="medium-9 column">

            <div class="tabs-content vertical admin-tabs" data-tabs-content="user-data">

              <div class="tabs-panel is-active" id="personal-info">
                <table class="personalInfo-table">
                  <tr>
                    <td width="150">Your Name</td>
                    <td><?php echo ucwords($row['f_name'] ." ". $row['l_name']);?></td>
                    <td width="90" class="edit-info">
                      <a class="small alert hollow radius button" href="#">
                        <i class="fa fa-pencil"></i> Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td width="150">Username</td>
                    <td><?php echo $row['username']; ?></td>
                    <td width="90" class="edit-info">
                      <a class="small alert hollow radius button" href="#">
                        <i class="fa fa-pencil"></i> Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td width="150">Your Email</td>
                    <td><?php echo $row['mail']; ?></td>
                    <td width="90" class="edit-info">
                      <a class="small alert hollow radius button" href="#">
                        <i class="fa fa-pencil"></i> Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td width="150">Your Addrss</td>
                    <td>
                      <?php echo ucwords($row['area'] ." - ". $row['street'] ." - Building no. ". $row['building']);?>
                    </td>
                    <td width="90" class="edit-info">
                      <a class="small alert hollow radius button" href="#">
                        <i class="fa fa-pencil"></i> Edit
                      </a>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- personal-info -->

              <div class="tabs-panel" id="my-orders">
                <table class="admin-table">
                  <thead>
                    <tr>
                      <th width="150">Cover</th>
                      <th>Book Title</th>
                      <th>Quantity</th>
                      <th width="120">Unit Price</th>
                      <th width="120">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
					  $sell_sql="SELECT * FROM selling where username = '$row[username]'";
					  $sell_res= mysqli_query($db_conn, $sell_sql) or die("Invalid query");
					  while($sell_row = mysqli_fetch_array($sell_res)){
						  $sell_book="SELECT * FROM books where name = '$sell_row[book_name]'";
					  	  $sb_res= mysqli_query($db_conn, $sell_book) or die("Invalid query");
						  $sb_row = mysqli_fetch_array($sb_res);
						  $price="SELECT * FROM prices where book_name = '$sell_row[book_name]'";
						  $price_res= mysqli_query($db_conn, $price) or die("Invalid query");
						  $price_row = mysqli_fetch_array($price_res);
					  ?>
                    <tr>
                      <td>
                        <a href="#">
                          <img src="img/books/<?php echo $sb_row['pic']; ?>" style="width:150px; height:210px" alt="book cover">
                        </a>
                      </td>
                      <td>
                        <div class="book-item">
                          <a href="#">
                            <h5><?php echo $sb_row['name']; ?></h5>
                          </a>
                          <span class="by">by:
                            <strong><a href="#"><?php echo $sb_row['author']; ?></a></strong>
                          </span>
                          <span class="rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </span>
                        </div><!-- book item -->
                      </td>
                      <td>
                        <?php echo $sell_row['copies']; ?>
                      </td>
                      <td>
                        <?php echo $price_row['hard_price']; ?> <strong>EGP</strong>
                      </td>
                      <td>
                        <?php echo $sell_row['sell_date']; ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tabs-panel" id="borrow">
                <table class="admin-table">
                  <thead>
                    <tr>
                      <th width="150">Cover</th>
                      <th>Book Title</th>
                      <th width="120">Borrowing Date</th>
                      <th width="120">Returning Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					  $borrow_sql="SELECT * FROM borrows where username = '$row[username]'";
					  $borrow_res= mysqli_query($db_conn, $borrow_sql) or die("Invalid query");
					  while($borrow_row = mysqli_fetch_array($borrow_res)){
						  $borrow_book="SELECT * FROM books where name = '$borrow_row[book_name]'";
					  	  $bb_res= mysqli_query($db_conn, $borrow_book) or die("Invalid query");
						  $bb_row = mysqli_fetch_array($bb_res);
					  ?>
                    <tr>
                      <td>
                        <a href="#">
                          <img src="img/books/<?php echo $bb_row['pic']; ?>" style="width:150px; height:210px" alt="book cover">
                        </a>
                      </td>
                      <td>
                        <div class="book-item">
                          <a href="#">
                            <h5><?php echo $bb_row['name']; ?></h5>
                          </a>
                          <span class="by">by:
                            <strong><a href="#"><?php echo $bb_row['author']; ?></a></strong>
                          </span>
                          <span class="rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </span>
                        </div><!-- book item -->
                      </td>
                      <td>
                        <?php echo $borrow_row['b_date']; ?>
                      </td>
                      <td>
                        <?php echo $borrow_row['book_return']; ?>
                      </td>
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div><!-- tabs-content -->
          </div>
        </div>
        <!-- user profile end -->

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
