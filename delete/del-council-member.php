<?php
  include_once("../config.php");
  $postdata = file_get_contents("php://input");
  $personalid=$_GET["username"];
  
  $delete = "DELETE FROM councilmember
  WHERE PersonalID = $personalid;";
  
  if(isset($postdata)) {
    $res = mysqli_query($mysqli, $delete) or die ("FAILED" .mysql_error());
  }
?>
