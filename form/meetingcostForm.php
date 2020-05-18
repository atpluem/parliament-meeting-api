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
  
  $BillingID = null;
  $ConferenceID = null;
  $CostTypeID = null;
  $CostValue = null;
  $ReceiptName = null;
  $ReceiptApproverID = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	print_r($array);
  
	foreach($array[jsonform] as $key => $output) {
		if($key === 'billingId') {
			$BillingID = $output;
			echo $BillingID."\n";
		}elseif($key === 'conferenceId'){
			$ConferenceID = $output;
			echo $ConferenceID."\n";
		}elseif($key === 'costTypeId'){
			$CostTypeID = $output;
			echo $CostTypeID."\n";
		}elseif($key === 'costValue'){
			$CostValue = $output;
			echo $CostValue."\n";
		}elseif($key === 'receiptName'){
			$ReceiptName = $output;
			echo $ReceiptName."\n";
		}elseif($key === 'receiptApproveId'){
			$ReceiptApproverID = $output;
			echo $ReceiptApproverID."\n";
		}
	} 

$sql = "INSERT INTO costs (BillingID,ConferenceID,CostTypeID,CostValue,ReceiptName,ReceiptApproverID)
VALUES ($BillingID,$ConferenceID,$CostTypeID,$CostValue,'$ReceiptName','$ReceiptApproverID')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();

?>
