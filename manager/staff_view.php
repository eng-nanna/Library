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
      <span>Admins</span>
      <a data-open="addAdmin" class="button">add employee</a>
    </h1>

    <div class="padding-1em">
    <!-- search box -->
        <form  method="post" action="s_search.php"  id="searchform">
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
          <th>Category</th>
          <th>Salary</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </thead>
        <tbody>
         <?php
		  $query="SELECT * FROM staff";
		  $result= mysqli_query($db_conn, $query) or die("Invalid query");
		  while($row = mysqli_fetch_array($result)){
		  ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['category'];?></td>
            <td><?php echo $row['salary'];?></td>
            <td class="text-center editRow"><a href="update_staff.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o"></i></a></td>
            <td class="text-center removeRow"><a href="delete_staff.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove"></i></a></td>
          </tr>
          <?php
                }
         ?>
        </tbody>
      </table>
    </div>

    <div class="reveal" id="addAdmin" data-reveal>
      <h3 class="">
        <span>Add Employee</span>
      </h3>
      <form class="addForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" placeholder="Employee Name">
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" placeholder="Age">
        
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" placeholder="Salary">
        
        <label for="cat">Category:</label>
        <select id="cat" class="" name="cat">
          <option value="" disabled selected>Category</option>
          <option>HR</option>
          <option>Borrowing</option>
          <option>Selling</option>
          <option>Financial</option>
          <option>Clients</option>
        </select>
        
        <label for="exp">Experience Years:</label>
        <input type="number" id="exp" name="exp" placeholder="Experience years">
        
        <label for="hire">Hiring Date:</label>
        <input type="text" id="datepicker" name="hire" placeholder="Hiring date">
        
        <label for="adrs">Address:</label>
        <input type="text" id="adrs" name="adrs" placeholder="Address">
        
        <label for="phone">Phone number:</label>
        <input type="text" id="phone" name="phone" placeholder="Phone Number">
        
        <label for="military">Military:</label>
        <select id="military" class="" name="military">
          <option value="" disabled selected>Status</option>
          <option>Exemption</option>
          <option>Complete the service Military</option>
		  <option>Postponed</option>
		  <option>Currently serving </option>
		  <option>Does not apply</option>
        </select>
        
        <input class="button expanded" type="submit" name="submit" value="Add Employee">
      </form>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- reveal -->
    <?php
 if (isset($_POST['submit'])){
   $f_name = $_POST['name'];
   $age = $_POST['age'];
   $salary = $_POST['salary'];
   $category = $_POST['cat'];
   $date = $_POST['hire'];
   $exp = $_POST['exp'];
   $adrs = $_POST['adrs'];
   $phone = $_POST['phone'];
   $military = $_POST['military'];
   $query = mysqli_query($db_conn,"INSERT INTO staff (name,age,salary,category,start_date,experience,address,phone,military) 
          VALUES ('$f_name','$age','$salary','$category','$date','$exp','$adrs','$phone','$military')");
   if ($query){
	   $message = "New staff member has been added.";
	   echo "<script type='text/javascript'>alert('$message');</script>";
   }
        else{
			$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
			echo "<script type='text/javascript'>alert('$message');</script>";
		}  
 }
 ?> 

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
