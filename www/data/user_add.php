<?php
	header('Content-Type:application/json;charset=UTF-8');
	@$uname=$_REQUEST['uname'] or die('{"code":2,"msg":"uname requested"}');
	$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	mysqli_query($con,$set);
	$sel="SELECT * FROM fn_user WHERE uname='$uname'";
	$rel=mysqli_query($con,$sel);
	$arr=mysqli_fetch_all($rel,MYSQLI_ASSOC);
	//var_dump($arr);
	if($arr===[]){
		@$upwd=$_REQUEST['upwd'] or die('{"code":2,"msg":"upwd requested"}');
		$int="INSERT INTO fn_user VALUES(NULL,'$uname','$upwd')";
    	 $result=mysqli_query($con,$int);
    	 if($result){
    	 	$output=["code"=>1,"msg"=>$uname];
    	 }
	}else{
		$output=["code"=>3,"msg"=>"registed"];
	}
	 echo json_encode($output);
?>