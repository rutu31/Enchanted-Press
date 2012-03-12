<?php

	@session_start();	
	
	$functionName = $_GET['functionName'];
	$functionName();
	
	// logout user by removing username and password from session
	function logout() {
		unset($_SESSION['username']);		
		unset($_SESSION['password']);
		echo "1";	
	}
	
	// check whether user is logged in or not
	function isUserLoggedIn() {
		if(empty($_SESSION['username']) && empty($_SESSION['password'])){
			echo "0";
		} else {
			echo "1";
		}
	}
	
?>