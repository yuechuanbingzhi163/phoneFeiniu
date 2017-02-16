<?php
	header('Content-Type:application/json;charset=UTF8');
	$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	mysqli_query($con,$set);
	//删除
  	foreach($_REQUEST as $key=>$value){
      		$del="DELETE FROM fn_cart_detail WHERE did=$key";
      		mysqli_query($con,$del);
      	}
    $sel="SELECT * FROM fn_cart_detail";
	//异步传输购物车数据
	$uid=$_REQUEST['uid'] or die('{"msg":"uid requested"}');
	$uname=$_REQUEST['uname'] or die('{"msg":"uname requested"}');
	$sel="SELECT cid FROM fn_cart WHERE userId=$uid";
	$result=mysqli_query($con,$sel);
	$cid=mysqli_fetch_row($result)[0];
	$sel="SELECT did,pic,pname,price,count FROM fn_cart_detail,fn_product WHERE cartId=$cid AND productId=pid";
	$result=mysqli_query($con,$sel);
	$list=mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($list);


?>