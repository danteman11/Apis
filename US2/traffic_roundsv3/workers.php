<?php
include "DBConnect.php";

            $output["error"] = True;

  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM wim_spts.workers where workerName!='n/a'");
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


			 
        // $output["error"] = FALSE; 
        // $response["workerID"] = $row["workerID"];
        // $response["workerName"] = $row["workerName"];
        // array_push($names, $row['workerName']) ;

            }
            }
echo json_encode($output);
            

?>