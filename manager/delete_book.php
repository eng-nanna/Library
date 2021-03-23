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
$query="SELECT * FROM books where id='$id'";
$result= mysqli_query($db_conn, $query) or die("Invalid query");
$row = mysqli_fetch_array($result);
$book = $row['name'];
unlink('../img/books/'.DIRECTORY_SEPARATOR.$row['pic']); //delete it

$sql = "SELECT * FROM upload where name='$book'";
$res= mysqli_query($db_conn, $sql) or die("Invalid query");
$count=mysqli_num_rows($res);
$rows = mysqli_fetch_array($res);
if ($count == 1)
	unlink('../manager/doc/'.DIRECTORY_SEPARATOR.$rows['book']); //delete it
	
$delete = "DELETE FROM upload WHERE name='$book'";
$result= mysqli_query($db_conn, $delete) or die("Invalid query");

$delete1 = "DELETE FROM books WHERE id=$id";
$result1= mysqli_query($db_conn, $delete1) or die("Invalid query");

$delete2 = "DELETE FROM book_4mat WHERE book_name='$book'";
$result2= mysqli_query($db_conn, $delete2) or die("Invalid query");

$delete3 = "DELETE FROM prices WHERE book_name='$book'";
$result3= mysqli_query($db_conn, $delete3) or die("Invalid query");

$delete4 = "DELETE FROM b_copies WHERE book_name='$book'";
$result4= mysqli_query($db_conn, $delete4) or die("Invalid query");

$delete5 = "DELETE FROM s_copies WHERE book_name='$book'";
$result5= mysqli_query($db_conn, $delete5) or die("Invalid query");

if ($result && $result1 && $result2 && $result3 && $result4 && $result5) header("Location: books.php");
			else echo "Error: " . $query . "<br>" . mysqli_error($db_conn);
?>
</body>
</html>