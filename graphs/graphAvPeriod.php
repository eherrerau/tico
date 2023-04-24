<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Total Cases per Engineer / Custom View</title>

</head>

<body>

<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("../include/connection.php"); //including the connection functions
$reporte =  $_GET["reportType"];
$engineer =  $_GET["engineer"];
$inicio = strtotime($_GET["startdate"]);
$fin = strtotime($_GET["enddate"]);
$dateStart = date("Y-m-d H:i:s", $inicio);
$dateEnd = date("Y-m-d H:i:s",$fin+60*59.9999*24);

$conndb = connectToDB();//Connection stablished

if ($dateStart < '2012-02-06'){
	$dateStart = '2012-02-06';
	}
$totalUsers=0;
$totalAvg=0;
$avgCrit=0;
$avg=0;
//----------------------------------
//--------Searching engineers-------------
if (($reporte == 1) or  ($reporte == 4) or ($reporte == 8)){//If the report is for all engineers
	$query =	"SELECT usrId, nameToDisplay FROM UserDetails WHERE usrId in (SELECT usrId FROM RoleByUsr WHERE roleId IN(SELECT roleId FROM Roles Where receivesCases=1)) and active='True' Order by nameToDisplay";//Finding all engineers
}
if (($reporte == 2) or  ($reporte == 5) or  ($reporte == 10)){//If the report is for Premier engineers
	$query =	"SELECT usrId, nameToDisplay FROM UserDetails WHERE usrId in (SELECT usrId FROM RoleByUsr WHERE roleId IN(SELECT roleId FROM Roles Where receivesCases=1)) and active='True' and premier='True' Order by nameToDisplay";//Finding all Premier engineers
}
if (($reporte == 3) or  ($reporte == 6) or  ($reporte == 9)){//If the report is for Foundation engineers
	$query =	"SELECT usrId, nameToDisplay FROM UserDetails WHERE usrId in (SELECT usrId FROM RoleByUsr WHERE roleId IN(SELECT roleId FROM Roles Where receivesCases=1)) and active='True' and premier='False' Order by nameToDisplay";//Finding all Foundation engineers
}
if ($reporte == 7){//specific query
	$query =	"exec uspCasesReportByUsr ".$engineer.", '".$dateStart."', '".$dateEnd."'";//Finding all Foundation engineers
}
if ($reporte == 11){//specific query
	$query =	"SELECT usrId, nameToDisplay FROM UserDetails WHERE usrId in (SELECT usrId FROM RoleByUsr WHERE roleId IN(SELECT roleId FROM Roles Where receivesCases=1)) and active='True' Order by nameToDisplay";//Finding all Foundation engineers
}



$params = array(5);
$result = sqlsrv_query( $conndb, $query, $params);
if ( $result === false)
	{
		 die( FormatErrors( sqlsrv_errors() ) ); 
	
	}
if ($reporte == 1){
	echo "<h2><div id=tittle>Average cases, all Engineer From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 2){
	echo "<h2><div id=tittle>Average cases Premier From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 3){
	echo "<h2><div id=tittle>Average cases Foundation From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 4){
	echo "<h2><div id=tittle>Total cases, all Engineer From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 5){
	echo "<h2><div id=tittle>Total cases Premier From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 6){
	echo "<h2><div id=tittle>Total cases Foundation From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 7){
	echo "<h2><div id=tittle>Total cases for ".$engineer." From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 8){
	echo "<h2><div id=tittle>Total Critical cases, all Engineer From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 10){
	echo "<h2><div id=tittle>Total Critical cases Premier From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 9){
	echo "<h2><div id=tittle>Total Critical cases Foundation From ".$dateStart." to ".$dateEnd." </div></h2>";
}
if ($reporte == 11){
	echo "<h2><div id=tittle>Engineer statistics From ".$dateStart." to ".$dateEnd." </div></h2>";
}

