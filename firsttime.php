<html>
<head>
<title>mapTheGraph</title>
</head>
<style type="text/css">

h1 {
	color: black;
	}

body {
background-image: url('mapthegraph.jpg');
font:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 20pt;
color: red;
font-weight: bold;
}

a:hover 
{
background-color: green;
color: white;
text-decoration: underline;
font-size: 60pt;
}

a {
background-color: green;
color: white;
text-decoration: none;
font-size: 36pt;
}

</style>
<body>

<h1> Hello , <?php echo $fbme['first_name']?></h1>

<br>


<p1> mapTheGraph is a whole new experience of social networking.</p1>
<br>
<p2> Update your status.Share the interesting places you have been to lately.</p2>
<br>
<p3> Get updates from your friends.</p3>
<br><br>
<a onclick='window.location="./inv3.php"' href="#">Hop aboard!</a>	
<?php
$result = $facebook->api(
            '/me/feed/',
            'post',
            array('message' => ' is now using mapTheGraph. Try mapTheGraph now! - share and discover new places to hang out at or explore. Click on the link to check it out.           http://apps.facebook.com/mapthegraph ')
        );
?>
 

</body>
</html>
