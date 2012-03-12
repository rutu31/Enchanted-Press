<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
 
<html>

	<head>
	
		<title>Enchanted Press: Shopping Cart</title>
		
		<link href="../css/CompanyName.css" rel="stylesheet" type="text/css" />
		
		<script src="../js/LoginOrLogout.js" language="javascript"></script>  
		
		<script src="../js/Cart.js" language="javascript"></script>
		
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
			
			<div id = "divcartmain" class = "div-cart-main">						
			<?php
				@session_start();
		
				// display cart details if cart is prsent in session
				if (isset($_SESSION['cart'])) {
					$cart = $_SESSION['cart'];
					$totalPrice = 0.0;
					echo("<div class='div-title'>Shopping Cart</div><br/><br/>");
					for ($i = 0; $i < count($cart); $i++) {
						$item = $cart[$i];
						$totalPrice += ($item['quantity'] * $item['price']);
						echo ("<span class = 'text-bold'>Title: </span>".$cart[$i]['title']);
						echo (" <span class = 'text-bold'>Quantity: </span>".$item['quantity']);
						echo (" <span class = 'text-bold'>Price: </span>$".$item['price']);
						echo ("<br/><br/>");						
					}
					
					echo ("<br/><br/>");
					echo("<div class = 'div-title'>Total Price: <span class = 'text-normal'>$".$totalPrice."</span></div>");
					echo ("<br/><br/>");
					echo("<form id ='formprocesscart' class = 'form-processcart' method='post' action='../php/ClearCart.php'>");
					echo("<input type='submit' id='buttonclearcart' value='Clear Cart'></input>");
					echo("<input type='button' id='buttoncheckout' value='Checkout' onClick = onClickCheckOut()></input>");
					echo("</form>");
				} else {
					// empty cart
					echo ("Your shopping cart is empty.");
				}			
			?>	
				        
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