<?php
include "DBConnect.php";
       
  $response["error"] = True; 
  $faults = $_REQUEST['faults'];
  $auditID = $_REQUEST['auditID'];
  $flu = explode(",", $faults);
 
 $size = sizeof($flu);
 for($i = 0; $i<$size-1;$i++){
 	$fault = $flu[$i];

  	$sql ="insert into traffic.faultlog(faultID,auditID) values ($fault,$auditID)";
    $row = sqlsrv_query ($conn, $sql);
    if($row){
    $response["error"] = false; 
}

 }



 echo json_encode($response);
  
?>