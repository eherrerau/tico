<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	echo"<meta http-equiv=\"Refresh\" content=\"0;URL=../login.php\">";
}
$contador = 0;
require_once("connection.php");
include_once("functions.php");
$userDetails = getProfileValues(callSessionName());
$conn = connectToDB();
$query = "exec uspUserByTimeIn";
$params = array(5);
$getUsers = sqlsrv_query( $conn, $query, $params);
if ( $getUsers === false)
	{ die( FormatErrors( sqlsrv_errors() ) ); }
echo "<div id=\"engineerT\" style=\"position:relative\"><div id=\"person\"><b>Engineer</b></div><div id=\"premier\">P</div><div id=\"LW\"></div><div id=\"Td\"></div><div id=\"TW\"></div><div id=\"Av\"></div><div id=\"in\">in</div><div id=\"lIn\">Lunch</div><div id=\"out\">out</div><div id=\"cases\">Cases</div></div>";
$scheduleIn ="";
$scheduleOut = "";
$scheduleLunch = "";
while($row = sqlsrv_fetch_array($getUsers)){		
	$queryShbyUsr = "EXEC uspAvailables @userid=". $row["usrId"];
	$getSchByUsr = sqlsrv_query( $conn, $queryShbyUsr, $params);
	if ( $getSchByUsr === false){
		die( FormatErrors( sqlsrv_errors() ) ); 
		}
	$i=0;
	//----------------------------------
	/*$sqlqueryAverage =	"exec uspAverageCasesMonth ".$row['usrId'];//This returns all the assigned cases for Today
	$params = array(5);
	$getCasesaverage = sqlsrv_query( $conn, $sqlqueryAverage, $params);
	if ( $getCasesaverage === false){
		die( FormatErrors( sqlsrv_errors() ) ); 		
		}
	if ($rowCasesAvg = sqlsrv_fetch_array($getCasesaverage)){
		//$CaseId = $rowCases['caseId'];
		$tamano= round($rowCasesAvg['average'], 1);
		}	*/
	//----------------------------------
	while($rowSchbyUsr = sqlsrv_fetch_array($getSchByUsr)){
		//$schByUser = $rowSchbyUsr["scheduleId"];
		$scheduleIn = date_format($rowSchbyUsr["timeIn"],"H:i");
		$scheduleOut = date_format($rowSchbyUsr["timeOff"],"H:i");
		$scheduleLunch = date_format($rowSchbyUsr["timeLunch"],"H:i");
		$scheduleLunchOff = date_format($rowSchbyUsr["timeLunchEnd"],"H:i");
		//$scheduleLunchOff = date("H:i",strtotime($scheduleLunch."+1 hour"));
		//echo $scheduleLunchOff. "--". $scheduleLunch."  ";
		if (($scheduleIn < date("H:i")) and ($scheduleOut >= date("H:i")) and !((date("H:i") >= $scheduleLunch)and(date("H:i") < $scheduleLunchOff))){	
			//echo $rowSchbyUsr["caseId"];
			$queryCase = "Exec uspUsrCasebyDay @userid =" . $row["usrId"];
			$getCase = sqlsrv_query( $conn, $queryCase, $params);
			if ( $getCase === false)
				{ die( FormatErrors( sqlsrv_errors() ) ); }
				$cases[$i]=0;
			while($rowCase = sqlsrv_fetch_array($getCase)){
					$premierCase[$i]= $rowCase["premier"];
					$caseSev[$i]= $rowCase["severy"];//this is the severity for an especific case
					$cases[$i]=  $rowCase["caseId"];//$cases[i] contains today's cases for one engineer
					$caseNum[$i]=  $rowCase["caseNumber"];//$cases[i] contains today's cases numbers
					$callback[$i]= $rowCase["note"];	
				$i = $i+ 1;
				}
			$queryPremier = "SELECT premier from UserDetails where usrId=". $row["usrId"];
			$getpremier = sqlsrv_query( $conn, $queryPremier, $params);
			if ( $getpremier === false)
			{ die( FormatErrors( sqlsrv_errors() ) ); }
			If ($rowpremier = sqlsrv_fetch_array($getpremier)){
				if ($rowpremier["premier"])
				$usrPremier = "<img src=\"images/premier.png\" width=\"12\" height=\"12\" title=\"Premier\" />";
				else
				$usrPremier=""; 
				// Creates and prints the div id="engineer"  for the available engineers only
				$contador = $contador +1;
					echo "<div id=\"engineer\">";
					if ($row['usrName']==$userDetails[1]){
						echo "<div id=\"person\"><b><a href=\"sip:".$row['usrMail']."\">". $row['nameToDisplay'] . "</a></b></div> <!--person-->";
					}
					else{
					echo "<div id=\"person\"><a href=\"sip:".$row['usrMail']."\">". $row['nameToDisplay'] . "</a></div> <!--person-->";}
							echo "<div id=\"premier\">". $usrPremier . "</div><!--premier-->
							<div id=\"LW\">";
							//------Birthday here-----							
					if ( date("m-d") == date_format($row['birthday'],'m-d')) {						
						echo "<img src=\"images/cake.gif\" width=\"15\" height=\"15\" alt=\"Birthday\">";						
						}
							//---------------------------
							echo "</div><!--LW-->
							<div id=\"Td\">";
							
								//-----------WFH------------
								$queryWFH = "exec uspChkWFH ". $row["usrId"];
								$getWFH = sqlsrv_query( $conn, $queryWFH, $params);
								if ( $getWFH === false)
								{ die( FormatErrors( sqlsrv_errors() ) ); }
								If ($rowWFH = sqlsrv_fetch_array($getWFH)){
									if ($rowWFH['schExcepTypeId']==8){
										echo "<img src=\"images/house.gif\" width=\"15\" height=\"15\" alt=\"WFH\" title=\"WFH\">";
									}
									if ($rowWFH['schExcepTypeId']==1){
										echo "<img src=\"images/vacations.gif\" width=\"15\" height=\"15\" alt=\"vacations\" title=\"vacations\">";
									}
									if ($rowWFH['schExcepTypeId']==2){
										echo "<img src=\"images/training.gif\" width=\"15\" height=\"15\" alt=\"Training\" title=\"Training\">";
									}
									if ($rowWFH['schExcepTypeId']==6){
										echo "<img src=\"images/qm.gif\" width=\"15\" height=\"15\" alt=\"Queue Monitor\" title=\"Queue Monitor\">";
									}
								}
							
							//---------------------------
							
							
							
							echo "</div><!--Td-->
							<div id=\"TW\"></div><!--TW-->
							<div id=\"Av\"></div><!--Av-->";
					if ($row['usrName']==$userDetails[1]){
						
						echo "<div id=\"in\"><b>". $scheduleIn ."</b></div><!--in-->
							<div id=\"lIn\"><b>". $scheduleLunch ." - ". $scheduleLunchOff ."</b></div><!--lIn-->
							<div id=\"out\"><b>". $scheduleOut ."</b></div><!--out-->";}
						else{
							echo "<div id=\"in\">". $scheduleIn ."</div><!--in-->
							<div id=\"lIn\">". $scheduleLunch ." - ". $scheduleLunchOff ."</div><!--lIn-->
							<div id=\"out\">". $scheduleOut ."</div><!--out-->";
			}
							echo "<div id=\"cases\">";
					$x=0;
					$countPrem =0;
					$countNoPrem=0;
					if ($i >7){
						while ($i>=0){
							if ($cases[$x] != 0){								
								if ($caseSev[$x] == 1){
									$countPrem= $countPrem +1;
								}
								else{
									$countNoPrem= $countNoPrem +1;
								}
							}	
							$caseSev[$x] = 0;
							$cases[$x] = 0;
							$i= $i-1;
							$x= $x+1;	
						}//while
						echo "<b style=\"color:#DD4B39\">".$countPrem. "</b> <img src=\"images/2case.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" > ";
						echo "<b style=\"color:#060\">".$countNoPrem . "</b> <img src=\"images/ncase.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
						}
					else {
						while ($i>=0){
							if ($cases[$x] != 0){
								
								if ($caseSev[$x] == 1){
									
									if ($premierCase[$x] == 1){										
										if ($callback[$x]=="Assign as Callback"){											
											echo "<img src=\"images/sev1cbpr.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
											}
											else{
												if ($callback[$x]=="Assign as elevation"){
													echo "<img src=\"images/Sev1PreEl.png.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
													}
												else{
													echo "<img src=\"images/2casep.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
												}
											}
										}
									else{
										if ($callback[$x]=="Assign as Callback"){
											echo "<img src=\"images/sev1cb.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
										}
										else{
											if ($callback[$x]=="Assign as elevation"){
												
													echo "<img src=\"images/Sev1PreEl.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
													}
												else{
													echo "<img src=\"images/2case.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
													}
										}
										$countPrem= $countPrem +1;
									}
								}
								else{
									
									if ($premierCase[$x] == 1){
										
										if ($callback[$x]=="Assign as Callback"){
											echo "<img src=\"images/sev2cbpr.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
										}
										else{
											if ($callback[$x]=="Assign as elevation"){
												
												echo "<img src=\"images/Sev2PreEl.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
												}
												else{
													echo "<img src=\"images/ncasep.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";}
										}
										}
									else{
										if ($callback[$x]=="Assign as Callback"){
											echo "<img src=\"images/sev2cb.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";
										}
										else{
											if ($callback[$x]=="Assign as elevation"){
												
												echo "<img src=\"images/Sev2FuEl.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";						;
												}
											else{
											echo "<img src=\"images/ncase.png\" width=\"10\" height=\"10\" onmouseover=\"javascript:caseDescription(event, ".$row["usrId"].")\" /> ";}
										}
										$countNoPrem= $countPrem +1;
									}
								}
							}	
							$caseSev[$x] = 0;
							$cases[$x] = 0;
							$i= $i-1;
							$x= $x+1;	
						}//while
					}
					echo "</div><!--cases--></div><!--engineer-->";//finishes the div creation for the engineer details
			}/*if*/
		}
	}/*While*/
}/**While*/
/* Close the connection. */
echo "<div id=\"total_eng\"><b>".$contador ."</b></div>";
closeDBConnetion();
?>