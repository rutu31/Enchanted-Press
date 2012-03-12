<?php
	
	@session_start();
	
	$functionName = $_GET['functionName'];
		
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
	
	$functionName();
	
	// for selling books
	function sellBooks() {
		$title = $_POST['selecttitle'];
		$quantity = $_POST['textquantity'];
		$address = $_POST['textaddress'];
		$city = $_POST['textcity'];
		$state = $_POST['textstate'];
		$zipCode = $_POST['textzipcode'];
	
		// Validations
		// 1. Input fields
		if(empty($quantity) || empty($address) || empty($city) || empty($zipCode)){
			echo ("All fields are required");
			exit(0);
		}
		
		// 2. Quantity
		$pattern = "/[\D]/";
		if(preg_match("$pattern", "$quantity") || $quantity <= 0){
			echo("Incorrect quantity ! Enter again");
			exit(0);
		}
		
		// 3. Zip code
		if(preg_match("$pattern", "$zipCode")){
			echo("Incorrect zip code ! Enter again");
			exit(0);
		}

		$sql = "SELECT * FROM SELL_BOOKS";
		$result = mysql_query($sql);	
		$sellId = mysql_num_rows($result);
		$sellId++;
		
		$userName = $_SESSION['username'];
		$sql = "SELECT CUST_ID FROM CUSTOMER WHERE USER_NAME = '".$userName."'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			// only one row
			$cust_id = $row['CUST_ID'];
		}
		
		$sql = "SELECT BOOK_ID, ORG_PRICE FROM BOOKS WHERE TITLE ='".$title."'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			// only one row
			$book_id = $row['BOOK_ID'];
			$orgPrice = $row['ORG_PRICE'];
		}
		
		$totalPrice = $orgPrice * 0.75 * $quantity;
		
		$sellDate = date("Y-m-d");
				
		// insert values in sell_books tables
		$sql = "INSERT INTO SELL_BOOKS VALUES (".$sellId.", ".$cust_id.", '".$book_id."', '".$address."', "."'".$city."', "."'".$state."', ".$zipCode.", ".$quantity.", ".$totalPrice.", '".$sellDate."')";
		$result = mysql_query($sql);				
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Enchanted Press: Sell</title>
		
		<link href="../css/CompanyName.css" rel="stylesheet" type="text/css" />
		
		<script src="../js/Login.js" language="javascript"></script>  
		
		<script src="../js/LoginOrLogout.js" language="javascript"></script>  
		
	</head>
	
	<body onload = "initialize(); isUserLoggedIn();">
	
		<div id = "divouter" class = "div-outer">
		
			<div id = "divheader" class = "div-header"> 
			
				<div id = "divbanner" class = "div-banner">
					<div id = "divlogo" class = "div-logo">
						<img src="../img/logo1.png" alt="Logo"></img> 
					</div>
					<div id = "divcompanyname" class = "div-companyname">ENCHANTED PRESS</div>
					<div id = "divtagline" class = "div-tagline">The books people...!</div>
				</div>	
				
			    <div id = "divnavigation" class = "div-navigation">		
			    		    
					<div id = "divlinkstop" class = "div-links-top">					
						<ul id="ullinkstop">
							<li><a id = "linkhome" class = "link-top-left" href = "../index.html" >Home</a></li>
							<li><a id = "linkbuy" class = "link-top-middle" href = "../php/Catalog.php" >Buy</a></li>
							<li><a id = "linksell" class = "link-top-middle" href = "../html/Sell.html" >Sell</a></li>
							<li><a id = "linkcart" class = "link-top-middle" href = "../php/Cart.php" >Cart</a></li>
							<li><a id = "linkhelp" class = "link-top-middle" href = "../html/Help.html" >Help</a></li>
							<li><a id = "linklogin" class = "link-top-right" href = "../html/Login.html" >Login</a></li>
						</ul>						
					</div>			
					
					<div id = "divsearch" class = "div-search">
					
						<form id = "formsearch"  class = "form-search" method = "post" action="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Search.php">
						
							<label id = "labelsearch">Search</label>
							
							<input type = "radio" checked = "checked" name = "radiosearch" value = "Books"></input>
							<span class = "text-small">Books</span>
							<input type = "radio"	name = "radiosearch" value = "Posters"></input>
							<span class = "text-small">Posters</span>
														
							<select id = "selectsearch" name = "selectsearch">
								<option value = "null"></option>
								<option value = "title">Title</option>
								<option value = "isbn">ISBN</option>
								<option value = "price">Price</option>
								<option value = "author">Author</option>
							</select>
							
							<input id = "textsearch" name = "textsearch" type = "text" class = "text-search"></input>
														
							<input id = "buttonsearch" class = "button-search" type = "submit" value = "Go"></input>
							
						</form>
					
					</div>
					
				</div>
				
			</div>
			
					
			<?php 
				if($result) { 	
					echo ("<div id = \"divsellresultsmain\" class = \"div-sellresultssucess-main\">");	
					echo ("The transaction has  been completed.");
					echo ("<br /> <br />");
					echo ("You will receive $$totalPrice by cheque once we get the book(s).");	
				} else {
					echo ("<div id = \"divsellresultsmain\" class = \"div-sellresultsfail-main\">");
					echo ("There was an error. Please try again.");
				}	
				echo ("</div>");
			?>				
			
			<div id = "divfooter" class = "div-footer">						
				<div id = "divlinksbottom" class = "div-links-bottom">
					<a id = "linkcontactus" class = "link-bottom" href = "../html/ContactUs.html" >Contact Us</a>
					<a id = "linkpolicies" class = "link-bottom" href = "../html/Policies.html" >Policies</a>
				</div>								
			</div>
											
		</div>	 

	</body>
	
