<?php
	header('Content-Type:application/json;charset=UTF-8');
	$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	@$label=$_REQUEST['label'] or die('{"msg":"label requested"}');
	$sel="SELECT * FROM f1 WHERE label='$label'";
	$result=mysqli_query($con,$sel);
	$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$test=json_encode($arr);
	echo $test;
?>