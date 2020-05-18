<?php
  include_once("config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT PersonalID,PartyName,
       CASE  WHEN m.PartyPosID IS NOT NULL
            THEN p.PartyPosName 
            ELSE NULL END AS PartyPosName
        ,SubMinistryName,
        CASE  WHEN m.CouncilPosID IS NOT NULL
            THEN c.CouncilposName
            ELSE NULL END AS CouncilposName
        ,CASE  WHEN m.MinistryPosID  IS NOT NULL
            THEN mn.MinistryPosName
            ELSE NULL END AS MinistryPosName,
        Surname,Lastname,DOB,EducationDegree,m.Password,MemberPicture
FROM councilmember m,PartyPos p,councilpos c,ministrypos mn
WHERE (m.PartyPosID = p.PartyPosID OR m.PartyPosID IS NULL)
     AND (m.CouncilPosID = c.CouncilPosID OR m.CouncilPosID  IS NULL)
     AND (m.MinistryPosID = mn.MinistryPosID  OR m.MinistryPosID IS NULL)
     AND m.PersonalID = $personalid
LIMIT 1;";
 
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
