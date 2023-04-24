<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>TICO - Schedule</title>
<?php 
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
include_once("functions.php");?>
</head>
<body> 
<?php  $profileDetails = getProfileValues(callSessionName());
//$roleDescription = getRoleDescription($_GET['schtype']);
//echo $roleDescription."blabla";
echo "<form name=\"updateScheForm\"  id=\"updateScheForm\" action=\"include/updateSchedule.php\" method=\"post\">
            	<div id=\"titulos\">
                	<div id=\"roleDescription\">".getRoleDescription($_GET['schtype'])."</div>
                    <div id=\"in\">In</div>
                    <div id=\"lunchIn\">Lunch in</div>
                    <div id=\"lunchOut\">Lunch out</div>
                    <div id=\"out\">Out</div>
                </div> 
				<input name=\"roleIdValue\" type=\"hidden\" value=\"".$_GET['schtype']."\" />
				 ";               
					echo $sched = implode(getScheduleForUser($profileDetails[0],$_GET['schtype'])); /// Cambiar a usar varios roles // 
					
               echo" <div id=\"schedSaveButon\" onClick=\"javascript:document.updateScheForm.submit()\" > <a href=\"include/updateSchedule.php\" title=\"Save Schedule\" onclick=\"return false\">Save</a></div> <!-- schedSaveButon -->
            </form>	"
?> 
<!-- <div id="schedSaveButon onClick="javascript:document.updateScheForm.submit()"> <a href="inlude\updateSchedule.php" title="Save Schedule">Save</a></div> <!-- schedSaveButon -->
</body>
</html>