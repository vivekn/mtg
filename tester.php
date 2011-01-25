<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
cceptreq.php
cceptreq.php
cceptreq.php
<html xmlns="http://www.w3.org/1999/xhtml">
cceptreq.php
cceptreq.php
cceptreq.php
<head>
cceptreq.php
cceptreq.php
cceptreq.php
<script language="javascript">
cceptreq.php
cceptreq.php
cceptreq.php
function changer() {
cceptreq.php
cceptreq.php
cceptreq.php
	var t = document.getElementById("txt");
cceptreq.php
cceptreq.php
cceptreq.php
    if(request.readyState==2)
cceptreq.php
cceptreq.php
cceptreq.php
	t.cols = request.responseText; 
cceptreq.php
cceptreq.php
cceptreq.php
	t.innerHTML = request.responseText+' '+request.status;
cceptreq.php
cceptreq.php
cceptreq.php
	}
cceptreq.php
cceptreq.php
cceptreq.php
var request = null;
cceptreq.php
cceptreq.php
cceptreq.php
function int() {
cceptreq.php
cceptreq.php
cceptreq.php

cceptreq.php
cceptreq.php
cceptreq.php
request = new XMLHttpRequest();
cceptreq.php
cceptreq.php
cceptreq.php
request.open("GET","rand.php?d=" + new Date().getTime(),true);
cceptreq.php
cceptreq.php
cceptreq.php
request.onreadystatechange = changer;
cceptreq.php
cceptreq.php
cceptreq.php

cceptreq.php
cceptreq.php
cceptreq.php
request.send();
cceptreq.php
cceptreq.php
cceptreq.php
}
cceptreq.php
cceptreq.php
cceptreq.php
</script>
cceptreq.php
cceptreq.php
cceptreq.php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
cceptreq.php
cceptreq.php
cceptreq.php
<title>Untitled Document</title>
cceptreq.php
cceptreq.php
cceptreq.php
</head>
cceptreq.php
cceptreq.php
cceptreq.php

cceptreq.php
cceptreq.php
cceptreq.php
<body>
cceptreq.php
cceptreq.php
cceptreq.php
<label>
cceptreq.php
cceptreq.php
cceptreq.php
  <textarea name="txt" id="txt" cols="75" rows="20" >
cceptreq.php
cceptreq.php
cceptreq.php
  </textarea>
cceptreq.php
cceptreq.php
cceptreq.php
</label>
cceptreq.php
cceptreq.php
cceptreq.php
<label>
cceptreq.php
cceptreq.php
cceptreq.php
  <input type="button" name="btn" id="btn" value="Submit" onclick = "int()"/>
cceptreq.php
cceptreq.php
cceptreq.php
</label>
cceptreq.php
cceptreq.php
cceptreq.php
</body>
cceptreq.php
cceptreq.php
cceptreq.php
</html>
cceptreq.php
cceptreq.php
cceptreq.php
