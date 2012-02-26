<?php

require_once('includes/db.php');

session_start();
$response = array();

header('Content-Type: application/json charset=UTF-8');

if (isset($_GET['type')) {

	switch($_GET['type']) {
		case 'adduser':
			add_user($_POST['data']);
			break;
		case 'add4sq':
			add_4sq($_POST['data']);
			break;
	}

	print json_encode($response);
	exit();	
}

function add_user($data) {

	$db = new mysql();
	
	$user['name'] = $data['name'];
	$user['fb_id'] = $data['id'];
	$user['fb_auth'] = $data['authtoken'];

	$db->insert('users', $user) or failure('could not insert');

	$userId = $db->get('users', 'userId', "fb_id='$fb_id'");

	$response['status'] = 'success';
	$response['data'] = array('userid' => $userid);
}

function add_4sq($data) {
	$db = new mysql();
	
	$user['4sq_id'] = $data['response']['user']['id'];
	$user['4sq_auth'] = $data['auth_token'];
	
	$db->update('users', $user, "userId = '$userId'");
}

function setToken($userId) {
	$_SESSION['token_timestamp'] = time();
	$_SESSION['token'] = uniqid($userId);
	return $_SESSION['token'];	
}

function checkToken($token) {
	if ($token !== $_SESSION['token'])
		return false;
	if (time() - $_SESSION['token_timestamp'] > 120000) // 2 minutes timeout
		return false;
	return true;
}

function failure($message) {
	$response['status'] = 'failure';
	$response['reason'] = $message;
	print json_encode($response);
	log('failure: ' . $message . implode(', ', $_POST));
	exit(9);
}



?>