echo "<div id=\"main\">";
$x=1;
$serie ="Serie". $x;
if ($reporte ==11){
	
	echo "<div id=\"rowHistory\">
			<div id=\"dateUpdate\">Engineer</div>
			<div id=\"severityHistory\" style=\"width:6%; \">Cases</div>
			<div id=\"fromEngineerHistory\" style=\"left:22%; width:18%;\">W.Days</div>
			<div id=\"toEngineerHistory\">Average</div>
			<div id=\"motiveHistory\">Sev1 Avg</div>
			<div id=\"notaHistory\"></div>  
			<div id=\"vacio\">.</div>
		</div>";
	}
if ($reporte ==7){
	
	echo "<div id=\"rowHistory\">
			<div id=\"dateUpdate\">Date</div>
			<div id=\"severityHistory\">Sev</div>
			<div id=\"fromEngineerHistory\">Case Number</div>
			<div id=\"toEngineerHistory\">QM</div>
			<div id=\"motiveHistory\">Engineer</div>
			<div id=\"notaHistory\">Note</div>  
			<div id=\"vacio\">.</div>
		</div>";
	}
While ($row = sqlsrv_fetch_array($result)){ //For each Engineer

	
	if ($reporte !=7){
		
	$sqlquery =	"exec uspAveragePeriod ".$row['usrId'].", '".$dateStart."', '".$dateEnd."'";//This returns all the assigned cases in the week
	if ($reporte >7 and  $reporte <11){
		$sqlquery =	"exec uspAveragePeriodCritical ".$row['usrId'].", '".$dateStart."', '".$dateEnd."'";//This returns all the assigned cases in the week
		//echo $sqlquery;
		}
		//echo $reporte."- ";
	$params = array(5);
	$getCases = sqlsrv_query( $conndb, $sqlquery, $params);
	if ( $getCases === false)
		{ die( FormatErrors( sqlsrv_errors() ) ); 
		
		}
	if ($rowCases = sqlsrv_fetch_array($getCases)){
		
		if ($reporte <= 3){
			$totalUsers=$totalUsers+1;
			$totalAvg = $totalAvg+$rowCases['average'];
			$tamano= $rowCases['average']*50;
			echo "<div id=row><div id=\"engineer\"> ". $row['nameToDisplay']. "</div><div id=\"graphline\" style=\"width:".$tamano."px; \"></div><div id=\"tamano\"  style=\"position:relative; \" >". round($rowCases['average'],2)."</div></div>";
			$x = $x+1;
		}
		if (($reporte >= 4) and ($reporte <= 6)){
			if ($rowCases['totalcases'] > 0){
				$totalUsers=$totalUsers+1;
				$totalAvg = $totalAvg+$rowCases['totalcases'];
				$tamano= $rowCases['totalcases']*2;
				echo "<div id=row><div id=\"engineer\"> ". $row['nameToDisplay']. "</div><div id=\"graphline\" style=\"width:".$tamano."px; \"></div><div id=\"tamano\"  style=\"position:relative; \" >". round($rowCases['totalcases'],2)."</div></div>";
				$x = $x+1;
			}
		}
		if ($reporte >7 and $reporte <11){
			//echo "OK";
			if ($rowCases['totalcases'] > 0){
				$totalUsers=$totalUsers+1;
				$totalAvg = $totalAvg+$rowCases['totalcases'];
				$tamano= $rowCases['totalcases']*2;
				echo "<div id=row><div id=\"engineer\"> ". $row['nameToDisplay']. "</div><div id=\"graphline\" style=\"width:".$tamano."px; \"></div><div id=\"tamano\"  style=\"position:relative; \" >". round($rowCases['totalcases'],2)."</div></div>";
				$x = $x+1;
			}
		}
		
	}
	} //<7
	
	if ($reporte ==7){

		echo "<div id=\"rowHistory\">
			<div id=\"dateUpdate\">". date_format($row['assignTime'], "M-d-Y")."</div>
			<div id=\"severityHistory\">".$row['severy']."</div>
			<div id=\"fromEngineerHistory\">";
		if ($row['premier']==1){
			echo "<img title=\"Premier\" src=\"../images/premier.png\" width=\"12\" height=\"12\" />";
		}
		echo $row['caseNumber']."</div>
			<div id=\"toEngineerHistory\">".$row['UserFrom']."</div>
			<div id=\"motiveHistory\">".$row['Userto']."</div>
			<div id=\"notaHistory\">".$row['note']."</div>  
			<div id=\"vacio\">.</div>
		</div>";
				//$x = $x+1;
			
	}
	if ($reporte ==11){
	
		echo "<div id=\"rowHistory\">
			<div id=\"dateUpdate\">". substr($row['nameToDisplay'],0,16). "</div>
			<div id=\"severityHistory\" style=\"width:6%;\">".$rowCases['totalcases']."</div>
			<div id=\"fromEngineerHistory\" style=\"left:22%; width:18%;\">". round($rowCases['totalWorkingDays'],3)."</div>
			<div id=\"toEngineerHistory\">".round($rowCases['average'],2)."</div>
			<div id=\"motiveHistory\">".round($rowCases['criticalAvg'],2)."</div>
			<div id=\"notaHistory\"></div>  
			<div id=\"vacio\">.</div>
		</div>";
				//$x = $x+1;
			$totalUsers=$totalUsers+1;
			$totalAvg = $totalAvg+$rowCases['totalcases'];
			$tamano= $rowCases['totalWorkingDays'];
			$avgCrit=$rowCases['criticalAvg'];
			$avg=$rowCases['average'];
	}
	
	
	
	$serie ="Serie". $x;
}//While
closeDBConnetion();	
if ($totalUsers>0){
	
	if ($reporte <= 3){	
	$totalAvg = $totalAvg/$totalUsers;
		echo "<div id=row><div id=\"engineer\"><b>AVERAGE</b></div><div id=\"graphline\" style=\"width:".round($totalAvg*50,2)."px; \"></div><div id=\"tamano\"  style=\"position:relative; \" ><b>".round($totalAvg,2)."</b></div>";
		$totalBar= round($totalAvg*50,0);
	}
	if (($reporte >= 4) and ($reporte <= 6)){
		
		echo "<div id=row><div id=\"engineer\"><b>Total Cases</b></div><div id=\"graphline\" style=\"width:0px; \"></div><div id=\"tamano\"  style=\"position:relative; \" ><b>".round($totalAvg,2)."</b></div></div>";
		$totalAvg = $totalAvg/$totalUsers;
		echo "<div id=row><div id=\"engineer\"><b>AVERAGE</b></div><div id=\"graphline\" style=\"width:".round($totalAvg*2,2)."px; \"></div><div id=\"tamano\"  style=\"position:relative; \" ><b>".round($totalAvg,2)."</b></div>";
		$totalBar= round($totalAvg*2,0);
	}
	
	$totalBar=$totalBar+5;
	if ($reporte ==11){
		$tamano=$tamano/$totalUsers;
		$avg=$avg/$totalUsers;
		$avgCrit=$avgCrit/$totalUsers;
		echo "<div id=\"rowHistory\" style=\"font-weight:bold\">
			<div id=\"dateUpdate\">Total / Avg</div>
			<div id=\"severityHistory\" style=\"width:6%;\">".$totalAvg."</div>
			<div id=\"fromEngineerHistory\" style=\"left:22%; width:18%;\">". round($tamano,3)."</div>
			<div id=\"toEngineerHistory\">".round($avg,2)."</div>
			<div id=\"motiveHistory\">".round($avgCrit,2)."</div>
			<div id=\"notaHistory\"></div>  
			<div id=\"vacio\">.</div>
		</div>";
				//$x = $x+1;
		
	}
	echo "</div><!--row-->";
	echo "<div id=\"avgBar\" style=\"width:".$totalBar."px\"></div>";
	
}
echo "</div>";
?>

</body>
</html>