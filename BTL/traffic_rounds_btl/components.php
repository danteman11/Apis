<?php
include "DBConnect.php";
  $output["error"] = True; 
$orderID = $_REQUEST['orderID'];
  $sizeID = $_REQUEST['sizeID'];
  //$designID = $_REQUEST['designID'];

    $result = sqlsrv_query($conn,"SELECT distinct componentID,componentName FROM traffic.order_details where orderID='$orderID' and sizeID='$sizeID'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Components'][] = array(
        "component_id" => $row['componentID'],
		"componentName" => $row['componentName']
       
               
 
        );        


            }
            }

            


echo json_encode($output);
            

?>