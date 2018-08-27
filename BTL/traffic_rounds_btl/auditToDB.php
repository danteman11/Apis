<?php

  include "DBConnect.php";
       
$response["error"] = TRUE; 
if(isset($_REQUEST['attendanceFlag'])){
  $flag = "1";
}
else{
  $flag = "0";
}
$lineID = $_REQUEST['lineID'];
$unitID = $_REQUEST['unitID'];
$userID = $_REQUEST['userID'];
$result = sqlsrv_query($conn,"SELECT * FROM traffic.users where userID='$userID'");
         if($result)
         {
			 $row = sqlsrv_fetch_array($result);
			 $lineUser = $row['lineID'];
			 $unitUser = $row['unitID'];
			 if($unitID!=$unitUser || $lineID!=$lineUser){
				 $result = sqlsrv_query($conn,"UPDATE traffic.users set lineID='$lineID',unitID='$unitID' where userID='$userID'");
			 }
		 }
$machineID = $_REQUEST['machineID'];
$workerID = $_REQUEST['workerID'];
$orderID = $_REQUEST['orderID'];
//$main_designID = $_REQUEST['main_designID'];
$componentID = $_REQUEST['componentID'];
$sizeID = $_REQUEST['sizeID'];
$component_designID = $_REQUEST['component_designID'];
$machineC = $_REQUEST['machineC'];
$buttoning = $_REQUEST['buttoning'];
$trim = $_REQUEST['trim'];
$construction = $_REQUEST['construction'];
$measurement = $_REQUEST['measurement'];
$pressing = $_REQUEST['pressing'];
$handling = $_REQUEST['handling'];
$filling = $_REQUEST['filling'];
$color = $_REQUEST['color'];
$result = sqlsrv_query($conn,"SELECT * FROM traffic.colors where Color='$color'");
         if($result)
         {
			 $row = sqlsrv_fetch_array($result);
			 $colorID = $row['colorID'];
		 }
$roundID = $_REQUEST['roundID'];
date_default_timezone_set('Asia/Karachi');
$auditDate = date("Y-m-d");
$roundTime = date("H:i:s");

$sql ="insert into traffic.auditform(auditDate,machineID,roundID,userID,lineID,unitID,workerID,colorID,orderID,componentID,sizeID,component_designID,machineC,buttoning,trim,construction,measurement,pressing,handling,filling,attendanceFlag)
values ('$auditDate','$machineID','$roundID','$userID','$lineID',$unitID,'$workerID','$colorID','$orderID','$componentID','$sizeID','$component_designID','$machineC','$buttoning','$trim','$construction','$measurement','$pressing','$handling','$filling','$flag');SELECT SCOPE_IDENTITY()";
$row = sqlsrv_query ($conn, $sql);
if($row){ 
   sqlsrv_next_result($row); 
    sqlsrv_fetch($row); 
    $auditID = sqlsrv_get_field($row, 0); 
      $result = sqlsrv_query($conn,"UPDATE traffic.machines SET roundID='$roundID' WHERE machineID='$machineID'") ;
      if($result){
        $response["error"] = false;
      }
      $response["auditID"] = $auditID;

}
else
{
  $errors = sqlsrv_errors();
  foreach ($errors as $error) {
    echo "SQLSTATE: ".$error['SQLSTATE'];
    echo "Message: ".$error['message'];
  }
}

echo json_encode($response);
?>