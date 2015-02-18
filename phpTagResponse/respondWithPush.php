<?php
	
	$rawdata = file_get_contents('php://input');
	$tag_code = explode('=', explode('&', $rawdata)[0])[1];
	$reader_serial = explode('=', explode('&', $rawdata)[1])[1];

	require_once('pushNotification.php');
	require_once('../phpDatabase/db_connect.php');
	
	$db = new DB_CONNECT();
	$conn = $db->connect();
	$sql = "SELECT passport_number FROM Person INNER JOIN RFID_Tag ON Person.person_id=RFID_Tag.person_id WHERE RFID_Tag.tag_code='$tag_code'";
	echo $sql."\n";
	if(!$result = $conn->query($sql)) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		echo "Error";
	} else {
		echo "Success";
	}
	
	$data = array();
	$data[0] = $reader_serial;
	
	$push = new PUSH();
	$push->sendPush($result->fetch_assoc()["passport_number"], $data);
	
	
?>