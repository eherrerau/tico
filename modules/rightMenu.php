<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	//header("Cache-Control: no-cache");
	header('Location:../login.php');
}
include_once("include/functions.php");
$userDetails = getProfileValues(callSessionName());
?>
<div id="mainMenu">
	<ul>
    	<?php
			if (isProfile(1)){
				echo "<li><a href=\"administration.php\" ><img src=\"images/config.gif\" width=\"18\" height=\"18\" border=\"\"></a></li>";
				}
			if (isProfile(3) or isProfile(1) or isProfile(2) or isProfile(5) or isProfile(4)){
				echo "<li><a href=\"ScheduleFull.php\" >Schedule</a></li>";
				}
		?>
    	<li><a href="index.php">Cases Monitor</a></li>
        <li><a href="profile.php">My Profile</a></li>        
        <li><a href="http://ent51.sharepoint.hp.com/teams/tico/Lists/ER%20and%20Issues%20Tracking/AllItems.aspx" target="_new">ER's</a></li>
		<li><a href="signout.php">Sign Out</a></li>  
	</ul>
</div><!-- mainMenu -->
<div id="messages"></div>
<?php
if ($_SESSION['DBtoUse']=='TICO_DB_PC'){
echo '<div id="fullBox">';
echo '<div id="newsTitle">Premier</div>';
echo
    '<div id="normalText">The following companies and SAIDs must be routed to Premier</div>
    <div id="newsRow">
    <div id="companyName">Halliburton</div>
        <div id="SAIDs">SAID:103677854905 HP engineers only</div>
    <div id="companyName">Avnet</div>
        <div id="SAIDs">SAIDs:103354072920, 103346209779, 103510590689</div>
    <div id="companyName">BCBS</div>
        <div id="SAIDs">SAID:103344911268</div>
    <div id="companyName">JPMC</div>
        <div id="SAIDs">SAID:103572246860 Swati</div>
    <div id="companyName">QCOM</div>
        <div id="SAIDs">SAID:103338936965 Swati</div>
    <div id="companyName">MHS</div>
        <div id="SAIDs">SAID:103994938960 Swati</div>
    <div id="companyName">UAL</div>        
        <div id="SAIDs">SAID:103633868304 Swati</div>
    <div id="companyName">Charles Schwab</div>
        <div id="SAIDs">SAID:104058278670 Swati</div>    
    <div id="companyName">GM</div>
        <div id="SAIDs">SAID:104040703851 Swati</div>
    <div id="companyName">TDBank</div>
        <div id="SAIDs">SAID:103905402819 Swati</div> 
  </div>';
echo '</div>';
}
if ($_SESSION['DBtoUse']=='TICO_DB_NNM'){
echo '<div id="fullBox">';
echo '<div id="newsTitle">Exceptions</div>';
echo '<div id="normalText"></div>
        <div id="newsRow">
        <div id="companyName">David Segura</div>
            <div id="SAIDs">Citrix 103886265877, Headquarters 103348321428
        </div>
        <div id="companyName">Duane Emroy</div>
            <div id="SAIDs">Air force DCGS 104037032563; Lockheed Martin 103518532289; Eagle Alliance–103250407580
        </div>
        <div id="companyName">Diego Gamboa</div>
            <div id="SAIDs">HCSC 103457040886, HPES GNTA - HPES GM 103635536233
            </div>
	<div id="companyName">Roger Barquero</div>
            <div id="SAIDs">T-Mobile 103475078900; Wal-Mart
            </div>
        <div id="companyName">Rafael Segura</div>
            <div id="SAIDs">Sprint, Telmex CNOC  103822856424 y Telmex LATAM 103762804190
            </div>
       </div>';
echo '</div>';
}
// *****************************
// Added by: dotbemail@test.com
// 
// Adding NEWS section for NA DB
//
// *****************************

if ($_SESSION['DBtoUse']=='TICO_DB_NA'){
echo '<div id="fullBox">';
echo '<div id="newsTitle">Premier Customers</div>';
echo '<div id="normalText"></div>
        <div id="newsRow">
        <div id="companyName">Daniel Garcia</div>
            <div id="SAIDs">Microsoft IT - 103909555336 | Telmex - 103822856424 / 103762804190</div>
         <div id="companyName">David Trejos</div>
            <div id="SAIDs"> T-Mobile - 103471913808 |  Sungard - 103862495900 | Kaiser Permanente - 104132215497 | Savvis – 103510585197</div>        
        <div id="companyName">Todd Heron</div>
            <div id="SAIDs">Wells Fargo - 103408728520 | GE - 103457156436 | GM - 104040703851</div>	
       </div>';
echo '</div>';
}
?>