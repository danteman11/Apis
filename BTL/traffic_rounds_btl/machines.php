<?php
include "DBConnect.php";


  $output["error"] = True; 
  
  $roundID = $_REQUEST['roundID'];
  $lineID = $_REQUEST['lineID'];
  $unitID  =$_REQUEST['unitID'];

 
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.machines where roundID='$roundID' and lineID='$lineID' and unitID ='$unitID'");
         if($result)
         {
          $output["error"] = false;
          
         }


       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['Machines'][] = array(
        "machine_id" => $row['machineID']
 
        );        


            }
            }


echo json_encode($output);
            

?>