<?php

	@session_start();
	
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
	
	// Query the database
	$sql = "SELECT * FROM POSTERS";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	// Display the poster inventory
	if(!$row){
		echo ("There are no posters available in the shop inventory");
	}else{?>
		<table style="text-align:center" width="100%" border="1" cellpadding="5" cellspacing="2">
			<tr>
				<th>Poster ID</th><th>TITLE</th><th>HEIGHT</th><th>WIDTH</th>
				<th>Copies</th><th>Condition</th><th>Original Price</th><th>Sell Price</th>
			</tr>
			<?php do{?>
			<tr>
				<td><?php echo $row['POSTER_ID']?></td>
				<td><?php echo $row['TITLE']?></td>
				<td><?php echo $row['HEIGHT']?></td>
				<td><?php echo $row['WIDTH']?></td>
				<td><?php echo $row['COPIES']?></td>
				<td><?php echo $row['PST_CONDITION']?></td>
				<td>$<?php echo $row['ORG_PRICE']?></td>
				<td>$<?php echo $row['SELL_PRICE']?></td>
			</tr>
			<?php }while($row = mysql_fetch_array($result));?>
		</table>
		
	<?php }?>
	
