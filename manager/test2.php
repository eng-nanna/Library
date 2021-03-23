<?php
include ("includes/config.php"); 
?>
 <div class="row small-up-1 medium-up-2 large-up-4 images-grid">
 <?php	  
$result = $_POST['selected'];
			   if ($result == "Show All"){
				   $sql="SELECT * FROM books";
			   }
			   else{
			   $sql="SELECT * FROM books where category='$result' || p_year='$result'";
			   }
			   $res= mysqli_query($db_conn, $sql) or die("Invalid query");
		  while($row = mysqli_fetch_array($res)){
			  ?>
        <div class="column">
          <a  href="sell_form.php?id=<?php echo $row['id'];?>"><img src="../img/books/<?php echo $row['pic'];?>" class="thumbnail" alt="<?php echo $row['name'];?>" style="height:200px; width:150px"></a>
        </div>
        <?php
			  }
         ?>