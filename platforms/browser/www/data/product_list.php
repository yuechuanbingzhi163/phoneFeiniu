<?php
	header('Content-Type:application/json;charset=UTF-8');
	/*$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	mysqli_query($con,$set);
	$sel="SELECT * FROM fn_product";
	$result=mysqli_query($con,$sel);
	$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($arr);*/
	@$pageNum=$_REQUEST['pageNum'] or die('{"msg":"pageNum requested"}');
	$output=[
		"recordCount"=>0,
		"pageCount"=>0,
		"pageNum"=>$pageNum,
		"pageSize"=>8,
		"data"=>0
	];
	$set="SET NAMES UTF8";
	$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
	mysqli_query($con,$set);
	$sel="SELECT COUNT(*) FROM fn_product";
	$result=mysqli_query($con,$sel);
	$output['recordCount']=mysqli_fetch_row($result)[0];
	$output['pageCount']=ceil($output['recordCount']/$output['pageSize']);
	$start=($output['pageNum']-1)*$output['pageSize'];
	$count=$output['pageSize'];
	$sel="SELECT * FROM fn_product LIMIT $start,$count";
	$result=mysqli_query($con,$sel);
	$output['data']=mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($output['data']);
?>