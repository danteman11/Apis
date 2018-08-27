<?php
include "DBConnect.php";

            $output["error"] = True;

//$count = 0;
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.workers order by workerID ");
         if($result)
         {
          $output["error"] = false;
      }
          
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
       // $count = $count +1;
        $output['Workers'][] = array(
        "worker_id" => $row['workerID'],
        "worker_name" => $row['workerName']
        );        
            }
            }
            //echo $count;
echo json_encode($output);
            

?>