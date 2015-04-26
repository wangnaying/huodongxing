<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
<link rel="stylesheet" type="text/css" href="css/register.css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="js/verify.js" type="text/javascript"></script>
<?php
if ($_POST["name"]) {
	$name = $_POST['name'];
	include("verify.php");
	$password = $_POST['password'];
	if(!Verify::isNames($name,2,20,'EN')){
			 echo "<script language=\"JavaScript\">alert(\"用户名不合法！\");</script>"; 
	}
}

?>
<script type="text/javascript">
	$(document).ready(function(){
		var tipUser = '请输入您的用户名！',tipPass = '请输入您的密码！',tipconfirmPass = '请再次输入您的密码！'
		,tipemail='请输入您的邮箱！';
		tips($('#register_name'),tipUser,false);
		tips($('#register_password'),tipPass,true);
		tips($('#register_confirm_password'),tipconfirmPass,true);
		tips($('#register_email'),tipemail,true);
});
</script>
</head>

<body>
	<div class="register_main">
		<h1>注册</h1>
		<form id="register_form" method="post" action="">
		<input id="register_name" type="text" name="name"></input></br>
		<input id="register_password" class="register_password" type="text" name="password"></input></br>
		<input id="register_confirm_password" class="register_password" type="text" name="confirm_password"></input></br>
		<input id="register_email" class="register_email" type="text" name="email"></input></br>
		<input id="register_submit" class="register_btn" type="submit" value="注册"></br>
		</form>
	</div>
</body>
</html>
