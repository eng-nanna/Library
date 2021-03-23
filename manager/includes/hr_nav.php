<?php
if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
}
$query1="SELECT * FROM privilege where username='$row[username]'";
			$result1= mysqli_query($db_conn, $query1) or die("Invalid query");
			while($row1 = mysqli_fetch_array($result1)){
				$privilege = explode(',',$row1['privilege']);
			}
?>
<ul class="menu vertical sideSubMenu">
<?php if(in_array("employee",$privilege)) {
	?>
        <li><a href="staff.php">Staff</a></li>
<?php }
if(in_array("attend",$privilege)){
	?>
        <li><a href="attend.php">Attendence</a></li>
        <?php }
		if(in_array("jobs",$privilege)){
	?>
        <li><a href="jobs.php">Jobs</a></li>
        <?php }
		if(in_array("jobs",$privilege))
		{
	?>
        <li><a href="vacancies.php">New Vacancies</a></li>
        <?php }
			?>
</ul>