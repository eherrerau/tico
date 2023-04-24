<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
</head>
<body onLoad="getenglst()">
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require_once("connection.php");
$conn = connectToDB();
$query = "EXEC uspProductList";
$params = array(5);
$getUserStaturs = sqlsrv_query( $conn, $query, $params);
if ( $getUserStaturs === false)
	{ 
	die( FormatErrors( sqlsrv_errors() ) ); 
	}
	echo"<select id=\"displayStatus\" name=\"displayStatus\" title=\"Status\" onChange=\"getenglst()\">";
	while($row = sqlsrv_fetch_array($getUserStaturs))
	{
		echo "<option value=".$row["productId"].">".$row["productDesc"]."</option>";
	}		
echo "</select>";
/* Close the connection. */
closeDBConnetion();
?>
</body>
</html>