<?php
if (get_magic_quotes_runtime())
set_magic_quotes_runtime(0);
class PUSH {
	private $appId = 'g53i1BHiKF9rTuMqZk0ctwtU0QPnpYIPCMspbCv8';
	private $restKey = '66Gy3Smr3lnvrbHCIlKf3goqtk6qok5IHVBWgpgY';
	private $masterKey = '4bqI9adXfW7S8WVksgO5OLxzLqFvRlIjFhR341OZ';
	private $url = "https://api.parse.com/1/push";
	//constructor
	function __construct(){
	}
	//send push
	function sendPush($passporNo, $data){
		$payload = '{"where":{"passportNo":"'.$passporNo.'"}, "data":{"alert":"hi", "title":"Im scanned"}}';
		echo stripslashes($payload)."\n";
		$rest = curl_init();
		curl_setopt($rest,CURLOPT_URL,$this->url);
		curl_setopt($rest,CURLOPT_PORT,443);
		curl_setopt($rest,CURLOPT_POST,1);
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($rest,CURLOPT_POSTFIELDS, stripslashes($payload));
		curl_setopt($rest,CURLOPT_HTTPHEADER,
		array("X-Parse-Application-Id: " . $this->appId,
		"X-Parse-REST-API-Key: " . $this->restKey,
		"X-Parse-Master-Key: " . $this->masterKey,
		"Content-Type: application/json"));
		$response = curl_exec($rest);
		curl_close($rest);
		echo $response;
		return $response;
	}
	
}
?>