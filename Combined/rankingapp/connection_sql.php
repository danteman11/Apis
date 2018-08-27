<?php  
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
// }  
// $tsql = "SELECT * FROM [spts].[dbo].[portal_operation_eff_alldays_b]";  

// /* Execute the query. */  

// $stmt = sqlsrv_query( $conn, $tsql);  

// if ( $stmt )  
// {  
//      echo "Statement executed.<br>\n";  
// }   
// else   
// {  
//      echo "Error in statement execution.\n";  
//      die( print_r( sqlsrv_errors(), true));  
// }  

//  Iterate through the result set printing a row of data upon each iteration.  

// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  
// {  
//      echo "Col1: ".$row[0]."\n";  
//      echo "Col2: ".$row[1]."\n";  
//      echo "Col3: ".$row[2]."<br>\n";  
//      echo "-----------------<br>\n";  
// }  

// /* Free statement and connection resources. */  
// sqlsrv_free_stmt( $stmt);  
// sqlsrv_close( $conn);  
?>  