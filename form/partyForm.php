<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-type: application/json');

$servername = "us-cdbr-iron-east-01.cleardb.net";
$dbusername = "b30ea52d3aa952";
$dbpassword = "918a5c13";
$dbname = "heroku_1c39a65d43a5546";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$image = null;
$image2 = null;
$partyName = null;
$FounderID = null;
$FoundingTime = null;
$PartyTel = null;
$BuildingName = null;
$BuildingNO = null;
$BuildingStreet = null;
$BuildingDetail = null;
$BuildingPicture = null;
$SubDistrictName = null;
$Zipcode = null;
$BuildingType = null;
$PartyLogo = null;
$leaderID = null;

$PersonalID = null;
$PartyPosID = null;
$SubMinistryName = null;
$CouncilPosID = null;
$MinistryPosID = null;
$Surname = null;
$Lastname = null;
$DOB = null;
$EducationDegree = null;
$Password = null;
$MemberPicture = null;

$data = file_get_contents("php://input");
$array = json_decode($data, true);
//print_r($array);
foreach ($array["jsonform"] as $key => $output) {
	if ($key === 'buildingdetail') {
		$BuildingDetail = $output;
		echo $BuildingDetail . "\n";
	} elseif ($key === 'buildingname') {
		$BuildingName = $output;
		echo $BuildingName . "\n";
	} elseif ($key === 'buildingnumber') {
		$BuildingNO =   $output;
		echo  $BuildingNO . "\n";
	} elseif ($key === 'buildingstreet') {
		$BuildingStreet = $output;
		echo $BuildingStreet . "\n";
	} elseif ($key === 'buildingtype') {
		$BuildingType = $output;
		echo $BuildingType . "\n";
	} elseif ($key === 'founderID') {
		$FounderID = $output;
		echo $FounderID . "\n";
	} elseif ($key === 'founderdate') {
		$FoundingTime = $output;
		echo $FoundingTime . "\n";
	} elseif ($key === 'leaderID') {
		$leaderID = $output;
		echo $leaderID . "\n";
	} elseif ($key === 'partyname') {
		$partyName = $output;
		echo $partyName . "\n";
	} elseif ($key === 'subdistrict') {
		$SubDistrictName = $output;
		echo $SubDistrictName . "\n";
	} elseif ($key === 'telephone') {
		$PartyTel = $output;
		echo $PartyTel . "\n";
	} elseif ($key === 'zipcode') {
		$Zipcode = $output;
		echo $Zipcode . "\n";
	} elseif ($key === 'id') {
		$PersonalID = $output;
		echo $PersonalID . "\n";
	} elseif ($key === 'password') {
		$Password = $output;
		echo $Password . "\n";
	} elseif ($key === 'firstname') {
		$Surname = $output;
		echo $Surname . "\n";
	} elseif ($key === 'lastname') {
		$Lastname = $output;
		echo $Lastname . "\n";
	} elseif ($key === 'education') {
		$EducationDegree = $output;
		echo $EducationDegree . "\n";
	} elseif ($key === 'dob') {
		$DOB = $output;
		echo $DOB . "\n";
	} elseif ($key === 'subministryname') {
		$SubMinistryName = $output;
		echo $SubMinistryName . "\n";
	}
}

foreach ($array["jsonform"] as $key => $output) {
	if ($key == 'councilpos') {
		foreach ($output as $key => $result) {
			if ($key == 'CouncilPosID') {
				$CouncilPosID = $result;
				echo $CouncilPosID . "\n";
			}
		}
	} elseif ($key == 'partyPos') {
		foreach ($output as $key => $result) {
			if ($key == 'PartyPosID') {
				$PartyPosID = $result;
				echo $PartyPosID . "\n";
			}
		}
	} elseif ($key == 'ministrypos') {
		foreach ($output as $key => $result) {
			if ($key == 'MinistryPosID') {
				$MinistryPosID = $result;
				echo $MinistryPosID . "\n";
			}
		}
	}
}

if ($FounderID === '') {
	$FounderID = "NULL";
} else {
	$FounderID = "'" . $FounderID . "'";
}
if ($BuildingType === '') {
	$BuildingType = "NULL";
	//print_r($BuildingType);
} else {
	$BuildingType = "'" . $BuildingType . "'";
	//print_r($BuildingType);
}

