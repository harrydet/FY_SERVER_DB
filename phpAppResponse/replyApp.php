<?php
	require_once('../phpDatabase/db_functions.php');
	$helper = new DB_FUNCTIONS();
	
	$rawdata = file_get_contents('php://input');
	$tag_code = explode('=', explode('&', $rawdata)[0])[1];
	$area_ID = explode('=', explode('&', $rawdata)[1])[1];
	if($tag_code == "explore_more"){
		$result = $helper->getReaderFromAreaID($area_ID);
		$reader_ID = $result->fetch_assoc()['reader_ID'];
		$results = $helper->getPoisForReader($reader_ID);
		$return = array();
		for($i = 0; $i < $results->num_rows; $i++){
			$return[$i] = $results->fetch_assoc();
		}
		echo json_encode($return, JSON_FORCE_OBJECT);
	} else {
		echo "ERR: BAD TAG";
	}
?> 