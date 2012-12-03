<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/divs.css">
	<script src="../jquery/jquery-1.8.2.min.js"></script>
</head>
<body>
 <div id="vertical">
	 <div id="login_popup">
		<?php
			$form = array('id' => 'myform');		
			$username = array(
				  	'name'        => 'username',
				  	'id'          => 'username',
				  	'placeholder' => 'Meno'
			);
			$password = array (
				  	'name'        => 'password',
				 	'id'          => 'password',
				  	'placeholder' => 'Heslo'
			);
			$submit = array(
				  	'id' => 'submit_button',
				'name' => 'submit_login',
				'value' => 'Prihlásenie'
			);
		
			echo "<h1>LDAP rozhranie</h1>";
			echo form_open('/index.php/login/authenticate',$form);
			echo form_label('Meno','username');
			echo form_input($username);
			echo form_label('Heslo','password');
			echo form_password($password);
			echo form_submit($submit);
			echo form_close();
		?>
	 </div> <!--- End div login_popup ---->

	 <div id="logo_srbn">
	  <center><img src="../images/logo-srbn.png"/></center>
	 </div> <!--- End div logo_srbn ---->


	<script>
	$(function() {
		$('#login_popup').fadeIn('1500');
	
	})
	</script>
</div>
</body>
</html>
