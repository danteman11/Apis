<?php  
/* Specify the server and connection string attributes. */  
$serverName = "us2levisqms.usaparel.com";  

/* Get UID and PWD from application-specific files.  */  
$uid = "wimetrix";  
$pwd = "sqms*3311";  
$connectionInfo = array( "UID"=>$uid,  
                         "PWD"=>$pwd,  
                         "Database"=>"spts_v3");  

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  
if( $conn == false )  
{  
     echo "Unable to connect.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}


?>