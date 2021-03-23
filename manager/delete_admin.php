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
$query="SELECT * FROM admin where id=$id";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);

$delete = "DELETE FROM privilege where username='$row[username]'";
$result= mysqli_query($db_conn, $delete) or die("Invalid query");

$del = "DELETE FROM branch where username='$row[username]'";
$res= mysqli_query($db_conn, $del) or die("Invalid query");

$delete1 = "DELETE FROM admin WHERE id=$id";
$result1= mysqli_query($db_conn, $delete1) or die("Invalid query");
if ($result && $result1 && $res) header("Location: home.php");
			else echo "Error: <br>" . mysqli_error($db_conn);
?>
</body>
</html>