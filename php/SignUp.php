<?php 

	@session_start();
		
	$functionName = $_GET['functionName'];
	$functionName();
	
	function signup() {
		$name = $_POST['textname'];
		$username = $_POST['textusername'];
		$password = $_POST['textpassword'];
		$email = $_POST['textemail'];
		$customerType = $_POST["radiocustomertype"];
		
		// Form Validations
		// 1. No input
		if(empty($name) || empty($username) || empty($password) || empty($email)){
			echo("All fields are required !");
			exit(0);
		}
		// 2. Name
		$pattern = '/[0-9]/';
		if(preg_match($pattern, $name)){
			echo("Name can not contain any digits!<br />");
			echo("Please enter gain.");
			exit(0);
		}
		
		// 3. Email address
		$pattern = '/\w+@\w+[.]\w{2,3}/'; //'/\w+(@){1}\w+(.)[\w]{2,3}(.)?[a-z]{2}/';
		if(!preg_match($pattern,$email)){
			echo ("Wrong email address!<br />");
			echo ("Please enter again.");
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
	
		$sql = "SELECT * FROM CUSTOMER";
		$result = mysql_query($sql);	
		$custId = mysql_num_rows($result);
		$custId++;
		
		// check customer type
		if($customerType == "General"){
			$customerType = 0;
		} else if($customerType == "Preferred"){
			$customerType = 1;
		}
				
		// insert values in customer table
		$sql = "INSERT INTO CUSTOMER VALUES (".$custId.", '".$name."', '".$username."', "."'".$password."', ".$customerType.", '".$email."')";
		
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
					echo ("<div id = \"divsellresultsmain\" class = \"div-sellresultsfail-main\">");	
					echo ("You have successfully signed up.");	
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
		mysql_close($db_conn);
	}
	
	function display() {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
	
		<title>Enchanted Press: Customer Sign Up</title>
		
		<link href="../css/CompanyName.css" rel="stylesheet" type="text/css" />
		
		<script src="../js/LoginOrLogout.js" language="javascript"></script>
		 
	</head>

	<body onload = "isUserLoggedIn()">

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
			
			<div id = "divmain" class = "div-signup-main">
			
				<form id="formsignup" method = "post" action = "../php/SignUp.php?functionName=signup">		

					<div id="divcustomerdetails" class="div-customer-details">
					
						<div id = "divsignupheader" class = "div-signup-header">				
							<label class = "text-bold">Sign Up</label>
							<br/> <br/>
							<label class = "text-small">(All fields are required)</label>						
						</div>
						
						<label class = "label-name">Name</label> 
						<input type = "text" id = "textname" name = "textname"></input><br/><br/>
													
						<label class = "label-username">User Name</label>
						<input type = "text" id = "textusername" name = "textusername"></input><br/><br/>
						
						<label class = "label-password">Password</label> 
						<input type = "password" id = "textpassword" name = "textpassword"></input><br/><br/>
						
						<label class = "label-email">Email Address</label>
						<input type = "text" id = "textemail" name = "textemail"></input><br/><br/>
						
						<label class = "label-customertype">Customer Type</label>									
						<input type="radio" name="radiocustomertype" value="General" checked="checked" />General
						<input type="radio" name="radiocustomertype" value="Preferred" />Preferred							
						 
						<input type = "submit" id = "signup" value = "Sign Up" class = "button-signup"></input>
						
					</div>
					
				</form>
						
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

<?php 
	exit(0);
	}
?>