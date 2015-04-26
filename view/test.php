<?php
	include('../class/DBhandler.class.php');
	$DBhandler=new DBhandler();
    $sql='select user_pw from user where user_id ="32011070034"';
    $results = $DBhandler->fetchQuery($sql);
	echo $results[0];
?>

