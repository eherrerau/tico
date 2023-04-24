<?php 
require_once("connection.php");
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
$errors = null;
$conn = connectToDB();//Connection stablished
$query =	"exec uspQmonitor";
$params = array(5);
$getUsers = sqlsrv_query( $conn, $query, $params);
if ( $getUsers === false)
	{ die( FormatErrors( sqlsrv_errors() ) ); 
	
	}
if ($row = sqlsrv_fetch_array($getUsers)){
	echo "<b>".$row['nameToDisplay']."</b>";
}
else{
	echo "<b>Not Assigned</b>"	;
}
closeDBConnetion();	
?>
