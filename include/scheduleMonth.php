<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Team Schedule</title>

</head>
<body>
<p>
  <?php
  
require_once("/functions.php");
  
  session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	
}

$firstDayDay = GetFDoM("2012-07-05");
$lastDay = GetLDoM("2012-07-05");
echo $inicio."The first date is: ".$firstDayDay. " and the last date is ".$lastDay;
/*
require_once("connection.php"); //including the connection functions

	$conndb = connectToDB();//Connection stablished
	
	$query =	"";
	$params = array(5);
	$result = sqlsrv_query( $conndb, $query, $params);
	if ( $result === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	
//----------------------------------------------	
	While ($row = sqlsrv_fetch_array($result)){ //For each different timeIn
		
	
	}//While
//-------------------------------------------------------
	closeDBConnetion();	*/
?>
</body>
</html>