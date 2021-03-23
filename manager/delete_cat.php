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
$query="SELECT * FROM category WHERE id = $id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
$name = $row['name'];

$del = "UPDATE books SET category = NULL WHERE category='$name'";
$res= mysqli_query($db_conn, $del) or die("Invalid query");

$delete = "DELETE FROM category WHERE id=$id";
$result= mysqli_query($db_conn, $delete) or die("Invalid query");
if ($res && $result) header("Location: catg.php");
			else echo "Error: " . $query . "<br>" . mysqli_error($db_conn);
?>
</body>
</html>