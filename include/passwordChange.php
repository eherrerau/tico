<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>TICO - Change your password</title>
<link href="../css/popups.css" rel="stylesheet" type="text/css" media="screen">
<script src="../jquery-ui-1.7.2/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
 <?php
        include_once("functions.php");
        session_start();
        if (!isset($_SESSION['DBtoUse'])) {
            header("Cache-Control: no-cache");
        }
        $profileDetails = getProfileValues(callSessionName());
        ?>
</head>
<body>
<form name="form1" method="post" action="passUpCheck.php">
  <span id="sprypassword1">
  <label for="Password_txt">Password</label>
  <input type="password" name="Password_txt" id="Password_txt" tabindex="1">
  <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span><span class="passwordInvalidStrengthMsg">The password doesn't meet the specified strength.</span></span>
  <p><span id="spryconfirm1">
    <label for="passConfirm_txt">Confirm</label>
    <input type="password" name="passConfirm_txt" id="passConfirm_txt" tabindex="2">
    <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></p>
  <p>
    <input type="submit" name="passChang_btn" id="passChang_btn" value="Change my password" tabindex="3">
  </p>
  <p>
      Password must be Alfa-Numeric, with one Capital, and at least 5 characters long.
  </p>
</form>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:4, maxChars:16, validateOn:["blur"], minAlphaChars:1, minNumbers:1, minUpperAlphaChars:1});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "Password_txt", {validateOn:["blur"]});
</script>
</body>
</html>