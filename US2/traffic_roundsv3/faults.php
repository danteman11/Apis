<?php
include "DBConnect.php";
       
        $output["error"] = TRUE; 
  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.fault");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['faults'][] = array(
        "fault_id" => $row['faultID'],
        "faultD" => $row['faultDescription']
        
        );        


            }
            }

            


echo json_encode($output);
            

?>