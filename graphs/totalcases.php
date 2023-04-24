<!DOCTYPE HTML>
<html>
<head>
<script src="../lib/js/getcases.js" type="text/javascript"></script>
<meta charset="utf-8">
<title>Team Schedule</title>
<link href="../css/schedule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<p>
  <?php
  session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("../include/connection.php"); //including the connection functions
include_once("../include/functions.php");
$todayDate = date("Y-m-d");
echo date("M", strtotime($todayDate));
$mes=date("m", strtotime($todayDate));
$anho=date("Y", strtotime($todayDate));

$conndb = connectToDB();//Connection stablished
	//----------------------------------
//--------getting total days of month-------------
	$query =	"select dbo.fnDaysInMonth('".$todayDate."') as totalDays";
	$params = array(5);
	$result = sqlsrv_query( $conndb, $query, $params);
	if ( $result === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	
	While ($row = sqlsrv_fetch_array($result)){ //For each different timeIn
	//$row["totalDays"] total days of the month	
		$totalDays = $row["totalDays"];

	}//While
//-------------------------------------------------------
//--------getting engineer list-------------
echo "<div id=\"mainContentMonth\">";

	echo "<div id=\"rowByEngineer\">";
		echo "<div id=\"engineerName\" style=\"text-align:center; font-weight:bold;\">";
        	echo "NAME"; 
		echo "</div> <!--engineerName-->"; 
		for ($i = 1; $i <= $totalDays; $i++) {
			echo "<div id=\"dayNum".$i."\" style=\"font-weight:bold;\">".$i."</div>";
		}
	echo "</div> <!--rowByEngineer-->";
	$query2 =	"SELECT usrId, nameToDisplay FROM UserDetails WHERE active=1 order by nameToDisplay ";
	$params2 = array(5);
	$resultE = sqlsrv_query( $conndb, $query2, $params2);
	if ( $resultE === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	 
	While ($rowEng = sqlsrv_fetch_array($resultE)){ //For each user
		echo "<div id=\"rowByEngineer\">";
			echo "<div id=\"engineerName\">";
        		echo $rowEng["nameToDisplay"]; 
			echo "</div> <!--engineerName-->"; 
			
			for ($i = 1; $i <= $totalDays; $i++) {
				$diaFecha=$anho."-".$mes."-".$i;
			$weekDay = date(l, strtotime($diaFecha));
				echo "<div id=\"dayNum".$i."\"";
				if (($weekDay=="Saturday")or($weekDay=="Sunday")){
					echo  " style=\"background-color:#EBE6E6;\"";
					}
	
				echo " >";
				
				//------------------------------------------------------------------
				
				
				$query3 =	"exec uspCasesByDayByUser ".$rowEng["usrId"].", '".$diaFecha."'";
				$params3 = array(5);
				$resultSch = sqlsrv_query( $conndb, $query3, $params3);
				if ( $resultSch === false){
					die( FormatErrors( sqlsrv_errors() ) ); 		
					}
				$numero = 0;
				$num_rows = sqlsrv_num_rows($resultSch);
				While ($rowSch = sqlsrv_fetch_array($resultSch)){ //For each different timeIn
					//echo $rowSch['schExcepTypeId'];
					$numero=$numero+1;
					if ($numero>3){
						?>
                        <style>
							#mainContentMonth #rowByEngineer {
								height: 25px;
							}
							
							#mainContentMonth #rowByEngineer {
								height: 25px;
							}
							#mainContentMonth #rowByEngineer #engineerName{
								height: 25px;
							}
						</style>
						
						<?php
						
						}
					if ($num_rows <4){
						if ($rowSch['severy'] == "1"){
							
							if ($rowSch['premier'] == "1"){
								echo "<img src=\"../images/2casep.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$rowSch["usrId"].")\" >";
								}
							else {echo "<img src=\"../images/2case.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$rowSch["usrId"].")\" >";}
						}
						else{
						
						if ($rowSch['premier'] == "1"){
							echo "<img src=\"../images/ncasep.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$rowSch["usrId"].")\" >";
							}
						else {echo "<img src=\"../images/ncase.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$rowSch["usrId"].")\" />";}
						}
					}
					else{
						echo $num_rows;
						}	
					
				}
				//------------------------------------------------------------------
				echo "</div>";
			}  	
        echo "</div> <!--rowByEngineer-->";
		

	}//While
//-------------------------------------------------------


		echo "</div><!-- main content -->";		
	closeDBConnetion();	
?>
<div id="detail"></div> 
</body>
</html>