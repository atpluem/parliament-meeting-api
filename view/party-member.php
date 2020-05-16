<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
 
$sql="SELECT c.Surname, c.Lastname, c.PartyName, p.PartyPosName, p.PartyPosDetail
FROM councilmember c JOIN partypos p
ON c.PartyPosID = p.PartyPosID
ORDER BY c.PartyName, p.PartyPosName;";
 
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
