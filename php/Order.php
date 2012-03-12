
<?php 
	@session_start();
	$ship_addr = $_POST["textaddress"];
	$ship_city = $_POST["textcity"];
	$ship_state = $_POST["textstate"];
	$ship_zip = $_POST["textzipcode"];
	$credit_no = $_POST["creditcardnumber"];
	$credit_type = $_POST["creditcardtype"];
	$credit_exp_mo = $_POST["creditcardexpirationmonth"];
	$credit_exp_yr = $_POST["creditcardexpirationyear"];
	$bill_addr = $_POST["bill_textaddress"];
	$bill_city = $_POST["bill_textcity"];
	$bill_state = $_POST["bill_textstate"];
	$bill_zip = $_POST["bill_textzipcode"];	
	
	// Validations
	// 1. Input values
	if(empty($ship_addr) || empty($ship_city) || empty($ship_state) || empty($ship_zip) || empty($credit_no) || empty($credit_exp_mo) || empty($credit_exp_yr) || empty($bill_addr) || empty($bill_city) || empty($bill_state) || empty($bill_zip)){
		echo("All fields are required ! Please check again");
		exit(0);	
	}
	
	// 2. Credit Card type = VISA 
	$pattern = '/^4[0-9]{12}(?:[0-9]{3})?$/';
	if($credit_type =="VISA" && !preg_match($pattern, $credit_no)){
		echo("Incorrect Credit Card numer! Check again.");
		exit(0);
	}
	
	// 3. Credit Card type = Master Card 
	$pattern = '/^5[1-5][0-9]{14}$/';
	if($credit_type =="Master Card" && !preg_match($pattern, $credit_no)){
		echo("Incorrect Credit Card numer! Check again.");
		exit(0);
	}
	
	// 4. Credit Card type = American Express 
	$pattern = '/^3[47][0-9]{13}$/';
	if($credit_type =="Americn Express" && !preg_match($pattern, $credit_no)){
		echo("Incorrect Credit Card numer! Check again.");
		exit(0);
	}
	
	// 5. Credit Card type = Discover 
	$pattern = '/^6(?:011|5[0-9]{2})[0-9]{12}$/';
	if($credit_type =="Discover" && !preg_match($pattern, $credit_no)){
		echo("Incorrect Credit Card numer! Check again.");
		exit(0);
	}
	
	// 6. Ship & Bill Zip Code
	$pattern = '/[\D]/';
	if(preg_match($pattern, $ship_zip) || preg_match($pattern, $bill_zip)){
		echo ("Incorrect zip code");
		exit(0);
	}
	
	//7. Credit Card Expiration Month and Year
	if(preg_match($pattern, $credit_exp_yr) || ($credit_exp_yr < (date("Y")))){
		echo ("Incorrect Credit Card Expiration Year! Enter again");
		exit(0);
	} else if ($credit_exp_yr == date("Y") && $credit_exp_mo < date("m")) {
		echo ("Incorrect Credit Card Expiration Month! Enter again");
		exit(0);
	}
	
	if(preg_match($pattern, $credit_exp_mo) || ($credit_exp_mo < 1 || $credit_exp_mo > 12)){
		echo ("Incorrect Credit Card Expiration Month! Enter again");
		exit(0);
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
	
	// query database for order id
	$sql = "SELECT * FROM ORDER_INFO";
	$result = mysql_query($sql);
	$orderId = mysql_num_rows($result);
	$orderId++;

	// query database for cutomer id
	$userName=$_SESSION['username'];
	$sql= "SELECT CUST_ID FROM CUSTOMER WHERE USER_NAME = '".$userName."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$cust_id = $row['CUST_ID'];
	
	// calculate total price, total quantity and create the product list for storing in database
	$totalPrice = 0.0;
	$totalQuantity = 0;
	if (isset($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];		
		$str="";
		for ($i = 0; $i < count($cart); $i++) {
			$item = $cart[$i];
			$totalPrice += ($item['quantity'] * $item['price']);
			$totalQuantity += $item['quantity'];
			$str=$str.$item['title']." ".$item['quantity'].",";
		}
	}
	
	// Calculate discount based on the customer type
	$sql = "SELECT CUST_TYPE FROM CUSTOMER WHERE CUST_ID = '".$cust_id."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$custType = $row['CUST_TYPE'];
	
	if($custType == 1){
		// Preferred customer (elementary school)
		// 20% discount on all purchases
		$totalPrice = $totalPrice * 0.8;
	} else if ($custType == 0 && $totalQuantity >= 10) {
		// General customer (individual)
		// 10% discount for 10 or more items
		$totalPrice = $totalPrice * 0.9;
	}
	
	$orderDate = date("Y-m-d");
	
	// query database to insert row in order_info table
	$sql = "INSERT INTO ORDER_INFO VALUES (".$orderId.", ".$cust_id.", '".$str."', '".$ship_addr."', '".$ship_city."', '".$ship_state."', ".$ship_zip.", '".$bill_addr."', '".$bill_city."', '".$bill_state."', ".$bill_zip.", ".$credit_no.", '".$credit_type."', ".$credit_exp_mo.", ".$credit_exp_yr.", ".$totalPrice.", '".$orderDate."', '".$orderDate."')";
	
	$result = mysql_query($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Enchanted Press: Thank you</title>
		
		<link href="../css/CompanyName.css" rel="stylesheet" type="text/css" />
		
		<script src="../js/Home.js" language="javascript"></script>  
		
		<script src="../js/LoginOrLogout.js" language="javascript"></script> 
	
	</head>
	
	<body onload = "isUserLoggedIn();">

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
							<input type = "radio" name = "radiosearch" value = "Posters"></input>
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
						
			<div id = "divthankyousmain" class = "div-sellthankyou-main">
			  Thank you for your order. You will receive email notification. 
			  <br />
			  Your credit card will be charged amount $<?php echo $totalPrice?> 
			  <br />
			  Requested items will be delivered within next 5 to 7 days.
			</div>				
					
			<div id = "divfooter" class = "div-footer">			
			
				<div id = "divlinksbottom" class = "div-links-bottom">
					<a id = "linkcontactus" class = "link-bottom" href = "../html/ContactUs.html" >Contact Us</a>
					<a id = "linkpolicies" class = "link-bottom" href = "../html/Policies.html" >Policies</a>
				</div>
					
			</div>
		</div>
	</body>
</html>	