</html>
<?php 
		
	}
	
	// for selling posters
	function sellPosters() {
		$title = $_POST['selecttitle'];
		$quantity = $_POST['textquantity'];
		$address = $_POST['textaddress'];
		$city = $_POST['textcity'];
		$state = $_POST['textstate'];
		$zipCode = $_POST['textzipcode'];
	
		// Validations
		// 1. Input fields
		if(!$quantity || !$address || !$city || !$zipCode){
			echo ("All fields are required");
			exit();
		}
		// 2. Quantity
		$pattern = '/[\D]/';
		if(preg_match("$pattern", "$quantity") || $quantity <= 0){
			echo("Incorrect quantity ! Enter again");
			exit();
		}
		
		// 3. Zip code
		if(preg_match("$pattern", "$zipCode")){
			echo("Incorrect zip code ! Enter again");
			exit();
		}
		
		$sql = "SELECT * FROM SELL_POSTERS";
		$result = mysql_query($sql);	
		$sellId = mysql_num_rows($result);
		$sellId++;
		
		$userName = $_SESSION['username'];
		$sql = "SELECT CUST_ID FROM CUSTOMER WHERE USER_NAME = '".$userName."'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			// only one row
			$cust_id = $row['CUST_ID'];
		}
		
		$sql = "SELECT POSTER_ID, ORG_PRICE FROM POSTERS WHERE TITLE ='".$title."'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			// only one row
			$poster_id = $row['POSTER_ID'];
			$orgPrice = $row['ORG_PRICE'];
		}
		
		$totalPrice = $orgPrice * 0.75 * $quantity;
		
		$sellDate = date("Y-m-d");
				
		// insert values in sell_posters table
		$sql = "INSERT INTO SELL_POSTERS VALUES (".$sellId.", ".$cust_id.", '".$poster_id."', '".$address."', "."'".$city."', "."'".$state."', ".$zipCode.", ".$quantity.", ".$totalPrice.", '".$sellDate."')";
		$result = mysql_query($sql);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Enchanted Press: Sell</title>
		
		<link href="../css/CompanyName.css" rel="stylesheet" type="text/css" />
		
		<script src="../js/Login.js" language="javascript"></script>  
		
		<script src="../js/LoginOrLogout.js" language="javascript"></script>  
		
	</head>
	
	<body onload = "initialize(); isUserLoggedIn();">
	
		<div id = "divouter" class = "div-outer">
		
			<div id = "divheader" class = "div-header"> 
			
				<div id = "divbanner" class = "div-banner">
					<div id = "divlogo" class = "div-logo">
						<img src="../img/logo1.png" alt="Logo"></img> 
					</div>
					<div id = "divcompanyname" class = "div-companyname">ENCHANTED PRESS</div>
					<div id = "divtagline" class = "div-tagline">The books people...!</div>
				</div>	
				
			    <div id = "divnavigation" class = "div-navigation">		
			    		    
					<div id = "divlinkstop" class = "div-links-top">					
						<ul id="ullinkstop">
							<li><a id = "linkhome" class = "link-top-left" href = "../index.html" >Home</a></li>
							<li><a id = "linkbuy" class = "link-top-middle" href = "../php/Catalog.php" >Buy</a></li>
							<li><a id = "linksell" class = "link-top-middle" href = "../html/Sell.html" >Sell</a></li>
							<li><a id = "linkcart" class = "link-top-middle" href = "../php/Cart.php" >Cart</a></li>
							<li><a id = "linkhelp" class = "link-top-middle" href = "../html/Help.html" >Help</a></li>
							<li><a id = "linklogin" class = "link-top-right" href = "../html/Login.html" >Login</a></li>
						</ul>						
					</div>			
					
					<div id = "divsearch" class = "div-search">
					
						<form id = "formsearch"  class = "form-search" method = "post" action="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Search.php">
						
							<label id = "labelsearch">Search</label>
							
							<input type = "radio" checked = "checked" name = "radiosearch" value = "Books"></input>
							<span class = "text-small">Books</span>
							<input type = "radio"	name = "radiosearch" value = "Posters"></input>
							<span class = "text-small">Posters</span>
														
							<select id = "selectsearch" name = "selectsearch">
								<option value = "null"></option>
								<option value = "title">Title</option>
								<option value = "isbn">ISBN</option>
								<option value = "price">Price</option>
								<option value = "author">Author</option>
							</select>
							
							<input id = "textsearch" name = "textsearch" type = "text" class = "text-search"></input>
														
							<input id = "buttonsearch" class = "button-search" type = "submit" value = "Go"></input>
							
						</form>
					
					</div>
					
				</div>
				
			</div>
			
					
			<?php 
				if($result) { 	
					echo ("<div id = \"divsellresultsmain\" class = \"div-sellresultssucess-main\">");	
					echo ("The transaction has  been completed.");
					echo ("<br /> <br />");
					echo ("You will receive $$totalPrice by cheque once we get the poster(s).");	
				} else {
					echo ("<div id = \"divsellresultsmain\" class = \"div-sellresultsfail-main\">");
					echo ("There was an error. Please try again.");
				}	
				echo ("</div>");
			?>				
			
			<div id = "divfooter" class = "div-footer">						
				<div id = "divlinksbottom" class = "div-links-bottom">
					<a id = "linkcontactus" class = "link-bottom" href = "../html/ContactUs.html" >Contact Us</a>
					<a id = "linkpolicies" class = "link-bottom" href = "../html/Policies.html" >Policies</a>
				</div>								
			</div>
											
		</div>	 

	</body>
	
</html>
<?php 
	} 
	mysql_close($db_conn);	
?>