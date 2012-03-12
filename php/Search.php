<?php @session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Enchanted Press: Search Results</title>
		
		<link href = "../css/CompanyName.css" rel = "stylesheet" type="text/css" />
		
		<script src="../js/LoginOrLogout.js" language="javascript"></script> 
		
		<script src="../js/Cart.js" language="javascript"></script>  
		
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
			<div id = "divmain" class = "div-main">				

				  <div id = "divmaintextsearch" class = "div-maintext-search">
				  	<div id = "divsearchresults" class = "div-searchresults">
				  	<p><span class="text-bold">Search Results</span></p>					   
					<?php
							// retrieve search parameters
							$radiosearch = $_POST['radiosearch'];
							$selectsearch = $_POST['selectsearch'];
							$textsearch = $_POST['textsearch'];
							
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
							
							$sql = "";
							// for string
							if($selectsearch=="author" || $selectsearch=="title" || $selectsearch=="isbn"){
								$selectsearch = strtoupper($selectsearch);
								$radiosearch = strtoupper($radiosearch);
								$sql = "SELECT * FROM ".$radiosearch." WHERE ".$selectsearch."='".$textsearch."';";
							}
							elseif($selectsearch=="price"){
								// for numeric field
								$selectsearch="SELL_PRICE";
								$textsearch=(float)$textsearch;
								$radiosearch = strtoupper($radiosearch);
								$sql = "SELECT * FROM ".$radiosearch." WHERE ".$selectsearch."=".$textsearch.";";
							}
							
							// query database to retrieve search results
							$result = mysql_query($sql);
							$row = @mysql_fetch_array($result);
							$index = 1;
										
							// retrieve book or poster details if results found
							if(!$row){
								echo ("<div id = \"divsearchresultsfailsmain\" class = \"div-searchresultsfail-main\">");
								echo ("No search results found !");
								echo ("</div>");
							}else{
								
								if($radiosearch=="BOOKS"){
									
									do{  ?> 
									
										<div class="div-searchinfo">
										<br />
											<div class="div-searchresult-details">
												<table style="text-align:center" width="80%" border="1" cellpadding="5" cellspacing="2">
												<tr><td><span class="text-bold">TITLE</span></td><td><?php echo $row['TITLE'];?></td></tr>
												<tr><td><span class="text-bold">ISBN</span></td><td><?php echo $row['ISBN'];?></td></tr>
												<tr><td><span class="text-bold">PUBLICATION YEAR</span></td><td><?php echo $row['PUB_YEAR'];?></td></tr>
												<tr><td><span class="text-bold">AUTHOR</span></td><td><?php echo $row['AUTHOR'];?></td></tr>
												<tr><td><span class="text-bold">COPIES AVAILABLE</span></td><td><?php echo $row['COPIES'];?></td></tr>
												<tr><td><span class="text-bold">CONDITION</span></td><td><?php echo $row['BK_CONDITION'];?></td></tr>
												<tr><td><span class="text-bold">ORIGINAL PRICE</span></td><td>$<?php echo $row['ORG_PRICE'];?></td></tr>
												<tr><td><span class="text-bold">SELLING PRICE</span></td><td>$<?php echo $row['SELL_PRICE'];?></td></tr>
												</table>
											</div>
											<div class="div-searchresult-image">
												<img src="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/img/books/<?php echo $row['TITLE'] ?>.jpg" width="50%" height="100%" alt="Book"/>
											</div>
											<div id = "temp" class="div-search-addtocart">
												<?php 
													if ($row['COPIES'] > 0) {	
														// display add to cart button if copies is greater than zero; else display reserve button
												?>
														<form id = "formadd" method = "post" action = "http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/AddToCart.php?bookid=<?php echo $row['BOOK_ID']?>">
															<p>ADD TO CART</p>
															Quantity <input type="text" id="itemqty<?php echo $index?>" name="itemqty<?php echo $index?>" class = "text-qty" />
															<input type="button" id="addtocart" name="addtocart" value="Add" onClick = "addToCart('<?php echo $row['BOOK_ID']?>', '<?php echo $index?>')"/>
														</form>
												<?php 
													} else { 
												?>		
														<form id = "formreserve" method = "post" action = "http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Reserve.php?bookid=<?php echo $row['BOOK_ID']?>">
															<p> RESERVE ITEM </p>
															<input type="button" id="reserve" name="reserve" value="Reserve" onClick = "reserveItem('<?php echo $row['BOOK_ID']?>')"/>
														</form>
												<?php 
													}	
												?>
											</div>
										<br />
										</div>
										<br /><br />
									<?php $index++; } while($row = mysql_fetch_array($result));
								}
								else if($radiosearch=="POSTERS"){
									do{	?>
										
										<div class="div-searchinfo">
										<br />
											<div class="div-searchresult-details">
												<table style="text-align:center" width="80%" border="1" cellpadding="5" cellspacing="2">
												<tr><td><span class="text-bold">TITLE</span></td><td><?php echo $row['TITLE'];?></td></tr>
												<tr><td><span class="text-bold">HEIGHT</span></td><td><?php echo $row['HEIGHT'];?></td></tr>
												<tr><td><span class="text-bold">WIDTH</span></td><td><?php echo $row['WIDTH'];?></td></tr>
												<tr><td><span class="text-bold">COPIES AVAILABLE</span></td><td><?php echo $row['COPIES'];?></td></tr>
												<tr><td><span class="text-bold">CONDITION</span></td><td><?php echo $row['PST_CONDITION'];?></td></tr>
												<tr><td><span class="text-bold">ORIGINAL PRICE</span></td><td>$<?php echo $row['ORG_PRICE'];?></td></tr>
												<tr><td><span class="text-bold">SELLING PRICE</span></td><td>$<?php echo $row['SELL_PRICE'];?></td></tr>
												</table>
											</div>
											<div class="div-searchresult-image">
												<img src="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/img/posters/<?php echo $row['TITLE'] ?>.jpeg" width="50%" height="100%" alt="Poster"/>
											</div>
											<div class="div-search-addtocart">
												<?php 
													if ($row['COPIES'] > 0) {	
														// display add to cart button if copies is greater than zero; else display reserve button
												?>
														<form id = "formadd" method = "post" action = "http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/AddToCart.php?posterid=<?php echo $row['POSTER_ID']?>">
															<p>ADD TO CART</p>
															Quantity <input type="text" id="itemqty<?php echo $index?>" name="itemqty<?php echo $index?>" class = "text-qty" />
															<input type="button" id="addtocart" name="addtocart" value="Add" onClick = "addToCartPoster('<?php echo $row['POSTER_ID']?>', '<?php echo $index?>')"/>
														</form>
												<?php 
													} else { 
												?>		
														<form id = "formreserve" method = "post" action = "http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Reserve.php?posterid=<?php echo $row['POSTER_ID']?>">
															<p> RESERVE ITEM </p>
															<input type="button" id="reserve" name="reserve" value="Reserve" onClick = "reserveItemPoster('<?php echo $row['POSTER_ID']?>')"/>
														</form>
												<?php 
													}	
												?>
											</div>
										<br />
										</div>
										<br /><br />
									<?php }while($row = mysql_fetch_array($result));								
								}
							}
							mysql_close($db_conn);
							?>
						</div>	
				  </div>
				
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