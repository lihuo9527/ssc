<?php 
require  'header.php';
global $conn,$date,$push_nums,$num,$num_index,$nums,$arr,$num1,$num2,$lose_index,$case,$last_nums,$last_num;
$case = $_GET['case'];
$index =(int)$_GET['index'];
$num1 = (int)$_GET['n'];
$num2 = (int)$_GET['i'];
$arr = [];
$lose_index = 0;
$last_num = "0";
$last_nums = "0";
$sql = "SELECT open_date,open_num  FROM ".$_GET['name']." order by id asc";
$result = $conn->query($sql);
if($result->num_rows>0){
	$i=0;
	while($row = $result->fetch_assoc()){
		  $item = explode(",",$row["open_num"]);
		  if($case =="1") $open_num = $item[0];
		  if($case =="2") $open_num = $item[1];
		  if($case =="3") $open_num = $item[2];
		  if($case =="4") $open_num = $item[3];
		  if($case =="5") $open_num = $item[4];
		 if($last_nums == $row["open_num"]) continue;
	     if(!strstr($last_num,$open_num)){
			$lose_index++;
		 }else{
			 array_push($arr,array("lose"=>$lose_index,"date"=>$row["open_date"]));
			 $lose_index =0;
		 }
		 $new_nums = back_num($open_num,$num1,$num2);
		//  echo "-".$open_num."|".$last_num."|".$row["open_date"]."-";
		 $last_num = $new_nums;
		 $last_nums = $row["open_num"];
	     if($i>=$index) break;
		$i++;

	}
}

function back_num($num,$num_1,$num_2){
	  $data = $num*$num_1-$num_2;
      if($data>=0){
         $i =  substr($data,-1);
	  }else{
        if($data==-1){$i=9;}
		if($data==-2){$i=8;}
		if($data==-3){$i=7;}
		if($data==-4){$i=6;}
		if($data==-5){$i=5;}
		if($data==-6){$i=4;}
		if($data==-7){$i=3;}
		if($data==-8){$i=2;}
		if($data==-9){$i=1;}
	  }
		if($i==0){return "123456789";}
		if($i==1){return "023456789";}
		if($i==2){return "013456789";}
		if($i==3){return "012456789";}
		if($i==4){return "012356789";}
		if($i==5){return "012346789";}
		if($i==6){return "012345789";}
		if($i==7){return "012345689";}
		if($i==8){return "012345679";}
		if($i==9){return "012345678";}
}
$arrs = $arr;
foreach($arrs as $val){
$key_arrays[]=$val['lose'];
}
array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$arrs);
echo "最高连续输".$arrs[count($arrs)-1]['lose']."期";

echo json_encode($arr);

$conn->close();
?>