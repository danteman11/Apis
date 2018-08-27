<?php
include "DBConnect.php";
  $output["error"] = True; 

  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM wim_spts.orders where orderID!='n/a'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['orders'][] = array(
        "order_id" => $row['orderID'],
        "poNO" => $row['Customer']
               
 
        );        


            }
            }

            


echo json_encode($output);
            

?>