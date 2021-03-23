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

$delete1 = "DELETE FROM quotes WHERE id=$id";
$result1= mysqli_query($db_conn, $delete1) or die("Invalid query");
if ($result1) header("Location: books.php");
			else echo "Error: <br>" . mysqli_error($db_conn);
?>
</body>
</html>