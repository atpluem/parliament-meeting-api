<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Content-type: application/json');
	
	$servername = "us-cdbr-iron-east-01.cleardb.net";
	$dbusername = "b30ea52d3aa952";
	$dbpassword = "918a5c13";
	$dbname = "heroku_1c39a65d43a5546";
	$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$BuildingName = null;
	$BuildingType = null;
	$BuildingNO = null;
	$BuildingStreet = null;
	$BuildingDetail = null;
	$BuildingPicture =null;
	$SubDistrictName=null;
	$Zipcode=null;

	$room1 = null;
	$room2 = null;
	$room3 = null;
	$room4 = null;
	$room5 = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	//print_r($array);
	
	foreach($array[0] as $key => $output) {
		if($key === "buildingname"){
			$BuildingName = $output;
			print_r($BuildingName."\n");
		}else if($key === "buildingnumber"){
			$BuildingNO = $output;
			print_r($BuildingNO."\n");
		}else if($key === "buildingtype"){
			$BuildingType = $output;
			print_r($BuildingType."\n");
		}else if($key === "buildingstreet"){
			$BuildingStreet = $output;
			print_r($BuildingStreet."\n");
		}else if($key === "zipcode"){
			$Zipcode = $output;
			print_r($Zipcode."\n");
		}else if($key === "subdistrict"){
			$SubDistrictName = $output;
			print_r($SubDistrictName."\n");
		}else if($key === "buildingdetail"){
			$BuildingDetail = $output;
			print_r($BuildingDetail."\n");
		}else if($key === "room1"){
			$room1 = $output;
			print_r($room1."\n");
		}else if($key === "room2"){
			$room2 = $output;
			print_r($room2."\n");
		}else if($key === "room3"){
			$room3 = $output;
			print_r($room3."\n");
		}else if($key === "room4"){
			$room4 = $output;
			print_r($room4."\n");
		}else if($key === "room5"){
			$room5 = $output;
			print_r($room5."\n");
		}
	} 
	$BuildingPicture = $array[1] ;
	if($BuildingType != null){
		$BuildingType = "'".$BuildingType."'";
		print_r($BuildingType);
	}else{
		$BuildingType = "NULL";
	}
	if($Zipcode != null){
		$Zipcode = "'".$Zipcode."'";
		print_r($Zipcode);
	}else{
		$Zipcode = "NULL";
	}
	if($BuildingNO != null){
		$BuildingNO = "'".$BuildingNO."'";
		print_r($BuildingNO);
	}else{
		$BuildingNO = "NULL";
	}
	if($BuildingStreet != null){
		$BuildingStreet = "'".$BuildingStreet."'";
		print_r($BuildingStreet);
	}else{
		$BuildingStreet = "NULL";
	}
	if($SubDistrictName != null){
		$SubDistrictName = "'".$SubDistrictName."'";
		print_r($SubDistrictName);
	}else{
		$SubDistrictName = "NULL";
	}
	if($BuildingDetail != null){
		$BuildingDetail = "'".$BuildingDetail."'";
		print_r($BuildingDetail);
	}else{
		$BuildingDetail = "NULL";
		
	}

	if($BuildingPicture === "https://bulma.io/images/placeholders/256x256.png"){
		$BuildingPicture = "NULL";
	}else
	{
		$BuildingPicture = explode(',', $BuildingPicture);
		$BuildingPicture = base64_encode($BuildingPicture[1]);
		$BuildingPicture = base64_decode("'".$BuildingPicture."'");
		$BuildingPicture = "'".$BuildingPicture."'";
	}
	//print_r($BuildingPicture);
	
if($BuildingName != null){
	$sql = "INSERT INTO Building (BuildingName,BuildingType,BuildingNO,BuildingStreet,BuildingDetail,BuildingPicture,SubDistrictName,Zipcode)
	VALUES ('$BuildingName',$BuildingType,$BuildingNO,$BuildingStreet,$BuildingDetail,$BuildingPicture,$SubDistrictName,$Zipcode)";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


if($room1 != null){
	$sql = "INSERT INTO room (BuildingName,RoomNo)
	VALUES ('$BuildingName','$room1')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
if($room2 != null){
	$sql = "INSERT INTO room (BuildingName,RoomNo)
	VALUES ('$BuildingName','$room2')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
if($room3 != null){
	$sql = "INSERT INTO room (BuildingName,RoomNo)
	VALUES ('$BuildingName','$room3')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
if($room4 != null){
	$sql = "INSERT INTO room (BuildingName,RoomNo)
	VALUES ('$BuildingName','$room4')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
if($room5 != null){
	$sql = "INSERT INTO room (BuildingName,RoomNo)
	VALUES ('$BuildingName','$room5')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

 $conn->close();
	


?>
