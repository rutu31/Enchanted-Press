var xmlhttp = getXmlHttpObject();
var reserveId;

//create XMLHttpRequest object
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

// handler for add book to cart
function addToCart(addbookId, index) {
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
		
	var textqtyid = "itemqty" + index;
	var itemqty = document.getElementById(textqtyid).value;
	
	if (itemqty == null || itemqty == "" || itemqty <= 0) {
		alert("Please enter a valid quantity.");
	} else {	
		var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/AddToCart.php";
		url = url + "?bookid="+addbookId+"&itemqty="+itemqty;
			
		xmlhttp.onreadystatechange = onResultAddToCart;
		xmlhttp.open("GET", url, true);
		xmlhttp.send(null);	
	}
}

// handler for add poster to cart
function addToCartPoster(addposterId, index) {	
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
		
	var textqtyid = "itemqty" + index;
	var itemqty = document.getElementById(textqtyid).value;
	
	if (itemqty == null || itemqty == "" || itemqty <= 0) {
		alert("Please enter a valid quantity.");
	} else {
		var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/AddToCart.php";
		url = url + "?posterid="+addposterId+"&itemqty="+itemqty;
				
		xmlhttp.onreadystatechange = onResultAddToCart;
		xmlhttp.open("GET", url, true);
		xmlhttp.send(null);	
	}
}

// handler for ajax call result
function onResultAddToCart() {
	if (xmlhttp.readyState == 4) {
		alert("Item has been added to your Shopping Cart.");
	}
}

// handler for reserve book
function reserveItem(reserveBookId) {
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
		
	reserveId = reserveBookId;
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/LoginOrLogout.php";
	url=url+"?functionName=isUserLoggedIn";
	
	xmlhttp.onreadystatechange = onResultIsUserLoggedInForBook;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
	
}

// handler for ajax call result
function onResultIsUserLoggedInForBook() {
	if (xmlhttp.readyState == 4) {		
		if (xmlhttp.responseText == "0") {
			alert ("Please login before reserving item...");
		} else if (xmlhttp.responseText == "1") {	
			var url="../php/Reserve.php";
			url = url + "?bookid="+reserveId;
					
			xmlhttp.onreadystatechange = onResultReserveItem;
			xmlhttp.open("GET", url, true);
			xmlhttp.send(null);
		}
	}
}	

// handler for reserve poster
function reserveItemPoster(reservePosterId) {
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	reserveId = reservePosterId;
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/LoginOrLogout.php";
	url=url+"?functionName=isUserLoggedIn";
		
	xmlhttp.onreadystatechange = onResultIsUserLoggedInForPoster;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

// handler for ajax call result
function onResultIsUserLoggedInForPoster() {
	if (xmlhttp.readyState == 4) {		
		if (xmlhttp.responseText == "0") {
			alert ("Please login before reserving item...");
		} else if (xmlhttp.responseText == "1") {	
			var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/Reserve.php";
			url = url + "?posterid="+reserveId;
			
			xmlhttp.onreadystatechange = onResultReserveItem;
			xmlhttp.open("GET", url, true);
			xmlhttp.send(null);	
		}
	}	
}	

// handler for ajax call result
function onResultReserveItem() {
	if (xmlhttp.readyState == 4) {
		alert("Item has been Reserved. You will be notified by email when item is available.");
	}
}

// handler for on click of checkout button
function onClickCheckOut(){
	if (xmlhttp == null)	{
		alert ("Browser does not support HTTP Request");
		return;
	}
		
	var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/CheckOut.php";
		
	xmlhttp.onreadystatechange = onResultCheckOut;
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);	
}

// handler for ajax call result
function onResultCheckOut(){
	if (xmlhttp.readyState == 4) {
		if (xmlhttp.responseText == "") {
			// user is not logged in
			alert("Please login first...");
		} else {
			// user is logged in	
			document.body.innerHTML =  xmlhttp.responseText;
	
			document.getElementById("linklogin").innerHTML = "Logout";
			document.getElementById("linklogin").href = "javascript: logout()";		
			
		}
	}
}
