  var userInput = '';
  var ajaxObject = false;
  // this is our object which gives us access
  // to Ajax functionality

  function doAjaxAutoComplete(url) {
    if(document.getElementById('name').value != userInput) {
      userInput = document.getElementById('name').value;
    } else {
      console.log("We have dup input so we leave it alone");
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
    ajaxObject.onreadystatechange = autoCompleteResponse;
    // DO NOT ADD THE () AT THE END, NO PARAMETERS ALLOWED!
    ajaxObject.open('GET', url, true); // open the query to the server
    ajaxObject.send(null); // close the query
    // and now we wait until the readystate changes, at which point
    // ajaxResponse(); is executed
    return true;
  } // end function doAjaxQuery

  function doAjaxSubmit(url) {
    ajaxObject = false;
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
    ajaxObject.onreadystatechange = submitResponse;
    // DO NOT ADD THE () AT THE END, NO PARAMETERS ALLOWED!
    ajaxObject.open('GET', url, true); // open the query to the server
    ajaxObject.send(null); // close the query
    // and now we wait until the readystate changes, at which point
    // ajaxResponse(); is executed
    return true;
  }

  function autoCompleteResponse() { // this function will handle the processing
    // N.B. - in making your own functions like this, please note
    // that you cannot have ANY PARAMETERS for this type of function!!
    if (ajaxObject.readyState == 4) { // if ready state is 4 (the page is finished loading)
      if (ajaxObject.status == 200) { // if the status code is 200 (everything's OK)
        var responseXML = ajaxObject.responseXML;
        // here is where we will do the processing
        //alert(ajaxObject.responseText);
        // we should parse the returning XML and show as HTML element
        document.getElementById('divResponse').className = "visibleDiv";
        resolveResponseXML(responseXML);
      } // end if
      else { // if the status code is anything else (bad news)
        alert('Error: ' + ajaxObject.status.toString() + '. ' + ajaxObject.statusText);
        return; // exit
      }
    } // end if
    // if the ready state isn't 4, we don't do anything, just
    // wait until it is...
  } // end function

  function submitResponse() { // this function will handle the processing
    // N.B. - in making your own functions like this, please note
    // that you cannot have ANY PARAMETERS for this type of function!!
    if (ajaxObject.readyState == 4) { // if ready state is 4 (the page is finished loading)
      if (ajaxObject.status == 200) { // if the status code is 200 (everything's OK)
        // here is where we will do the processing
        //alert(ajaxObject.responseText);
        document.getElementById('divResponse').className = "hiddenDiv";
        if (ajaxObject.responseText == '1') {
          console.log('The name is on server');
        } else {
          console.log('The name is not on server');
        }
      } // end if
      else { // if the status code is anything else (bad news)
        alert('Error: ' + ajaxObject.status.toString() + '. ' + ajaxObject.statusText);
        return; // exit
      }
    } // end if
    // if the ready state isn't 4, we don't do anything, just
    // wait until it is...
  } // end function ajaxRespons

  function resolveResponseXML(responseXML) {
    var wList = responseXML.getElementsByTagName('W');
    var out = '<ul>';
    for (i = 0, len = wList.length; i < len; ) {
      out += '<li>' + wList[i++].firstChild.nodeValue + '</li>';
    }
    out += '</ul>';
    document.getElementById('divResponse').innerHTML = out;
  }

