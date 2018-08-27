<?php
include "DBConnect.php";
  $output["error"] = True; 
  $workerID = $_REQUEST['workerID'];
  $machineID = $_REQUEST['machineID'];
  $roundID = $_REQUEST['roundID'];

    $result = sqlsrv_query($conn,"SELECT * FROM dbo.faultLog_RoundHistory where machineID='$machineID' and workerID='$workerID' and roundID='$roundID'");
         if($result)
         {
          $output["error"] = false;
          
		while($row = sqlsrv_fetch_array($result)){
		   if($row){   
					$output['faultHistory'][] = array(
					"fault_id" => $row['faultID'],
					"fault_description" => $row['faultDescription'],
					"fault_group" => $row['faultGroup'],
					"round_time" => $row['roundTime']
					);        
			}
        }
	}
echo json_encode($output);
            

?>