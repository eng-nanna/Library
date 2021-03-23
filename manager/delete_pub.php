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
$query="SELECT * FROM publisher WHERE id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
$name = $row['name'];

$del = "UPDATE books SET publisher = NULL WHERE publisher='$name'";
$res= mysqli_query($db_conn, $del) or die("Invalid query");

$delete = "DELETE FROM publisher WHERE id=$id";
$result= mysqli_query($db_conn, $delete) or die("Invalid query1");
if ($res && $result) header("Location: pub.php");
			else echo "Error: " . $query . "<br>" . mysqli_error($db_conn);
?>
</body>
</html>