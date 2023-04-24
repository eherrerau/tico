<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Get Schedule Exceptions</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("connection.php");
require_once("functions.php");
$userDetails = getProfileValues(callSessionName());
$schedExc = array();
$schedExc = getNextSchedExcep($userDetails[0]);
echo implode(", ",$schedExc);
?>
</body>
</html>