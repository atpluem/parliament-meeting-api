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
	$chairmanID = null;
	$ConferenceID = null;
	$ConferenceTopic = null;
	$StartTime = null;
	$StartTimeMin = null;
	$EndTime = null;
	$EndTimeMin = null;
	$Dates = null;
    $ConferenceTypeID = null;
    $BuildingName = null;
	$RoomNo = null;

	$SubTopicName = null;
	$SpeakerID = null;
	$StartTopicTime = null;
	$StartTopicTimeMin = null;
	$EndTopicTime = null;
	$EndTopicTimeMin = null;
	$NumberAcceptor = null;
	$NumberRejector = null;
	$NumberNonvoter = null;
	$SubDate = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	print_r($array);
	foreach($array as $key => $output) {
		if($key === 'topicname') {
			$ConferenceTopic = $output;
			echo $ConferenceTopic."\n";
		}elseif($key === 'dateconference'){
			$Dates = $output;
			echo $Dates."\n";
		}elseif($key === 'chairmanID'){
			$chairmanID = $output;
			echo $chairmanID."\n";
		}elseif($key === 'endtime'){
			$EndTime = $output;
			echo $EndTime."\n";
		}elseif($key === 'endtimemin'){
			$EndTimeMin = $output;
			echo $EndTimeMin."\n";
		}elseif($key === 'starttime'){
			$StartTime = $output;
			echo $StartTime."\n";
		}elseif($key === 'starttimemin'){
			$StartTimeMin = $output;
			echo $StartTimeMin."\n";
		}elseif($key === 'buildingname'){
			$BuildingName = $output['BuildingName'];
			echo $BuildingName."\n";
		}
		elseif($key === 'conferencetype'){
			$ConferenceTypeID = $output['ConferenceTypeID'];
			echo $ConferenceTypeID."\n";
		}elseif($key === 'roomnumber'){
			$RoomNo = $output['RoomNo'];
			echo $RoomNo."\n";
		}elseif($key === 'speakerID'){
			$SpeakerID = $output;
			echo $SpeakerID."\n";
		}elseif($key === 'subtopicname'){
			$SubTopicName = $output;
			echo $SubTopicName."\n";
		}elseif($key === 'substarttime'){
			$StartTopicTime = $output;
			echo $StartTopicTime."\n";
		}elseif($key === 'substarttimemin'){
			$StartTopicTimeMin = $output;
			echo $StartTopicTimeMin."\n";
		}elseif($key === 'subendtime'){
			$EndTopicTime = $output;
			echo $EndTopicTime."\n";
		}elseif($key === 'subendtimemin'){
			$EndTopicTimeMin = $output;
			echo $EndTopicTimeMin."\n";
		}elseif($key === 'acceptor'){
			$NumberAcceptor = $output;
			echo $NumberAcceptor."\n";
		}elseif($key === 'rejector'){
			$NumberRejector = $output;
			echo $NumberRejector."\n";
		}elseif($key === 'nonvoter'){
			$NumberNonvoter = $output;
			echo $NumberNonvoter."\n";
		}elseif($key === 'datesubtopic'){
			$SubDate = $output;
			echo $SubDate."\n";
		}								
	} 

	if($ConferenceTypeID == null){
		$ConferenceTypeID = "NULL";
	}else{
		$ConferenceTypeID = "'".$ConferenceTypeID."'";
	}
	if($StartTimeMin == null){
		$StartTimeMin = "00";
	}
	if($StartTime == null){
		$StartTime = "NULL";
	}else{
		$StartTime = "'"."$StartTime:$StartTimeMin"."'";
		//print_r($StartTime);
	}

	if($EndTimeMin == null){
		$EndTimeMin = "00";
	}
	if($EndTime == null){
		$EndTime = "NULL";
	}else{
		$EndTime = "'"."$EndTime:$EndTimeMin"."'";
		//print_r($EndTime);
	}

	if($chairmanID == null){
		$chairmanID = "NULL";
	}else{
		$chairmanID = "'".$chairmanID."'";
		//print_r($chairmanID);
	}

	if($BuildingName == null){
		$BuildingName = "NULL";
	}else{
		$BuildingName = "'".$BuildingName."'";
		//print_r($BuildingName);
	}

	if($RoomNo == null){
		$RoomNo = "NULL";
	}else{
		$RoomNo = "'".$RoomNo."'";
		//print_r($RoomNo."\n");
	}

	if($SpeakerID == null){
		$SpeakerID = "NULL";
	}else{
		$SpeakerID = "'".$SpeakerID."'";
		//print_r($SpeakerID);
	}

	if($StartTopicTimeMin == null){
		$StartTopicTimeMin = "00";
	}
	if($StartTopicTime == null){
		$StartTopicTime = "NULL";
	}else{
		$StartTopicTime = "'"."$SubDate $StartTopicTime:$StartTopicTimeMin"."'";
		//print_r($StartTopicTime);
	}
	if($EndTopicTimeMin == null){
		$EndTopicTimeMin = "00";
	}
	if($EndTopicTime == null){
		$EndTopicTime = "NULL";
	}else{
		$EndTopicTime = "'"."$SubDate $EndTopicTime:$EndTopicTimeMin"."'";
		//print_r($EndTopicTime);
	}
	if($NumberAcceptor == null){
		$NumberAcceptor = "NULL";
	}else{
		$NumberAcceptor = "'".$NumberAcceptor."'";
		//print_r($NumberAcceptor);
	}
	if($NumberRejector == null){
		$NumberRejector = "NULL";
	}else{
		$NumberRejector = "'".$NumberRejector."'";
		//print_r($NumberRejector);
	}
	if($NumberNonvoter == null){
		$NumberNonvoter = "NULL";
	}else{
		$NumberNonvoter = "'".$NumberNonvoter."'";
		//print_r($NumberNonvoter);
	}

	if($SubTopicName == null){
		$SubTopicName = "NULL";
	}else{
		$SubTopicName = "'".$SubTopicName."'";
		//print_r($SubTopicName);
	}

	if($Dates == null){
		$Dates = "NULL";
	}else{
		$Dates = "'".$Dates."'";
		//print_r($Dates);
	}
	if($SubDate == null){
		$SubDate = "NULL";
	}else{
		$SubDate = "'".$SubDate."'";
		//print_r($SubDate);
	}

	if($ConferenceID == null){
		$ConferenceID = "NULL";
	}else{
		$ConferenceID = "'".$ConferenceID."'";
	}
