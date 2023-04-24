<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
        <title>TICO-Tickets Control Center</title>
        <link href="css/profile.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="lib/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <?php
        include("include/functions.php");
        session_start();
        if (!isset($_SESSION['DBtoUse'])) {
            header('Location:../login.php');
        }
        ?>
        <?php
        $profileDetails = getProfileValues(callSessionName());
        $product = getAllProductsOnMyProfile();
        ?>
    </head>
    <body onload="onLoadProfile()">
        <div id="principal">
            <?php
            include("modules/header.php");
            include("modules/rightMenu.php");
            ?>
            <div id="mainContent">
                <div id="engineers">
                    <div id="formul">
                        <form action="include/updateMyProfile.php" method="post" id="MyProfileForm" name="MyProfileForm">
                            <div id="displayNameT" class="leftColunmOnProfile">Name to Display:</div>
                            <div id="displayName" class="rightColumOnProfile"><input name="Name" id="Name" type="text" size="20" value="<?php echo $profileDetails[2]; ?>" autofocus autocomplete="on" /></div> 
                            <div id="chgpass" onClick="MM_openBrWindow('include/passwordChange.php', 'Password', 'width=550,height=250')"><a href="#">Change your password</a></div>
                            <div id="displayMailT" class="leftColunmOnProfile">e-mail:</div>
                            <div id="displayMail" class="rightColumOnProfile"><input name="Mail" id="Mail" type="text" value="<?php echo $profileDetails[3]; ?>" size="30" /></div> 
                            <div id="displayPhoneT" class="leftColunmOnProfile">Phone #:</div>
                            <div id="displayPhone" class="rightColumOnProfile"><input name="Phone" id="Phone" type="text" value="<?php echo $profileDetails[4]; ?>" /></div>  
                            <div id="displayBdayT" class="leftColunmOnProfile">Birthday:</div>
                            <div id="displayBday" class="rightColumOnProfile"><input name="Bday" id="Bday" type="text" value="<?php echo date_format($profileDetails[5], "d-m-Y"); ?>" /></div>  
                            <div id="displayPremierT" class="leftColunmOnProfile">Premier:</div>
                            <?php
                            if ($profileDetails[6] == '1') {
                                echo "<div id=\"displayPremier\" class=\"rightColumOnProfile\" ><input name=\"premier_ck\" type=\"checkbox\" id=\"premier_ck\" checked ></div>";
                            } else {
                                echo "<div id=\"displayPremier\" class=\"rightColumOnProfile\" ><input name=\"premier_ck\" type=\"checkbox\" id=\"premier_ck\" ></div>";
                            }
                            ?>
                            <div id="displayTeamT" class="leftColunmOnProfile" >Team:</div>
                            <div id="displayTeam" class="rightColumOnProfile"><label><?php echo $profileDetails[7]; ?></label></div>                 
                            <div id="displayRolesT" class="leftColunmOnProfile">Roles:</div>
                            <div id="displayRoles" class="rightColumOnProfile"><?php echo $roles = implode(", ", getRolesOnMyProfile($profileDetails[0])); ?></div>         
                            <div id="displayProductT" class="leftColunmOnProfile">Supported Products:</div>
                            <div id="displayProduct" class="rightColumOnProfile"><?php echo implode(", ", compareArrayProducts($profileDetails[0])); ?> </div>                 
                            <div id="displayStatusT" class="leftColunmOnProfile">Actual status:</div>
                            <div id="displayStatus" class="rightColumOnProfile"> </div>
                            <div id="boton" onClick="javascript:document.MyProfileForm.submit()"><a href="include/updateMyProfile.php" onClick="return false">Save</a></div> 
                        </form> 
                    </div><!-- formul -->	
                    <div id="info"><b>Schedule Exceptions for the last 45 days:</b><br/>
