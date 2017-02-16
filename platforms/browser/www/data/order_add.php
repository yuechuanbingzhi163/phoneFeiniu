<?php
  header("Content-Type:application/json;charset=UTF-8");
  $set="SET NAMES UTF8";
  $con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
  mysqli_query($con,$set);
  //@$oid=$_REQUEST['oid'] or die('{"code":"2","msg":"oid requested"}');
  @$rcvName=$_REQUEST['rcvName'] or die('{"code":"2","msg":"rcvName requested"}');
  @$addr=$_REQUEST['addr'] or die('{"code":"2","msg":"addr requestedd"}');
  @$price=$_REQUEST['price'] or die('{"code":"2","msg":"price requested"}');
  @$payment=$_REQUEST['payment'] or die('{"code":2,"msg":"payment requested"}');
  @$orderTime=time();
  @$status=$_REQUEST['status'] or die('{"code":"2","msg":"status requested"}');
  @$userId=$_REQUEST['userId'] or die('{"code":"2","msg":"userId requested"}');
  $int="INSERT INTO fn_order VALUES(NULL,'$rcvName','$addr','$price','$payment','$orderTime','$status','$userId')";
  $result=mysqli_query($con,$int);
  $oid=mysqli_insert_id($con);
  //echo $oid;
  $sel="SELECT cid FROM fn_cart WHERE userId='$userId'";
  $result=mysqli_query($con,$sel);
  $cid=mysqli_fetch_row($result)[0];
  //echo $cid;
  $sel="SELECT * FROM fn_cart_detail WHERE cartId=$cid";
	$result=mysqli_query($con,$sel);
	$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
	//var_dump($arr);
	//echo $arr[0]['productId'];
	for($i=0;$i<count($arr);$i++){
		$productId=$arr[$i]['productId'];
		$count=$arr[$i]['count'];
		$int="INSERT INTO fn_order_detail VALUES(NULL,$oid,$productId,$count)";
		mysqli_query($con,$int);
	}

	$sql = "DELETE FROM fn_cart_detail WHERE cartId=(SELECT cid FROM fn_cart WHERE userId=$userId)";
  mysqli_query($con,$sql);

	$sel="SELECT pic,price,orderTime,status FROM fn_product,fn_order_detail WHERE productId=pid,oid=orderId";
	$result=mysqli_query($con,$sel);
	$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($arr);
?>