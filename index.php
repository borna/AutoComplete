<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>First ever Ajax application with PHP</title>
<link type="text/css" rel="stylesheet" href="index.css" />
<script language="JavaScript" type="text/javascript">
<!--

var userInput = '';
var ajaxObject = false; 
// this is our object which gives us access
// to Ajax functionality

function doAjaxQuery(url) {
	
	if(document.getElementById('name').value != userInput)
	{
		userInput = document.getElementById('name').value;
	}
	else
	{
		return false;
	}
	
    ajaxObject = false;
	
	//if(document.getElementById('name').value >= 'a' && document.getElementById('name').value <= 'z')
	//	alert(document.getElementById('name').value);

	if (window.XMLHttpRequest) { // if we're on Gecko (Firefox etc.), KHTML/WebKit (Safari/Konqueror) and IE7
		
		ajaxObject = new XMLHttpRequest(); // create our new Ajax object

		if (ajaxObject.overrideMimeType) { // older Mozilla-based browsers need some extra help
			ajaxObject.overrideMimeType('text/xml');
		}
	
		
	}
	else if (window.ActiveXObject) { // and now for IE6
			try {// IE6 has two methods of calling the object, typical!

			ajaxObject = new ActiveXObject("Msxml2.XMLHTTP"); 
			// create the ActiveX control


		} catch (e) { // catch the error if creation fails

			try { // try something else

			ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
			// create the ActiveX control (using older XML library)


			} catch (e) {} // catch the error if creation fails
		}
	}

        if (!ajaxObject) { // if the object doesn't work

	    	// for some reason it hasn't worked, so show an error

		alert('Sorry, your browser seems to not support this functionality.');

		return false; // exit out of this function
        }

	
        ajaxObject.onreadystatechange = ajaxResponse; // when the ready state changes, run this function

	// DO NOT ADD THE () AT THE END, NO PARAMETERS ALLOWED!

	ajaxObject.open('GET', url, true); // open the query to the server

        ajaxObject.send(null); // close the query

	// and now we wait until the readystate changes, at which point
	// ajaxResponse(); is executed

	return true;

    } // end function doAjaxQuery

function ajaxResponse() { // this function will handle the processing

	// N.B. - in making your own functions like this, please note
	// that you cannot have ANY PARAMETERS for this type of function!!
	
	if (ajaxObject.readyState == 4) { // if ready state is 4 (the page is finished loading)

		if (ajaxObject.status == 200) { // if the status code is 200 (everything's OK)

			// here is where we will do the processing
			//alert(ajaxObject.responseText);
			if (ajaxObject.responseText == '1') // if the result is 1
			{
				//alert('Welcome back!');
				//alert(ajaxObject.responseText);
				document.getElementById('divResponse').className = "visibleDiv";

			}

			else { // otherwise

			//	alert('Nice to meet you, stranger!');
				document.getElementById('divResponse').className = "hiddenDiv";

			}

		} // end if

		else { // if the status code is anything else (bad news)

			alert('There was an error. HTTP error code ' + ajaxObject.status.toString() + '.');
			return; // exit

		}

	} // end if

	// if the ready state isn't 4, we don't do anything, just
	// wait until it is...


} // end function ajaxResponse

//-->
</script>
</head>
<body>
<form name="ajaxform" method="get" action="javascript:;" onkeyup="doAjaxQuery('ajaxKey.php?name=' + document.getElementById('name').value);"" onsubmit="doAjaxQuery('ajax.php?name=' + document.getElementById('name').value);">
Search:&nbsp;&nbsp;<input type="text" name="name" id="name" value="" /><br /><br />
<input type="submit" value=" OK " />
</form>
<div Class="hiddenDiv" id="divResponse">word is in the database!</div>
</body>
</html>