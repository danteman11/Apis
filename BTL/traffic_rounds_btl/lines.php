
<?php
include "DBConnect.php";

            $output["error"] = True;
			


    $result = sqlsrv_query($conn,"SELECT * FROM traffic.linestable");
         if($result)
         {
            $output["error"] = false;
            while($row = sqlsrv_fetch_array($result))
            {

     if($row){
        
        $output['Lines'][] = array(
        "line_id" => $row['lineID'],
		"line_Desc" => $row['lineDescription']
        );
      }

            }


         }
          
      

            
echo json_encode($output);
            

?>