if($ConferenceTopic != null){
	$sql = "INSERT INTO councilconference (ConferenceID,ConferenceTopic,StartTime,Endtime,Dates,
	ConferenceTypeID,BuildingName,RoomNo,ChairmanID)
	VALUES ($ConferenceID,'$ConferenceTopic',$StartTime,$EndTime,$Dates,$ConferenceTypeID,$BuildingName,$RoomNo,$chairmanID)";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
}



$conn->close();
if($SpeakerID != "NULL" && $StartTopicTime != "NULL" && $SubTopicName != "NULL"){
	$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT ConferenceID FROM councilconference  ORDER BY ConferenceID DESC LIMIT 1" ;
	$result = mysqli_query($conn,$sql) or die("Bad query: $sql");
	while($row = mysqli_fetch_assoc($result)){
		$ConferenceID =  "{$row['ConferenceID']}";
	}
	print_r($ConferenceID);
	
	$sql = "INSERT INTO subtopic (ConferenceID,SubTopicName,SpeakerID,StartTopicTime,EndTopicTime,
NumberAcceptor,NumberRejector,NumberNonvoter)
VALUES ($ConferenceID,$SubTopicName,$SpeakerID,$StartTopicTime,$EndTopicTime,$NumberAcceptor,$NumberRejector,$NumberNonvoter)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
}

 $conn->close();

?>
