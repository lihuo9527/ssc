<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET');
header('Access-Control-Allow-Credentials:true'); 
header("Content-Type: application/json;charset=utf-8"); 
date_default_timezone_set('prc');
$servername = "localhost";
$username = "root";
$password = "root";
$sqlname = "ssc";
// 创建连接
$conn = new mysqli($servername, $username, $password,$sqlname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>