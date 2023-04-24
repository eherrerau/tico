<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("connection.php"); //including the connection functions
$errors = null;
$engineer = $_GET["engineer"];
$conndb = connectToDB();//Connection stablished
echo "<b>Cases details:</b>";
$sqlquery =	"exec uspUsrCasebyDay ".$engineer;
$params = array(5);
$getcase = sqlsrv_query( $conndb, $sqlquery, $params);
if ( $getcase === false){
	die( FormatErrors( sqlsrv_errors() ) ); 	
	}
while ($rowcase = sqlsrv_fetch_array($getcase)){
	echo "<div id=\"divcontainer\">";
	echo "<div id=\"assigndTime\">".date_format($rowcase["assignTime"],"h:i")."</div>";
	echo "<div id=\"kaseNum\">".$rowcase["caseNumber"]."</div>";
	echo "";
	if ($rowcase["severy"] == 1){
		if ($rowcase["premier"]==1){
			echo "<div id=\"circle\"><img  id=\"imgcase\" src=\"images/2casep.png\" width=\"10\" height=\"10\" /> </div>";
		}
		else{
			echo "<div id=\"circle\"><img id=\"imgcase\" src=\"images/2case.png\" width=\"10\" height=\"10\" /></div> ";
		}
	}
	else{
		if ($rowcase["premier"]==1){
			echo "<div id=\"circle\"><img  id=\"imgcase\" src=\"images/ncasep.png\" width=\"10\" height=\"10\" /></div> ";
		}
		else{
			echo "<div id=\"circle\"><img id=\"imgcase\" src=\"images/ncase.png\" width=\"10\" height=\"10\"  /></div> ";
		}
	}
	echo "</div>";
}
closeDBConnetion();	
?>