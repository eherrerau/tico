<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title>TICO-Maintenance</title>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/header.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['DBtoUse'])){
	header('Location:../login.php');
}
include_once("include/functions.php");
require_once("include/connection.php"); //including the connection functions 
$userDetails = getProfileValues(callSessionName());
?>
<p>
<div id="principal">
    <?php 	include("modules/header.php");
		include("modules/rightMenu.php");?>
<!-- the Body of the page starts here -->
	<div id="fullPage">
    	<div id="tittle"><h2>Maintenance</h2></div>
    	<div id="users">
        	<div id="subMenu">
            	<div id="opt1"><a href="javascript:createUser()">Create</a></div>
            	<div id="opt2"><a href="javascript:modifyUser()">Modify</a></div>
				<div id="opt3">Enable</div>
            </div>
            <div id=logoUsers></div>
            <div id=tittleUsers><h4>Users Maintenance</h4></div>
            <!-- Create User Form-->
            <form action="xxx.php" method="post" name="createUserF" style="display:block"> 
            <div id="tittleTab">Create User</div>
            <div id=dynamicForm>
            	 <div id="usrLbl">User Name:</div>
                 <div id="usrTxt"><input name="txtUsrName" type="text" size="20" maxlength="20"></div>
                 
                 <div id="nameLbl">Name to Display:</div>
                 <div id="nameTxt"><input name="txtDisplayName" type="text" size="20" maxlength="20"></div>
                 
                 <div id="premierLbl">Premier</div>
                 <div id="premierChk"><input name="premier" type="checkbox" value=""></div>
                 
                 <div id="roles">
                 	<div id="rolesTittle">Roles</div> 
                    <div id="rolesContent"><?php echo implode("<br>",getAllRoles());?> </div>
                 </div>
                 <div id="products">
                 	<div id="productsTittle">Products</div> 
                    <div id="productsContent"><?php echo implode("<br>",getAllProductsOnMyProfile());?> </div>
                 </div>
                 <div id="button"><a href="" >Create</a></div>
                 
            </div>
            </form>

            <!-- -------------------- -->
             <!-- Modify User Form-->
            <form action="xxx.php" method="post" name="modifyUserF" style="display:none"> 
            <div id="tittleTab">Modify User</div>
            <div id=dynamicForm>
            	 <div id="existusrLbl">User Name:</div>
                 <div id="usrdrp"></div>
            	 <div id="usrLbl">User Name:</div>
                 <div id="usrTxt"><input name="txtUsrName" type="text" size="20" maxlength="20"></div>
                 
                 <div id="nameLbl">Name to Display:</div>
                 <div id="nameTxt"><input name="txtDisplayName" type="text" size="20" maxlength="20"></div>
                 
                 <div id="premierLbl">Premier</div>
                 <div id="premierChk"><input name="premier" type="checkbox" value=""></div>
                 
                 <div id="roles">
                 	<div id="rolesTittle">Roles</div> 
                    <div id="rolesContentM"></div>
                 </div>
                 <div id="products">
                 	<div id="productsTittle">Products</div> 
                    <div id="productsContentM"><?php echo implode("<br>",getAllProductsOnMyProfile());?> </div>
                 </div>
                 <div id="button"><a href="" >Update</a></div>
                 
            </div>
            </form>
            <!-- -------------------- -->
        </div><!-- users -->
    	<div id="permission">
        	<div id="subMenu">
            	<div id="opt1">Create</div>
            	<div id="opt2">Modify</div>
				<div id="opt3">Enable</div>
            </div>
            <div id=logoPermission></div>
            <div id=tittlePermission><h4>Schedule Exceptions Maintenance</h4></div>
        </div><!-- permission -->
        <div id="other">
        	<div id="subMenu">
            	<div id="opt1">Create</div>
            	<div id="opt2">Modify</div>
				<div id="opt3">Enable</div>
            </div>
            <div id=logoOther></div>
            <div id=tittleOther><h4>Other Maintenance</h4></div>
        </div><!-- other -->    
    </div><!-- fullPage -->
</div><!-- principal -->
</body>
<script src="lib/js/script.js" type="text/javascript"></script>
<script src="lib/js/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="lib/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script> 
<script type="text/javascript">
	$("#fullBox").draggable();
</script>
</html>