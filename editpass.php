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

	$PersonalID = null;
	$Password = null;
	$NewPassword = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
  
	foreach($array[jsonform] as $key => $output) {
		if($key === 'password') {
			$Password = $output;
		}
    		else if($key === 'newpassword') {
      			$NewPassword = $output;
    		}	
		else if($key === 'personalid') {
      			$PersonalID = $output;
    		}
	} 

$sql = "UPDATE councilmember
SET Password = $NewPassword WHERE Password = $Password AND PersonalID = $PersonalID";

if ($conn->query($sql) === TRUE) {
	print_r("Change password successfully");
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();

?>
