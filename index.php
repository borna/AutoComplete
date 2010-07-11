<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>First ever Ajax application with PHP</title>
    <link type="text/css" rel="stylesheet" href="index.css" />
    <script language="JavaScript" type="text/javascript">
      var userInput = '';
      var ajaxObject = false;
      // this is our object which gives us access
      // to Ajax functionality
      function doAjaxQuery(url) {
        if(document.getElementById('name').value != userInput) {
          userInput = document.getElementById('name').value;
        } else {
          return false;
        }
        ajaxObject = false;
        //if(document.getElementById('name').value >= 'a' && document.getElementById('name').value <= 'z')
        // alert(document.getElementById('name').value);
        if (window.XMLHttpRequest) { // if we're on Gecko (Firefox etc.), KHTML/WebKit (Safari/Konqueror) and IE7
          ajaxObject = new XMLHttpRequest(); // create our new Ajax object
          if (ajaxObject.overrideMimeType) { // older Mozilla-based browsers need some extra help
            ajaxObject.overrideMimeType('text/xml');
          }
        } else if (window.ActiveXObject) { // and now for IE6
          try {// IE6 has two methods of calling the object, typical!
            ajaxObject = new ActiveXObject("Msxml2.XMLHTTP");
            // create the ActiveX control
          } catch (e) { // catch the error if creaion fails
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
        document.getElementById('divResponse').className = "hiddenDiv";

        if (url.match(/ajaxAC/)) {
          ajaxObject.onreadystatechange = ajaxAC_Response;
        }
        else {
          ajaxObject.onreadystatechange = ajax_Response; // when the ready state changes, run this function
        }
        // DO NOT ADD THE () AT THE END, NO PARAMETERS ALLOWED!
        ajaxObject.open('GET', url, true); // open the query to the server
        ajaxObject.send(null); // close the query
        // and now we wait until the readystate changes, at which point
        // ajaxResponse(); is executed
        return true;
      } // end function doAjaxQuery

      function ajaxAC_Response() { // this function will handle the processing
        // N.B. - in making your own functions like this, please note
        // that you cannot have ANY PARAMETERS for this type of function!!
        if (ajaxObject.readyState == 4) { // if ready state is 4 (the page is finished loading)
          if (ajaxObject.status == 200) { // if the status code is 200 (everything's OK)
            // here is where we will do the processing
            //alert(ajaxObject.responseText);
            // we should parse the returning XML and show as HTML element
            document.getElementById('divResponse').className = "visibleDiv";
            document.getElementById('divResponse').innerHTML = ajaxObject.responseText;
          } // end if
          else { // if the status code is anything else (bad news)
            alert('Error: ' + ajaxObject.status.toString() + '. ' + ajaxObject.statusText);
            return; // exit
          }
        } // end if
        // if the ready state isn't 4, we don't do anything, just
        // wait until it is...
      } // end function

      function ajax_Response() { // this function will handle the processing
        // N.B. - in making your own functions like this, please note
        // that you cannot have ANY PARAMETERS for this type of function!!
        if (ajaxObject.readyState == 4) { // if ready state is 4 (the page is finished loading)
          if (ajaxObject.status == 200) { // if the status code is 200 (everything's OK)
            // here is where we will do the processing
            //alert(ajaxObject.responseText);
            document.getElementById('divResponse').className = "hiddenDiv";
            if (ajaxObject.responseText == '1') {
              alert('The name is on server');
            } else {
              alert('The name is not on server');
            }
          } // end if
          else { // if the status code is anything else (bad news)
            alert('Error: ' + ajaxObject.status.toString() + '. ' + ajaxObject.statusText);
            return; // exit
          }
        } // end if
        // if the ready state isn't 4, we don't do anything, just
        // wait until it is...
      } // end function ajaxResponse

      function submit_and_cleanup() {
        doAjaxQuery('ajax.php?name=' + document.getElementById('name').value);
        //document.getElementById('divResponse').className = "hiddenDiv";
        //document.getElementById('divResponse').innerHTML = "";
      }
    </script>
  </head>
  <body>
    <div>
      <form name="ajaxform"
            method="get"
            action="javascript:;"
            autocomplete = "off"
            onkeyup="doAjaxQuery('ajaxAC.php?name=' + document.getElementById('name').value);"
            onsubmit="doAjaxQuery('ajax.php?name=' + document.getElementById('name').value);">

        <!--Search:&nbsp;&nbsp;-->
        <input type="text" name="name" id="name" value="" />
        <input type="submit" value=" Search " onClick="submit_and_cleanup();"/>
      </form>
    </div>

    <div Class="hiddenDiv" id="divResponse">server response area:</div>
  </body>
</html>
