<?php
include ("includes/config.php");
session_start(); //to ensure you are using same session
if(isset($_COOKIE["username"])) {
	unset($_COOKIE['username']);
	setcookie('username', '', time()-60*60*24*30);
}
session_destroy(); //destroy the session
header("location:index.php"); //to redirect back to "index.php" after logging out
exit();
?>
</body>
</html>