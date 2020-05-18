<?php 
  // Test serv
  include_once("../config.php");
  $postdata = file_get_contents("php://input");
  $personalid=$_GET["username"];
  
  $sql = "DELETE FROM councilmember
  WHERE PersonalID = $personalid;";
  
  if($mysqli->query($sql) === true) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $mysqli->error;
  }
?>
