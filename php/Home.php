<?php 
 	
	@session_start();
	$aboutUs = "About Us";
	$seriesInfo = "Series Info";
	
	$linkName = $_GET["linkName"];
	
	// about us information
	if ($linkName == $aboutUs) {
		echo ("* Welcome to Enchanted Press !*"); 
		echo ("<br /><br />");
		echo ("As our motto says, 'we are the books people' <br /><br />");
		echo ("We are a company specializing in old issues of children series books and posters.<br />	<br />");
		echo ("We have been in this business since last 20 years.<br /><br />");
		echo ("It's been a great journey till now.<br /><br /><br />");
		echo ("Our founders started this company with great vision and we have been folowing their footsteps !<br /><br />");
		echo ("And we promise to serve you with the unique but classic old books of all ages....");
		
	} else if ($linkName == $seriesInfo) {
		// series information
		echo ("* Series Info - 'TOOTIE' * <br /><br />");
		echo ("'Tootie' is one of our popular series of children's cartoon books.<br /><br />");
		echo ("The series includes a collection of posters and books about the character Tootie.<br /><br />");
		echo ("Tootie is basically a small bird who likes to live in her own world. <br /><br />");
		echo ("She has lots of friends, she enjoys her jungle and yes, she also celebrated her birthday ! <br /><br />");
		echo ("Our collection has some of the popular books & posters in this series.<br /><br />");
		echo ("Go through our catalog and enjoy our collection <br /><br />");
		echo ("You'll definitely love it !!");
	} 
?>
