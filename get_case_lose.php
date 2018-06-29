<?php 
require  'header.php';
global $conn,$data,$arr,$state,$dates,$times,$name,$x,$index;
$state = $_GET["init"];
$date = $_GET["date"];
$name = $_GET["name"];
$case = $_GET["case"];
$arrays = array();
$arr = array();
$dates = array();
if($name == "pk10"){
	$sql = "SELECT open_issue,open_num,push_num FROM ".$_GET['name']." order by id desc";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$i = 0;
		$last_open_index = 0 ;
		$index = 0 ;
		$last = 0;
		$x = 0;
		$buff2 = true;
		$init = true;
		$last_day = 0;
		while($row = $result->fetch_assoc()){
			    $item = explode(",",$row["open_num"]);
				$push_nums = explode("&",$row["push_num"]);
				$buff = false;
		        $buff3 = false;
				if($case==1){
                   if(substr_count($push_nums[0],$item[4]) > 0){
					$buff = true;
				   }
			   }
			   if($case==2){
                   if(substr_count($push_nums[1],$item[5]) > 0){
					$buff = true;
				   }
			   }
			   if($case==3){
                   if(substr_count($push_nums[2],$item[1]) > 0){
					$buff = true;
				   }
			   }
			   if($case==4){
                   if(substr_count($push_nums[3],$item[8]) > 0){
					$buff = true;
				   }
			   }
			    if($case==5){
					if($push_nums[4] == 0) $res = $item[4];
				    if($push_nums[4] == 1) $res = $item[5];
				    if($push_nums[4] == 2) $res = $item[1];
				    if($push_nums[4] == 3) $res = $item[8];
                   if(substr_count($push_nums[$push_nums[4]],$res) > 0){
					$buff = true;
				   }
			   }
			if($state=="true"){
            if($i==0 && $init===true){
                $text = substr($row["open_issue"],0,8);
				array_push($dates,$text);
				$init = false;
			}
			if($text == substr($row["open_issue"],0,8)){
				if($buff){
					if($last_open_index>0){
						$last_open_index = $x - $last -1;
					}else{
						$last_open_index = $x - $last;
					}
					if($last_open_index === -1) $last_open_index=0;
				    array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["open_issue"],9,14)));
					$index +=1;
				if($last_open_index>0){
						$last = $x;
					}else{
						$last = $x +1;
					}
						
				 }

			    if(!$buff3) $x ++;
		
			}else{
				
                if($dates[count($dates)-1]!=substr($row["open_issue"],0,8))array_push($dates,substr($row["open_issue"],0,8));
				
			}
		}else{
			if($buff && $buff2 && $_GET["date"] != substr($row["open_issue"],0,8)){
               $last_day = $i;
			}
            if($_GET["date"] == substr($row["open_issue"],0,8)){
				if($buff){
						$last_open_index = $x - $last -1;
						$last = $x;
				
				    if($buff2){
                      $buff2 = false;
					  $last_open_index = $i- $last_day -1;
					}
					if($last_open_index < 0) $last_open_index=0;
                    array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["open_issue"],9,14)));
					$index +=1;
				 }
				  if(!$buff3) $x ++;
			  }
			}
         if(!$buff3) $i++;
       }

			for($i=0;$i<count($dates);$i++){
				$times = $times.$dates[$i].'|';
			}
			for($i=0;$i<count($arrays);$i++){
				$data = $data.$arrays[$i]["issue"].'_'.$arrays[$i]["open_index"]."*";
			}
			$data = substr($data,0,strlen($data)-1); 
			if($state=="true"){
			$times = substr($times,0,strlen($times)-1);
			echo '{"msg":"'.$data.'","date":"'.$date.'","dates":"'.$times.'","name":"'.$name.'","count":"'.$x.'","red":"'.$index.'"}';
			}else{
			echo '{"msg":"'.$data.'","date":"'.$date.'","name":"'.$name.'","count":"'.$x.'","red":"'.$index.'"}';
			}
		}
}else{
$sql = "SELECT issue,num,push_nums,a,b,c,d,e,f FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	$i = 0;
	$last_open_index = 0 ;
	$index = 0 ;
	$last = 0;
	$x = 0;
	$buff2 = true;
	$init = true;
	$last_day = 0;
	while($row = $result->fetch_assoc()){
		// echo  "长度：".mb_strlen($row['issue'])."|";
		$dig_3 = mb_substr($row['issue'],13,1,'utf-8');
		$dig_2 = mb_substr($row['issue'],14,1,'utf-8');
		$dig_1 = mb_substr($row['issue'],15,1,'utf-8');
		$item = explode(",",$row["num"]);
		$nums = $item[0] + $item[1] + $item[2] + $item[3] + $item[4];
		$buff = false;
		$buff3 = false;
		$add_state = false;
			if($case==1){
				// echo $row["issue"]."-"."push_nums:".substr($row["push_nums"], 0, 5)."-".$item[0]."-";
                if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0){
					$buff = true;
				}
			}
			if($case==2){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0){
					$buff = true;
				}
			}
			if($case==3){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}
			if($case==4){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0){
					$buff = true;
				}
			}
			if($case==5){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}
			if($case==6){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}
			if($case==7){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0){
					$buff = true;
				}
			}
			if($case==8){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0){
					$buff = true;
				}
			}
			if($case==9){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0){
					$buff = true;
				}
			}
			if($case==10){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}
			if($case==11){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0){
					$buff = true;
				}
			}
			if($case==12){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0){
					$buff = true;
				}
			}
		 if($case==13){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}
		 if($case==14){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0){
					$buff = true;
				}
			}
		 if($case==15){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}
		if($case==16){
				if(substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0){
					$buff = true;
				}
			}

		if($case==17){
				if(substr_count("13579",$item[0]) > 0 ){
					$buff = true;
				}
			}
		if($case==18){
				if(substr_count("13579",$item[1])> 0 ){
					$buff = true;
				}
			}
		if($case==19){
				if(substr_count("13579",$item[2]) > 0 ){
					$buff = true;
				}
			}
		if($case==20){
				if(substr_count("13579",$item[3]) > 0 ){
					$buff = true;
				}
			}
		if($case==21){
				if(substr_count("13579",$item[4]) > 0 ){
					$buff = true;
				}
			}
		if($case==22){
				if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==23){
				if(substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==24){
				if(substr_count($row["num"],substr($row["push_nums"], 2, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==25){
				if(substr_count($row["num"],substr($row["push_nums"], 3, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==26){
				if(substr_count($row["num"],substr($row["push_nums"], 4, 1)) > 0 ){
					$buff = true;
				}
			}

		if($case==27){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[2]) > 0){
				$buff = true;
			}
		}
		if($case==28){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==29){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==30){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==31){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==32){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 6),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==33){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0){
				$buff = true;
			}
		}
		if($case==34){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0,8),$item[2]) > 0){
				$buff = true;
			}
		}
		if($case==35){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==36){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==37){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0){
				$buff = true;
			}
		}
		if($case==38){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==39){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==40){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==41){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==42){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
				$buff = true;
			}
		}
       if($case==43){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0){
				$buff = true;
			}
		}
		if($case==44){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==45){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==46){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==47){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==48){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==49){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0){
				$buff = true;
			}
		}
		if($case==50){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0){
				$buff = true;
			}
		}
		if($case==51){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==52){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==53){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0){
				$buff = true;
			}
		}
		if($case==54){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==55){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==56){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
				$buff = true;
			}
		}
		if($case==57){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==58){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
				$buff = true;
			}
		}
		if($case==59){
			if(substr_count(substr($row["push_nums"], 0, 9),$item[4]) > 0 ){
				$buff = true;
			}
		}
		if($case==60){
			if(substr_count(substr($row["push_nums"], 0, 8).substr($row["push_nums"], 9, 1),$item[3]) > 0 ){
				$buff = true;
			}
		}
       if($case==61){
			if(substr_count(substr($row["push_nums"], 0, 7).substr($row["push_nums"], 8, 2),$item[2]) > 0 ){
				$buff = true;
			}
		}
       if($case==62){
			if(substr_count(substr($row["push_nums"], 0, 6).substr($row["push_nums"], 7, 3),$item[1]) > 0 ){
				$buff = true;
			}
		}
       if($case==63){
			if(substr_count(substr($row["push_nums"], 0, 5).substr($row["push_nums"], 6, 4),$item[0]) > 0 ){
				$buff = true;
			}
		}
	  if($case==64){
			if(substr_count(substr($row["push_nums"], 0, 1),$item[0]) > 0  || substr_count(substr($row["push_nums"], 0, 1),$item[1])>0 || substr_count(substr($row["push_nums"], 0, 1),$item[2])>0){
				$buff = true;
			}
		}
	  if($case==65){
			if(substr_count(substr($row["push_nums"], 0, 1),$item[0]) > 0  || substr_count(substr($row["push_nums"], 0, 1),$item[1])>0 || substr_count(substr($row["push_nums"], 0, 1),$item[3])>0){
				$buff = true;
			}
		}
	  if($case==66){
			if(substr_count(substr($row["push_nums"], 0, 1),$item[0]) > 0  || substr_count(substr($row["push_nums"], 0, 1),$item[1])>0 || substr_count(substr($row["push_nums"], 0, 1),$item[4])>0){
				$buff = true;
			}
		}
	  if($case==67){
			if(substr_count(substr($row["push_nums"], 0, 1),$item[1]) > 0  || substr_count(substr($row["push_nums"], 0, 1),$item[2])>0 || substr_count(substr($row["push_nums"], 0, 1),$item[3])>0){
				$buff = true;
			}
		}
	  if($case==68){
			if(substr_count(substr($row["push_nums"], 0, 1),$item[1]) > 0  || substr_count(substr($row["push_nums"], 0, 1),$item[2])>0 || substr_count(substr($row["push_nums"], 0, 1),$item[4])>0){
				$buff = true;
			}
		}
	  if($case==69){
			if(substr_count(substr($row["push_nums"], 0, 1),$item[2]) > 0  || substr_count(substr($row["push_nums"], 0, 1),$item[3])>0 || substr_count(substr($row["push_nums"], 0, 1),$item[4])>0){
				$buff = true;
			}
		}
       if($case==70){
				if(substr_count(substr($row["push_nums"], 0, 4),$item[0]) > 0 ){
					$buff = true;
				}
			}
		if($case==71){
				if(substr_count(substr($row["push_nums"], 0, 4),$item[1]) > 0 ){
					$buff = true;
				}
			}
		if($case==72){
				if(substr_count(substr($row["push_nums"], 0, 4),$item[2]) > 0 ){
					$buff = true;
				}
			}
		if($case==73){
				if(substr_count(substr($row["push_nums"], 0, 4),$item[3]) > 0 ){
					$buff = true;
				}
			}
		if($case==74){
				if(substr_count(substr($row["push_nums"], 0, 4),$item[4]) > 0 ){
					$buff = true;
				}
			}
		if($case==75){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 ){
				$buff = true;
			}
		}
		if($case==76){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 ){
				$buff = true;
			}
		}
		if($case==77){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 ){
				$buff = true;
			}
		}
		if($case==78){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0 ){
				$buff = true;
			}
		}
		if($case==79){
			if(substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0 ){
				$buff = true;
			}
		}
		if($case==80){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 ){
				$buff = true;
			}
		}
		if($case==81){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 ){
				$buff = true;
			}
		}
		if($case==82){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0 ){
				$buff = true;
			}
		}
		if($case==83){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0 ){
				$buff = true;
			}
		}
		if($case==84){
			if(substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0 ){
				$buff = true;
			}
		}
		if($case==85){
			if(substr_count(substr($row["push_nums"], 0, 5),$item[0]) > 0 ){
				$buff = true;
			}
		}
		if($case==86){
			if(substr_count(substr($row["push_nums"], 0, 5),$item[1]) > 0 ){
				$buff = true;
			}
		}
		if($case==87){
			if(substr_count(substr($row["push_nums"], 0, 5),$item[2]) > 0 ){
				$buff = true;
			}
		}
		if($case==88){
			if(substr_count(substr($row["push_nums"], 0, 5),$item[3]) > 0 ){
				$buff = true;
			}
		}
		if($case==89){
			if(substr_count(substr($row["push_nums"], 0, 5),$item[4]) > 0 ){
				$buff = true;
			}
		}
		if($case==90){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[0]) > 0 ){
				$buff = true;
			}
		}
		if($case==91){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[1]) > 0 ){
				$buff = true;
			}
		}
		if($case==92){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[2]) > 0 ){
				$buff = true;
			}
		}
		if($case==93){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[3]) > 0 ){
				$buff = true;
			}
		}
		if($case==94){
			if(substr_count(substr($row["push_nums"], 0, 6),$item[4]) > 0 ){
				$buff = true;
			}
		}
		if($case==95){
				if(substr_count($row["num"],substr($row["push_nums"], 5, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==96){
				if(substr_count($row["num"],substr($row["push_nums"], 6, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==97){
				if(substr_count($row["num"],substr($row["push_nums"], 7, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==98){
				if(substr_count($row["num"],substr($row["push_nums"], 8, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==99){
				if(substr_count($row["num"],substr($row["push_nums"], 9, 1)) > 0 ){
					$buff = true;
				}
			}
		if($case==100){
				if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 0  || substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 0){
					$buff = true;
				}
			}
		if($case==101){
				if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 0  || substr_count($row["num"],substr($row["push_nums"], 8, 1)) > 0){
					$buff = true;
				}
			}
		if($case==102){
				if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 0  || substr_count($row["num"],substr($row["push_nums"], 9, 1)) > 0){
					$buff = true;
				}
			}
		if($case==103){
				if(substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 0  || substr_count($row["num"],substr($row["push_nums"], 8, 1)) > 0){
					$buff = true;
				}
			}
		if($case==104){
				if(substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 0  || substr_count($row["num"],substr($row["push_nums"], 9, 1)) > 0){
					$buff = true;
				}
			}
		if($case==105){
				if(substr_count($row["num"],substr($row["push_nums"], 8, 1)) > 0  || substr_count($row["num"],substr($row["push_nums"], 9, 1)) > 0){
					$buff = true;
				}
			}
		if($case==106){
			if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 2, 1)) > 1){
				$buff = true;
			}
		}
		if($case==107){
			if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 2, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 3, 1)) > 1 ){
				$buff = true;
			}
		}
		if($case==108){
			if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 2, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 3, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 4, 1)) > 1){
				$buff = true;
			}
		}
		if($case==109){
			if(substr_count($row["num"],substr($row["push_nums"], 0, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 1, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 2, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 3, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 4, 1)) > 1 || substr_count($row["num"],substr($row["push_nums"], 5, 1)) > 1){
				$buff = true;
			}
		}
	   if($case==110){
			if($row["f"] != ""){
				if($row["f"]=="大双" && $nums<23  ||  $row["f"]=="大单" && $nums<23)$buff = true;
				if($row["f"]=="小双" && $nums>=23  ||  $row["f"]=="小单" && $nums>=23)$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==111){
			if($row["a"] != ""){
				if($row["a"]=="大双" && $item[0]<5  ||  $row["a"]=="大单" && $item[0]<5)$buff = true;
				if($row["a"]=="小双" && $item[0]>=5  ||  $row["a"]=="小单" && $item[0]>=5)$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==112){
			if($row["b"] != ""){
				if($row["b"]=="大双" && $item[1]<5  ||  $row["b"]=="大单" && $item[1]<5)$buff = true;
				if($row["b"]=="小双" && $item[1]>=5  ||  $row["b"]=="小单" && $item[1]>=5)$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==113){
			if($row["c"] != ""){
				if($row["c"]=="大双" && $item[2]<5  ||  $row["c"]=="大单" && $item[2]<5)$buff = true;
				if($row["c"]=="小双" && $item[2]>=5  ||  $row["c"]=="小单" && $item[2]>=5)$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==114){
			if($row["d"] != ""){
				if($row["d"]=="大双" && $item[3]<5  ||  $row["d"]=="大单" && $item[3]<5)$buff = true;
				if($row["d"]=="小双" && $item[3]>=5  ||  $row["d"]=="小单" && $item[3]>=5)$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==115){
			if($row["e"] != ""){
				if($row["e"]=="大双" && $item[4]<5  ||  $row["e"]=="大单" && $item[4]<5)$buff = true;
				if($row["e"]=="小双" && $item[4]>=5  ||  $row["e"]=="小单" && $item[4]>=5)$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==116){
			if($row["f"] != ""){
				if($row["f"]=="大双" && $nums%2!=0  ||  $row["f"]=="小双"  && $nums%2!=0 )$buff = true;
				if($row["f"]=="大单" && $nums%2==0  ||  $row["f"]=="小单"  && $nums%2==0 )$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==117){
			if($row["a"] != ""){
				if($row["a"]=="大双" && $item[0]%2!=0  ||  $row["a"]=="小双"  && $item[0]%2!=0 )$buff = true;
				if($row["a"]=="大单" && $item[0]%2==0  ||  $row["a"]=="小单"  && $item[0]%2==0 )$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==118){
			if($row["b"] != ""){
				if($row["b"]=="大双" && $item[1]%2!=0  ||  $row["b"]=="小双"  && $item[1]%2!=0 )$buff = true;
				if($row["b"]=="大单" && $item[1]%2==0  ||  $row["b"]=="小单"  && $item[1]%2==0 )$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==119){
			if($row["c"] != ""){
				if($row["c"]=="大双" && $item[2]%2!=0  ||  $row["c"]=="小双"  && $item[2]%2!=0 )$buff = true;
				if($row["c"]=="大单" && $item[2]%2==0  ||  $row["c"]=="小单"  && $item[2]%2==0 )$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==120){
			if($row["d"] != ""){
				if($row["d"]=="大双" && $item[3]%2!=0  ||  $row["d"]=="小双"  && $item[3]%2!=0 )$buff = true;
				if($row["d"]=="大单" && $item[3]%2==0  ||  $row["d"]=="小单"  && $item[3]%2==0 )$buff = true;
			}else{
				$add_state = true;
			}
		}
	   if($case==121){
			if($row["e"] != ""){
				if($row["e"]=="大双" && $item[4]%2!=0  ||  $row["e"]=="小双"  && $item[4]%2!=0 )$buff = true;
				if($row["e"]=="大单" && $item[4]%2==0  ||  $row["e"]=="小单"  && $item[4]%2==0 )$buff = true;
			}else{
				$add_state = true;
			}
		}
	if($state=="true"){
            if($i==0 && $init===true){
				if($name=="bjssc"){
                    $text = substr($row["issue"],0,4);
				}else{
                    $text = substr($row["issue"],0,10);
				}
					array_push($dates,$text);
					$init = false;
			}
			if($text == substr($row["issue"],0,10)  || $text == substr($row["issue"],0,4) && $name=="bjssc"){
				if($buff){
				  // echo "第".substr($row["issue"],13,3)."期中，";
					if($last_open_index>0){
						$last_open_index = $x - $last -1;
					}else{
						$last_open_index = $x - $last;
					}
					if($last_open_index === -1) $last_open_index=0;
					// echo "间隔".$last_open_index."期";
					// echo "\n";
					// array_push($arrays,$last_open_index);
					if($name == "bjssc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],4,2)));
					if($name == "txffc" ||$name == "qqffc"||$name == "jsffc" )  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],13,4)));
                    if($name == "twssc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],13,6)));
					if($name != "twssc" && $name != "txffc" && $name != "bjssc" && $name != "qqffc"&& $name != "jsffc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],13,3)));

					$index +=1;
				if($last_open_index>0){
						$last = $x;
					}else{
						$last = $x +1;
					}
						
				 }

			    if($buff3 ==false && $add_state ==false) $x ++;
		
			}else{
				if($name=="bjssc"){
				     if($dates[count($dates)-1]!=substr($row["issue"],0,4))array_push($dates,substr($row["issue"],0,4));
					   }else{
                      if($dates[count($dates)-1]!=substr($row["issue"],0,10))array_push($dates,substr($row["issue"],0,10));
				}
			}
		}else{
			if($buff && $buff2 && $_GET["date"] != substr($row["issue"],0,10) || $buff && $buff2 && $_GET["date"] != substr($row["issue"],0,4) && $name=="bjssc"){
               $last_day = $i;
			}
            if($_GET["date"] == substr($row["issue"],0,10) || $_GET["date"] == substr($row["issue"],0,4) && $name=="bjssc"){
				if($buff){
					
						$last_open_index = $x - $last -1;
						$last = $x;
					//  }else{
					// 	$last_open_index = $x - $last;
					// 	$last = $x +1;
					// }
					
				    if($buff2){
                      $buff2 = false;
					  $last_open_index = $i- $last_day -1;
					}
					if($last_open_index < 0) $last_open_index=0;
					// echo "间隔".$last_open_index."期";
					// echo "\n";
					if($name == "bjssc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],4,2)));
					if($name == "txffc"||$name == "qqffc"||$name == "jsffc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],13,4)));
                    if($name == "twssc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],13,6)));
					if($name != "twssc" && $name != "txffc" && $name != "bjssc" && $name != "qqffc" && $name != "jsffc")  array_push($arrays,array("open_index"=>$last_open_index,"issue"=>substr($row["issue"],13,3)));
					$index +=1;
			
				 }
				  if($buff3 ==false && $add_state ==false) $x ++;
			  }
			}
       if($buff3 ==false && $add_state ==false) $i++;
    }

for($i=0;$i<count($dates);$i++){
	$times = $times.$dates[$i].'|';
}
for($i=0;$i<count($arrays);$i++){
	$data = $data.$arrays[$i]["issue"].'_'.$arrays[$i]["open_index"]."*";
}
$data = substr($data,0,strlen($data)-1); 
if($state=="true"){
   $times = substr($times,0,strlen($times)-1);
   echo '{"msg":"'.$data.'","date":"'.$date.'","dates":"'.$times.'","name":"'.$name.'","count":"'.$x.'","red":"'.$index.'"}';
}else{
   echo '{"msg":"'.$data.'","date":"'.$date.'","name":"'.$name.'","count":"'.$x.'","red":"'.$index.'"}';
  }
}
}

$conn->close();
?>
