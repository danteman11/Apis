<?php
//SQL DB Connections
include "DBConnect.php";
  $response['error']=true ;
  $itemID = $_REQUEST['itemID'];
 //SQL QUERY TO GET TABLE INFO
$columns = array();
 $result = sqlsrv_query($conn,"SELECT * FROM information_schema.columns WHERE table_name='totalProgress' AND (COLUMN_NAME='operationDescription' or COLUMN_NAME='workerName' or COLUMN_NAME='progressTime') ");
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
  
      //$count = count($columns,COUNT_NORMAL);//Getting lenght of Array  Columns
       $result1 = sqlsrv_query($conn,"SELECT  operationDescription,workerName,progressTime  from totalProgress where itemID='$itemID'");//QUERY TO GET RECORDS FROM DATABASE ;// Update Table name here 
      if($result1){
        
        $i=0 ;
        $k=0;
        while($row=sqlsrv_fetch_array($result1)){
                 for($i=0;$i<$count;$i++){
          $response[$k][] = array(
        $columns[$i] => $row[$i]);
        }//END OF FOR LOOP
        $k++ ;
       }//END of WHILE LOOP
      $response['RowCount']= $k ;
         }//End of 2nd IF   
        }
      echo json_encode($response);
?>
            