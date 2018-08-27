<?php
include "DBConnect.php";
  $output["error"] = True; 

 
    $result = sqlsrv_query($conn,"SELECT distinct orderID FROM traffic.order_details");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Orders'][] = array(
        "order_id" => $row['orderID']
       
               
 
        );        


            }
            }

            


echo json_encode($output);
            

?>