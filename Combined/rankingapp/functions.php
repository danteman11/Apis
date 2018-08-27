<?php

date_default_timezone_set('Asia/Karachi');
$date = "2017-09-07";
$lineID = "18";
$slot_data = get_slotdata($date,$lineID) ;

function get_slotdata($date,$lineID) {
     
    $conn = getconnection(); 
 
    $query = "select isnull(QC_production ,0) as QC_production ,  orderSlotTarget , h_slot  from [spts].[dbo].[h_portal_slotProduction_c_all] where h_slotID   between 9 and 18  AND p_date= '$date' AND lineID='$lineID'  order  by h_slotID ";
    $result = sqlsrv_query ($conn, $query);
    if($result)
    { 
        $slot_data = array();
        while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
        { 
            array_push($slot_data,array('time'=>$row['h_slot']->format('H:i:s'),'production'=>$row['QC_production'],'target'=>$row['orderSlotTarget']));
        }    
        sqlsrv_free_stmt($result);
        sqlsrv_close($conn);

         $response['slot_data']= $slot_data;
         $response["error"] = false;
    }
    else
    	$response["error"] = true;
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