<?php 


require_once('includes/db.php');
$fb_id = $_GET['fb_id'];

$db = new mysql();

$fb_auth = $db->get('users','fb_auth',"fb_id='$fb_id'");

$graph_url = "https://graph.facebook.com/" . $fb_id . "?access_token=" . $fb_auth;

$user = json_decode(file_get_contents($graph_url));
echo("Hello " . $user->name); 


?>
