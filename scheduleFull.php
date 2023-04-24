<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title>TICO - Team Schedule</title>
<link href="css/schedule.css" rel="stylesheet" type="text/css" />
<link href="css/header.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	//header("Cache-Control: no-cache");
	header('Location:../login.php');
}
include_once("include/functions.php");
require_once("include/connection.php"); //including the connection functions
$userDetails = getProfileValues(callSessionName());
?>
<div id="principal">
<?php 	include("modules/header.php");
		include("modules/rightMenu.php");?>
<div id="mainContent">
<?php
$Contador =0;
	$conndb = connectToDB();//Connection stablished
	//--------Searching case history-------------
	$query =	"select distinct timeIn from Schedule where timeIn > '00:00:00' and (roleId =5 or roleId =4) order by timeIn";
	$params = array(5);
	$result = sqlsrv_query( $conndb, $query, $params);
	if ( $result === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	echo "<div id=\"schedule\">";
	echo "<div id=tittle>Week Schedule";
	//$row = sqlsrv_fetch_array($result);
	echo "</div>";
	echo "<div id=\"rowHistory2\">
			<div id=\"Monday\"><b>Monday</b></div>
			<div id=\"Tuesday\"><b>Tuesday</b></div>
			
			<div id=\"Wednesday\"><b>Wednesday</b></div>
			<div id=\"Thursday\"><b>Thursday</b></div>
			
			<div id=\"Friday\"><b>Friday</b></div> 
			<div id=\"vacio3\">-</div>
		</div>";
//----------------------------------------------	
	While ($row = sqlsrv_fetch_array($result)){ //For each different timeIn
		
	$timeIn = date_format($row["timeIn"],"H:i:s");
	echo "<div id=\"rowHistory2\">".$timeIn."</div>";
		//$timeOff = date_format($row["timeOff"],"H:i");
		//echo $timeIn;
		//----------------------------------------
		$query2 =	"exec uspScheduleByTimeIn '".$timeIn."', 2";
		//echo $query2;
		$params = array(5);
		$result2 = sqlsrv_query( $conndb, $query2, $params);
		if ( $result2 === false){
			die( FormatErrors( sqlsrv_errors() ) ); 		
			}
		echo "<div id=\"rowHistory3\">
				<div id=\"Monday2\">";	
	
		While ($row2 = sqlsrv_fetch_array($result2)){
			if ($row2["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" />";
			else
				$usrPremier=""; 
			echo $row2['nameToDisplay']." ". $usrPremier ."<BR>";		
		}//While
		echo "</div>";
		//-------------------------------------
		//----------------------------------------
		$query2 =	"exec uspScheduleByTimeIn '".$timeIn."', 3";
		//echo $query2;
		$params = array(5);
		$result2 = sqlsrv_query( $conndb, $query2, $params);
		if ( $result2 === false){
			die( FormatErrors( sqlsrv_errors() ) ); 		
			}	
		echo "<div id=\"Tuesday2\">";	

		While ($row2 = sqlsrv_fetch_array($result2)){
			if ($row2["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" />";
			else
				$usrPremier=""; 
			echo $row2['nameToDisplay']." ". $usrPremier ."<BR>";			
		}//While
		
		//-------------------------------------
		echo "</div>";
		//----------------------------------------
		$query2 =	"exec uspScheduleByTimeIn '".$timeIn."', 4";
		//echo $query2;
		$params = array(5);
		$result2 = sqlsrv_query( $conndb, $query2, $params);
		if ( $result2 === false){
			die( FormatErrors( sqlsrv_errors() ) ); 		
			}	
		echo "<div id=\"Wednesday2\">";	
			
		While ($row2 = sqlsrv_fetch_array($result2)){
			if ($row2["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" />";
			else
				$usrPremier=""; 
			echo $row2['nameToDisplay']." ". $usrPremier ."<BR>";			
		}//While		
		//-------------------------------------
		echo "</div>";
		
		//----------------------------------------
		$query2 =	"exec uspScheduleByTimeIn '".$timeIn."', 5";
		//echo $query2;
		$params = array(5);
		$result2 = sqlsrv_query( $conndb, $query2, $params);
		if ( $result2 === false){
			die( FormatErrors( sqlsrv_errors() ) ); 		
			}	
		echo "<div id=\"Thursday2\">";	

		While ($row2 = sqlsrv_fetch_array($result2)){
			if ($row2["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" />";
			else
				$usrPremier=""; 
			echo $row2['nameToDisplay']." ". $usrPremier ."<BR>";			
		}//While
		//-------------------------------------
		echo "</div>";
		//----------------------------------------
		$query2 =	"exec uspScheduleByTimeIn '".$timeIn."', 6";
		//echo $query2;
		$params = array(5);
		$result2 = sqlsrv_query( $conndb, $query2, $params);
		if ( $result2 === false){
			die( FormatErrors( sqlsrv_errors() ) ); 		
			}	
		echo "<div id=\"Friday2\">";				
			
		While ($row2 = sqlsrv_fetch_array($result2)){
			if ($row2["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" />";
			else
				$usrPremier=""; 
			echo $row2['nameToDisplay']." ". $usrPremier ."<BR>";
			
		}//While
		
		//-------------------------------------
		echo "</div><div id=\"vacio4\">-<BR>-<BR>-<BR>-<BR>-<BR>-<BR>-</div>
				</div>";
	}//While
//-------------------------------------------------------
?>

<?php closeDBConnetion();	?>
		</div><!--Schedule-->
        <div id="exceptions">
    	<div id="scheExcTittle">Schedule Exceptions</div>       
        <?php
        //--------Searching case history-------------
	$query =	"Select usrid, nameToDisplay from UserDetails where usrId in (select usrId from ScheduleExceptions where (timeFrom >= GETDATE()) or (timeFrom <= GETDATE() and timeTo >= GETDATE()))";
	$params = array(5);
	$resulte = sqlsrv_query( $conndb, $query, $params);
	if ( $result === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
     While ($row = sqlsrv_fetch_array($resulte)){
		 $user = $row['usrid'];
		
		 	$query2 =	"select ScheduleExceptions.*, schExcepTypeDesc from ScheduleExceptions, ScheduleExcepTypesList where (usrId=".$user.") 	and (receivesCases='False')	and (ScheduleExceptions.schExcepTypeId= ScheduleExcepTypesList.schExcepTypeId)	and ((scheduleExceptions.timeFrom >= GETDATE()) or (scheduleExceptions.timeFrom <= GETDATE() and scheduleExceptions.timeTo >= GETDATE()) )";
	
		$params = array(5);
		$resulte2 = sqlsrv_query( $conndb, $query2, $params);
		if ( $resulte2 === false){
			die( FormatErrors( sqlsrv_errors() ) ); 		
			}
			
		While ($row2 = sqlsrv_fetch_array($resulte2)){
			
			echo " <div id=\"row\"><b>". $row['nameToDisplay']."</b> is on <b>".$row2['schExcepTypeDesc']."</b><br> From ".date_format($row2['timeFrom'],'m-d-Y H:i')." to ".date_format($row2['timeTo'],'m-d-Y H:i')."  </div>";
			
		}//While
	 }
	 ?>
		</div><!--exceptions-->
	</div><!--MainContent-->
</div><!--Principal-->
<script src="lib/js/script.js" type="text/javascript"></script>
<script src="lib/js/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="lib/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script> 
<script type="text/javascript">
	$("#fullBox").draggable();
</script>
</body>

</html>