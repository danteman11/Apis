<?php
include "DBConnect.php";
  $output["error"] = True; 
  $orderID = $_REQUEST['orderID'];

    $result = sqlsrv_query($conn,"SELECT distinct sizeID,sizeName FROM traffic.order_details where orderID='$orderID'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Sizes'][] = array(
        "size_id" => $row['sizeID'],
       "sizeName" => $row['sizeName']
        );        


            }
            }

            


echo json_encode($output);
            

?>