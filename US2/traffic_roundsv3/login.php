<?php
include "DBConnect.php";
  $response["error"] = True; 

$username= $_REQUEST['Username'] ;
$pass = $_REQUEST['Password'] ;


$query_slots = "SELECT * FROM spts.traffic.users where userID='$username' and password='$pass' "; 
$row = sqlsrv_query ($conn, $query_slots);
if($row = sqlsrv_fetch_array($row)){
	
  		$response["error"] = FALSE; 
        $response["name"] = $row["name"];
        $response["email"] = $row["email"];
        $response['username']= $row['userID'];
        $response['type']=$row['userType'];
        $response['section'] =$row['sectionID'];
		$response['line'] =$row['lineID'];

 }

echo json_encode($response);

?>