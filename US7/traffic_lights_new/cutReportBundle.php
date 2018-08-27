<?php
include "DBConnect.php";



  $response["error"] = True; 
$orderID = $_REQUEST['orderID'];
  $cutID = $_REQUEST['cutID'];
   $userID = $_REQUEST['userID'];
 // $orderID = '1120170445-8';
 //   $cutID = '511';

        $response["error"] = TRUE; 
  $names = array();
  $result = sqlsrv_query($conn,"SELECT * from traffic.users where userID='$userID'");
  $row=sqlsrv_fetch_array($result);
  $sectionID = $row['sectionID'];
    $result = sqlsrv_query($conn,"SELECT * from dbo.cutReport_bundleStatus where orderID='$orderID' and cutID='$cutID' and sectionID='$sectionID' ORDER BY cast(bundleID as int) ASC");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
       $flag = $row['flag'];
       if($flag=='1'){
        $status = '1';
       }
       else{
        $status='0';
       }
       $output['quantity']=$row['quantity'] ;
        $output['orders'][] = array(
        "bundle_id" => $row['bundleID'],
        "bundle_status" => $status

        );        

            }
            }
echo json_encode($output);
            
foreach ($_REQUEST as $name => $value) {
    error_log("$name : $value  ",3,'bundleList.log');
}
error_log('('.date('d-m-y H:i:s').')'.PHP_EOL,3,'bundleList.log');

?>