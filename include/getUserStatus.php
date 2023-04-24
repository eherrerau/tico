<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("connection.php");

$conn = connectToDB();
$query = "EXEC uspScheduleExcepTypesList";

$params = array(5);
$getUserStaturs = sqlsrv_query( $conn, $query, $params);
if ( $getUserStaturs === false)
	{ 
	die( FormatErrors( sqlsrv_errors() ) ); 
	}
	echo"<select id=\"schTypeList_dp\" name=\"schTypeList_dp\" title=\"Status\">";
	while($row = sqlsrv_fetch_array($getUserStaturs))
	{
		echo "<option value=".$row["schExcepTypeId"].">".$row["schExcepTypeDesc"]."</option>";
	}		
echo "</select>";

/* Close the connection. */
closeDBConnetion();
?>
</body>
</html>