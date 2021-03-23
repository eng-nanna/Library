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
                  <div class="loginSection">
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

          <section id="mainSlider">
            <h1 class="hide-title">Main Slider</h1>
            <ul class="mainSlider">
               <?php
		  $query="SELECT * FROM slider";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
            <li>
              <a><img src="img/slider/<?php echo $row['pic'];?>" alt="slide image"></a>
            </li>
             <?php
                }
         ?>
            </ul>
          </section>
          <!-- main slider -->

          <div class="row">
            <div class="small-12 column">
              <section class="section-style">
                <h1 class="section-title">
                    <span>Last added</span>
                </h1>
                <div class="row multiple-items">
                 <?php
					  $query="SELECT * FROM books ORDER BY id DESC LIMIT 8";
					  $result= mysqli_query($db_conn, $query) or die("Invalid query");
					  while($row = mysqli_fetch_array($result)){
						  $book_name = $row['name'];
						  $sql="SELECT * FROM prices where book_name = '$book_name'";
						  $res= mysqli_query($db_conn, $sql) or die("Invalid query1");
						  $rowing = mysqli_fetch_array($res);
					  ?>
                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <a href="book.php?id=<?php echo $row['id']; ?>" class="item-bookcover">
                          <img src="img/books/<?php echo $row['pic']; ?>" style="width:150px; height:220px" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </a>
                      <h1><a href="book.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h1>
                      <span class="by">by:
                          <strong><?php echo $row['author']; ?></strong>
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
                <!-- .row -->
              </section>
            </div>
          </div>
          <!-- row -->

          <!-- Ads Section -->
          <div class="row">
            <div class="small-12 column">
              <div class="ad text-center">
                <a href="#" title="ad">
                  <img src="http://placehold.it/728x90" alt="">
                </a>
              </div>
            </div>
          </div>
          <!-- End Ads Section -->

          <main>
            <div class="row">
              <div class="small-12 medium-9 small-order-1 medium-order-2 column">

                <section class="section-style">
                  <h1 class="section-title">
                      <span>Best selling</span>
                    </h1>
                  <div class="row">
                  <?php
				$query = "SELECT book_name, sum( copies ) 
						FROM selling 
						GROUP BY book_name
						ORDER BY sum( copies ) DESC
						LIMIT 8";
				$result= mysqli_query($db_conn, $query) or die("Invalid query");
		  		while($row = mysqli_fetch_array($result)){
			    	$query1="SELECT * FROM books WHERE name= '$row[book_name]'";
					$result1= mysqli_query($db_conn, $query1) or die("Invalid query1");
					$row1 = mysqli_fetch_array($result1);
					$book_name = $row1['name'];
					$sql="SELECT * FROM prices where book_name = '$book_name'";
					$res= mysqli_query($db_conn, $sql) or die("Invalid query");
					$rowing = mysqli_fetch_array($res);
				?>
                    <div class="small-12 medium-4 large-3 column">
                    <div class="book-item">
                      <a href="book.php?id=<?php echo $row1['id']; ?>" class="item-bookcover">
                          <img src="img/books/<?php echo $row1['pic']; ?>" style="width:150px; height:220px" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </a>
                      <h1><a href="book.php?id=<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></a></h1>
                      <span class="by">by:
                          <strong><?php echo $row1['author']; ?></strong>
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
                   
                  <!-- .row -->
                </section>
              </div>
              <div class="small-12 medium-3 small-order-2 medium-order-1 column">
                <aside class="section-side">
                  <section class="widget">
                    <h5>Books By Subject</h5>
                    <nav>
                      <ul class="menu vertical aside-nav">
                      <?php
					  $query="SELECT * FROM category";
					  $result= mysqli_query($db_conn, $query) or die("Invalid query");
					  while($row = mysqli_fetch_array($result)){
					  ?>
                        <li>
                          <a href="book-section.php?cat=<?php echo $row['name']; ?>">
                            <i class="fa fa-angle-right"></i> <?php echo $row['name']; ?></a>
                        </li>
                        <?php }?>
                      </ul>
                    </nav>
                  </section>
                </aside>
              </div>
            </div>
          </main>



          <div class="row">
            <div class="small-12 column">
              <section class="section-style">
                <h1 class="section-title">
                    <span>Top Rated</span>
                  </h1>
                <div class="row multiple-items">

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                     <a href="book.php?id=<?php echo $row1['id']; ?>" class="item-bookcover">
                          <img src="img/books/<?php echo $row1['pic']; ?>" style="width:150px; height:220px" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </a>
                      <h1><a href="book.php?id=<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></a></h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                  <div class="small-12 medium-4 large-2 column">
                    <div class="book-item">
                      <span class="item-bookcover">
                          <img src="img/cover1.jpg" width="150" height="220" alt="book cover">
                          <!-- <img src="http://placehold.it/150x220" width="150" height="220" alt="book cover"> -->
                        </span>
                      <h1>Game Of Throns Song of ice & fire</h1>
                      <span class="by">by:
                          <strong>James Bond</strong>
                        </span>
                      <span class="rate">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      <div class="cta-button">
                        <div class="price">85<small>EGP</small>
                        </div>
                        <a href="#" class="button">
                          <i class="fa fa-shopping-basket"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- .book-item -->

                </div>
                <!-- .row -->
              </section>
            </div>
          </div>

          <footer class="main-footer">
            <div class="row">
              <div class="small-12 medium-7 show-for-medium column">
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
		<?php include("includes/copy_right.html"); ?>
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
