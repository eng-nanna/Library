<?php
session_start();
include ("manager/includes/config.php");
$mail = $_GET['user'];
/***************************************/
if (isset($_POST['submit'])){
	$mail = $_POST['email'];
	$f_name = $_POST['first'];
	$l_name = $_POST['last'];
	$username = $_POST['username'];
	$pass = md5($_POST['password']);
	$tel = $_POST['phone'];
	$area = $_POST['area'];
	$street = $_POST['street'];
	$building = $_POST['building'];
	$query = mysqli_query($db_conn,"INSERT INTO users (f_name,l_name,username,mail,password,tel,area,street,building,status) 
							  VALUES ('$f_name','$l_name','$username','$mail','$pass','$tel','$area','$street','$building','new member')");
	if ($query){
		$_SESSION['user'] = $mail;
		header("Location: index.php"); // Redirecting To Home Page
	}else{
		$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
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

                  <!-- wrap -->
                </div>
                <!-- loginSection -->
              </div>
            </div>
          </div>
          <div class="menuContainer show-for-medium">
            <div class="row">
              <?php include("includes/main_nav.html"); ?>
            </div>
          </div>
        </header>
        <!-- breadcrumbs -->

        <div class="loginForm">
          <div class="row medium-collapse">
            <div class="small-12 column">
              <h1 class="section-title white-title">
                <span>Login</span>
              </h1>
            </div>
            <div class="small-12 medium-5 column small-order-3 medium-order-1 large-order-1">
              <form action="" method="POST" data-abide novalidate>
                <div data-abide-error class="alert callout" style="display: none;">
                  <p><i class="fi-alert"></i> There are some errors in your form.</p>
                </div>

                <div class="row">
                  <div class="small-12 medium-6 column">
                    <label>First Name
                      <input type="text" name="first" value="" required>
                      <span class="form-error">
                        Yo, you had better fill this out, it's required.
                      </span>
                    </label>
                  </div>
                  <div class="small-12 medium-6 column">
                    <label>Last Name
                      <input type="text" name="last" value="" required>
                      <span class="form-error">
                        Yo, you had better fill this out, it's required.
                      </span>
                    </label>
                  </div>
                </div><!-- .row -->

                <label>Username
                  <input type="text" name="username" value="" required>
                  <span class="form-error">
                    Yo, you had better fill this out, it's required.
                  </span>
                </label>

                <label>Email
                  <input type="email" name="email" value="<?php echo $_GET['user']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                  <span class="form-error">
                    Yo, you had better fill this out, it's required.
                  </span>
                </label>
                <label>Password
                  <input type="password" name="password" value="" required pattern=".{6,}" title="Six or more characters">
                  <span class="form-error">
                    Yo, you had better fill this out, it's required.
                  </span>
                </label>
                
                <label>Phone
                  <input type="number" name="phone" value="" required pattern="number">
                </label> 
                
                 <label>
                  Area 
                  <select name="area">
                    <option>Ismailia</option>
                    <option>PortSaid</option>
                    <option>Suez</option>
                    <option>Cairo</option>
                    <option>Alex</option>
                  </select>
                  <span class="form-error">
                    Your area is required!
                  </span>
                </label>

                <label>
                  Street Name 
                  <input type="text" name="street" required>
                  <span class="form-error">
                    Street Name is required!
                  </span>
                </label>
                <label>
                  Building Number 
                  <input type="number" name="building" required>
                  <span class="form-error">
                    Building Number is required!
                  </span>
                </label>
               
                <input class="button expanded" type="submit" name="submit" value="SUBMIT">
              </form>
              <!-- form end -->
            </div>
            <div class="small-12 medium-2 column show-for-medium loginPage-or small-order-2 medium-order-2 large-order-3">
              <span>OR</span>
            </div><!-- OR -->
            <div class="small-12 medium-5 column small-order-1 medium-order-3 large-order-3 fb-container">
                <a href="#" class="large button facebook-btn"><i class="fa fa-facebook-square"></i> Login With Facebook</a>
            </div><!-- facebook login -->
          </div>
        </div>
        <!-- loginForm -->

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
