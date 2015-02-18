<?php

	require_once('pushNotification.php');
	require_once('../phpDatabase/db_connect.php');
	
	$data = array();
	$data[0] = 335392;
	
	$push = new PUSH();
	$push->sendPush('001001', $data);
	
?>