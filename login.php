<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title>Login Page-TICO-Tickets Control Center</title>
<link href="css/normalize.css" rel="stylesheet" />
<link href="css/header.css" rel="stylesheet" />
<link href="css/login.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body onLoad="onLoadLoginPage()">
<div id="principal">
    <div id="header">
      <div id="titulo">TICO-Tickets Control Center - Login</div><!-- titulo -->
	</div><!-- header -->   
  <div id="mainContentLogin">   
    	<div id="MainLoginBox">
			<div id="LoginForm">
                <form action="include/loginCheck.php" method="post" name="loginForm" id="loginForm" onKeyPress="{if (event.keyCode==13)loginValidation()}">             
                    <div id="LoginIconImage"></div>
                    <div id="LoginErrorMessageLabel"><label id="errorlbl"></label></div>
                    <div id="LoginUserNameContainer">
                        <div id="LoginUserNameLabel">Username:</div>
                        <div id="LoginUserNameTextbox"><input name="username" type="text" id="username" tabindex="1" size="12" maxlength="15" autofocus /></div>
					</div><!--LoginUserNameContainer-->
                	<div id="LoginPasswordContainer">
                        <div id="LoginPasswordLabel">Password:</div>
                      	<div id="LoginPasswordTextbox"><input name="passwordTB" type="password" id="passwordTB" tabindex="2"  size="12" maxlength="18" /></div>
                    </div><!--LoginPasswordConainer-->
                    <div id="LoginTeamSelector">
                        <div id="LoginTeamSelectorLabel">Team:</div>
                        <div id="LoginTeamSelectorCombobox"></div>
                    </div><!--LoginTeamSelector-->
                    <div id="LoginSubmitButton"><a href="javascript:loginValidation();" title="Login" tabindex="4">Login</a></div><!--LoginSubmitButton-->
            	</form>
            </div><!-- LoginForm -->        
        </div><!-- MainLoginBox -->    	  	
  </div><!-- mainContentLogin-->
</div><!-- principal -->
</body>
<script src="lib/js/script.js" type="text/javascript"></script>
<script> 
 $('.input').keypress(function(e) {
        if(e.which == 13) {
            //jQuery(this).blur();
            //jQuery('#loginForm').focus().click();
			jQuery("loginValidation();")			
        }
    });
</script>
</html>