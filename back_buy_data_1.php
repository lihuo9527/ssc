<?php 
require  'header.php';
global $conn,$date,$push_nums,$num,$num_index,$nums,$arr,$lose_index;
$sql = "SELECT num FROM ".$_GET['name']." order by id desc";
$arr = [];
$nums = [];
$arr_lose=[];
$index = (int)$_GET['index'];
$lose_index = 1;
$state =false;
$result = $conn->query($sql);
if($result->num_rows>0){
	$i=0;
	$state = false ;
	while($row = $result->fetch_assoc()){
		  $item = explode(",",$row["num"]);
		  if($i==0){
			 $num  = $row["num"];
		  } 
	     if($i<40){
			array_push($nums,$item[$index]);
		 }else{
			 break;
		 }
		$i++;

	}
}
for($i=0;$i<count($nums);$i++){
	if(count($arr)<1){
       array_push($arr,$nums[$i]);
	}else{
		if(count($arr)>=7) break;
		$num_text = implode(",",$arr);
		if(!strstr($num_text,$nums[$i])){
           array_push($arr,$nums[$i]);
		}
	}
}
for($i=0;$i<count($nums);$i++){
	for($j=0;$j<count($nums);$j++){
		if($i<$j){
			$array = [];
			$array2 = [];
			for($x=0;$x<count($nums);$x++){
				if($x>=$j){
				    array_push($array,$nums[$x]);
				}  
			}
			for($v=0;$v<count($array);$v++){
				if(count($array2)<1){
                    array_push($array2,$array[$v]);
				}else{
					$num_text = implode(",",$array2);
					if(!strstr($num_text,$array[$v])) array_push($array2,$array[$v]);
					}
				}
			$text = $array2[0].$array2[1].$array2[2].$array2[3].$array2[4].$array2[5].$array2[6];
			// echo $text."___";
			if(!strstr($text,$nums[$i])){
				$lose_index++;
				break;
			}else{
				array_push($arr_lose,$lose_index);
				$state = true;
				// $lose_index = 1;
				break;
			}
		}
	}
	if($state) break;
	// if($i>=1900) break;
}
$lose_text = implode("_",$arr_lose);
$sql = "SELECT  name,push_nums,push_date,buy_money,front_two_seven,front_three_seven,front_two_eight,front_three_eight,after_two_seven,after_three_seven,after_two_eight,after_three_eight  FROM push_data";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
               echo $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6];
			}
  	}
}
$conn->close();
?>