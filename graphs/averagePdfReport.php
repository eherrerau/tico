
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header("Cache-Control: no-cache");
	//header('Location:../login.php');
}
require("../include/fpdf/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(40,10,'Average cases per Engineer/This Month');

require_once("../include/connection.php"); //including the connection functions


$conndb = connectToDB();//Connection stablished
//----------------------------------
//--------Searching engineers-------------
$query =	"SELECT usrId, nameToDisplay FROM UserDetails WHERE usrId in (SELECT usrId FROM RoleByUsr WHERE roleId IN(SELECT roleId FROM Roles Where receivesCases=1)) and active='True' Order by nameToDisplay";//Finding all engineers
$params = array(5);
$result = sqlsrv_query( $conndb, $query, $params);
if ( $result === false)
	{ die( FormatErrors( sqlsrv_errors() ) ); 
	
	}
/*echo "<h2><div id=tittle></div></h2>";
echo "<div id=main>";*/
$x=1;
$serie ="Serie". $x;
While ($row = sqlsrv_fetch_array($result)){ //For each Engineer

	//$row['usrId']

	$sqlquery =	"exec uspAverageCasesMonth ".$row['usrId'];//This returns all the assigned cases in the week
	$params = array(5);
	$getCases = sqlsrv_query( $conndb, $sqlquery, $params);
	if ( $getCases === false)
		{ die( FormatErrors( sqlsrv_errors() ) ); 
		
		}
	if ($rowCases = sqlsrv_fetch_array($getCases)){
		//$CaseId = $rowCases['caseId'];
		$tamano= $rowCases['average']*5;
		//echo "<div id=row><div id=\"engineer\"> ". $row['nameToDisplay']. "</div><div id=\"graphline\" style=\"width:".$tamano."px; \"></div><div id=\"tamano\"  style=\"position:relative; \" >". round($rowCases['average'],2)."</div></div>";
$pdf->Ln();
$pdf->SetFont('Arial','',16);
$pdf->Cell(80,10, $row['nameToDisplay']);	
$pdf->Cell(40,10, round($rowCases['average'],2));		
	if ($x==20)	{$pdf->AddPage();}
		
		
		//echo "the engineer ". $row['nameToDisplay']. " has "; 
		//echo "total cases ". $rowCases['total']. "  ";
	}
	$x = $x+1;
	$serie ="Serie". $x;
}//While
closeDBConnetion();	





$pdf->Output();
?>
