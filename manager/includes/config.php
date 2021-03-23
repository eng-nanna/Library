<?php
	$db_user = 'u159177665_lib';
	$db_pass = 'AihBBz2bAXej';
	$host = 'mysql.hostinger.co.uk';
	/******************************************************/
	$db_conn = mysqli_connect($host, $db_user, $db_pass);
	if (!$db_conn){
		die('Could not connect: ');
	}

	/******************************************************/
	// select the desired database
	$db_name= "u159177665_lib";
	$db_select = mysqli_select_db($db_conn,$db_name);
	if (!$db_select){
		die('Database selection failed: ');
	}

	/******************************************************/
	mysqli_query($db_conn,"SET NAMES 'utf8'");

?>
