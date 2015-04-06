<?php
	session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log In</title>
<link rel="stylesheet" type="text/css" href="../webroot/css/login.css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="../webroot/js/verify.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	var tipUser = '请输入您的用户名！',tipPass = '请输入您的密码！';
	tips($('#login_name'),tipUser,false);
	tips($('#login_password'),tipPass,true);
});
</script>
</head>
<?php
	if (isset($_SESSION["online"])) {
		echo "<script language=\"JavaScript\">alert(\"已经登录！\");</script>";
		$username = $_SESSION['online'];
	}
	else{
		if ($_POST["name"]) {
		include("verify.php");
		$name = $_POST['name'];
		$password = $_POST['password'];
		if(!Verify::isNames($name,5,20,'EN')){
			 echo "<script language=\"JavaScript\">alert(\"用户名不合法！\");</script>"; 
		}
		else{
			include('../class/DBhandler.class.php');
			$DBhandler=new DBhandler();
        	$sql='select user_pw from user where user_id ='.$name;
        	$results = $DBhandler->fetchQuery($sql);
			if($results[0]==$password){
				echo "<script language=\"JavaScript\">alert(\"登陆成功！\");</script>";
				$_SESSION["online"] = $name; 
				}
			else{
				echo "<script language=\"JavaScript\">alert(\"用户名或密码不正确！\");</script>"; 
				}
			}
		}
	}
?>
<body>
	<div class="login_content">
		<h1>登录</h1>
		<form id="login_form" method="post" action="">
		<input id="login_name" type="text" name="name"></input></br>
		<input id="login_password" type="text" name="password"></input></br>
		<input id="login_submit" class="login_btn" type="submit" value="登录"></br>
		</form>
		<a class="forget_password" href="">忘记密码</a>
		<a class="register" href="register.php">注册</a>
	</div>
</body>
</html>
