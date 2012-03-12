<?php 
	@session_start();
	
	// check whether book or poster is to be reserved
	if (isset($_GET['bookid'])) {
        $bookId = $_GET['bookid'];
     } else if (isset($_GET['posterid'])) {
        $posterId = $_GET['posterid'];
     }
		
    // connect to database
	$db_conn = @mysql_connect("dbserver.engr.scu.edu", "sdoshi", "");
	if(! $db_conn) {
		echo ("Unable to connect to database.");
		exit();
	}
	
	$db = @mysql_select_db("sdb_sdoshi",$db_conn);
	if(!$db) {
		echo ("Unable to open database");
		exit();
	}
		
	// query database for cutomer id
	$userName=$_SESSION['username'];
	$sql= "SELECT CUST_ID FROM CUSTOMER WHERE USER_NAME = '".$userName."'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$cust_id = $row['CUST_ID'];
	}
	
	$reserveDate = date("Y-m-d");
	
	// insert reservation details in database
	if(isset($bookId)){
		$sql = "SELECT * FROM BOOKS_RESERVATION";
		$result = mysql_query($sql);
		$resId = mysql_num_rows($result);
		$resId++;
		$sql = "INSERT INTO BOOKS_RESERVATION VALUES ('$resId','$reserveDate','$cust_id','$bookId')";	
		$result = mysql_query($sql);
	} else if(isset($posterId)){
		$sql = "SELECT * FROM POSTERS_RESERVATION";
		$result = mysql_query($sql);
		$resId = mysql_num_rows($result);
		$resId++;
		$sql = "INSERT INTO POSTERS_RESERVATION VALUES ('$resId','$reserveDate','$cust_id','$posterId')";
		$result = mysql_query($sql);
	}	
?>