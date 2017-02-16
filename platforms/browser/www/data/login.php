<?php
	header('Content-Type:application/json;charset=UTF8');
	$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	mysqli_query($con,$set);
	@$uname=$_REQUEST['uname'] or die('uname requested');
	@$upwd=$_REQUEST['upwd'] or die('upwd requested');
	$sel="SELECT * FROM fn_user WHERE uname='$uname' AND upwd='$upwd'";
	$result=mysqli_query($con,$sel);
	$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
	if($arr){
		$output=["code"=>"1","uname"=>$uname,"uid"=>$arr[0]['uid']];
	}else{
		$output=["code"=>"2","msg"=>"用户名和密码登录错误"];
	}
		echo json_encode($output);
?>