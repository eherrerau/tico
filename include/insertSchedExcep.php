<?php

session_start();
if (!isset($_SESSION['DBtoUse'])) {
    header("Cache-Control: no-cache");
}
include_once("functions.php");
$profileDetails = getProfileValues(callSessionName());

insertScheduleException($_POST['engineerlst'], $profileDetails[0]);

header('Location:../profile.php');
?>