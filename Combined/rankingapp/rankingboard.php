 <?php 
$unit= "6";
 
$workerEfficiency = workerEfficiency_unitDisplay($unit) ;
        
function workerEfficiency_unitDisplay($lineID)
 {
  
    $conn = getconnection();  
    $query = "SELECT Top 4 lineID
        ,workerID
        ,workerName
        ,Login_Time
        ,lastLogin
        ,current_operationDescription
        ,workerProductionToday
        ,workerWageToday        
        ,workerEff
        ,SMV 
      FROM [spts].[dbo].[floor_dataset_b]        
      where lineID = '$lineID'   
      order by lineID,workerEarnedSAMtoday desc";

    $result4 = sqlsrv_query ($conn, $query);
    if($result4 )
    { 
        $workerEfficiency = array();
        while($row = sqlsrv_fetch_array($result4,SQLSRV_FETCH_ASSOC))
        { 
            array_push($workerEfficiency,array('workerID'=>$row['workerID'] ,  'workerName'=>$row['workerName'] , 'Login_Time'=>$row['Login_Time'], 'lastLogin'=>$row['lastLogin'], 'operationDesc'=>$row['current_operationDescription']  , 'SMV'=>$row['SMV']  ,'workerProductionToday'=>$row['workerProductionToday']  , 'workerWageToday'=>$row['workerWageToday']  , 'workerEff'=>$row['workerEff']  ));
        } 

        sqlsrv_free_stmt($result4);
        sqlsrv_close($conn); 
        $response['workers']= $workerEfficiency;
         $response["error"] = false;
       
    }
    else{
       $response["error"] = true;
    }
 echo json_encode($response);
    
 }
function getconnection ()
{
   /* Specify the server and connection string attributes. */  
  $serverName = "172.16.0.10";  

/* Get UID and PWD from application-specific files.  */  
$uid = "sa";  
$pwd = "spts@3311";  
  $connectionInfo = array( "UID"=>$uid,  
                         "PWD"=>$pwd,  
                         "Database"=>"spts");  

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  
if( $conn === false )  
{  
     echo "Unable to connect.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}
    
    return $conn;
}




?>




