<?php
include_once("include/functions.php");
$QMDetails = getProfileValues(callSessionName());
	//----------Finding QM--------------
	require_once("include/connection.php"); //including the connection functions
	$errors = null;
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
	closeDBConnetion();	
if ($_POST["ascallback"]=="No"){	
	//------------------------------------------------
	//----------Does the case exists?--------------
	require_once("include/connection.php"); //including the connection functions
	$errors = null;
	$connect = connectToDB();//Connection stablished
	
	$sql =	"exec uspFindCase ".$_POST["casetxt"];
	$params = array(5);
	$getCase = sqlsrv_query( $connect, $sql, $params);
	if ( $getCase === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	if ($rowCase = sqlsrv_fetch_array($getCase)){
		echo "<b>The case is already assigned</b>";
	}
	else{			
		if ($_POST["premier"]=="Yes"){ //Check if the case is premier
			$premierValue="True";
			addNewCase($premierValue,$QMDetails[0]);	
			}
		else{
			$premierValue="False";
			addNewCase($premierValue, $QMDetails[0]);
			}	
		}
	closeDBConnetion();	
}
else{
	//Add an exception for the callback:	
	//$myDB = "Arenal_DB";
	//$serverName = "(local)";
	//$connectionInfo = array( "Database"=>$myDB);
	require_once("include/connection.php"); //including the connection functions
	$conn = connectToDB();//Connection stablished
	//$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if(!$conn )
			die( print_r( sqlsrv_errors(), true));
	//Calls the store procedure to insert the new case and create the exceptions related.
	$query = "exec uspAsCallback ".$_POST["casetxt"].",".$QMDetails[0].",".$_POST["engineerlst"].",1";
	
	//values for this query: severity, premier, productId, case number, qmonitor, engineer
	$params = array(5);
	$getUsers = sqlsrv_query( $conn, $query, $params);
	if ( $getUsers === false)
		{ //die( print_r( sqlsrv_errors(), true) ); 
			$sql =	"exec uspFindCase ".$_POST["casetxt"];
			$params = array(5);
			$getCase = sqlsrv_query( $conn, $sql, $params);
			if ( $getCase === false){
				die( FormatErrors( sqlsrv_errors() ) ); 				
				}
			if ($rowCase = sqlsrv_fetch_array($getCase)){
				echo "<b>The case is already assigned as callback</b>";
			}
			else{
					
				if ($_POST["premier"]=="Yes"){ //Check if the case is premier
					$premierValue="True";
					addNewCase($premierValue, $QMDetails[0]);	
					}
				else{
					$premierValue="False";
					addNewCase($premierValue, $QMDetails[0]);
					}				
				}		
		}
		
	else{
		$queryUsr = "select usrMail from UserDetails where usrId=". $_POST["engineerlst"];
		$getUsr = sqlsrv_query( $conn, $queryUsr, $params);
		if ( $getUsr === false){
			die( FormatErrors( sqlsrv_errors() ) ); 
			}
		else{
			while($rowUsr = sqlsrv_fetch_array($getUsr))
			{
			$mail = $rowUsr['usrMail']	;
			
			$message = "The case ".$_POST["casetxt"]." has been assigned to you, as a callback, with severity ".$_POST["severitylst"];
			mail($mail, 'A case has been assigned to you', $message, null);
   			}
		}
		
		echo "The case " .$_POST["casetxt"]. " has been assigned succesfully as a callback";}
	/* Close the connection. */
	closeDBConnetion();
}
//------------------------------------------------
function addNewCase($premierValue, $qmonitor){
	//$myDB = "Arenal_DB";
	//$serverName = "(local)";
	//$connectionInfo = array( "Database"=>$myDB);	
	$conn = connectToDB();//Connection stablished
	//$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if(!$conn )
			die( print_r( sqlsrv_errors(), true));
	//Calls the store procedure to insert the new case and create the exceptions related.
	$query = "exec uspAddCase ".$_POST["severitylst"].",".$premierValue.",1,".$_POST["casetxt"].",".$qmonitor.",".$_POST["engineerlst"].",1";


	
	//values for this query: severity, premier, productId, case number, qmonitor, engineer
	$params = array(5);
	$getUsers = sqlsrv_query( $conn, $query, $params);
	if ( $getUsers === false)
		{ die( print_r( sqlsrv_errors(), true) ); }
	else{
		
		$queryUsr = "select usrMail from UserDetails where usrId=". $_POST["engineerlst"];
		$getUsr = sqlsrv_query( $conn, $queryUsr, $params);
		if ( $getUsr === false){
			die( FormatErrors( sqlsrv_errors() ) ); 
			}
		else{
			while($rowUsr = sqlsrv_fetch_array($getUsr))
			{
			$mail = $rowUsr['usrMail']	;
			
			$message = "The case ".$_POST["casetxt"]." has been assigned to you with severity ".$_POST["severitylst"];
			mail($mail, 'A case has been assigned to you', $message, null);
   			}
		}
		//mail("oiciniv@gmail.com", "Testing case assignement", "This means a case has been assigned", "From:marcos.ramirezemail@test.com");
		/*require("../class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->From = "test@TIquetCOntrolsystem.com";
		$mail->FromName = "TI_CO";
		$mail->AddAddress("oiciniv@gmail.com", "Marcos Ramírez");
		$mail->WordWrap = 50;    
		$mail->IsHTML(true);                                  // set email format to HTML

	$mail->Subject = "Assignement test";
	$mail->Body    = "A new case has bin assigned to you. <b>TEST</b>";
	if(!$mail->Send()){
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}*/	
		echo "The case " .$_POST["casetxt"]. " has been assigned succesfully";	
	}closeDBConnetion();
}
?>