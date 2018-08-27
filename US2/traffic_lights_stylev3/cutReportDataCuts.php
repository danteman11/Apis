<?php
include "DBConnect.php";


  $response["error"] = True; 
 $orderID = $_REQUEST['orderID'];

 //$orderID = '1120170445-8' ;
  $names = array();
    $result = sqlsrv_query($conn,"SELECT distinct cutID from wim_spts.cutreport where orderID='$orderID'");
         if($result)
         {
          $output["error"] = false;
          
         }
       while($row = sqlsrv_fetch_array($result)){
		   if($row){
        
        $output['cuts'][] = array(
        "cut_id" => $row['cutID']
        );        


            }
            }

            


echo json_encode($output);
            

?>