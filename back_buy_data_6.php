<?php 
require  'header.php';
global $conn,$data,$name,$index;
$name = $_GET["name"];
$arrays = array(0,0,0,0,0);
$sql = "SELECT open_issue,open_num,push_num FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	$i = 0;
	$buff1 = false;
	$buff2 = false;
	$buff3 = false;
	$buff4 = false;
	$buff5 = false;
	while($row = $result->fetch_assoc()){
			$buff = false;
			$item = explode(",",$row["open_num"]);
			$push_nums = explode("&",$row["push_num"]);
			if($buff1 == false){
               if(substr_count($push_nums[0],$item[4]) > 0){
				  $buff1 = true;
				  $arrays[0]= $i + 1;
				}
			}
			if($buff2 == false){
               if(substr_count($push_nums[1],$item[5]) > 0){
				  $buff2 = true;
				  $arrays[1]= $i + 1;
				}
			}
			if($buff3 == false){
               if(substr_count($push_nums[2],$item[1]) > 0){
				  $buff3 = true;
				  $arrays[2]= $i + 1;
				}
			}
			if($buff4 == false){
               if(substr_count($push_nums[3],$item[8]) > 0){
				  $buff4 = true;
				  $arrays[3]= $i + 1;
				}
			}
		    if($buff5 == false){
				if($push_nums[4] == 0) $res = $item[4];
				if($push_nums[4] == 1) $res = $item[5];
				if($push_nums[4] == 2) $res = $item[1];
				if($push_nums[4] == 3) $res = $item[8];
               if(substr_count($push_nums[$push_nums[4]],$res) > 0){
				  $buff5 = true;
				  $arrays[4]= $i + 1;
				}
			}
			if($buff1 ==true && $buff2 ==true && $buff3 ==true && $buff4 ==true  && $buff5 ==true){
			   break;
			}
		$i++;
	}
}
$data = implode(",",$arrays);
$sql = "SELECT  name,push_nums,opentime,num  FROM new_ssc";
$result = $conn->query($sql);
$date = date('H|i');
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
               echo $row["opentime"]."*".$row["push_nums"]."*".$data."*".$date."*".$row["num"];
			}
  	}
}

$conn->close();
?>