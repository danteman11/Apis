
<?php
include "DBConnect.php";

            $output["error"] = True;

  $names = array();
    $result = sqlsrv_query($conn,"SELECT * FROM traffic.linestable");
         if($result)
         {
            $output["error"] = false;
            while($row = sqlsrv_fetch_array($result))
            {

     if($row){
        
        $output['Lines'][] = array(
        "line_id" => $row['lineID']
        );
      }

            }


         }
          
      

            
echo json_encode($output);
            

?>

