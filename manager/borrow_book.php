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
      <span>Borrowed Books</span>
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
          <th>Username</th>
          <th>Borrowing date</th>
          <th>Renew Date</th>
          <th>Return Date</th>
          <th class="text-center">Return Book</th>
          <th class="text-center">Renew Borrowing</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM borrows";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
			  $current_date = date('Y-m-d');
			  $defult_return = date("Y-m-d", strtotime($row['b_date']. '+ 14 days'));
			  $defult_return1 = date("Y-m-d", strtotime($row['renew']. '+ 14 days'));
			  if ($row['book_return']=="0000-00-00" && $row['renew']=="0000-00-00" && $current_date > $defult_return ){
		  ?>
          <tr style="background:rgb(252, 250, 102)">
          <?php }elseif ($row['book_return']!="0000-00-00"  && $row['book_return'] > $defult_return ){ ?>
          <tr style="background:rgb(252, 250, 102)">
          <?php }elseif ($row['book_return']=="0000-00-00" && $row['renew']!="0000-00-00" && $current_date > $defult_return1 ){ ?>
          <tr style="background:rgb(252, 250, 102)">
          <?php }else{ ?>
          <tr>
          <?php } ?>
            <td><?php echo $row['book_name'];?></td>
            <td><?php echo $row['username'];?></td>
            <td><?php echo $row['b_date'];?></td>
            <td><?php if ($row['renew']=="0000-00-00") echo "NOT RENEWED";
					  else echo $row['renew']; ?></td>
            <td><?php if ($row['book_return']=="0000-00-00" && $row['renew']=="0000-00-00")
							echo "NOT RETURNED YET";
							elseif ($row['book_return']=="0000-00-00" && $row['renew']!="0000-00-00") echo "RENEWED";
							else echo $row['book_return'];?></td>
            <td class="text-center editRow"><?php if ($row['book_return']=="0000-00-00")
							echo "<a href='return.php?id=$row[id]'><i class='fa fa-hourglass-end'></i></a>";
							else echo "";?></td>
            <td class="text-center removeRow"><?php if ($row['book_return']=="0000-00-00")
							echo "<a href='renew.php?id=$row[id]'><i class='fa fa-repeat'></i></a>";
							else echo "";?></td> 
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

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
</body>
</html>
