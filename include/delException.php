<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Creates a Schedule Exception</title>
<?php 
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
//include_once("functions.php");
	$excepId = $_POST['excId'];
?>
</head>
<body>
<?php  	
	require_once("connection.php");
	$conn = connectToDB();
	$query = "delete from ScheduleExceptions where schedExecId=".$excepId;
	
	$params = array(5);
	$getNextSchedExcep = sqlsrv_query( $conn, $query, $params);
	if ( $getNextSchedExcep === false){ 
		//die( FormatErrors( sqlsrv_errors() ) ); 
		$result = "couldn't delete the Schedule Exception";
	}else{
		echo "Exception Deleted";
		
		}
	header('Location:../profile.php');
		
?>		
</body>
</html>