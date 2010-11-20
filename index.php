<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>First ever Ajax application with PHP</title>
    <link type="text/css" rel="stylesheet" href="index.css" />
    <script type="text/javascript" src="isugg.js"></script>
  </head>
  <body>
    <div>
      <form name="ajaxform"
            method="get"
            action="javascript:"
            autocomplete="off"
            onkeyup="doAjaxAutoComplete('ajaxAC.php?name=' + document.getElementById('name').value);"
            onsubmit="doAjaxSubmit('ajax.php?name=' + document.getElementById('name').value);"
            >
        <input type="text" name="name" id="name" value="" />
        <input type="submit" value=" Search " />
      </form>
    </div>

    <div Class="hiddenDiv" id="divResponse">server response area:</div>
  </body>
  </html>
