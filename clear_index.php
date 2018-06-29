<?php 
require  'header.php';
global $conn,$date,$name;
$name = $_GET["name"];
$sql = "SELECT name,clear_index_date  FROM index_data";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
  while($row = $result->fetch_assoc()){
    if($row["name"]==$_GET["name"]){
		if($_GET["name"]=="cqssc"||$_GET["name"]=="tjssc" ||$_GET["name"]=="twssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="qqffc" ||$_GET["name"]=="txffc"){
           $sql = "update index_data set one_cold_index=0,two_cold_index=0,three_cold_index=0,four_cold_index=0,five_cold_index=0,five_hot_index=0,four_hot_index=0,three_hot_index=0,two_hot_index=0,one_hot_index=0,clear_index_date='$date'  where name='$name'";
		}else{
           $sql = "update index_data set one_cold_index=0,two_cold_index=0,three_cold_index=0,three_hot_index=0,two_hot_index=0,one_hot_index=0,clear_index_date='$date'  where name='$name'";
		}
		$res = $conn->query($sql);  
		if(!$res){
		   echo '次数清0失败！';
		}else{
		   echo '次数清0成功！';
		}
	}
  }
}
$conn->close();
?>