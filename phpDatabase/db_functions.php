<?php

class DB_FUNCTIONS {

	
	function __construct(){
		require_once 'db_connect.php';
	}
	function __destruct(){
		
	}
	
	public function getUserByTicketPin($passport_number, $pin){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT first_name, last_name FROM Person WHERE passport_number='$passport_number'";
		if(!$result = $conn->query($sql)) {
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}	
	}
	
	public function getAllReaders(){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT * FROM READERS";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getAllReadersLtd($offset, $rec_limit){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT * FROM READERS LIMIT $offset, $rec_limit";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getAllPointsOfInterest(){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT * FROM POINTS_OF_INTEREST";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getAllPointsOfInterestLtd($offset, $rec_limit){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT * FROM POINTS_OF_INTEREST LIMIT $offset, $rec_limit";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function deletePoiFromID($id){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="DELETE FROM POINTS_OF_INTEREST WHERE poi_ID=$id";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function insertIntoPoiWithFields($field1, $field2, $field3){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="INSERT INTO POINTS_OF_INTEREST (poiName, poiDescription, poiCategory) VALUES('$field1', '$field2', $field3)";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function deleteReaderFromID($id){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="DELETE FROM READERS WHERE reader_ID=$id";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function insertIntoReadersWithFields($field1, $field2){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="INSERT INTO READERS (areaID, sensorSerial) VALUES('$field1', '$field2')";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getReaderFromAreaID($area_ID){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "SELECT reader_ID FROM READERS WHERE areaID=$area_ID";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getPoisForReader($reader_ID){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="SELECT o.poiName, o.poiDescription, o.poiCategory, o.poiCoverImage FROM JNCT_GATES_POINTS_OF_INTEREST AS uo INNER JOIN POINTS_OF_INTEREST AS o ON uo.poi_FK = o.poi_ID WHERE uo.reader_FK = $reader_ID";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getPoiAssociations($poi_ID){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="SELECT reader_FK FROM JNCT_GATES_POINTS_OF_INTEREST WHERE poi_FK=$poi_ID";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function getPoiByID($poi_ID){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="SELECT * FROM POINTS_OF_INTEREST WHERE poi_ID=$poi_ID";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function updatePoi($poi_ID, $poiName, $poiDescription, $poiCategory){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql="UPDATE POINTS_OF_INTEREST SET poiName='".$poiName."', poiDescription='".$poiDescription."', poiCategory=$poiCategory WHERE poi_ID=$poi_ID";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
	public function storeImagePath($poi_ID, $path){
		$db = new DB_CONNECT();
		$conn = $db->connect();
		$sql = "UPDATE POINTS_OF_INTEREST SET poiCoverImage='".$path."' WHERE poi_ID=$poi_ID";
		if(!$result = $conn->query($sql)){
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			echo "Error";
		} else {
			return $result;
		}
	}
	
}

?>