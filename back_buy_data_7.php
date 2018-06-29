<?php 
require  'header.php';
global $conn,$data,$name,$index,$arrays;
$name = $_GET["name"];
$arrays = ["","","","",""];
$sql = "SELECT issue,num,push_nums,a,b,c,d,e FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	$i = 0;
	$n1 = 0;
	$n2 = 0;
	$n3 = 0;
	$n4 = 0;
	$n5 = 0;
	$buff1 = false;
	$buff2 = false;
	$buff3 = false;
	$buff4 = false;
	$buff5 = false;
	while($row = $result->fetch_assoc()){
			$item = explode(",",$row["num"]);
		if($buff1 == false){
			if($row["a"]!=""){
				if(mb_substr($row["a"],0,1,'utf-8')=="小" && $item[0]>=5 || mb_substr($row["a"],0,1,'utf-8')=="大" && $item[0]<5){
					$buff1 = true;
					$arrays[0] .= strval($n1 + 1)."|";
				}
			}
		}
		if($buff2 == false){
			if($row["b"]!=""){
				if(mb_substr($row["b"],0,1,'utf-8')=="小" && $item[1]>=5 || mb_substr($row["b"],0,1,'utf-8')=="大" && $item[1]<5){
					$buff2 = true;
					$arrays[1] .= strval($n2 + 1)."|";
				}
			}
		}
		if($buff3 == false){
			if($row["c"]!=""){
				if(mb_substr($row["c"],0,1,'utf-8')=="小" && $item[2]>=5 || mb_substr($row["c"],0,1,'utf-8')=="大" && $item[2]<5){
					$buff3 = true;
					$arrays[2] .= strval($n3 + 1)."|";
				}
			}
		}
		if($buff4 == false){
			if($row["d"]!=""){
				if(mb_substr($row["d"],0,1,'utf-8')=="小" && $item[3]>=5 || mb_substr($row["d"],0,1,'utf-8')=="大" && $item[3]<5){
					$buff4 = true;
					$arrays[3] .= strval($n4 + 1)."|";
				}
			}
		}
		if($buff5 == false){
			if($row["e"]!=""){
				if(mb_substr($row["e"],0,1,'utf-8')=="小" && $item[1]>=5 || mb_substr($row["e"],0,1,'utf-8')=="大" && $item[1]<5){
					$buff5 = true;
					$arrays[4] .= strval($n5 + 1)."|";
				}
			}
		}
		if($buff1 ==true && $buff2 ==true && $buff3 ==true && $buff4 ==true  && $buff5 ==true){
			   break;
			}
		$i++;
		if($row["a"]!="")$n1++;
		if($row["b"]!="")$n2++;
		if($row["c"]!="")$n3++;
		if($row["d"]!="")$n4++;
		if($row["e"]!="")$n5++;
	}
}
$sql = "SELECT issue,num,push_nums,a,b,c,d,e FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	$i = 0;
	$n1 = 0;
	$n2 = 0;
	$n3 = 0;
	$n4 = 0;
	$n5 = 0;
	$buff1 = false;
	$buff2 = false;
	$buff3 = false;
	$buff4 = false;
	$buff5 = false;
	while($row = $result->fetch_assoc()){
			$item = explode(",",$row["num"]);
		if($buff1 == false){
			if($row["a"]!=""){
				if(mb_substr($row["a"],1,1,'utf-8')=="单" && $item[0]%2==0 || mb_substr($row["a"],1,1,'utf-8')=="双" && $item[0]%2!=0){
					$buff1 = true;
					$arrays[0] .= strval($n1 + 1)."|";
				}
			}
		}
		if($buff2 == false){
			if($row["b"]!=""){
				if(mb_substr($row["b"],1,1,'utf-8')=="单" && $item[1]%2==0 || mb_substr($row["b"],1,1,'utf-8')=="双" && $item[1]%2!=0){
					$buff2 = true;
					$arrays[1] .= strval($n2 + 1)."|";
				}
			}
		}
		if($buff3 == false){
			if($row["c"]!=""){
				if(mb_substr($row["c"],1,1,'utf-8')=="单" && $item[2]%2==0 || mb_substr($row["c"],1,1,'utf-8')=="双" && $item[2]%2!=0){
					$buff3 = true;
					$arrays[2] .= strval($n3 + 1)."|";
				}
			}
		}
		if($buff4 == false){
			if($row["d"]!=""){
				if(mb_substr($row["d"],1,1,'utf-8')=="单" && $item[3]%2==0 || mb_substr($row["d"],1,1,'utf-8')=="双" && $item[3]%2!=0){
					$buff4 = true;
					$arrays[3] .= strval($n4 + 1)."|";
				}
			}
		}
		if($buff5 == false){
			if($row["e"]!=""){
				if(mb_substr($row["e"],1,1,'utf-8')=="单" && $item[4]%2==0 || mb_substr($row["e"],1,1,'utf-8')=="双" && $item[4]%2!=0){
					$buff5 = true;
					$arrays[4] .= strval($n5 + 1)."|";
				}
			}
		}
		if($buff1 ==true && $buff2 ==true && $buff3 ==true && $buff4 ==true  && $buff5 ==true){
			   break;
			}
		$i++;
		if($row["a"]!="")$n1++;
		if($row["b"]!="")$n2++;
		if($row["c"]!="")$n3++;
		if($row["d"]!="")$n4++;
		if($row["e"]!="")$n5++;
	}
}
$sql = "SELECT  name,opentime,a,b,c,d,e,num,push_nums  FROM new_ssc";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
				$arrays[0] .= $row["a"];
				$arrays[1] .= $row["b"];
				$arrays[2] .= $row["c"];
				$arrays[3] .= $row["d"];
				$arrays[4] .= $row["e"];
				$data = implode(",",$arrays);
				break;
			}
  	}
}
$sql = "SELECT  name,push_nums,push_num,push_date,now_lose_text  FROM push_data";
$result = $conn->query($sql);
$date = date('H|i');
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
               echo $row["push_date"]."*".$row["push_nums"]."*".$row["push_num"]."*".$row["now_lose_text"]."*".$date."*".$data;
			}
  	}
}
$conn->close();
?>