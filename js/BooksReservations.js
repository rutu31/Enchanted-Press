var xmlhttp = getXmlHttpObject();

// handler for on click of reservations tab
function TabReservationsActivate(paneElement) {
	if (xmlhttp == null)	{
		alert ("Browser does not support XML-HTTP");
		return;
	}
	
	paneElement.innerHTML = 'Double click on tab to load data';
    paneElement.style.cssText = 'overflow: auto; height: 300px; width: 760px;';

    var url="http://linux.students.engr.scu.edu/~sdoshi/EnchantedPress/php/BooksReservations.php";
    xmlhttp.onreadystatechange = onReservationsTab(paneElement);
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

// handler for ajax call result
function onReservationsTab(paneElement) {	
	if (xmlhttp.readyState == 4) {
		paneElement.innerHTML = xmlhttp.responseText;
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