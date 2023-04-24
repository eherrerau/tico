<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link href="../lib/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<!--<link href="css/normalize.css" rel="stylesheet" />-->
<script src="../lib/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
<script src="../lib/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script> 
<script src="../lib/js/script.js" type="text/javascript"></script>
<script src="../lib/js/graphs.js" type="text/javascript"></script>

<title>Average</title>
</head>
<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();
		$( "#datepicker3" ).datepicker();		
	});	
</script>
<body>
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
include_once("../include/functions.php");
$userDetails = getProfileValues(callSessionName());
//----------------------------------------------------
?>

 <div id="dateFrom">
<p><b>Date From:</b> <input type="text" name="datepicker" id="datepicker" value="" size="8"></p>
 </div><!-- End dateFrom -->
<div id="dateTo">
<p><b>Date to:</b> <input type="text" name="datepicker2" id="datepicker2" value="" size="8"></p>
 </div><!-- End dateTo -->     
 <div id="avg" onclick="graphicAv('graphAvPeriod.php', this.datepicker.value, this.datepicker2.value);"><a href="graphAvPeriod.php"  onclick="return false;">Average</a></div>
</body>
</html>