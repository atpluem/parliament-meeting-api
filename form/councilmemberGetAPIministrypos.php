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
//ministrypos
$sql = "SELECT MinistryPosID,MinistryPosName FROM ministrypos";
$result = mysqli_query($conn,$sql) or die("Bad query: $sql");

if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $json_data[] = array(
            "MinistryPosID" => $row['MinistryPosID'],   
            "MinistryPosName" => $row['MinistryPosName'],   
        );
    }
}

// แปลง array เป็นรูปแบบ json string  
if(isset($json_data)){  
    $json= json_encode($json_data);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}

?>
