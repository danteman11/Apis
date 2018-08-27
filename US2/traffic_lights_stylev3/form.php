<?php
include "DBConnect.php";
  $response["error"] = True; 


$username= $_REQUEST['secID'] ;
$pass = $_REQUEST['Ext'] ;

// $username= 'back_q';
// $pass = '12345';

    $result = sqlsrv_query($conn,"SELECT * FROM traffic.users where userID='$username' and password='$pass' ");
       $row = sqlsrv_fetch_array($result);

if($row){
  $response["error"] = FALSE; 
        $response["name"] = $row["name"];
        $response["email"] = $row["email"];
        $response['username']= $row['userID'];
        $response['type']=$row['userType'];

}




echo json_encode($response);

?>