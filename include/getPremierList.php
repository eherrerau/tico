<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("connection.php");
/*
$todayDate = date("Y-m-d");
$date=$todayDate;

$date_arr=explode('-',$date);

$dateOneMonthAgo= Date("Y-m-d",mktime(0,0,0,$date_arr[1]-1,$date_arr[2],$date_arr[0]));
if ($dateOneMonthAgo < '2012-02-06'){
	$dateOneMonthAgo = '2012-02-06';
	}*/
	
	//-------------Check start date-------------------
$conn = connectToGlobal();
$querydate =	"select * from Team where teamId in(select teamId from DB_ByTeam where DBname='".$_SESSION['DBtoUse']."')";//Finding all engineers

$params = array(5);
$resultado = sqlsrv_query( $conn, $querydate, $params);
if ( $resultado === false)
	{ 
	//echo $querydate;
	die( FormatErrors( sqlsrv_errors() ) ); 
	
	}

While ($rowDate = sqlsrv_fetch_array($resultado)){ 

//echo $_SESSION['DBtoUse'];
//echo  "fecha es ".date_format($rowDate["startDate"],"M-d-Y") ."--- team ".$rowDate['teamDesc'];
	$todayDate = date("Y-m-d");
	$date=$todayDate;
	
	$date_arr=explode('-',$date);
	
	$dateOneMonthAgo= Date("Y-m-d",mktime(0,0,0,$date_arr[1]-2,$date_arr[2],$date_arr[0]));
	if ($dateOneMonthAgo < date_format($rowDate["startDate"],"Y-m-d")){
		$dateOneMonthAgo = date_format($rowDate["startDate"],"Y-m-d");
		}
}

closeDBConnetion();
//-----------------------------------------------------
$conn = connectToDB();
$query =  "exec uspNextEngineer '".$dateOneMonthAgo."', '".$todayDate."', ".$_GET['producto'];
$params = array(5);
$getUsers = sqlsrv_query( $conn, $query, $params);
if ( $getUsers === false)
	{ die( FormatErrors( sqlsrv_errors() ) ); }

$scheduleIn ="";
$scheduleOut = "";
$scheduleLunch = "";
echo"<select id=\"engineerlst\" name=\"engineerlst\">";
while($row = sqlsrv_fetch_array($getUsers))
{
	$queryShbyUsr = "EXEC uspAvailablePremier @userid=". $row["usrId"];
	$getSchByUsr = sqlsrv_query( $conn, $queryShbyUsr, $params);
	if ( $getSchByUsr === false)
		{ die( FormatErrors( sqlsrv_errors() ) ); }
	$i=0;                  
	while($rowSchbyUsr = sqlsrv_fetch_array($getSchByUsr)){
		//$schByUser = $rowSchbyUsr["scheduleId"];
		$scheduleIn = date_format($rowSchbyUsr["timeIn"],"H:i");
		$scheduleOut = date_format($rowSchbyUsr["timeOff"],"H:i");
		$scheduleLunch = date_format($rowSchbyUsr["timeLunch"],"H:i");
		$scheduleLunchOff = date_format($rowSchbyUsr["timeLunchEnd"],"H:i");
		//$scheduleLunchOff = date("H:i",strtotime($scheduleLunch."+1 hour"));
		//echo $scheduleLunchOff. "--". $scheduleLunch."  ";
		if (($scheduleIn < date("H:i")) and ($scheduleOut >= date("H:i")) and !((date("H:i") >= $scheduleLunch)and(date("H:i") < $scheduleLunchOff))){	
		
		echo "<option value=\"". $row["usrId"] ."\">".$row["nameToDisplay"]."</option>";
			/*echo $rowSchbyUsr["caseId"];
			$queryCase = "Exec uspUsrCasebyDay @userid =" . $row["usrId"];
			$getCase = sqlsrv_query( $conn, $queryCase, $params);
			if ( $getCase === false)
				{ die( FormatErrors( sqlsrv_errors() ) ); }
			while($rowCase = sqlsrv_fetch_array($getCase)){
					$caseSev[$i]= $rowCase["severy"];//this is the severity for an especific case
					$cases[$i]=  $rowCase["caseId"];//$cases[i] contains today's cases for one engineer
					$caseNum[$i]=  $rowCase["caseNumber"];//$cases[i] contains today's cases numbers
	
				$i = $i+ 1;
				
				}
			$queryPremier = "SELECT premier from UserDetails where usrId=". $row["usrId"];
			$getpremier = sqlsrv_query( $conn, $queryPremier, $params);
			if ( $getpremier === false)
			{ die( FormatErrors( sqlsrv_errors() ) ); }
			If ($rowpremier = sqlsrv_fetch_array($getpremier)){
				if ($rowpremier["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" alt=\"Premier\" />";
				else
				$usrPremier=""; 
				// Creates and prints the div id="engineer"  for the available engineers only
					echo "<div id=\"engineer\">
							<div id=\"person\">". $row['nameToDisplay'] . "</div> <!--person-->
							<div id=\"premier\">". $usrPremier . "</div><!--premier-->
							<div id=\"LW\"> 0 </div><!--LW-->
							<div id=\"Td\"> 0 </div><!--Td-->
							<div id=\"TW\"> 0 </div><!--TW-->
							<div id=\"Av\"> 0 </div><!--Av-->
							<div id=\"in\">". $scheduleIn ."</div><!--in-->
							<div id=\"lIn\">". $scheduleLunch ." - ". $scheduleLunchOff ."</div><!--lIn-->
							<div id=\"out\">". $scheduleOut ."</div><!--out-->
							<div id=\"cases\">";
					$x=0;
					$countPrem =0;
					$countNoPrem=0;
					if ($i >3){
						while ($i>=0){
							if ($cases[$x] != 0){
								
								if ($caseSev[$x] == 1){
									$countPrem= $countPrem +1;
								}
								else{
									$countNoPrem= $countNoPrem +1;
								}
							}	
							$caseSev[$x] = 0;
							$cases[$x] = 0;
							$i= $i-1;
							$x= $x+1;	
						}//while
						echo "<b style=\"color:#DD4B39\">".$countPrem. "</b> <img src=\"images/2case.png\" width=\"10\" height=\"10\" alt=\"" . $countPrem ." Critical cases\" /> ";
						echo "<b style=\"color:#060\">".$countNoPrem . "</b> <img src=\"images/ncase.png\" width=\"10\" height=\"10\" alt=\"" . $countNoPrem ." Non Critical cases\" /> ";
						}
					else {
						while ($i>=0){
							if ($cases[$x] != 0){
								
								if ($caseSev[$x] == 1){
									echo "<img src=\"images/2case.png\" width=\"10\" height=\"10\" alt=" . $caseNum[$x] ." /> ";
									$countPrem= $countPrem +1;
								}
								else{
									echo "<img src=\"images/ncase.png\" width=\"10\" height=\"10\" alt=" . $caseNum[$x] ." /> ";
									$countNoPrem= $countPrem +1;
								}
							}	
							$caseSev[$x] = 0;
							$cases[$x] = 0;
							$i= $i-1;
							$x= $x+1;	
						}//while
					}
					echo "</div><!--cases--></div><!--engineer-->";//finishes the div creation for the engineer details
			}/*if*/
		}
	}/*While*/
	
}/**While*/
echo "</select>";
closeDBConnetion();
?>