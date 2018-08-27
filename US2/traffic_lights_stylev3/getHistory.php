  <?php
  include "DBConnect.php";

  $username = $_REQUEST['userID'];
  $orderID = $_REQUEST['orderID'];
  $cutID = $_REQUEST['cutID'];
  $bundleID = $_REQUEST['bundleID'];
  
// $username = 'front_q_1';
// $orderID = '2120180185/1';
// $cutID = '218-14600';
// $bundleID = '1';


  $output["error"] = TRUE; 
    
      $result2 = sqlsrv_query($conn,"SELECT * FROM wim_spts.cutreport where orderID='$orderID' and cutID='$cutID' and bundleID = '$bundleID'");
         if($result2){
          $row2 = sqlsrv_fetch_array($result2);
          $itemID = $row2['itemID'];
      $output["error"] = false;
      
        
     
          $result3 = sqlsrv_query($conn,"SELECT * FROM [dbo].[qualityLog_checkDefects] where itemID = '$itemID' and userID = '$username' and defectsNo > '0' and rework ='0'");
          if($result3){
        
           $result5 = sqlsrv_query($conn,"SELECT @@ROWCOUNT as rows");
            $row5 = sqlsrv_fetch_array($result5);
             $rows=$row5['rows'];
           
            if($rows != 0){
              while($row3 = sqlsrv_fetch_array($result3)){
             $logID = $row3['qualityLogID'];
             $styleID = $row3['qualityFault_operationID'];
          $result = sqlsrv_query($conn,"SELECT * FROM dbo.progresscomplete where styleID='$styleID' and itemID='$itemID' ");
          $row4 = sqlsrv_fetch_array($result);
          if($row4){
        $operatorID =  $row4['workerID'];
        $operatorName = $row4['workerName'] ;  
         }
         else{  
        $operatorID =  "N/A";
        $operatorName = "Not Available" ;  
         }
            $output['faults'][] = array(
              "fault_id" => $row3['qualityFaultID'],
          "faultName" => $row3['qualityFaultType'],
          "totalFaults" => $row3['defectsNo'],
          "operator_name" => $operatorName,
          "operator_ID" => $operatorID,
          "qualityLogID" => $logID
        ); 
            $faultID = $row3['qualityFaultID'] ;
        }
         $result = sqlsrv_query($conn,"SELECT * FROM dbo.faultpicturelog WHERE qualityLogID='$logID'");
  
         while($row = sqlsrv_fetch_array($result)){

          $output['pictures'][] = array(
              "faultID" => $faultID,
        "pictureID" => $row['pictureID']
        );        

    }        

  
            }
      
      
    }
  }
  else
    $output["error"] = true;



echo json_encode($output);


?>