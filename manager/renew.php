<?php
session_start();
include ("includes/config.php");

$id = $_GET['id'];
$query="SELECT * FROM borrows where id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
$renew = date("Y-m-d", strtotime($row['b_date']. '+ 14 days'));
$sql = mysqli_query($db_conn,"Update borrows SET renew='$renew' where id='$id'");
if ($sql) header("Location: borrow_book.php");
else{
	$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
	echo "<script type='text/javascript'>alert('$message');</script>";
} 
?>