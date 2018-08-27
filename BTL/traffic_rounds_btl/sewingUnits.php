
<?php
include "DBConnect.php";

            $output["error"] = True;


    $result = sqlsrv_query($conn,"SELECT * FROM traffic.sewingUnits");
         if($result)
         {
            $output["error"] = false;
            while($row = sqlsrv_fetch_array($result))
            {

     if($row){
        
        $output['Units'][] = array(
        "unit_id" => $row['unitID'],
		"unit_Desc" => $row['unitDescription']
        );
      }

            }


         }
          
      

            
echo json_encode($output);
            

?>

