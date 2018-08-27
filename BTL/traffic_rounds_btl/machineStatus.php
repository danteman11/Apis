<?php
include "DBConnect.php";


  $output["error"] = true; 
  
  $roundID = $_REQUEST['roundID'];


 
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.machines where roundID='$roundID'");
         if($result)
         {
          $output["error"] = false;
          
         


       $row = sqlsrv_fetch_array($result);
		   if($row){
        
               $output["error"] = false;
            }
            else{
          $output["error"] = true;
            }
            
}

echo json_encode($output);
            

?>