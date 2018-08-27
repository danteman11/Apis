<?php
include "DBConnect.php";
        $output["error"] = TRUE; 
  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.sections");
         if($result)
         {
          $output["error"] = false;
            while($row = sqlsrv_fetch_array($result)){
       if($row){
        
        $output['sections'][] = array(
          "section_id" => $row['sectionID'],
        "sectionD" => $row['sectionDescription']
        );        


            }
            }
         }
     

            


echo json_encode($output);
            

?>