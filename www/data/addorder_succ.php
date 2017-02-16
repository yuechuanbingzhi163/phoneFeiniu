<?php
/***
*接收客户端提交的用户编号，获取该用户对应的所有订单，
*以JSON格式返回：[{},{}...]
*/
header('Content-Type: application/json;charset=UTF-8');

@$uid = $_REQUEST['uid'] or die('{"code":2,"msg":"uid required"}');

$set="SET NAMES UTF8";
$con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
mysqli_query($con,$set);

//SQL1：根据用户编号查询出其所有的订单
$sql = "SELECT * FROM fn_order WHERE userId=$uid";
$result = mysqli_query($con,$sql);
$list = mysqli_fetch_all($result, MYSQLI_ASSOC);

//此时的订单列表中只有订单基本信息，缺少商品信息

foreach($list as $k=>$order){
    $oid = $order['oid'];  //订单的编号
    //SQL2: 根据订单编号查询出其所有的商品
    $sql = "SELECT * FROM fn_product WHERE pid IN (SELECT productId FROM fn_order_detail WHERE orderId=$oid)";
    $result = mysqli_query($con,$sql);
    //$order['productList'] = [10,30];  错误写法
    $list[$k]['productList'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
//最终得到的订单列表$list是一个四维数组
echo  json_encode($list);





