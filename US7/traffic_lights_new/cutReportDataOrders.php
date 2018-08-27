<?php
 include "DBConnect.php";



  $response["error"] = True; 

  $names = array();
    $result = sqlsrv_query($conn,"SELECT distinct orderID from traffic.cutreport");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['orders'][] = array(
        "order_id" => $row['orderID']
        );        


            }
            }

            


echo json_encode($output);
            

?>