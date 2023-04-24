<?php
include_once("include/functions.php");
$userDetails = getProfileValues(callSessionName());
?>
<div id="header">
    	<div id="titulo">TICO-Tickets Control Center</div><!-- titulo -->
        <div id=rightInfo>
        	<div id="userLogin"><?php echo $userDetails[1]; ?></div><!-- userLogin -->
        	<div id=QMbar>
            	<div id="QMName">
                    <?php include_once './include/getQmon.php'; ?>
                </div>
                <div id="QMLabel">QM on Duty:</div>                
	        </div><!-- QMbar -->
        </div><!-- rightInfo -->
</div><!-- header -->     
