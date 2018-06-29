<?php 
require  'header.php';
global $conn,$date,$data;
$sql = "SELECT num,push_nums FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
			$item = explode(",",$row["num"]);
		if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) >0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
			}
		if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) >0 && substr_count(substr($row["push_nums"], 0, 8),$item[1]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
			}
		if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) >0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) >0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
		}
		if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) >0 && substr_count(substr($row["push_nums"], 0, 8),$item[1]) >0 && substr_count(substr($row["push_nums"], 0, 8),$item[2]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
			}

		if(substr_count(substr($row["push_nums"], 0, 7),$item[3]) >0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
			}
		if(substr_count(substr($row["push_nums"], 0, 8),$item[3]) >0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
			}
		if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) >0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) >0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
		}
		if(substr_count(substr($row["push_nums"], 0, 8),$item[2]) >0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) >0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) >0){
			$data .= "true"."*";
			}else{
			$data .= "false"."*";
			}
         break;
		}
	}
$sql = "SELECT  name,push_nums,push_date,buy_money,front_two_seven,front_three_seven,front_two_eight,front_three_eight,after_two_seven,after_three_seven,after_two_eight,after_three_eight,front_two_seven_2,front_three_seven_2,front_two_eight_2,front_three_eight_2,after_two_seven_2,after_three_seven_2,after_two_eight_2,after_three_eight_2  FROM push_data";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
               echo $row["push_date"]."*".$row["push_nums"]."*".$row["buy_money"]."*".$row["front_two_seven"]."*".$row["front_two_eight"]."*".$row["front_three_seven"]."*".$row["front_three_eight"]."*".$row["after_two_seven"]."*".$row["after_two_eight"]."*".$row["after_three_seven"]."*".$row["after_three_eight"]."*".$row["front_two_seven_2"]."*".$row["front_two_eight_2"]."*".$row["front_three_seven_2"]."*".$row["front_three_eight_2"]."*".$row["after_two_seven_2"]."*".$row["after_two_eight_2"]."*".$row["after_three_seven_2"]."*".$row["after_three_eight_2"]."*".$data;
			}
  	}
}
$conn->close();
?>