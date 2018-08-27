<?php //require_once("./includes/session.php"); ?>
<?php require_once("includes/connection_sql.php"); ?>
<?php require_once("includes/functions.php"); 
$sumProduction = 0;
$sumtarget = 0;
?>

<?php 
if(isset( $_GET['day']) || isset( $_GET['lineID']) )
{
    $day =  $_GET['day'];
    $lineID = $_GET['lineID'];
}
else
{  
    $day = date("Y-m-d");
     $lineID = $_GET['lineID'];
}

?>
<div class="col-sm-1  col-card-item">
    <div class="panel  " style="background-color: rgb(71,121,131) ; min-height:146px; max-height:146px">
        <div class="panel-body" font-family="verdana , sans-serif" style="color:white;padding:5px 5px">
            <b> <center><h1 style="font-size:15px"><br>HOURLY <br>
                PRODUCTION  <hr> CUMULATIVE PRODUCTION  </h1>
                </center> 
              </b>
        </div>
        <!-- /.panel-body -->
    </div>
</div>
<?php 

$slotdata = get_slotdata($day, $lineID);
if (  sizeof($slotdata)  >0 )
{
    foreach($slotdata as $slot)
{
     
    
 ?>
 

<div class="col-sm-1  col-card-item " id="slotbox">
    <div class="panel" style="background-color: rgb(163,193,173) ;min-height:145px; max-height:145px;">
        <div class="panel-body" style="padding: 5px 10px;color:black ; border-style:solid;border-color:black;border-width:2px">
           <?php 
         $per =100; 
        if($slot['target'] >0 )
        {
          $per = round( ($slot['production'] / $slot['target']) *100  ) ;
          
        }
          
        if( $per < 90 )
        {  ?>
            
            <b> <h1 class="blinking"> <a  id="blinkProductionValue" style="font-size:25px;color:red"><?php echo round( $curProduction =   $slot['production']  )  ?> </a>     <sub id="blinktargetValue"   style="font-size:50%;color:red"> / <?php echo round( $curTarget =  $slot['target'] )  ?></sub>  </h1> </b>
      
            
       <?php }
        else
        {?>
            <b> <h1> <a  id="blinkProductionValue" style="font-size:25px;color:black"><?php echo round( $curProduction =   $slot['production']  )  ?> </a>    <sub id="blinktargetValue"   style="font-size:50%"> / <?php echo round( $curTarget =  $slot['target'] )  ?></sub>  </h1> </b>
      
        <?php  }   ?>
                   <hr style="margin-top:25px;margin-bottom:1px">
                <b style="color:Blue"> <h1  style="font-size:25px"><?php echo round ( $sumProduction = $curProduction + $sumProduction )   ?>   <sub  style="font-size:50%"> / <?php echo 
                round( $sumtarget = $sumtarget + $curTarget ); ?></sub>  </h1> 
                </b>
           
             <b> <span style="cursor:pointer" id="<?php echo $slot['time'] ?>" onclick="slottime(this.id)">   <?php echo $slot['time'] ?> </span>
           </b>   
              
              
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>


<?php }  
}
else

for ($i=1; $i<11 ; $i++  )
{  ?>


<div class="col-sm-1  col-card-item ">
    <div class="panel" style="background-color: rgb(163,193,173) ;min-height:110px; max-height:110px">
        <div class="panel-body " style="padding: 0px 0px;color:black;font-size:70%">
            <b> <h1  > 0  <sub  style="font-size:50%"> /0</sub>  </h1> 
              
            <span> N/A </span>
            </b>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>


<?php } ?>


<!-- /.col-sm-6 -->
 
<script>
function blinker() {
     
    var  percentage = parseInt( $('#blinktargetValue').html() ) / parseInt( $('#blinkProductionValue').html() ) ;
    
  // alert(Math.round(percentage));
    
	$('.blinking').fadeOut(500);
	$('.blinking').fadeIn(500);
}
setInterval(blinker, 1000);
</script>
