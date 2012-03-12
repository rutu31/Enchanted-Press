<?php

	@session_start();
	
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
	
	// query database to retrieve book details
	$sql = "SELECT * FROM BOOKS";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if(!$row){
		echo ("0");
	}else{?>
		<table style="text-align:center" width="100%" border="1" cellpadding="5" cellspacing="2">
			<tr>
				<th>BOOK ID</th><th>TITLE</th><th>ISBN</th><th>Author</th><th>Publication Year</th>
				<th>Copies</th><th>Condition</th><th>Original Price</th><th>Sell Price</th>
			</tr>
			<?php do{?>
			<tr>
				<td><?php echo $row['BOOK_ID']?></td>
				<td><?php echo $row['TITLE']?></td>
				<td><?php echo $row['ISBN']?></td>
				<td><?php echo $row['AUTHOR']?></td>
				<td><?php echo $row['PUB_YEAR']?></td>
				<td><?php echo $row['COPIES']?></td>
				<td><?php echo $row['BK_CONDITION']?></td>
				<td>$<?php echo $row['ORG_PRICE']?></td>
				<td>$<?php echo $row['SELL_PRICE']?></td>
			</tr>
			<?php }while($row = mysql_fetch_array($result));?>
		</table>
		
	<?php }?>
	
