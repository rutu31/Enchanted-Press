<?php
	@session_start();	

	$username = $_GET['textusername'];
	$password = $_GET['textpassword'];

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
	
	// query database
	$sql = "SELECT * FROM ADMIN WHERE USER_NAME = '".$username."' and PASSWORD = '".$password."'";
	$result = mysql_query($sql);

	if(!mysql_fetch_array($result)){
		echo ("");		
	} else {
		$_SESSION['adminusername'] = $username;
		$_SESSION['adminpassword'] = $password;
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
					<li><a id = "linkhome" href = "AdminHome.html" >Home</a></li>
					<li><a id = "linkmanagebooks" href = "AdminBooks.html" >Manage Books</a></li>
					<li><a id = "linkmanageposters" href = "AdminPosters.html" >Manage Posters</a></li>
				</ul>						
			</div>			
			
			<div id = "divsearch" class = "div-search">
			
				<form id = "formsearch"  class = "form-search" method = "post" action="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/AdminSearch.php">
				
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
		Welcome Admin,
		<br/> <br/> <br/>
		You have the following options under Manage Books / Manage Posters:
		
		<ul id = "uloptions">
			<li><span class = "text-bold">Inventory:</span> Check the inventory for books / posters</li> 
			<li><span class = "text-bold">Reservation:</span> Check the reservations for books / posters</li> 
			<li><span class = "text-bold">Add:</span> Add a new book / poster</li> 
			<li><span class = "text-bold">Update:</span> Update a book / poster</li> 
			<li><span class = "text-bold">Delete:</span> Delete a book / poster</li> 
		</ul>			
		
	</div>

</div>

<?php 			
	}
	mysql_close($db_conn);	
?>