var xmlhttp = getXmlHttpObject();

// handler for on click of sell books link
function onClickSellBooks() {
	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/SellBooks.php";
	
	xmlhttp.onreadystatechange = onResultSellClick;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);	
}

// handler for on click of sell posters link
function onClickSellPosters() {
	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/SellPosters.php";
	
	xmlhttp.onreadystatechange = onResultSellClick;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);	
}

// handler for ajax call result
function onResultSellClick() {
	if (xmlhttp.readyState == 4) {
		if (xmlhttp.responseText == "") {
			// user is not logged in
			alert("Please login first before filling up the sell form...");
		} else {
			// user is logged in; show sell page	
			
			document.body.innerHTML =  xmlhttp.responseText;
			
			document.getElementById("linklogin").innerHTML = "Logout";
			document.getElementById("linklogin").href = "javascript: logout()";			
		}
	}	
}

// handler for on click of submit button on sell book form
function onSubmitSellBooks() {
	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/SubmitSell.php";
	url = url + "?functionName=sellBooks";
		
	xmlhttp.onreadystatechange = onResultSellClick;
	xmlhttp.open("POST", url, true);
	xmlhttp.send(null);	
}

// handler for on click of submit button on sell poster form
function onSubmitSellPosters() {
	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/SubmitSell.php";
	url = url + "?functionName=sellPosters";
		
	xmlhttp.onreadystatechange = onResultSellClick;
	xmlhttp.open("POST", url, true);
	xmlhttp.send(null);	
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

