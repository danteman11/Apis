<?php
//SQL DB Connections
include "DBConnect.php";
  $response['error']=true ;
  
 //SQL QUERY TO GET TABLE INFO
$columns = array();
 $result = sqlsrv_query($conn,"SELECT * FROM information_schema.columns WHERE table_name='fault' AND (COLUMN_NAME='faultID' or COLUMN_NAME='faultDescription' or COLUMN_NAME='faultGroup') ");
 if($result) {
	 $response['error']=false;//Start of IF 1
 	$count=0 ;
	
 	while($row = sqlsrv_fetch_array($result)){
 		   //All Columns Added to JSON ARRAY
		   $response['Columns'][] = array(
        "Column_name" => $row['COLUMN_NAME']//Adding Column Names to Array "Columns"
          );
 		$columns[$count] = $row['COLUMN_NAME'];
 		$count++ ;
     }
	 //End OF WHILE Loop
    $operations = $_REQUEST['operations'];
     $flu = explode(",", $operations);
     $size = sizeof($flu);
$k=0;
        $output["error"] = TRUE; 
  for($i = 0; $i<$size-1;$i++){
  $faultGroup = $flu[$i];

      //$count = count($columns,COUNT_NORMAL);//Getting lenght of Array  Columns
       $result1 = sqlsrv_query($conn,"SELECT  *  from traffic.fault where faultGroup='$faultGroup'");//QUERY TO GET RECORDS FROM DATABASE ;// Update Table name here 
      if($result1){
        
        $j=0 ;
        
        while($row=sqlsrv_fetch_array($result1)){
                 for($j=0;$j<$count;$j++){
          $response[$k][] = array(
        $columns[$j] => $row[$j]);
        }//END OF FOR LOOP
        $k++ ;
       }//END of WHILE LOOP
      $response['RowCount']= $k ;
         }//End of 2nd IF   
        }
      }
      
      echo json_encode($response);
?>
            