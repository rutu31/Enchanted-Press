<?php
	@session_start();	

	$username = $_GET['textusername'];
	$password = $_GET['textpassword'];

	// connect to database
	$db_conn = @mysql_connect("dbserver.engr.scu.edu", "sdoshi", "");
	if(! $db_conn) {
		echo ("Unable to connect to database.");
		exit();
	}
	
	$db = @mysql_select_db("sdb_sdoshi",$db_conn);
	if(!$db) {
		echo ("Unable to open tootie database");
		exit();
	}
	
	// query database to check if username and password match
	$sql = "SELECT * FROM CUSTOMER WHERE USER_NAME = '".$username."' AND PASSWORD = '".$password."'";
	$result = mysql_query($sql);

	if(!mysql_fetch_array($result)){
		echo ("0");		
	} else {
		// store valid username and password in session
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;	
		echo("1");		
	}
	mysql_close($db_conn);
	
?>