if ($BuildingName === '') {
	$BuildingName = "NULL";
} else {
	$BuildingName = "'" . $BuildingName . "'";
}

if ($BuildingStreet === '') {
	$BuildingStreet = "NULL";
} else {
	$BuildingStreet = "'" . $BuildingStreet . "'";
}

if ($BuildingDetail === '') {
	$BuildingDetail = "NULL";
} else {
	$BuildingDetail = "'" . $BuildingDetail . "'";
}

if ($PersonalID === '') {
	$BuildingDetail = "NULL";
} else {
	$PersonalID = "'" . $PersonalID . "'";
}

if ($Surname === '') {
	$Surname = "NULL";
} else {
	$Surname = "'" . $Surname . "'";
}
if ($Lastname === '') {
	$Lastname = "NULL";
} else {
	$Lastname = "'" . $Lastname . "'";
}

if ($DOB === '') {
	$DOB = "NULL";
} else {
	$DOB = "'" . $DOB . "'";
}

if ($EducationDegree === '') {
	$EducationDegree = "NULL";
} else {
	$EducationDegree = "'" . $EducationDegree . "'";
}

if ($Password === '') {
	$Password = "NULL";
} else {
	$Password = "'" . $Password . "'";
}

if ($SubMinistryName == '') {
	$SubMinistryName = "NULL";
	//print_r('eaosd');
} else {
	$SubMinistryName = "'" . $SubMinistryName . "'";
	//print_r('eaossssssssssd');
}

if ($PartyPosID === null) {
	$PartyPosID = "NULL";
}
if ($CouncilPosID === null) {
	$CouncilPosID = "NULL";
}
if ($MinistryPosID === null) {
	$MinistryPosID = "NULL";
} 

$image = $array["image"];
$image2 = $array["image2"];
$MemberPicture = $array["image3"];
//echo $image."\n";
if ($image == "https://bulma.io/images/placeholders/256x256.png") {
	$image = "NULL";
} else {
	$image = explode(',', $image);
	$image = base64_encode($image[1]);
	$image = base64_decode("'" . $image . "'");
	$image = "'" . $image . "'";
}
if ($image2 == "https://bulma.io/images/placeholders/256x256.png") {
	$image2 = "NULL";
} else {
	$image2 = explode(',', $image2);
	$image2 = base64_encode($image2[1]);
	$image2 = base64_decode("'" . $image2 . "'");
	$image2 = "'" . $image2 . "'";
}

if ($MemberPicture == "https://bulma.io/images/placeholders/256x256.png") {
	$MemberPicture = "NULL";
} else {
	$MemberPicture = explode(',', $MemberPicture);
	$MemberPicture = base64_encode($MemberPicture[1]);
	$MemberPicture = base64_decode("'" . $MemberPicture . "'");
	$MemberPicture = "'" . $MemberPicture . "'";
}

$sql = "INSERT INTO politicalparty (partyName,FounderID,FoundingTime,PartyTel,BuildingName,
BuildingNO,BuildingStreet,BuildingDetail,BuildingPicture,SubDistrictName,Zipcode,BuildingType,PartyLogo)
VALUES ('$partyName',$FounderID,'$FoundingTime','$PartyTel',$BuildingName,'$BuildingNO',$BuildingStreet,$BuildingDetail,$image2,'$SubDistrictName','$Zipcode',$BuildingType,$image)";
if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}


if (
	$PersonalID != "NULL" && $PartyPosID != "NULL" && $SubMinistryName != "NULL" && $CouncilPosID != "NULL" && $MinistryPosID != "NULL"
	&& $Surname != "NULL" && $Lastname != "NULL" && $DOB != "NULL" && $EducationDegree != "NULL" && $Password != "NULL" && $MemberPicture != "NULL"
) {
	$sql = "INSERT INTO councilmember (personalID,PartyName,PartyPosID,SubministryName,CouncilPosID,
MinistryPosID,Surname,Lastname,DOB,EducationDegree,Password,MemberPicture)
VALUES ($PersonalID,'$partyName',$PartyPosID,$SubMinistryName,$CouncilPosID,$MinistryPosID,$Surname,$Lastname,$DOB,$EducationDegree,$Password,$MemberPicture)";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
$conn->close();
?>

