<?php
include "DBConnect.php";
$response["error"] = true; 

if(isset($_REQUEST['clear'])){
    $clear = $_REQUEST['clear'];
}
else{
    $clear="no";
}

$username = $_REQUEST['username'];
$orderID = $_REQUEST['orderID'];
$cutID = $_REQUEST['cutID'];
$bundleID = $_REQUEST['bundleID'];
$ImageFlag = $_REQUEST['imageFlag'] ;


// $username = 'front_q_1';
// $orderID = '2120180185/1';
// $cutID = '218-14600';
// $bundleID = '1';
//  $ImageFlag = 'false' ;
//  $clear = "yes";

  $result = sqlsrv_query($conn,"SELECT * FROM wim_spts.cutreport where orderID='$orderID' and cutID='$cutID' and bundleID = '$bundleID'");
            if($result)
{
         $row = sqlsrv_fetch_array($result);
         $itemID = $row['itemID'];

 
         $response['itemID'] = $itemID;
         
          $result = sqlsrv_query($conn,"SELECT * FROM traffic.users where userID='$username'");
        $row = sqlsrv_fetch_array($result);
        $sectionID = $row['sectionID'];
        $lineID = $row['lineID'];
        
if($clear == "no"){
        $qualityID = $_REQUEST['qualityID'];
        $defects = $_REQUEST['defectsNo'];

        // $qualityID = '138';
        //  $defects = '10';

        $fault = $qualityID;
        $faultno =  $defects;
 
  $result = sqlsrv_query($conn,"SELECT * FROM traffic.qualityfaults where qualityFaultID='$fault' and sectionID='$sectionID' and lineID = '$lineID'");
       if($result){
        $row = sqlsrv_fetch_array($result);
        $response['faultNames'] = $row['qualityFaultType'];
 
    $logIDs = "";
    if($_REQUEST['operationID']!=""){
  $operationID = $_REQUEST['operationID'];
  $sql1 ="insert into traffic.qualitylog(itemID,userID,qualityFaultID,defectsNo,qualityFault_operationID)
    values ('$itemID','$username','$fault','$faultno','$operationID');  SELECT SCOPE_IDENTITY();";
}
else{
  $sql1 ="insert into traffic.qualitylog(itemID,userID,qualityFaultID,defectsNo)
    values ('$itemID','$username','$fault','$faultno');  SELECT SCOPE_IDENTITY();";
}
    
    $result = sqlsrv_query($conn,$sql1) ;
       if($result){
    $sql2 ="select top 1 * from traffic.qualitylog where userID ='$username'  and itemID ='$itemID' and qualityFaultID='$fault' 
order by auditTime DESC";
    $result2 = sqlsrv_query($conn,$sql2) ;
             if($result2){
    $row = sqlsrv_fetch_array($result2);
         $logIDs = $row['qualityLogID'] ;
 }  
       $response["error"] = false;

   }

       } 
}    
else{
 
    $result1 = sqlsrv_query($conn,"SELECT * FROM traffic.qualityfaults where sectionID ='$sectionID'and lineID='$lineID' and sw_flag='0'");
         if( $result1)
         {
          $row = sqlsrv_fetch_array($result1);
          $fault = $row['qualityFaultID'];
          $sql1 ="insert into traffic.qualitylog(itemID,userID,qualityFaultID,defectsNo)
          values ('$itemID','$username','$fault','0')";
          $result = sqlsrv_query($conn,$sql1) ;
       if($result){
       $response["error"] = false;
       
   }
}
}

if($ImageFlag=='true' && $clear=='no'){
    $response["error"] = true;
           $json = file_get_contents('php://input');
$obj = json_decode($json);
$qualitylogID = $logIDs;

$rework = $_POST['rework'];
$imgJson = $_POST['ImageNames'];


$Images = json_decode($imgJson,true);

 if(isset($imgJson)){

   foreach($Images as $key => $value){
 $data="";
 $imgname = "faultpictures/".$value["Image_name"];
 $image = str_replace(' ','+',$value["Image_source"]); 

      $data = base64_decode($image, true) ;

$fp = fopen($imgname, 'w');
fwrite($fp, $data);
if(fclose($fp)){
  $response["error"] = false;
  $img_name = explode("/", $imgname);

$sql1 ="insert into dbo.faultpicturelog(qualityLogID,pictureID,rework)
values ('$qualitylogID','$img_name[1]','$rework')";
 $result = sqlsrv_query($conn,$sql1) ;

      if($result){
      $response["error"] = false;
  }
  else{
    $response["error"] = true;
  }
}else{
  $response["error"] = true;
}
   }
  }
 }
}
 // $errors = sqlsrv_errors();
 //  foreach ($errors as $error) {
 //    echo "SQLSTATE: ".$error['SQLSTATE'];
 //    echo "Message: ".$error['message'];
 //  }

echo json_encode($response);

//   foreach ($_REQUEST as $name => $value) {

//     error_log("$name : $value  ",3,'cutreport.log');
// }
// error_log('('.date('d-m-y H:i:s').')'.PHP_EOL,3,'cutreport.log');          

?>