<?php

require_once('includes/db.php');

if (isset($_GET['name'])) {
	
	$db = new mysql();
	
	$shortname = $_GET['name'];
	$venue = $db->select(array(
		'table' => "venues",
		'condition' => "shortname='$shortname'"
	));
	$fsqid = $venue['4sq_id'];
	$name = $venue['name'];

} else {
  echo "<h1>Couldn't find Venue.</h1>";
	echo "<p>Try <a href=\"/spin\">one of these</a>?";
	exit();
}

?>


<html>
<head>
<title>Check into <?= $name ?></title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
 <script> 
 	 var appID = "279836385418317";
 
     function AddUser(user) {
       $.post("get.php?type=adduser", user);
     }

     if (window.location.hash.length == 0) {
       var path = 'https://www.facebook.com/dialog/oauth?';
   var queryParams = ['client_id=' + appID,
     'redirect_uri=' + window.location,
     'response_type=token'];

	var query = queryParams.join('&');
	var url = path + query;
	window.open(url);
     } else {
	var accessToken = window.location.hash.substring(1);
	var path = "https://graph.facebook.com/me?";
   	var queryParams = [accessToken, 'callback=addUser'];
  	var query = queryParams.join('&');
   	var url = path + query;

	// use jsonp to call the graph
	var script = document.createElement('script');
	script.src = url;
	document.body.appendChild(script);        
    }
</script> 

</head>
<body>
	<h1><?= $name ?></h1>
  <button name="checkin" value="Check Me In  <br>  And Play My Shit" />
</body>
</html>
