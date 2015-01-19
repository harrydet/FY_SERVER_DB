<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	require_once 'db_functions.php';
	
	$helper = new DB_FUNCTIONS();
	$rawdata = file_get_contents('php://input');
	$tag = explode('=', explode('&', $rawdata)[0])[1];
	$ticket_no = explode('=', explode('&', $rawdata)[1])[1];
	$pin = explode('=', explode('&', $rawdata)[2])[1];
	
	$result = $helper->getUserByTicketPin($ticket_no, $pin);
	$response = $result->fetch_assoc();
	echo json_encode($response);
?>