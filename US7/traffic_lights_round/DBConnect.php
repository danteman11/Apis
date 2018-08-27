<?php  
/* Specify the server and connection string attributes. */  
$serverName = "193.168.60.11";  


/* Get UID and PWD from application-specific files.  */  
$uid = "sptsWimetrix";  
$pwd = "qwerty";  
$connectionInfo = array( "UID"=>$uid,  
                         "PWD"=>$pwd,  
                         "Database"=>"traffic");  

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  

if( $conn == false )  
{  
     echo "Unable to connect.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}
?>