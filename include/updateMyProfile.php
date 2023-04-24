<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<title>update my profile</title>
<?php 
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
include_once("functions.php");
?>
</head>
<body>
<?php 
$profileDetails = getProfileValues(callSessionName());
?>
<?php 
updateMyProfile($profileDetails[0]);	
	header('Location:../profile.php');
?> 
</body>
</html>