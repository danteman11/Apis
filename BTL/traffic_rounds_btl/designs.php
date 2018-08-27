<?php
include "DBConnect.php";
  $output["error"] = True; 
  $orderID = $_REQUEST['orderID'];
  $sizeID = $_REQUEST['sizeID'];

    $result = sqlsrv_query($conn,"SELECT distinct main_designID,main_designName FROM traffic.order_details where orderID='$orderID' and sizeID='$sizeID'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Designs'][] = array(
        "design_id" => $row['main_designID'],
		"designName" => $row['main_designName']
    
        );        


            }
            }

            


echo json_encode($output);
            

?>