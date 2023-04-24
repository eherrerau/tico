<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Total Cases per Engineer / Current Week</title>

</head>

<body>

<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("../include/connection.php"); //including the connection functions

$todayDate = date("Y-m-d");
$date=$todayDate;

$date_arr=explode('-',$date);

$dateOneMonthAgo= Date("Y-m-d",mktime(0,0,0,$date_arr[1]-1,$date_arr[2],$date_arr[0]));
if ($dateOneMonthAgo < '2012-02-06'){
	$dateOneMonthAgo = '2012-02-06';
	}



$conndb = connectToDB();//Connection stablished
$totalUsers=0;
$totalAvg=0;
//----------------------------------
//--------Searching engineers-------------
$query =	"exec uspOrderFoundation' ".$dateOneMonthAgo."', '".$todayDate."'";//Finding all engineers
$params = array(5);
$result = sqlsrv_query( $conndb, $query, $params);
if ( $result === false)
	{ die( FormatErrors( sqlsrv_errors() ) ); 
	
	}
//echo "<a href=\"graphs\averagePdfReport.php\">pdf</a>";
// <a href=\"graphs\averagePdfReport.php\">pdf</a>";
echo "<h2><div id=tittle>Average cases per Engineer/From ".$dateOneMonthAgo." to ".$todayDate." </div></h2>";
echo "<div id=main>";
$x=1;
$serie ="Serie". $x;
While ($row = sqlsrv_fetch_array($result)){ //For each Engineer

	

	$sqlquery =	"exec uspAveragePeriod ".$row['usrId'].", '".$dateOneMonthAgo."' , '".$todayDate."'";//This returns all the assigned cases in the week

	$params = array(5);
	$getCases = sqlsrv_query( $conndb, $sqlquery, $params);
	if ( $getCases === false)
		{ die( FormatErrors( sqlsrv_errors() ) ); 
		
		}
	if ($rowCases = sqlsrv_fetch_array($getCases)){
		$totalUsers=$totalUsers+1;
		$totalAvg = $totalAvg+$rowCases['average'];
		$tamano= $rowCases['average']*50;
		$tamanoCritical= $rowCases['criticalAvg']*50;
		//-------------chick if Available
		
		$queryShbyUsr = "EXEC uspAvailables @userid=". $row["usrId"];
		
		$getSchByUsr = sqlsrv_query( $conndb, $queryShbyUsr, $params);
		if ( $getCasesaverage === false)
		{
			
			 die( FormatErrors( sqlsrv_errors() ) ); 
			
		}
		//else {echo "<div id=row><div id=\"engineer\">";}
		$rowSchbyUsr = sqlsrv_fetch_array($getSchByUsr);
		
		if($rowSchbyUsr){
			echo "<div id=row><div id=\"engineer\" >";
		
		}
		else {echo "<div id=row><div id=\"engineer\"style=\"color: #DD4B39;\">";}
		//--------------------------------------
		echo " ". $row['nameToDisplay']. "</div><div id=\"graphline\" style=\"width:".$tamano."px; \">";
		if ($tamanoCritical>0){
			
			echo "<img src=\"../images/criticalBar.gif\" width=\"".$tamanoCritical."px\" height=\"14px\" alt=\"Average Critical cases\" />";
			}
		
		echo "</div><div id=\"tamano\"  style=\"position:relative; \" >". round($rowCases['average'],2)."</div></div>";
		//echo "the engineer ". $row['nameToDisplay']. " has "; 
		//echo "total cases ". $rowCases['total']. "  ";
	}
	$x = $x+1;
	$serie ="Serie". $x;
}//While
closeDBConnetion();	
if ($totalUsers>0){
	
	$totalAvg = $totalAvg/$totalUsers;
	
	echo "<div id=row><div id=\"engineer\" style=\"color:#DD4B39;\"><b>AVERAGE</b></div><div id=\"graphline\" style=\"width:".round($totalAvg*50,0)."px; \"></div><div id=\"tamano\"  style=\"position:relative; color:#DD4B39;\"><b>".round($totalAvg,2)."</b></div></div>";
	$totalBar= round($totalAvg*50,0);
	$totalBar=$totalBar+5;
	echo "<div id=\"avgBar\" style=\"width:".$totalBar."px;\"></div>";
	
	
}
?>
</div>

</body>
</html>