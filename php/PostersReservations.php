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
	$sql = "SELECT * FROM POSTERS_RESERVATION";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if(!$row){
		echo ("Currently there are no reservations on any poster");
	}else{?>
		<table style="text-align:center" width="100%" border="1" cellpadding="5" cellspacing="2">
			<tr>
				<th>RESERVATION ID</th><th>DATE OF RESERVATION</th><th>CUSTOMER ID</th><th>BOOK ID</th>
			</tr>
			<?php do{?>
			<tr>
				<td><?php echo $row['RES_ID']?></td>
				<td><?php echo $row['RES_DATE']?></td>
				<td><?php echo $row['CUST_ID']?></td>
				<td><?php echo $row['POSTER_ID']?></td>
			</tr>
			<?php }while($row = mysql_fetch_array($result));?>
		</table>
		
	<?php }?>
