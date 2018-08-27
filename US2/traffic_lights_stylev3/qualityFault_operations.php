<?php
include "DBConnect.php";

        $output["error"] = TRUE; 
  $userID= $_REQUEST['userID'];
  $orderID = $_REQUEST['orderID'];
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.users where userID='$userID' ");
         if($result)
         {
         $row = sqlsrv_fetch_array($result);
         $sectionID= $row['sectionID'];
         $result = sqlsrv_query($conn,"SELECT * FROM dbo.stylebulletin_info where sectionID='$sectionID' and orderID='$orderID' ");
          while($row = sqlsrv_fetch_array($result)){
       if($row){
        $output["error"] = false;
        $output['operations'][] = array(
        "fault_operation_id" => $row['styleID'],
        "fault_operation_name" => $row['operationDescription']
        );   
         }
         else{
          echo "no data";
         }
            


            }
            }
            else{
              echo "error";
            }

            


echo json_encode($output);
            

?>