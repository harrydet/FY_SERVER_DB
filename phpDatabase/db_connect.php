<?php
/**
* A class file to connect to database
*/
class DB_CONNECT {
// constructor
function __construct() {
// connecting to database
$this->connect();
}
/**
* Function to connect with database
*/
function connect() {
// import database connection variables
require_once __DIR__ . '/db_config.php';
// Connecting to mysql database
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
// check connection
if ($conn->connect_error) {
trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
// returing connection cursor
return $conn;
}
}
?>