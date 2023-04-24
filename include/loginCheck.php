<?php 
include_once('functions.php');
//login();
if (login()){	
	}else{
		if(getErrors()){
			echo getErrors();
		}
		}
?>

