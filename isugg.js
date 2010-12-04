  var userInput = '';
  var ajaxObject = false;

  function doAjaxAutoComplete(url) {
    if(document.getElementById('idInputBox').value != userInput) {
      userInput = document.getElementById('idInputBox').value;
    } else {
      console.log("We have dup input so we leave it alone");
      return false;
    }
    ajaxObject = false;
    if (window.XMLHttpRequest) { 
      ajaxObject = new XMLHttpRequest();
      if (ajaxObject.overrideMimeType) {
        ajaxObject.overrideMimeType('text/xml');
      }
    } else if (window.ActiveXObject) {
      try {
        ajaxObject = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        try {
          ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {}
      }
    }
    if (!ajaxObject) {
      alert('Sorry, your browser seems to not support this functionality.');
      return false;
    }
    document.getElementById('divResponse').className = "hiddenDiv";
    ajaxObject.onreadystatechange = autoCompleteResponse;
    ajaxObject.open('GET', url, true);
    ajaxObject.send(null);
    return true;
  }

  function doAjaxSubmit(url) {
    ajaxObject = false;
    if (window.XMLHttpRequest) {
      ajaxObject = new XMLHttpRequest();
      if (ajaxObject.overrideMimeType) {
        ajaxObject.overrideMimeType('text/xml');
      }
    } else if (window.ActiveXObject) {
      try {
        ajaxObject = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        try {
          ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {}
      }
    }
    if (!ajaxObject) {
      alert('Sorry, your browser seems to not support this functionality.');
      return false;
    }
    document.getElementById('divResponse').className = "hiddenDiv";
    ajaxObject.onreadystatechange = submitResponse;
    ajaxObject.open('GET', url, true);
    ajaxObject.send(null);
    return true;
  }

  function autoCompleteResponse() {
    if (ajaxObject.readyState == 4) {
      if (ajaxObject.status == 200) {
        var responseXML = ajaxObject.responseXML;
        document.getElementById('divResponse').className = "visibleDiv";
        resolveResponseXML(responseXML);
      }
      else {
        alert('Error: ' + ajaxObject.status.toString() + '. ' + ajaxObject.statusText);
        return;
      }
    }
  }

  function submitResponse() {
    if (ajaxObject.readyState == 4) {
      if (ajaxObject.status == 200) {
        document.getElementById('divResponse').className = "hiddenDiv";
        if (ajaxObject.responseText == '1') {
          console.log('The name is on server');
        } else {
          console.log('The reponse from PHP is:' + ajaxObject.responseText);
        }
      }
      else {
        alert('Error: ' + ajaxObject.status.toString() + '. ' + ajaxObject.statusText);
        return;
      }
    }
  }

  function resolveResponseXML(responseXML) {
    var wList = responseXML.getElementsByTagName('W');
    var out = '<ul>';
    for (i = 0, len = wList.length; i < len; ) {
      out += '<li>' + wList[i++].firstChild.nodeValue + '</li>';
    }
    out += '</ul>';
    document.getElementById('divResponse').innerHTML = out;
  }

