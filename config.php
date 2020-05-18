<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
 
	$db_username = 'b6f44590f309b7';
	$db_password = 'df25ea47';
	$db_name = 'heroku_081a4c7d902d08f';
	$db_host = 'us-cdbr-east-06.cleardb.net';				
	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
 
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
?>
