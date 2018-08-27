<?php
include "DBConnect.php";

            $output["error"] = True;

  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.workers where status!='non'");
         if($result)
         {
          $output["error"] = false;
      }
          
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Workers'][] = array(
        "worker_id" => $row['workerID'],
        "name" => $row['workerName'],
        );        


			 

            }
            }
echo json_encode($output);
            

?>