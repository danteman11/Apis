<?php
include "DBConnect.php";



  $output["error"] = True; 
  $section = $_REQUEST['Section'];

 
    $result = sqlsrv_query($conn,"SELECT * FROM dbo.stylebulletin_info where sectionID='$section'");
        
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
         $output["error"] = false;
        $output['Operations'][] = array(
        "operation_id" => $row['styleID'],
          "operationD" => $row['operationDescription']
        );        
           }
            }
echo json_encode($output);
            

?>