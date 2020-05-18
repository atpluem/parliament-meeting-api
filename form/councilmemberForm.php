<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-type: application/json');

$servername = "us-cdbr-east-06.cleardb.net";
$dbusername = "b6f44590f309b7";
$dbpassword = "df25ea47";
$dbname = "heroku_081a4c7d902d08f";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$id = null;
$firstname = null;
$lastname = null;
$dob = null;
$education = null;
$councilpos = null;
$partyname = null;
$subministryname = null;
$ministrypos = null;
$image = null;
$password = null;
$PartyPosID = null;

$editclick = null;
$addclick = null;
$deleteclick = null;

$data = file_get_contents("php://input");
$array = json_decode($data, true);
print_r($array);
$addclick = $array["addclick"];
$editclick = $array["editclick"];
$deleteclick = $array["deleteclick"];

//print($addclick . $editclick . $deleteclick);

foreach ($array["jsonform"] as $key => $output) {
	if ($key === 'id') {
		$id = $output;
		//echo $id."\n";
	} elseif ($key === 'firstname') {
		$firstname = $output;
		//echo $firstname."\n";
	} elseif ($key === 'lastname') {
		$lastname = $output;
		//echo $lastname."\n";
	} elseif ($key === 'dob') {
		$dob = $output;
		//echo $dob."\n";
	} elseif ($key === 'education') {
		$education = $output;
		//echo $education."\n";
	} elseif ($key === 'councilpos') {
		foreach ($output as $key => $result) {
			if ($key == 'CouncilPosID') {
				$councilpos = $result;
				echo $councilpos . "\n";
			}
		}
		//echo $councilpos."\n";
	} elseif ($key === 'partyname') {
		$partyname = $output;
		//echo $partyname."\n";
	} elseif ($key === 'subministryname') {
		$subministryname = $output;
		echo $subministryname . "\n";
	} elseif ($key === 'ministrypos') {
		foreach ($output as $key => $result) {
			if ($key == 'MinistryPosID') {
				$ministrypos = $result;
				echo $ministrypos . "\n";
			}
		}
		//echo $ministrypos."\n";
	} elseif ($key === 'password') {
		$password = $output;
		//echo $password."\n";
	} elseif ($key === 'partyPos') {
		foreach ($output as $key => $result) {
			if ($key == 'PartyPosID') {
				$PartyPosID = $result;
				echo $PartyPosID . "\n";
			}
		}
	}
}

print_r($partyname,$PartyPosID,$subministryname,$ministrypos);
if($partyname == null){
	$partyname = "NULL";
}
else{
	$partyname = "'".$partyname."'";
}

if($PartyPosID == null){
	$PartyPosID = "NULL";
}

if($subministryname == null){
	$subministryname = "NULL";
}
else{
	$subministryname = "'".$subministryname."'";
}

if($ministrypos == null){
	$ministrypos = "NULL";
}


$image = $array["image"];
$image = explode(',', $image);
$image = base64_encode($image[1]);
$image = base64_decode($image);
//echo $image."\n";

if ($addclick == true) {
	$sql = "INSERT INTO councilmember (personalID,PartyName,PartyPosID,SubministryName,CouncilPosID,
MinistryPosID,Surname,Lastname,DOB,EducationDegree,Password,MemberPicture)
VALUES ('$id',$partyname,$PartyPosID,$subministryname,$councilpos,$ministrypos,'$firstname','$lastname','$dob','$education','$password','$image')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
} elseif ($editclick == true) {
	$sql = "SELECT personalID FROM councilmember ";
	$result = mysqli_query($conn, $sql) or die("Bad query: $sql");
	while ($row = mysqli_fetch_assoc($result)) {
		if ($id == "{$row['personalID']}") {
			$sql = "UPDATE councilmember
			SET PartyName = $partyname, PartyPosID = $PartyPosID,SubministryName = $subministryname,CouncilPosID = $councilpos,
MinistryPosID = $ministrypos,Surname='$firstname',Lastname = '$lastname',DOB = '$dob',EducationDegree = '$education', Password = '$password', MemberPicture = '$image'
			WHERE personalID = '$id'";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}elseif($deleteclick == true){
	$sql = "SELECT personalID FROM councilmember ";
	$result = mysqli_query($conn, $sql) or die("Bad query: $sql");
	while ($row = mysqli_fetch_assoc($result)) {
		if ($id == "{$row['personalID']}") {
			$sql = "DELETE FROM councilmember WHERE personalID = '$id'";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}


$conn->close();
