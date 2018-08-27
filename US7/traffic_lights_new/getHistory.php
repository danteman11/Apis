  <?php
  include "DBConnect.php";

  $username = $_REQUEST['userID'];
  $orderID = $_REQUEST['orderID'];
  $cutID = $_REQUEST['cutID'];
  $bundleID = $_REQUEST['bundleID'];
  
 // $orderID = '2120172077/1';
 //    $cutID = '218-4585';
 //  $bundleID='1';
 //  $username= 'back_q_1';

  $output["error"] = TRUE; 
    
      $result2 = sqlsrv_query($conn,"SELECT * FROM traffic.cutreport where orderID='$orderID' and cutID='$cutID' and bundleID = '$bundleID'");
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

            $output['faults'][] = array(
              "fault_id" => $row3['qualityFaultID'],
          "faultName" => $row3['qualityFaultType'],
          "totalFaults" => $row3['defectsNo'],
          "qualityLogID" => $logID
        ); 
            $faultID = $row3['qualityFaultID'] ;
        }
    //      $result = sqlsrv_query($conn,"SELECT * FROM dbo.faultpicturelog WHERE qualityLogID='$logID'");
  
    //      while($row = sqlsrv_fetch_array($result)){

    //       $output['pictures'][] = array(
    //           "faultID" => $faultID,
    //     "pictureID" => $row['pictureID']
    //     );        

    // }        

  
            }
      
      
    }
  }
  else
    $output["error"] = true;



echo json_encode($output);


?>