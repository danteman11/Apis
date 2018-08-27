  <?php
  include "DBConnect.php";

  $username = $_REQUEST['userID'];

  //$username = 'back_q';
  
  $output["error"] = TRUE; 
  
  $result = sqlsrv_query($conn,"SELECT * FROM traffic.users where userID='$username'");
  $row = sqlsrv_fetch_array($result);
  if($result){
    $sectionID = $row['sectionID'];
    $lineID = $row['lineID'] ;
    
    $result1 = sqlsrv_query($conn,"SELECT * FROM traffic.qualityfaults where sectionID ='$sectionID' and lineID='$lineID' and sw_flag='1' order by qualityFaultID");
    if($result1)
    {
          $output["error"] = False; 
        while($row = sqlsrv_fetch_array($result1)){
        $output['quality'][] = array(
          "quality_id" => $row['qualityFaultID'],
          "qualityD" => $row['qualityFaultType']
    
        );        
        }
}
}

echo json_encode($output);


?>