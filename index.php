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
</head>
<body>
	<h1><?= $name ?></h1>
  <button name="checkin" value="Check Me In  <br>  And Play My Shit" />
</body>
</html>
