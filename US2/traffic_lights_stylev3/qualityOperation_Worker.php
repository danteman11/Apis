<?php
include "DBConnect.php";

        $output["error"] = TRUE; 
  $styleID= $_REQUEST['styleID'];
  $itemID = $_REQUEST['itemID'];
  $notID = "N/A";
  $notName = "Not Available";
    
         $result = sqlsrv_query($conn,"SELECT * FROM dbo.progresscomplete where styleID='$styleID' and itemID='$itemID' ");
          $row = sqlsrv_fetch_array($result);
       if($row){
        $output["error"] = false;
        $output['operators'][] = array(
        "operator_id" => $row['workerID'],
        "operator_name" => $row['workerName']
        );   
         }
         else{
          $output["error"] = false;
          $output['operators'][] = array(
        "operator_id" => $notID,
        "operator_name" => $notName
        );
         }

echo json_encode($output);
            

?>