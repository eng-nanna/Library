<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
session_start();
include ("includes/config.php");
if(!isset($_SESSION["username"]))
{
    header("Location: index.php");
}
$id=$_GET['id'];
$query="SELECT * FROM contracts where id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
$filename = $row['attach']; //get the filename
unlink('contracts/'.DIRECTORY_SEPARATOR.$filename); //delete it

$delete = "DELETE FROM contracts WHERE id=$id";
$result= mysqli_query($db_conn, $delete) or die("Invalid query");
if ($result) header("Location: contract.php");
			else echo "Error: " . $result . "<br>" . mysqli_error($db_conn);
?>
</body>
</html>