  
<?php
  include_once("../config.php");
 
$sql="SELECT cm.Surname, cm.Lastname, m.MinistryName, m.MinistryDetail, cm.SubMinistryName,  mp.MinistryPosName
FROM ministry m JOIN councilmember cm JOIN ministrypos mp
ON m.MinisterID = cm.PersonalID AND cm.MinistryPosID = mp.MinistryPosID
ORDER BY m.MinistryName;";
 
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
