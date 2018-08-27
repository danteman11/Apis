<?php
include "DBConnect.php";
  $response["error"] = True; 

$username= $_REQUEST['Username'] ;
$pass = $_REQUEST['Password'] ;


$query_slots = "SELECT * FROM traffic.users where userID='$username' and password='$pass' "; 
$row = sqlsrv_query ($conn, $query_slots);
if($row = sqlsrv_fetch_array($row)){
	
  		$response["error"] = FALSE; 
        $response["name"] = $row["name"];
        $response['username']= $row['userID'];
		$response['email']= $row['email'];
        $response['type']=$row['userType'];
        $response['line'] =$row['lineID'];
		$response['unit'] =$row['unitID'];
		$line = $row['lineID'];
		$unit = $row['unitID'];
		$result = sqlsrv_query($conn,"SELECT * FROM traffic.linestable where lineID='$line'");
		$row = sqlsrv_fetch_array($result);
		$response['line_Desc'] =$row['lineDescription'];
		$result = sqlsrv_query($conn,"SELECT * FROM traffic.sewingUnits where unitID='$unit'");
		$row = sqlsrv_fetch_array($result);
		$response['unit_Desc'] =$row['unitDescription'];

 }

echo json_encode($response);

?>