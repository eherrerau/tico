<?php 
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("connection.php"); //including the connection functions
$errors = null;
include_once("functions.php");
$QMDetails = getProfileValues(callSessionName());
//----------Finding QM--------------
$conndb = connectToDB();//Connection stablished
$sqlquery =	"exec uspQmonitor";
$params = array(5);
$getQM = sqlsrv_query( $conndb, $sqlquery, $params);
if ( $getQM === false){
	die( FormatErrors( sqlsrv_errors() ) ); 	
	}
if ($rowqm = sqlsrv_fetch_array($getQM)){
	$qmonitor = $rowqm['usrId'];
}
//------------------------------------------
$conn = connectToDB();//Connection stablished
$query =	"uspCheckIfDeleted " . $_POST["casetxt"];
$params = array(5);
$getUsers = sqlsrv_query( $conn, $query, $params);
if ( $getUsers === false){
	die( FormatErrors( sqlsrv_errors() ) ); 	
	}
if ($row = sqlsrv_fetch_array($getUsers)){
//-----------------------------------------------------------
	//$qry =	"EXEC uspDeleteCase " . $_POST["casetxt"] . ", " . $_POST["qmontor"] . ", " . $_POST["teamid"];
	$qry =	"EXEC uspDeleteCase " . $_POST["casetxt"] . ", ".$QMDetails[0].", 1"; //values case number, qmonitor, teamId
	$params = array(5);
	$getUsers = sqlsrv_query( $conn, $qry, $params);
	echo "deleted";
	if ( $getUsers === false)
		{ die( FormatErrors( sqlsrv_errors() ) ); 
		
		}	
	else{	
		echo "The case ". $_POST["casetxt"]." has been deleted";	
		$querymail = "select usrMail from UserDetails where usrId in (select userTo from CaseExceptions where newAssign=1 and caseId in (select caseId From Cases where caseNumber = ". $_POST["casetxt"].")) ";
		$params = array(5);
		$getmail = sqlsrv_query( $conn, $querymail, $params);
		if ( $getmail === false){
			echo "error";
			die( FormatErrors( sqlsrv_errors() ) ); 
			}
		else{
			while($rowmail = sqlsrv_fetch_array($getmail))
			{
			$mail = $rowmail['usrMail'];
			
			$message = "The case ".$_POST["casetxt"]." has been deleted";
			mail($mail, 'Your case has been deleted', $message, null);
   			}
		}	
	
		
	}
//-----------------------------------------------------------
}
else{
	echo "The case does not exists or has been deleted";
}
closeDBConnetion();	
?>