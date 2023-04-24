<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<?php 
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("functions.php");?>
</head>
<body >
<?php
	$usrname = $_GET["user"];
	
	$userDetails = getProfileValues($usrname);

	echo implode("<br>",getAllRolesByUsr($userDetails[0]));
	

?>
</body>
</html>