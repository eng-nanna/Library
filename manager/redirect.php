<?php
session_start();
include ("includes/config.php");
if(!isset($_SESSION["username"]) || !isset($_COOKIE["username"]))
{
    header("Location: index.php");
}

if(isset($_COOKIE["username"])) {
$admin = $_COOKIE["username"];
}else if(isset($_SESSION["username"])) {
$admin = $_SESSION["username"];
}
$query="SELECT * FROM admin where username = '$admin'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
if ($row['type'] == "Administrator")
	header("Location: home.php");
elseif ($row['type'] == "Borrowing")
	header("Location: borrow.php");
elseif ($row['type'] == "Librarian")
	header("Location: books.php");
elseif ($row['type'] == "Selling")
	header("Location: sell.php");
elseif ($row['type'] == "HR")
	header("Location: staff.php");
?>