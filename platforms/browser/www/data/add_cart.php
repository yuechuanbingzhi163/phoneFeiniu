<?php
	header('Content-Type:application/json;charset=UTF8');
	$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	mysqli_query($con,$set);
	@$uid=$_REQUEST['uid'] or die('uid requested');
	@$pid=$_REQUEST['pid'] or die('pid requested');
	$sel="SELECT cid FROM fn_cart WHERE userId='$uid'";
	$result=mysqli_query($con,$sel);
	$list=mysqli_fetch_row($result);
	if($list){
		$sel="SELECT * FROM fn_cart_detail WHERE productId=$pid AND cartId=$list[0]";
		$result=mysqli_query($con,$sel);
		$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
		if($arr){
			$count=$arr[0]['count'];
			$did=$arr[0]['did'];
			$upt="UPDATE fn_cart_detail SET count=$count+1 WHERE did=$did";
			$result=mysqli_query($con,$upt);
			//mysqli_affected_rows($result);
			$output=["proid"=>$pid,"count"=>$count+1];
		}else{
			$int="INSERT INTO fn_cart_detail VALUES(NULL,'$list[0]','$pid',1)";
			mysqli_query($con,$int);
			$output=["proid"=>$pid,"count"=>1];
		}
	}else{
		$int="INSERT INTO fn_cart VALUES(NULL,$uid)";
		$result=mysqli_query($con,$int);
		$arr=mysqli_fetch_assoc($result);
		$int="INSERT INTO fn_cart_detail VALUES(NULL,$arr[cid],$pid,1)";
		mysqli_query($con,$int);
		$output=["proid"=>$pid,"count"=>1];
	}
	echo json_encode($output);
?>