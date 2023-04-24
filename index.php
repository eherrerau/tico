<!DOCTYPE HTML>
<html>
    <script src="lib/js/script.js" type="text/javascript"></script>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <title>TICO-Tickets Control Center</title>
        <link href="css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="lib/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link href="css/index.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    </head>
    <body onload="showUser()">

        <?php
        session_start();
        if (!isset($_SESSION['DBtoUse'])) {
            //header("Cache-Control: no-cache");
            header('Location:../login.php');
        }

        $DBteam = $_SESSION['DBtoUse'];
        include_once("include/functions.php");
        $userDetails = getProfileValues(callSessionName());
        ?>
        <div id="principal">
            <?php include("modules/header.php");
            include("modules/rightMenu.php");
            ?>
            <div id="menus">

                <?php
                if (isProfile(3)) {
                    echo "<div id=\"leftMenu\">";
                    echo "<div id=\"leftMenu1\" onclick=\"addcase();\"><a href=\"add.html\" onclick=\"return false;\"></a></div>
                    <div id=\"leftMenu2\" onclick=\"delcase();\"><a href=\"modify.html\" onclick=\"return false;\"></a></div>
                    <div id=\"leftMenu3\" onclick=\"modcase();\"><a href=\"add.html\" onclick=\"return false;\"></a></div>
                    <div id=\"leftMenu4\" onclick=\"miscase();\"><a href=\"add.html\" onclick=\"return false;\"></a></div>";
                    echo "</div><!-- leftMenu -->";
                    include("modules/assignForm.php");
                } else {
                    if (isProfile(2)) {
                        echo "<div id=\"leftMenu\">";
                        echo " <div id=\"leftMenu4\" onclick=\"miscase();\"><a href=\"add.html\" onclick=\"return false;\"></a></div>";
                        echo "</div><!-- leftMenu -->";
                        include("modules/assignForm.php");
                    }
                }
                ?>      


            </div><!-- Menus -->
            <!---------------------------------->  
            <div id="mainContent">
                <div id="engineers">
                    <div id="titulo0"><img src="images/2case.png" width="10" height="10" alt="Critical"> Critical <img src="images/ncase.png" width="10" height="10" alt="Non critical"> Non Critical <img src="images/premier.png" width="12" height="12" alt="Premier"> Premier <img src="images/cbtittle.png" width="12" height="12" alt="Premier"> As callback <img src="images/elevation.png" width="12" height="12" alt="Premier"> As elevation </div>
                    <div id="titulo1"><b>Available</b></div>
                    <div id="box1"></div>
                    <div id="titulo2"><b>Lunch</b></div>
                    <div id="box2"></div>
                    <?PHP
                    if (($DBteam === "TICO_DB_PPM") or ($DBteam === "TICO_DB_NNM")) {
                        echo "<div id=\"titulo3\"><b>Teach Leads</b></div>
				  <div id=\"box3\"></div><!--box3-->";
                        ?>
                        <script languaje="javascript">
            getexpert();
            // setInterval(getexpert, 60000);
                        </script>

                        <?php
                    }
                    if (($DBteam === "TICO_DB_PC")) {
                        echo "<div id=\"titulo3\"><b>SWAT</b></div>
				  <div id=\"box3\"></div><!--box3-->";
                        ?>
                        <script languaje="javascript">
            getexpert();
            // setInterval(getexpert, 60000);
                        </script>

                        <?php
                    }
                    ?>
                    <!-- <div id="titulo3"><b>Experts</b></div>
                     <div id="box3"></div> -->         
                    <div id="titulo4"><b>Not Available</b></div>
                    <div id="box4"></div>

                </div><!-- engineers -->
                <div id="graphs">
                    <div id="menuGraph">
                        <?php
                        if (isProfile(3) or isProfile(1) or isProfile(2)) {//if is a QM, admin or manager
                            echo "
                        <div id=\"opt6\" onclick=\"todaycases('include/todayCasesList.php');\"><a href=\"include\"todayCasesList.php\"  onclick=\"return false;\">Cases</a></div>";
                            //<div id=\"opt1\" onclick=\"graphic('graphs/graphDay.php');\"><a href=\"graphDay.php\"  onclick=\"return false;\">Day</a></div>
                            echo " 
                        <div id=\"opt2\" onclick=\"graphic('graphs/graphWeek.php');\"><a href=\"graphWeek.php\" onclick=\"return false;\">Week</a></div>";
//                        <div id=\"opt3\" onclick=\"graphic('graphs/graphmonth.php');\"><a href=\"graphmonth.php\"  onclick=\"return false;\">Month</a></div>";
                            echo"
                        <div id=\"opt4\" onclick=\"graphic('graphs/graphAverage.php');\"><a href=\"graphAverage.php\"  onclick=\"return false;\">Avg Foundation</a></div>
                        <div id=\"opt4\" onclick=\"graphic('graphs/graphAveragePremier.php');\"><a href=\"graphAverage.php\"  onclick=\"return false;\">Avg Premier</a></div>
                        <div id=\"opt6\" onclick=\"graphic('graphs/graphPremier.php');\"><a href=\"graphPremier.php\"  onclick=\"return false;\">Premier</a></div>  "; // <div id=\"opt5\" onclick=\"graphic('graphs/graphCritical.php');\"><a href=\"graphCritical.php\"  onclick=\"return false;\">Sev1</a></div>                    
                        }
                        if (isProfile(5) or isProfile(4) or isProfile(3) or isProfile(1)) {// if is an engineer, expert, QM or admin
                            echo "<div id=\"opt3\" onclick=\"graphic('graphs/mygraphMonth.php');\"><a href=\"mygraphDay.php\"  onclick=\"return false;\">My Statistics</a></div>";
                        }
                        ?>
                    </div><!-- menuGraph -->
                    <div id="grafico"></div>
                </div><!-- graphs -->
            </div><!-- mainContent -->
        </div><!-- principal -->
        <div id="detail"></div> 
    </body>
    <script src="lib/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
    <script src="lib/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

    <script src="lib/js/getcases.js" type="text/javascript"></script>
    <script src="lib/js/graphs.js" type="text/javascript"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
            $("#datepicker2").datepicker();
            $("#datepicker3").datepicker();
            $("#datepicker4").datepicker();
        });
    </script>
</html>
