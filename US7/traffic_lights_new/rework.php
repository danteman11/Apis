<?php
include "DBConnect.php";
$qualitylogID = $_REQUEST['qualityLogID'];
$imgJson = $_POST['ImageNames'];

    //$response["error"] = true;
$json = file_get_contents('php://input');
$obj = json_decode($json);
$rework = "1";
$Images = json_decode($imgJson,true);
       
 if(isset($imgJson)){
   
   foreach($Images as $key => $value){
 
 $imgname = "reworkPictures/".$value["Image_name"];
 $image = str_replace(' ','+',$value["Image_source"]); //replacing ' ' with '+' 
// if ( base64_encode(base64_decode($image, true)) == $image){
      $data = base64_decode($image, true) ;
//}

// // $imsrc = base64_decode($imsrc);
$fp = fopen($imgname, 'w');
fwrite($fp, $data);
if(fclose($fp)){
  $response["error"] = false;
  $img_name = explode("/", $imgname);
  
$sql1 ="insert into dbo.faultpicturelog(qualitylogID,pictureID,rework)
values ('$qualitylogID','$img_name[1]','$rework')";
 $result = sqlsrv_query($conn,$sql1) ;

      if($result){
             $result = sqlsrv_query($conn,"UPDATE traffic.qualitylog SET rework='$rework' WHERE qualitylogID='$qualitylogID'") ;
             if($result){
             $response["error"] = false;
             }
             else
             $response["error"] = true;
             
  }
  else{
    $response["error"] = true;
  }
}else{
  $response["error"] = true;
}
   }
  }
 


echo json_encode($response);
  


?>