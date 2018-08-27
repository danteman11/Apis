<?php  
/* Specify the server and connection string attributes. */  
$serverName = "WIN-0VETF4PGK98\SQLEXPRESS01";  
//$serverName = "172.16.10.11";  

/* Get UID and PWD from application-specific files.  */  

//$uid = "sa";  
$uid = "smartlight";
$pwd = "smartlight";  
$connectionInfo = array( "UID"=>$uid,  
                         "PWD"=>$pwd,  
                         "Database"=>"bismillah_traffic");  

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  
if( $conn == false )  
{  
     echo "Unable to connect.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}


?>