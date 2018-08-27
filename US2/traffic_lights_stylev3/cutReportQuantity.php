<?php
include "DBConnect.php";


$response["error"] = True; 

$userID = $_REQUEST['userID'];
$orderID = $_REQUEST['orderID'];
$cutID = $_REQUEST['cutID'];
$bundleID = $_REQUEST['bundleID'];

//error_log("REQUEST Array: ".$REQUEST,3,'entries.log');
 // $orderID = '1120170445-8';
 //    $cutID = '511';
 //  $bundleID='1';
  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM wim_spts.cutreport where orderID = '$orderID' and cutID = '$cutID' and bundleID='$bundleID' ");
         if($result)
         {
          $output["error"] = false;
          
         }
     $row = sqlsrv_fetch_array($result);
		   if($row){
        $output['quantity']=$row['quantity'] ;
        $itemID = $row['itemID'] ;
        $output['itemID'] = $itemID;
        $output['status'] = 0;
         $result3 = sqlsrv_query($conn,"SELECT * FROM traffic.qualityLog where itemID = '$itemID' and userID = '$userID'");
          if($result3){
            $result5 = sqlsrv_query($conn,"SELECT @@ROWCOUNT as rows");
            $row5 = sqlsrv_fetch_array($result5);
            $rows=$row5['rows'];
            if($rows != 0){

              $output['status'] = 1;
            }
            $row3 = sqlsrv_fetch_array($result3); 
          }
              
            }
            
echo json_encode($output);
foreach ($_REQUEST as $name => $value) {
    error_log("$name : $value  ",3,'entries.log');
}
error_log('('.date('d-m-y H:i:s').')'.PHP_EOL,3,'entries.log');
?>