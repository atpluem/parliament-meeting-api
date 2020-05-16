<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT  BuildingName,COUNT(*) AS 'UseTimes'
FROM CouncilConference 
WHERE Dates >= '1900-00-00' AND Dates <= '2000-12-31'
GROUP BY BuildingName;";
 
if($result = mysqli_query($mysqli,$sql))
{
 $rows = array();
  while($row = mysqli_fetch_assoc($result))
  {
    $rows[] = $row;
  }
 
  echo json_encode($rows);
}
else
{
  http_response_code(404);
}
?>
