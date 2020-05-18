<?php 
  include_once("../config.php");
  $postdata = file_get_contents("php://input");
  $personalid=$_GET["username"];
  
  $sql = "DELETE FROM councilmember WHERE PersonalID = $personalid;";

  if(isset($personalid)){
    $res = mysqli_query($mysqli, $sql) or die ("FAILED" .mysql_error());
  }
?>
