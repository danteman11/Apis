<?php
include "DBConnect.php";
  $output["error"] = True; 
$orderID = $_REQUEST['orderID'];
  $sizeID = $_REQUEST['sizeID'];
 // $designID = $_REQUEST['designID'];
  $componentID = $_REQUEST['componentID'];
  
 
    $result = sqlsrv_query($conn,"SELECT distinct component_designID,component_designName FROM traffic.order_details where orderID='$orderID' and sizeID='$sizeID' and componentID='$componentID'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Component_Designs'][] = array(
        "design_id" => $row['component_designID'],
		"designName" => $row['component_designName']
       
               
 
        );        


            }
            }

            


echo json_encode($output);
            

?>