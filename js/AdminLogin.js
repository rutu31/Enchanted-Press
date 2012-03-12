var xmlhttp = getXmlHttpObject();

// register click listener for sign in button
function initialize() {
	document.getElementById("signin").onclick = onClickSignIn;
}

// event handler for sign in button
function onClickSignIn() {	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var username = document.getElementById("textusername").value;
	var password = document.getElementById("textpassword").value;
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/AdminLogin.php";
	url=url+"?textusername="+username+"&textpassword="+password;
		
	xmlhttp.onreadystatechange = onResultSignIn;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function onResultSignIn() {
	if (xmlhttp.readyState == 4) {
		if (xmlhttp.responseText == "") {
			alert ("Incorrect Username or Password!");
		} else {
			document.body.innerHTML = xmlhttp.responseText;				
		}
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