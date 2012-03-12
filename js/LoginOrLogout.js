var xmlhttp = getXmlHttpObject();

// handler for on click of logout button
function logout() {	
	if (xmlhttp == null) {
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/LoginOrLogout.php";
	url=url+"?functionName=logout";
	
	xmlhttp.onreadystatechange = onResultLogout;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function onResultLogout() {
	if (xmlhttp.readyState == 4) {
		
		if (xmlhttp.responseText == "1") {
			if (document.getElementById("divloginmain") != null) {
				document.getElementById("divloginmain").innerHTML = "You have successfully logged out.";
				document.getElementById("divloginmain").style.cssText = "background: #F7F8E0; border-style: solid; " +
																	"border-width: 1px; margin-top: 1%; margin-bottom: 1%;" +
																	"padding-top: 14.5%; padding-bottom: 14.5%; float: left;" +
																	"width: 80%; text-align: center";				
			} else if (document.getElementById("divformsellmain") != null) {
				document.getElementById("divformsellmain").innerHTML = "You have successfully logged out.";
				document.getElementById("divformsellmain").style.cssText = "background: #F7F8E0; border-style: solid; " +
																	"border-width: 1px; margin-top: 1%; margin-bottom: 1%;" +
																	"padding-top: 14.5%; padding-bottom: 14.5%; float: left;" +
																	"width: 80%; text-align: center";				
			} else {
				alert ("You have successfully logged out.");
			}
			
			// user has logged out; provide link for login
			document.getElementById("linklogin").innerHTML = "Login";
			if (document.title.indexOf("Home") != -1)  {
				document.getElementById("linklogin").href = "html/Login.html";
			} else {
				document.getElementById("linklogin").href = "../html/Login.html";
			}	
		} 
		// else the user should try to logout again.
	}
}

// function to check whether user is logged in or not
function isUserLoggedIn() {
	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/LoginOrLogout.php";
	url=url+"?functionName=isUserLoggedIn";
	
	xmlhttp.onreadystatechange = onResultIsUserLoggedIn;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function onResultIsUserLoggedIn() {
	if (xmlhttp.readyState == 4) {
		if (xmlhttp.responseText == "0") {
			// user is not logged in; default link is for login
			// do nothing?
		} else if (xmlhttp.responseText == "1") {
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