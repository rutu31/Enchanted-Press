var xmlhttp = getXmlHttpObject();
var bookTitle;
var posterTitle;

// handler for on click of book title link
function onClickBookTitleLink (title) {	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	bookTitle = title;	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/BookDetails.php";
	url=url+"?title="+title;
		
	xmlhttp.onreadystatechange = onResultBookTitle;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for on click of poster title link
function onClickPosterTitleLink (title) {
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	posterTitle = title;
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/PosterDetails.php";
	url=url+"?title="+title;
		
	xmlhttp.onreadystatechange = onResultPosterTitle;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function onResultBookTitle() {
	if (xmlhttp.readyState == 4) {
		
		document.getElementById("divmaintext").style.display = "none";
		
		document.getElementById("divcontent").style.width = "720px";
		document.getElementById("divcontent").style.height = "350px";
		document.getElementById("divcontent").style.overflow = "auto";
		
		document.getElementById("divlinkdetails").innerHTML = xmlhttp.responseText;
		document.getElementById("divlinkdetails").style.cssText = "float:left;	margin-top:2.5%; " +
																   "margin-right: 2%; margin-left: 5%;"+
																   "width: 20%;" +
																	"margin-bottom: 2.9%;";
																   
		var image = "<img src = 'http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/img/books/" + bookTitle + ".jpg' width='100%' alt='Book'> </img>";
		document.getElementById("divcatalogmainimage").innerHTML = image;
		document.getElementById("divcatalogmainimage").style.cssText = "float: left;" +
																		"width: 40%; margin-top: 2.5%;" +
																		"margin-left: 11%; margin-right: 5%;"+ 																		
																		"padding: 0;";		
	}
}

// handler for ajax call result
function onResultPosterTitle() {
	if (xmlhttp.readyState == 4) {
		
		document.getElementById("divmaintext").style.display = "none";
		
		document.getElementById("divcontent").style.width = "720px";
		document.getElementById("divcontent").style.height = "350px";
		document.getElementById("divcontent").style.overflow = "auto";
		
		document.getElementById("divlinkdetails").innerHTML = xmlhttp.responseText;
		document.getElementById("divlinkdetails").style.cssText = "float:left;	margin-top:2.5%; " +
																   "margin-right: 2%; margin-left: 5%;"+
																   "width: 20%;" +
																	"margin-bottom: 2.9%;";
		
		var image = "<img src = 'http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/img/posters/" + posterTitle + ".jpeg' width='100%' alt='Poster'> </img>";
		document.getElementById("divcatalogmainimage").innerHTML = image;
		document.getElementById("divcatalogmainimage").style.cssText = "float: left;" +
																		"width: 40%; margin-top: 2.5%;" +
																		"margin-left: 14%; margin-right: 5%;"+																		
																		"padding: 0;";	
	}
}

// create XMLHttpRequest object
function getXmlHttpObject() {
	
	if (window.XMLHttpRequest)	{
	  // For IE7+, Firefox, Chrome, Opera, Safari
	  return new XMLHttpRequest();
	}
	if (window.ActiveXObject)	{
	  // For IE6, IE5
	  return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}