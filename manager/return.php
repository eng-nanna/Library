<?php
session_start();
include ("includes/config.php");

$id = $_GET['id'];
$query="SELECT * FROM borrows where id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM b_copies where book_name='$row[book_name]'";
$res1 = mysqli_query($db_conn, $sql1) or die("Invalid query");
$rows1 = mysqli_fetch_array($res1);

$status = "In Time";
$today = date('Y-m-d');
if($today > $row['book_return'])
	$status = "delay";
else
	$status = "In Time";

$sql = mysqli_query($db_conn,"Update borrows SET user_return='$today', status='$status' where id='$id'");
if ($sql){
	if($row['type'] == 'hard'){
			   $current_copies = $rows1['current_copies'];
			   $current_copies += 1;
			    $resulting = mysqli_query($db_conn,"Update b_copies SET current_copies='$current_copies' where book_name = '$row[book_name]'");
				if($resulting)
					header("Location: borrower.php");
		   }else header("Location: borrower.php");
	   }else{
	$message = "Error: " . $query . "<br>" . mysqli_error($db_conn);
	echo "<script type='text/javascript'>alert('$message');</script>";
} 
?>