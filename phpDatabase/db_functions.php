<?php

class DB_FUNCTIONS {

	
	function __construct(){
		require_once 'db_connect.php';
	
	function __destruct(){
		
	}
	
	public function getUserByTicketPin($passport_number, $pin){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT first_name, last_name, Person.person_id FROM Person INNER JOIN RFID_Tag ON Person.person_id = RFID_Tag.person_id WHERE passport_number='$passport_number'";
		if(!$result = $conn->query($sql)) {
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}	
	}
}

?>