<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Content-type: application/json');

	$servername = "us-cdbr-east-06.cleardb.net";
	$dbusername = "b6f44590f309b7";
	$dbpassword = "df25ea47";
	$dbname = "heroku_081a4c7d902d08f";
	$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$personalID = null;
	$conferenceID = null;
	$conferencedate = null;
	$startime = null;
	$starttimemin = null;
	$endtime = null;
	$endtimemin = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data, true);
	print_r($array);
	
	foreach($array[jsonform] as $key => $output) {
		if($key === 'personalID') {
			$personalID = $output;
			echo $personalID."/n";
		}
		elseif($key === 'conferenceID') {
			$conferenceID = $output;
			echo $conferenceID."/n";
		}
		elseif($key === 'conferencedate') {
			$conferencedate = $output;
			echo $conferencedate."/n";
		}
		elseif($key === 'starttime') {
			$starttime = $output;
			echo $starttime."/n";
		}
		elseif($key === 'starttimemin') {
			$starttimemin = $output;
			echo $starttimemin."/n";
		}
		elseif($key === 'endtime') {
			$endtime = $output;
			echo $endtime."/n";
		}
		elseif($key === 'endtimemin') {
			$endtimemin = $output;
			echo $endtimemin."/n";
		}
	}

	$sql = "INSERT INTO attendees (PersonalID, ConferenceID, AttendantTime, LeaveTime) VALUES ($personalID, $conferenceID, '$conferencedate-$starttime:$starttimemin', '$conferencedate-$endtime:$endtimemin')";
	
	if ($conn -> query($sql) === true) {
		echo "New record created successfully";
	}
	else {
		echo "Error : " . $sql . "/n" . $conn -> error;
	}
	
	$conn -> close();

?>
