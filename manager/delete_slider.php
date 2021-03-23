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
$id = $_GET['id'];
$query="SELECT * FROM slider where id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
 $filename = $row['pic']; //get the filename
unlink('../img/slider/'.DIRECTORY_SEPARATOR.$filename); //delete it

$delete = "DELETE FROM slider WHERE id=$id";
$result = mysqli_query($db_conn, $delete) or die("Invalid query");
if ($result) header("Location: slider.php");
			else echo "Error: <br>" . mysqli_error($db_conn);
?>
</body>
</html>