var xmlhttp = getXmlHttpObject();
var aboutUs = "About Us";
var seriesInfo = "Series Info";
var image;

// handler for on click of about us or series info link
function onClickInfoLink (linkName) {

	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
		
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Home.php";
	url=url+"?linkName="+linkName;
		
	if(linkName == aboutUs){
		image = "<img src = 'http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/img/bookgraphic.jpg' alt = 'Book Graphic' width='100%' > </img>";
	}else if(linkName == seriesInfo){
		image = "<img src = 'http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/img/BirdDesigns.jpg' alt = 'Tootie' width='100%' > </img>";
	}
	
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function stateChanged() {
	if (xmlhttp.readyState == 4) {
		document.getElementById("divmaintextindex").innerHTML = xmlhttp.responseText;		
		document.getElementById("divmainpageimage").innerHTML = image;
		document.getElementById("divmainpageimage").style.width = "20%";
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