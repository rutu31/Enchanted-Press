var xmlhttp = getXmlHttpObject();

// register click listeners
function initialize() {
	document.getElementById("signup").onclick = onClickSignUp;
	document.getElementById("signin").onclick = onClickSignIn;
}

// handler for on click of sign up button
function onClickSignUp() {	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	bookTitle = title;	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/BookDetails.php";
	url=url+"?title="+title;
		
	xmlhttp.onreadystatechange = onResultSignUp;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for on click of sign in button
function onClickSignIn() {	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var username = document.getElementById("textusername").value;
	var password = document.getElementById("textpassword").value;
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Login.php";
	url=url+"?textusername="+username+"&textpassword="+password;
	
	xmlhttp.onreadystatechange = onResultSignIn;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function onResultSignUp() {
	if (xmlhttp.readyState == 4) {
		document.getElementById("divloginmain").innerHTML = xmlhttp.responseText;
	}
}

// handler for ajax call result
function onResultSignIn() {
	if (xmlhttp.readyState == 4) {
		if (xmlhttp.responseText == "0") {
			alert ("Incorrect Username or Password!");
		} else {
			document.getElementById("divloginmain").innerHTML = "You have successfully logged in.";
			document.getElementById("divloginmain").style.cssText = "background: #F7F8E0; border-style: solid; " +
																	"border-width: 1px; margin-top: 1%; margin-bottom: 1%;" +
																	"padding-top: 14.5%; padding-bottom: 14.5%; float: left;" +
																	"width: 80%; text-align: center";
			
			// user is logged in; provide link for logout
			document.getElementById("linklogin").innerHTML = "Logout";
			document.getElementById("linklogin").href = "javascript: logout()";		
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