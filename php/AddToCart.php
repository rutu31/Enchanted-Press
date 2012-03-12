<?php
	
	@session_start();
	
	if (isset($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
	}
	
	// check whether book or poster is to be added to cart 
	if (isset($_GET['bookid'])) {
		$bookId = $_GET['bookid'];
	} else if (isset($_GET['posterid'])) {
		$posterId = $_GET['posterid'];
	}	
	$quantity = $_GET['itemqty'];
	
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
	
	// query the database
	if (isset($bookId)) {
		$sql = "SELECT TITLE, SELL_PRICE FROM BOOKS WHERE BOOK_ID = '".$bookId."'";
	} else if (isset($posterId)) {
		$sql = "SELECT TITLE, SELL_PRICE FROM POSTERS WHERE POSTER_ID = '".$posterId."'";
	}
		
	$result = mysql_query($sql);
	
	// add item to cart
	while($row = mysql_fetch_array($result)) {		
		$item = array("title" => $row['TITLE'], 
					  "quantity" => $quantity,
					  "price" => $row['SELL_PRICE']);			
		if(!isset($cart)) {				
			$cart[0] = $item; 				
		} else {				
			$index = count($cart);
			$cart[$index] = $item; 				
		}
		$_SESSION['cart'] = $cart;
	}			
?>