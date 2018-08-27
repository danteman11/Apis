<?php

  include "DBConnect.php";
       
$response["error"] = TRUE; 
if(isset($_REQUEST['attendanceFlag'])){
  $flag = "1";
}
else{
  $flag = "0";
}
$userID = $_REQUEST['userID'];
$machineID = $_REQUEST['MachineID'];
$WorkerID = $_REQUEST['WorkerID'] ;
$OperationID = $_REQUEST['OperationID'] ;
$Sewing = $_REQUEST['Sewing'] ;
$Card = $_REQUEST['Card'] ;
$Pc = $_REQUEST['Pc'] ;
$OrderID = $_REQUEST['orderID'] ;
$Finish = $_REQUEST['Finish'] ;
$Mc = $_REQUEST['Mc'] ;
$Season = $_REQUEST['Season'];
$MachineC = $_REQUEST['MachineC'] ;
$SPI = $_REQUEST['SPI'] ;
$Gauge = $_REQUEST['Gauge'] ;
$Construction = $_REQUEST['Construction'] ;
$Check = $_REQUEST['Check'] ;
$Color = $_REQUEST['color'] ;
$res = sqlsrv_query($conn,"SELECT * FROM traffic.colors where color='$Color'");
$row = sqlsrv_fetch_array($res);
$ColorID = $row['colorID'];
$RoundID = $_REQUEST['RoundID'] ;
$totalCric = $_REQUEST['totalCric'];
date_default_timezone_set('Asia/Karachi');
$auditDate = date("Y-m-d");
$roundTime = date("H:i:s");
$res = sqlsrv_query($conn,"SELECT * FROM traffic.machines where machineID='$machineID'");
$row = sqlsrv_fetch_array($res);
$SectionID = $row['sectionID'];
$LineID = $row['lineID'];
if($flag=='1'){
$res = sqlsrv_query($conn,"SELECT * FROM traffic.operations where sectionID='$SectionID' and operationDescription='n/a'");
$row = sqlsrv_fetch_array($res);
$OperationID = $row['operationID'];
//$res = sqlsrv_query($conn,"SELECT * FROM traffic.workers where lineID='$LineID' and status='non'");
//$row = sqlsrv_fetch_array($res);
//$WorkerID = $row['workerID'];
}


$sql ="insert into traffic.auditform(auditDate,machineID,roundID,userID,operationID,lineID,workerID,sectionID,colorID,pcNo,orderID,season,
sewingUnit,finish,cardNo,totalMC,totalCritical,machineC,spi,gauge,construction,quickCheck,attendanceFlag)
values ('$auditDate','$machineID','$RoundID','$userID','$OperationID','$LineID','$WorkerID','$SectionID','$ColorID','$Pc','$OrderID',
'$Season','$Sewing','$Finish','$Card','$Mc','$totalCric','$MachineC','$SPI','$Gauge','$Construction','$Check','$flag');SELECT SCOPE_IDENTITY()";
$row = sqlsrv_query ($conn, $sql);
if($row){ 
   sqlsrv_next_result($row); 
    sqlsrv_fetch($row); 
    $auditID = sqlsrv_get_field($row, 0); 

       $res = sqlsrv_query($conn,"SELECT * FROM  traffic.machines where machineID='$machineID'");
    $row = sqlsrv_fetch_array($res);
    $macsec = $row['sectionID'];
    $maclin = $row['lineID'];
    if($SectionID!=$macsec || $LineID!=$maclin){
      $result = sqlsrv_query($conn,"UPDATE traffic.machines SET sectionID='$SectionID',lineID='$LineID' WHERE machineID='$machineID'") ;
    }
      $result = sqlsrv_query($conn,"UPDATE traffic.machines SET roundID='$RoundID' WHERE machineID='$machineID'") ;
      if($result){
        $response["error"] = false;
      }
      $response["auditID"] = $auditID;

}
else
{
  $errors = sqlsrv_errors();
  foreach ($errors as $error) {
    $response['error'] ="SQLSTATE: ".$error['SQLSTATE'];
    $response['error1']= "Message: ".$error['message'];

  }
}
foreach ($_REQUEST as $name => $value) {
    error_log("$name : $value  ",3,'entries.log');
}
error_log('('.date('d-m-y H:i:s').')'.PHP_EOL,3,'entries.log');
echo json_encode($response);
?>