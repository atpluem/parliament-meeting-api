<?php
  include_once("../config.php");
 
$sql="select cc.ConferenceID, cc.ConferenceTopic, ct.ConferenceTypeName, cc.StartTime, cc.EndTime, cc.Dates, cm.Surname, cm.Lastname, cc.BuildingName 
FROM councilconference cc JOIN conferencetype ct JOIN councilmember cm
ON cc.ConferenceTypeID = ct.ConferenceTypeID AND cm.PersonalID = cc.ChairmanID;";
 
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
