
<?php @session_start(); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Enchanted Press: Products Catalog</title>
		
		<link href="../css/CompanyName.css" rel="stylesheet" type="text/css" />
		
		<link href="../css/mktree.css" rel="stylesheet" type="text/css" />
		
		<script src="../js/mktree.js" language="javascript" type="text/javascript"></script>  
		
		<script src="../js/Catalog.js" language="javascript" type="text/javascript"></script>  
		
		<script src="../js/LoginOrLogout.js" language="javascript" type="text/javascript"></script> 
		
		<script src="../js/Cart.js" language="javascript" type="text/javascript"></script> 
		
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
			
			<div id = "divmain" class = "div-main">				
			
				<div id = "divtreeleft" class = "div-tree-left">
									 
					 <ul id = "ulbooks" class = "mktree">
					 	<li>Books
						 	<ul>
								<?php
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
									
									// query database for books
									$sql = "SELECT TITLE FROM BOOKS";
			
									$result = mysql_query($sql);
									
									while($row = mysql_fetch_array($result)) {									
									
								?>
									 					 
							 	<li> <a href = "javascript: onClickBookTitleLink('<?php echo $row['TITLE']; ?>')"> <?php echo $row['TITLE'];?> </a> </li>
							 	<?php }?>
						 	</ul>
					 	</li>
					 </ul>
					
					<ul id = "ulposters" class = "mktree">
						<li>Posters
							<ul>
								<?php 
									// query database for posters
									$sql = "SELECT TITLE FROM POSTERS";
			
									$result = mysql_query($sql);
									
									while($row = mysql_fetch_array($result)) {								
								?>
								
								<li> <a href = "javascript: onClickPosterTitleLink('<?php echo $row['TITLE']; ?>')"> <?php echo $row['TITLE']; ?> </a> </li>
								<?php } ?>
							</ul> 	
						</li>				
					</ul>
					
				</div>
								
				<div id = "divcontent" class = "div-content"> 
			    	
				  	<div id = "divcatalogmainimage"> </div>
				  	<div id="divlinkdetails"> </div>
			    	
				  	<div id = "divmaintext" class = "div-catalog-main-text">
				  	
					  	<table border = "0" cellspacing = "20">
						   	<tr>
						   		<th colspan = "2">Books</th>
						   	</tr>
					   	 
					   		<?php 
								$sql = "SELECT TITLE FROM BOOKS";		
								$result = mysql_query($sql);								
								$tdPerTrCount = 0;
								
								// display book images
								while($row = mysql_fetch_array($result)) {	
									if (($tdPerTrCount % 2) == 0) {
										echo "<tr>";
										echo "<td><img src = \"../img/books/". $row['TITLE']. ".jpg\" width = \"100%\" alt=\"Book\"></img></td>";									
									} else {
										echo "<td><img src = \"../img/books/". $row['TITLE']. ".jpg\" width = \"100%\" alt=\"Book\"></img></td>";
										echo "</tr>";
									}
									$tdPerTrCount++;
								}							
							?>
							
						   	 <tr>
						   	 	<th colspan = "2">Posters</th>
						   	 </tr>
					   	 
						   	 <?php 
								$sql = "SELECT TITLE FROM POSTERS";		
								$result = mysql_query($sql);								
								$tdPerTrCount = 0;
								
								// display poster images
								while($row = mysql_fetch_array($result)) {	
									if (($tdPerTrCount % 2) == 0) {
										echo "<tr>";
										echo "<td><img src = \"../img/posters/". $row['TITLE']. ".jpeg\" width = \"100%\" alt=\"Poster\"></img></td>";									
									} else {
										echo "<td><img src = \"../img/posters/". $row['TITLE']. ".jpeg\" width = \"100%\" alt=\"Poster\"></img></td>";
										echo "</tr>";
									}
									$tdPerTrCount++;
								}			
		
								mysql_close($db_conn);
							?>
							
					  	</table>
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
