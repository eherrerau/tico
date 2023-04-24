<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php
        include_once("functions.php");
        session_start();
        if (!isset($_SESSION['DBtoUse'])) {
            header("Cache-Control: no-cache");
        }
        $profileDetails = getProfileValues(callSessionName());
        ?>
</head>

<body>
<?php 
if(changePassword($profileDetails[0])){
	$message= ("Error: The password did not changed");
	}else{
		$message= ("The password changed succesfully");
}	
	echo $message;
; ?>
</body>
</html>