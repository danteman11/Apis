<?php
include "DBConnect.php";

  $output["error"] = True; 
  $orderID = $_REQUEST['orderID'];
  $cutID = $_REQUEST['cutID'];
  $bundleID = $_REQUEST['bundleID'];
  $userID = $_REQUEST['userID'];

  $result = sqlsrv_query($conn,"SELECT * from traffic.users where userID='$userID'");
 $row = sqlsrv_fetch_array($result);
 $sectionID = $row['sectionID'];
 $result = sqlsrv_query($conn,"SELECT * from wim_spts.cutreport where orderID='$orderID' and cutID='$cutID' and bundleID='$bundleID'");
 $row = sqlsrv_fetch_array($result);
 $itemID = $row['itemID'];
 
    $result = sqlsrv_query($conn,"SELECT * FROM dbo.missingProgress where itemID='$itemID' and sectionID='$sectionID'");
        if($result){
			$result5 = sqlsrv_query($conn,"SELECT @@ROWCOUNT as rows");
            $row5 = sqlsrv_fetch_array($result5);
             $rows=$row5['rows'];
			 if($rows!=0){
				 $output['opStatus'] = false;
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
			   
         $output["error"] = false;
        $output['operations'][] = array(
        "fault_operation_id" => $row['styleID'],
          "fault_operation_name" => $row['operationDescription']
        );        
           }
            }
			 }
			 else{
				 $output['opStatus'] = true;
			 }
		}
echo json_encode($output);
            

?>