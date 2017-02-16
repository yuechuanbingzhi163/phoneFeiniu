<?php
  header('Content-Type:application/json;charset=UTF8');
  $set="SET NAMES UTF8";
  $con=mysqli_connect('127.0.0.1','root','','feiniu','3306');
  mysqli_query($con,$set);
  $sel="SELECT * FROM ban";
  $result=mysqli_query($con,$sel);
  $arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
  var_dump($arr);
?>