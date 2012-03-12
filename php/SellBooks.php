<?php
	@session_start();	
	
	if(empty($_SESSION['username']) && empty($_SESSION['password'])){
			echo "";
			exit (0);
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
	
	// query database to retrieve book titles for displaying in dropdown
	$sql = "SELECT TITLE FROM BOOKS";

	$result = mysql_query($sql);									
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
	
	<div id = "divformsellmain" class = "div-form-sell-main">
		
		<div id = "divsellbooksheader" class = "div-sellbooks-header">				
			<label class = "text-bold">Sell Book(s)</label>
			<br/> <br/>
			<label class = "text-small">(All fields are required)</label>						
		</div>
		
		<form id = "formsellbooks" class = "form-sell" method = "post" action = "http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/SubmitSell.php?functionName=sellBooks">  	
					
			<label>BOOK DETAILS</label>
			
			<div id = "divbookdetails" class = "div-details">
				<div id = "div-form-sell-inner1" class = "div-form-sell-inner">			
					<label class = "text-form-sellbooks1">Book Title</label>
					<select id = "selecttitle" name = "selecttitle">
					<?php 
						while($row = mysql_fetch_array($result)) {	
							echo "<option value = \"".$row['TITLE']."\">".$row['TITLE']."</option>";
						}
						mysql_close($db_conn);
					?>
					</select>
				</div>	
				<br />					
				<div id = "div-form-sell-inner2" class = "div-form-sell-inner">	
					<label class = "text-form-sellbooks2">Quantity</label>
					<input id = "textquantity" name = "textquantity" type = "text" class = "text-quantity"></input> 
				</div>				
			</div>
			
			<br />			
			<label>SHIPPING DETAILS</label>
			
			<div id = "divshippingdetails" class = "div-details">
				<div id = "div-form-sell-inner3" class = "div-form-sell-inner">			
					<label class = "text-form-sellbooks3">Address</label>
					<input id = "textaddress" name = "textaddress" type = "text"></input> 
				</div>	
				<br />
				<div id = "div-form-sell-inner4" class = "div-form-sell-inner">	
					<label class = "text-form-sellbooks4">City</label>
					<input id = "textcity" name = "textcity" type = "text"></input> 
				</div>
				<br />
				<div id = "div-form-sell-inner5" class = "div-form-sell-inner">	
					<label class = "text-form-sellbooks5">State</label>
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
				<div id = "div-form-sell-inner6" class = "div-form-sell-inner">	
					<label class = "text-form-sellbooks6">Zip Code</label>
					<input id = "textzipcode" name = "textzipcode" type = "text"  maxlength = "5" class = "text-zip"></input> 
				</div>
			</div>
			
			<br />			
			<div id = "div-form-sell-inner6" class = "div-form-sell-inner">	
				<input id = "buttonsellbook" type = "submit" value = "Submit" class = "button-sell"></input> 
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
		
