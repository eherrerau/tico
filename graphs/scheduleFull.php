<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Team Schedule</title>
<link href="../css/schedule.css" rel="stylesheet" type="text/css" />
<script src="lib/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
<script src="lib/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script src="lib/js/script.js" type="text/javascript"></script>
<script src="lib/js/getcases.js" type="text/javascript"></script>
<script src="lib/js/graphs.js" type="text/javascript"></script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
include_once("../include/functions.php");
$userDetails = getProfileValues(callSessionName());
?>
<p>
<div id="principal">
    <!---------------------------------->	
   	    <div id="header">
        	<div id="titulo">
        		<h1>TICO - Your brand</h1>
            </div> <!-- titulo -->
          <div id="info">
              <h4> <?php echo $userDetails[1]; ?> / <label id="TimeClock"></label></h4>
          </div><!-- info -->
        </div><!-- header -->
     <!---------------------------------->
     <div id="menus">
     <div id="rightTop">
           	  <div id="mainMenu">
                	<ul>
                        <li><a href="signout.php">Sign Out</a></li>  
                        <li><a href="mailto:test@terst.com?subject=Enhancement Request on TICO Site">Submit an ER</a></li>
                        <li><a href="profile.php">My Profile</a></li>
                        <li><a href="index.php" class="current">Cases Monitor</a></li>
                         <?php if (isProfile(1)){
                        echo "<li><a href=\"index.php\" class=\"current\"><img src=\"images/config.png\" width=\"25\" height=\"26\" border=\"\"></a></li>";
						 }
			  ?>
                    </ul>
                </div><!-- mainMenu -->
             
            </div><!-- rightTop -->
	  </div>
  <?php
  
 	  
require_once("../include/connection.php"); //including the connection functions
$Contador =0;
	$conndb = connectToDB();//Connection stablished
	//----------------------------------
	//--------Searching case history-------------
	$query =	"select distinct timeIn from Schedule where timeIn > '00:00:00' and (roleId =5 or roleId =4) order by timeIn";
	$params = array(5);
	$result = sqlsrv_query( $conndb, $query, $params);
	if ( $result === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	echo "<div id=tittle><h2>Today's Schedule";
	//$row = sqlsrv_fetch_array($result);
	echo "</div>";
	echo "<div id=\"main\">";
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
			echo $usrPremier." ".$row2['nameToDisplay']."<BR>";
			
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
			echo $usrPremier." ".$row2['nameToDisplay']."<BR>";
			
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
			echo $usrPremier." ".$row2['nameToDisplay']."<BR>";
			
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
			echo $usrPremier." ".$row2['nameToDisplay']."<BR>";
			
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
	
		echo "<div id=\"Friday2\">";	
			
			
		While ($row2 = sqlsrv_fetch_array($result2)){
			if ($row2["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" />";
			else
				$usrPremier=""; 
			echo $usrPremier." ".$row2['nameToDisplay']."<BR>";
			
		}//While
		
		//-------------------------------------
		echo "</div>
					<div id=\"vacio4\">-</div>
				</div>";
	}//While
//-------------------------------------------------------
	closeDBConnetion();	
?>
</div>
</body>
</html>