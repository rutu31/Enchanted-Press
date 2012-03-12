<?php

	@session_start();
	
	$title = $_GET["title"];
	
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
	$sql = "SELECT * FROM BOOKS WHERE TITLE ='".$title."'";

	$result = mysql_query($sql);?>
	
	<!-- retrieve book details -->
	<table style="text-align:center" width="80%" border="1" cellpadding="5" cellspacing="2">
	
	<?php while($row = mysql_fetch_array($result)) {?>	
		<tr><td><?php echo ("<span class= 'text-bold'>TITLE</span>")?></td><td><?php echo $row['TITLE']?></td></tr>		
		<tr><td><?php echo ("<span class='text-bold'>ISBN</span>")?></td><td><?php echo $row['ISBN']?></td></tr>
		<tr><td><?php echo ("<span class='text-bold'>PUBLICATION YEAR</span>")?></td><td><?php echo $row['PUB_YEAR']?></td></tr>
		<tr><td><?php echo ("<span class='text-bold'>AUTHOR</span>")?></td><td><?php echo $row['AUTHOR']?></td></tr>
		<tr><td><?php echo ("<span class='text-bold'>COPIES AVAILABLE</span>")?></td><td><?php echo $row['COPIES']?></td></tr>
		<tr><td><?php echo ("<span class='text-bold'>CONDITION</span>")?></td><td><?php echo $row['BK_CONDITION']?></td></tr>
		<tr><td><?php echo ("<span class='text-bold'>ORIGINAL PRICE</span>")?></td><td>$<?php echo $row['ORG_PRICE']?></td></tr>
		<tr><td><?php echo ("<span class='text-bold'>SELLING PRICE</span>")?></td><td>$<?php echo $row['SELL_PRICE']?></td></tr>
	<?php }?>
	</table>
	
	<?php 
		$result = mysql_query($sql);
		$index = 1;
		
		// show add to cart button if copies is greater than 0; else show reserve button
		while($row = mysql_fetch_array($result)) {
			if ($row['COPIES'] > 0) {	
	?>
				<form id = "formadd">
					<p>ADD TO CART</p>
					Quantity <input type="text" id="itemqty<?php echo $index?>" name="itemqty<?php echo $index?>" class = "text-qty" />
					<input type="button" id="addtocart" name="addtocart" value="Add" onClick = "addToCart('<?php echo $row['BOOK_ID']?>', '<?php echo $index?>')"/>
				</form>
	<?php 
			} else { 
	?>		
				<form id = "formreserve">
					<p> RESERVE ITEM </p>
					<input type="button" id="reserve" name="reserve" value="Reserve" onClick = "reserveItem('<?php echo $row['BOOK_ID']?>')"/>
				</form>
	<?php 
			}	
			$index++;
		}	
	?>

	<?php mysql_close($db_conn);
?>