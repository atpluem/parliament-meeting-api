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
	$MinistryName = null;
	$MinistryID = null;
	$MinistryDetail = null;
	$MinistrySymbol = null;

	$SubMinistryName = null;
	$MinistryName =null;
	$SubMinistryDetail=null;
	$BuildingName = null;
	$BuildingType = null;
	$BuildingNO = null;
	$BuildingStreet = null;
	$BuildingDetail = null;
	$BuildingPicture =null;
	$SubDistrictName=null;
	$Zipcode=null;


	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	print_r($array);
	
	foreach($array[0] as $key => $output) {
		if($key == "ministryname"){
			$MinistryName = $output;
			print_r($MinistryName."\n");
		}else if($key == "ministryID"){
			$MinistryID = $output;
			print_r($MinistryID."\n");
		}else if($key == "ministrydetail"){
			$MinistryDetail = $output;
			print_r($MinistryDetail."\n");
		}else if($key == "buildingname"){
			$BuildingName = $output;
			print_r($BuildingName."\n");
		}else if($key == "buildingnumber"){
			$BuildingNO = $output;
			print_r($BuildingNO."\n");
		}else if($key == "buildingtype"){
			$BuildingType = $output;
			print_r($BuildingType."\n");
		}else if($key == "buildingstreet"){
			$BuildingStreet = $output;
			print_r($BuildingStreet."\n");
		}else if($key == "zipcode"){
			$Zipcode = $output;
			print_r($Zipcode."\n");
		}else if($key == "subdistrict"){
			$SubDistrictName = $output;
			print_r($SubDistrictName."\n");
		}else if($key == "buildingdetail"){
			$BuildingDetail = $output;
			print_r($BuildingDetail."\n");
		}else if($key == "subministryname"){
			$SubMinistryName = $output;
			print_r($SubMinistryName."\n");
		}else if($key == "subministrydetail"){
			$SubMinistryDetail = $output;
			print_r($SubMinistryDetail."\n");
		}
	} 
	if($BuildingName != null){
		$BuildingName = "'".$BuildingName."'";
		print_r($BuildingName);
	}else{
		$BuildingName = "NULL";
	}
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
	if($SubMinistryName != null){
		$SubMinistryName = "'".$SubMinistryName."'";
		print_r($SubMinistryName);
	}else{
		$BuildingDetail = "NULL";
	}
	if($SubMinistryDetail != null){
		$SubMinistryDetail = "'".$SubMinistryDetail."'";
		print_r($SubMinistryDetail);
	}else{
		$SubMinistryDetail = "NULL";
	}
	if($MinistryID != null){
		$MinistryID = "'".$MinistryID."'";
		print_r($MinistryID);
	}else{
		$MinistryID = "NULL";
	}
	if($MinistryDetail != null){
		$MinistryDetail = "'".$MinistryDetail."'";
		print_r($MinistryDetail);
	}else{
		$MinistryDetail = "NULL";
	}
	$MinistrySymbol = $array[1];
	if($MinistrySymbol === "https://bulma.io/images/placeholders/256x256.png"){
		$MinistrySymbol = "NULL";
	}else
	{
		$MinistrySymbol = explode(',', $MinistrySymbol);
		$MinistrySymbol = base64_encode($MinistrySymbol[1]);
		$MinistrySymbol = base64_decode($MinistrySymbol);
		$MinistrySymbol = "'".$MinistrySymbol."'";
	}

	$BuildingPicture = $array[2];
	if($BuildingPicture === "https://bulma.io/images/placeholders/256x256.png"){
		$BuildingPicture = "NULL";
	}else
	{
		$BuildingPicture = explode(',', $BuildingPicture);
		$BuildingPicture = base64_encode($BuildingPicture[1]);
		$BuildingPicture = base64_decode($BuildingPicture);
		$BuildingPicture = "'".$BuildingPicture."'";
	}

			
	
$sql = "INSERT INTO ministry (MinistryName,MinisterID,MinistryDetail,MinistrySymbol)
VALUES ('$MinistryName',$MinistryID,$MinistryDetail,$MinistrySymbol)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}

if($SubMinistryName != null){
	$sql = "INSERT INTO subministry (SubMinistryName,MinistryName,SubMinistryDetail,BuildingName,BuildingNO,BuildingStreet,BuildingDetail,BuildingPicture,SubDistrictName,Zipcode)
	VALUES ($SubMinistryName,'$MinistryName',$SubMinistryDetail,$BuildingName,$BuildingNO,$BuildingStreet,$BuildingDetail,$BuildingPicture,$SubDistrictName,$Zipcode)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
}
 $conn->close();
	


?>
