<?php
  include "DBConnect.php";

  $output["error"] = True; 
$itemID = $_REQUEST['itemID'];
 
  $names = array();
    $result = mysqli_query($conn,"SELECT * from traffic.cutreport where itemID='$itemID' ");
         if($result)
         {
          if (mysqli_num_rows($result) == 0)
  $output["error"] = true;
         else $output["error"] = false;
          while($row = mysqli_fetch_array($result)){
       if($row){
       
       $output['orderID']=$row['orderID'] ;
        $output['cutID']=$row['cutID'] ;
         $output['bundleID']=$row['bundleID'] ;
         $output['quantity']=$row['quantity'];
                

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