<?php echo implode(" ", getNextSchedExcep($profileDetails[0])); ?>
                    </div><!-- info -->
                </div><!-- engineers -->
                <div id="graphs">
                    <div id="menuGraph">
                        <?php
                        if (isProfile(3)) {//if is a QM
                            echo "<div id=\"opt1\" onclick=\"getSchedule('include/getSchedule.php',3);\"><a href=\"include/getSchedule.php\"  onclick=\"return false;\">QM</a></div>";
                        }
                        if (isProfile(5)) {// if is an engineer,
                            echo "<div id=\"opt1\" onclick=\"getSchedule('include/getSchedule.php',5);\"><a href=\"include/getSchedule.php\"  onclick=\"return false;\">Engineer</a></div>";
                        }
                        if (isProfile(4)) {// if is an Expert
                            echo "<div id=\"opt1\" onclick=\"getSchedule('include/getSchedule.php',4);\"><a href=\"include/getSchedule.php\"  onclick=\"return false;\">Expert</a></div>";
                        }
                        ?>
                    </div>
                    <div id="schedule">
<?php /* Here is where the schedule is inserted from getSchedule.php */ ?>
                    </div><!-- schedule -->
                    <div id="exception">
                        <form name="exceptionForm"  id="exceptionForm" method="post" action="include/insertSchedExcep.php">
                            <div id="excTitle"><h2>Schedule Exceptions</h2></div>                            
                            <div id="engineerNameList">
                                <?php //if ((isProfile(1))||(isProfile(2))|| (isProfile(3)))  {                                                            
                                    include_once 'include/getFullEngineerList.php';
                                       //}     ?>
                            </div>
                            <div id="engineerName">
                                <?php if ((isProfile(1))||(isProfile(2))|| (isProfile(3)))  {                                                            
                                    echo 'Engineer:';
                                       }     ?>                                
                            </div>
                            <div id="tipo2">Type:</div>
                            <div id="schTypeList"><select name="schedExecList"><?php echo $schedList = implode(getSchedExcepList()) ?></select></div>
                            <div id="dateFrom">
                                Date From:<input type="text" name="datepickerFrom" id="datepickerFrom" value="" size="8">
                            </div><!-- End dateFrom -->
                            <div id="dateTo">
                                Date to: <input type="text" name="datepickerTo" id="datepickerTo" value="" size="8">
                            </div><!-- End dateTo -->                
                            <div id="timeFrom">From:<select name="finh">
                                    <?php echo getHours(); ?>
                                </select>:<select name="finmin">
                                    <?php echo getMinutes(); ?>
                                </select></div>
                            <div id="timeTo">To:<select name="tinh">
                                    <?php echo getHours(); ?>
                                </select>:<select name="tinmin">
<?php echo getMinutes(); ?>
                                </select></div>
                            <div id="timeAll">All day:<input name="allDay" id="allDay" type="checkbox" value="1"/></div>
                            <div id="createExc" onClick="javascript:document.exceptionForm.submit()"><a href="include/JavascriptRequired.php" title="Create Exception" onClick="return false">Create</a></div>
                        </form>	
                    </div><!-- exception -->
                </div><!-- graphs -->
            </div><!-- mainContent -->            
        </div>
        <script src="lib/js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="lib/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script> 
        <script src="lib/js/script.js" type="text/javascript"></script>
        <script>
        $(function() {
            $("#datepickerFrom").datepicker();
            $('#datepickerFrom').datepicker('option', {dateFormat: 'yy-mm-dd'});
            $("#datepickerTo").datepicker();
            $('#datepickerTo').datepicker('option', {dateFormat: 'yy-mm-dd'});
        });
        </script>   
        <script type="text/javascript">
            function MM_openBrWindow(theURL, winName, features) { //v2.0
                window.open(theURL, winName, features);
            }
        </script>
        <script type="text/javascript">
            $("#fullBox").draggable();
        </script>
    </body><!-- ------------Body------------ -->
</html>