<?php
//git test
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

	$response = array();
	date_default_timezone_set('UTC');
	
	require_once __DIR__ . '/db_connect.php';
	
	$db = new DB_CONNECT();
	$conn = $db->connect();
	$rawdata = file_get_contents('php://input');
	$first_name = explode('=', explode('&', $rawdata)[0])[1];
	$last_name = explode('=', explode('&', $rawdata)[1])[1];
	$passport_no_raw = explode('=', explode('&', $rawdata)[2])[1];
	$raw_dob = explode('=', explode('&', $rawdata)[3])[1];
	$tag_code = explode('=', explode('&', $rawdata)[4])[1];
	$tag_protocol = explode('=', explode('&', $rawdata)[5])[1];
	$last_read = explode('=', explode('&', $rawdata)[6])[1];
	$dob = str_replace('%2F', '-', $raw_dob);
	$passport_no = str_replace('+', ' ', $passport_no_raw);
	
	$sql = "INSERT INTO Person (first_name, last_name, passport_number, date_of_birth) VALUES ('$first_name', '$last_name', '$passport_no', '$dob')";
	
	if($conn->query($sql) === false) {
		$responseReader = array("status" => "error", "details" => $conn->error);
	} else {
		$responseReader = array("status" => "success", "details" => $conn->error);
	}	
	
	$sql = "INSERT INTO RFID_Tag (tag_code, protocol, last_read_from, person_id) VALUES ('$tag_code', '$tag_protocol', '$last_read', (SELECT MAX(person_id) AS person_id FROM Person))";
	if($conn->query($sql) === false) {
		$responseTag = array("status" => "error", "details" => $conn->error);
		if($responseReader["status"] == "success"){
			$sql = "DELETE FROM Person WHERE passport_number='$passport_no'";
			$conn->query($sql);
		}
	} else {
		$responseTag = array("status" => "success", "details" => $conn->error);
	}
	
	echo json_encode(array("reply_reader" => $responseReader, "reply_tag" => $responseTag));
	
	
?>
	