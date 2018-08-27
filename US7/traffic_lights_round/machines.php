<?php
include "DBConnect.php";


  $output["error"] = True; 
  $username = $_REQUEST['username'];
  $roundID = $_REQUEST['roundID'];

  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.machines where userID='$username' and roundID='$roundID'");
         if($result)
         {
          $output["error"] = false;
          
         }


       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['MAchines'][] = array(
        "machines_id" => $row['machineID']
 
        );        


            }
            }

            


echo json_encode($output);
            

?>