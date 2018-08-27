<?php
  include "DBConnect.php";

  $output["error"] = True; 
$itemID = $_REQUEST['itemID'];
 
  $names = array();
    $result = sqlsrv_query($conn,"SELECT * from dbo.totalProgress where itemID='$itemID' ");
         if($result)
         {
          while($row = sqlsrv_fetch_array($result)){
       if($row){
       $output["error"] = false; 
       $output['orderID']=$row['orderID'] ;
        $output['cutID']=$row['cutID'] ;
         $output['bundleID']=$row['bundleID'] ;
                

            }
            else{
              
            }
            }
          
         }

       else{
        $output["error"] = true;
       }
echo json_encode($output);
            

?>