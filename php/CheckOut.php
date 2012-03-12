<?php
	@session_start();	
	
	// Login required for buying the books
	if(empty($_SESSION['username']) && empty($_SESSION['password'])){
			echo "";
			exit (0);
	}
	else{
				
		// Connect to the database
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
	}
?>

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

	<div id = "divmainorder" class = "div-main-order">
	
		<form id="confirmorder" class="confirm-order" method="post" action="../php/Order.php">
		
			<p class = "div-title">
				Order<br /><br />
				<label class = "label-order-allfieldsrequired">(All fields are required)</label>
			</p>
									
			<div id="shippingdetails" class="div-shipping-details">
			
				<label class = "label-order-title">SHIPPING DETAILS</label>
				
				<div id="shippingaddress" class="div-shipping-address">			
					
					<div class = "div-form-sell-inner">			
						<label class = "label-order-address">Address</label>
						<input id = "textaddress" name = "textaddress" type = "text"></input> 
					</div>	
					<br />
					
					<div class = "div-form-sell-inner">	
						<label class = "label-order-city">City</label>
						<input id = "textcity" name = "textcity" type = "text"></input> 
					</div>
					<br />
					
					<div class = "div-form-sell-inner">	
						<label class = "label-order-state">State</label>
						<select id = "textstate" name = "textstate">
							<option value = "AZ">AZ</option>
							<option value = "CA">CA</option>
							<option value = "FL">FL</option>
							<option value = "IL">IL</option>
							<option value = "KS">KS</option>
							<option value = "MS">MS</option>
							<option value = "NJ">NJ</option>
							<option value = "NY">NY</option>
							<option value = "TX">TX</option>
							<option value = "WA">WA</option>
						</select>
					</div> 
					<br />
										
					<div class = "div-form-sell-inner">	
						<label class = "label-order-zip">Zip Code</label>
						<input id = "textzipcode" name = "textzipcode" type = "text"  maxlength = "5" class = "text-zip"></input> 
					</div>
							
				</div> 
				
			</div>
			
			<div id="billingdetails" class="div-billing-details">
			
				<label class = "label-order-title">BILLING DETAILS</label>
			
				<div id="billingaddress" class="div-billing-address">
				
					<div class = "div-form-sell-inner">			
						<label class = "label-order-address">Address</label>
						<input id = "bill_textaddress" name = "bill_textaddress" type = "text"></input> 
					</div>	
					<br />
					
					<div class = "div-form-sell-inner">	
						<label class = "label-order-city">City</label>
						<input id = "bill_textcity" name = "bill_textcity" type = "text"></input> 
					</div>
					<br />
					
					<div class = "div-form-sell-inner">	
						<label class = "label-order-state">State</label>
						<select id = "bill_textstate" name = "bill_textstate">
							<option value = "AZ">AZ</option>
							<option value = "CA">CA</option>
							<option value = "FL">FL</option>
							<option value = "IL">IL</option>
							<option value = "KS">KS</option>
							<option value = "MS">MS</option>
							<option value = "NJ">NJ</option>
							<option value = "NY">NY</option>
							<option value = "TX">TX</option>
							<option value = "WA">WA</option>
						</select>
					</div> 
					<br />					
					
					<div class = "div-form-sell-inner">	
						<label class = "label-order-zip">Zip Code</label>
						<input id = "bill_textzipcode" name = "bill_textzipcode" type = "text"  maxlength = "5" class = "text-zip"></input>
					</div>
					<br />
					
					<div id="creditcardtype"  class = "div-form-sell-inner">
					<label class = "label-order-cctype">Credit Card Type</label>																			
						<input type="radio" checked="checked" id = "creditcardtype" name="creditcardtype" value="VISA" />VISA &nbsp;
						<input type="radio" id = "creditcardtype" name="creditcardtype" value="Master Card" />Master Card &nbsp;	
						<input type="radio" id = "creditcardtype" name="creditcardtype" value="American Express" />American Express &nbsp;
						<input type="radio" id = "creditcardtype" name="creditcardtype" value="Discover" />Discover
					</div>
					<br />
					
					<div class = "div-form-sell-inner">
						<label class = "label-order-ccno">Credit Card No.</label>
						<input type="text" id="creditcardnumber" name="creditcardnumber" />
					</div>
					<br />
					
					<div class = "div-form-sell-inner">
						<label class = "label-order-ccmonth">Credit Card Expiry Month (mm)</label>
						<input type="text" id="creditcardexpirationmonth" name="creditcardexpirationmonth" />
					</div>
					<br />	
					
					<div class = "div-form-sell-inner">
 						<label class = "label-order-ccyear">Credit Card Expiry Year (yyyy)</label>
						<input type="text" id="creditcardexpirationyear" name="creditcardexpirationyear" />	
					</div>				
					
				</div>
				
				<br /><br />
				
			</div>
			
			<div id="divorderconfirmbtn" class="div-orderconfirmbtn">
				<input type="submit" id="customer-signup" name="customer-signup" value="Confirm Order"></input>
			</div>
			<br /><br />
				
		</form>
		
	</div>
	
</div>

