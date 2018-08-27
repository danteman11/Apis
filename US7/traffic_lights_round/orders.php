<?php
include "DBConnect.php";
  $output["error"] = True; 

  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.orders where orderID!='n/a'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['orders'][] = array(
        "order_id" => $row['orderID'],
        "poNO" => $row['CustomerPO#']
               
 
        );        


            }
            }

            


echo json_encode($output);
            

?>