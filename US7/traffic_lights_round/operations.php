<?php
include "DBConnect.php";



  $output["error"] = True; 
  $section = $_REQUEST['Section'];

 
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.operations where sectionID='$section'and operationDescription!='n/a'");
        
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
         $output["error"] = false;
        $output['Operations'][] = array(
        "operation_id" => $row['operationID'],
          "operationD" => $row['operationDescription']
        );        
           }
            }
echo json_encode($output);
            

?>