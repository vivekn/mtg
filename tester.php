<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">
function changer() {
	var t = document.getElementById("txt");
    if(request.readyState==2)
	t.cols = request.responseText; 
	t.innerHTML = request.responseText+' '+request.status;
	}
var request = null;
function int() {

request = new XMLHttpRequest();
request.open("GET","rand.php?d=" + new Date().getTime(),true);
request.onreadystatechange = changer;

request.send();
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<label>
  <textarea name="txt" id="txt" cols="75" rows="20" >
  </textarea>
</label>
<label>
  <input type="button" name="btn" id="btn" value="Submit" onclick = "int()"/>
</label>
</body>
</html>