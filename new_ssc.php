<?php 
require  'header.php';
global $conn,$arr,$back_data,$data,$opentime,$open_num,$lottery_time,$name,$first,$last,$total,$first_lose,$last_lose,$total_lose,$arrs,$times_count,$times_count2,$arrs_num,$times_count3,$x,$e,$push_nums,$nums_lose,$nums_index,$color_index,$state,$num_index,$date_or_index,$index_2,$name_2,$arrs1,$arrs2,$arrs3,$arrs4,$arrs5,$arrs_add;
$push_nums="";
$color_index = array();
$arr = array();
$arrs1 = array(0,0,0,0);
$arrs2 = array(0,0,0,0);
$arrs3 = array(0,0,0,0);
$arrs4 = array(0,0,0,0);
$arrs5 = array(0,0,0,0);
$arrs_add = array(0,0,0,0);
$arrs_num = array(
array("number"=>0,"index"=>0,"times_count"=>0),
array("number"=>1,"index"=>0,"times_count"=>0),
array("number"=>2,"index"=>0,"times_count"=>0),
array("number"=>3,"index"=>0,"times_count"=>0),
array("number"=>4,"index"=>0,"times_count"=>0),
array("number"=>5,"index"=>0,"times_count"=>0),
array("number"=>6,"index"=>0,"times_count"=>0),
array("number"=>7,"index"=>0,"times_count"=>0),
array("number"=>8,"index"=>0,"times_count"=>0),
array("number"=>9,"index"=>0,"times_count"=>0));
$name = $_GET["name"];
$sql = "SELECT opentime,name,first,last,total,first_lose,last_lose,total_lose,times_count,times_count2,times_count3,nums_lose,nums_index,state  FROM new_ssc";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			 if($row["name"]==$name){
                    $opentime = $row["opentime"];
					$first = $row["first"];
					$last  = $row["last"];
					$total = $row["total"];
					$first_lose = $row["first_lose"];
					$last_lose = $row["last_lose"];
					$total_lose = $row["total_lose"];
					$times_count = $row["times_count"];
					$times_count2 = $row["times_count2"];
					$times_count3 = $row["times_count3"];
					$nums_lose = $row["nums_lose"];
					$nums_index = $row["nums_index"];
					$state = $row["state"];
					echo $times_count3."次";
					break;
					// echo "first:" . $first."last:".$last."total:".$total."first_lose:" . $first_lose."last_lose:".$last_lose."total_lose:".$total_lose;

			 };
		}
}
echo date('h：i：s');
$sql = "SELECT  issue, num, lotterytime,push_nums,e FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
	  $i = 0;
	  $i2 = 0;
	  $case_array = array(
      	array("name"=>"任选2万千7码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2万百7码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2万十7码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2万个7码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2千百7码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2千十7码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2千个7码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2百十7码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2百个7码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2十个7码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2万千8码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2万百8码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2万十8码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2万个8码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2千百8码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2千十8码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2千个8码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2百十8码","index"=>0,"state"=>"lose"),
		array("name"=>"任选2百个8码",  "index"=>0,"state"=>"lose"),
		array("name"=>"任选2十个8码","index"=>0,"state"=>"lose")
		);
	  while($row = $result->fetch_assoc()){
		$item = explode(",",$row["num"]);
		for($b=0;$b<count($case_array);$b++){
		if($case_array[$b]["state"] == "lose"){
		   $buff = false;
			if($b==0){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0){
					$buff = true;
				}
			}
			if($b==1){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0){
					$buff = true;
				}
			}
			if($b==2){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
					$buff = true;
				}
			}
			if($b==3){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==4){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0){
					$buff = true;
				}
			}
			if($b==5){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
					$buff = true;
				}
			}
			if($b==6){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==7){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0){
					$buff = true;
				}
			}
			if($b==8){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==9){
				if(substr_count(substr($row["push_nums"], 0, 7),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 7),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==10){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0){
					$buff = true;
				}
			}
			if($b==11){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0){
					$buff = true;
				}
			}
			if($b==12){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0){
					$buff = true;
				}
			}
			if($b==13){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[0]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==14){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0){
					$buff = true;
				}
			}
			if($b==15){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0){
					$buff = true;
				}
			}
			if($b==16){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[1]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==17){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0){
					$buff = true;
				}
			}
			if($b==18){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[2]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
					$buff = true;
				}
			}
			if($b==19){
				if(substr_count(substr($row["push_nums"], 0, 8),$item[3]) > 0 && substr_count(substr($row["push_nums"], 0, 8),$item[4]) > 0){
					$buff = true;
				}
			}
	
            if($buff){
               $case_array[$b]["state"] = "win";
			   if($b==89){
                  $case_array[$b]["index"] = $i + 1 - $i2;
			   }else{
                  $case_array[$b]["index"] = $i +1 ;
			   }
		    }
	      }
	 }


		if($i <= $times_count3 - 1){
              for($j=0;$j<count($item);$j++){
				  compute_arr3($item[$j]);
			  }
		  }
		if($i <= $times_count2 - 1){
                $add_num = $item[0] + $item[1] + $item[2] + $item[3] + $item[4];
						if($add_num<10) $add_num ="0".$add_num;
						$mm ="";
						if($add_num>22&&substr($add_num, 1, 2)%2==0){
                            $mm="大双";
						}else if($add_num>22&&substr($add_num, 1, 2)%2!=0){
                            $mm="大单";
						}else if($add_num<=22&&substr($add_num, 1, 2)%2!=0){
							$mm="小单";
						}else{
							$mm="小双";
						}
			   set_array($mm,6);
			   for($a=0;$a<count($item);$a++){
                    $mm = "";
					if($item[$a] == "0" || $item[$a] == "2" || $item[$a] == "4" ) $mm="小双";
					if($item[$a] == "1" || $item[$a] == "3" ) $mm="小单";
					if($item[$a] == "6" || $item[$a] == "8" ) $mm="大双";
					if($item[$a] == "5" || $item[$a] == "7" || $item[$a] == "9") $mm="大单";
					if($a==0) set_array($mm,1);
				    if($a==1) set_array($mm,2);
				    if($a==2) set_array($mm,3);
				    if($a==3) set_array($mm,4);
				    if($a==4) set_array($mm,5);
	
			   }

		   }
			if($i ==0){
				 if($row["issue"]==$opentime){
					  echo '{"msg":"还没有开奖！"}';
					  return;
				 }else{
					 $opentime = $row["issue"];
					 $open_num = $row["num"];
					 $lottery_time = $row["lotterytime"];
				 }
			}
			  $i++;
			  if($i>=200) break;
		}
	}
// var_dump($arrs1);
// var_dump($arrs2);
// var_dump($arrs3);
// var_dump($arrs4);
// var_dump($arrs5);
echo date('h：i：s');
for($i=0;$i<count($arrs_num);$i++){
	if($arrs_num[$i]["index"]==0) $arrs_num[$i]["index"] = 0.5;
}
foreach($arrs_num as $val){
$key_arrays[]=$val['index'];
}

array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$arrs_num);

echo "第一次".date('h：i：s');
$x=0;
while($x < count($arrs_num)){
for($i=0;$i<count($arrs_num);$i++){
	for($j=0;$j<count($arrs_num);$j++){
		if($j!=$i && $arrs_num[$i]["index"]==$arrs_num[$j]["index"]){
			$sql = "SELECT num FROM ".$_GET['name']." order by id desc";
			$res = $conn->query($sql);
			$arr_data = array(array("index"=>0,"times_count"=>0),array("index"=>0,"times_count"=>0));
			if($res->num_rows>0){
			$a = 0;
			while($row = $res->fetch_assoc()){
				   $item = explode(",",$row["num"]);
				if($a >= $times_count2){
					for($b=0;$b<count($item);$b++){
						if($item[$b]==$arrs_num[$i]["number"]){
                            $arr_data[0]["index"] += 1;
						  }
						 if($item[$b]==$arrs_num[$j]["number"]){
                            $arr_data[1]["index"] += 1;
						  }
						}
					}
				if($arr_data[0]["index"]!=$arr_data[1]["index"]){
				   if($arr_data[0]["index"]>$arr_data[1]["index"]){
                      $arrs_num[$i]["times_count"] += 0.001;
				    }
				   break;
				}
		  $a++;
		}
	  }
    }
  }
 }
$x++;
}
for($i=0;$i<count($arrs_num);$i++){
	 $arrs_num[$i]["index"] = $arrs_num[$i]["index"] + $arrs_num[$i]["times_count"];
}

//进行从小到大排序；
foreach($arrs_num as $value){
  $arr_s[]=$value['index'];
}

array_multisort($arr_s,SORT_ASC,SORT_NUMERIC,$arrs_num);
// var_dump($arrs_num);
echo "第二次".date('h：i：s');

$sql = "SELECT  name,one_cold,two_cold,three_cold,four_cold,five_cold,five_hot,four_hot,three_hot,two_hot,one_hot,one_cold_index,two_cold_index,three_cold_index,four_cold_index,five_cold_index,five_hot_index,four_hot_index,three_hot_index,two_hot_index,one_hot_index,date_or_index  FROM index_data";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		if($row["name"] == $name){
			$obj_text = ["one_cold","two_cold","three_cold","four_cold","five_cold","five_hot","four_hot","three_hot","two_hot","one_hot"];
			for($i=0;$i<count($obj_text);$i++){
				$appear_index = substr_count($open_num,$row[$obj_text[$i]]);
				 if($appear_index>0){
					 if($row["date_or_index"]=="true"){
                       $appear_index = $row[$obj_text[$i]."_index"] + 1;
					 }else{
                       $appear_index = $row[$obj_text[$i]."_index"] + $appear_index;
					 }
					array_push($color_index,$i);
					echo "appear_index:".$appear_index;
                    $sql = "update index_data set ".$obj_text[$i]."_index='$appear_index'  where name='$name'";
					$res = $conn->query($sql);  
					if(!$res){
						echo '计次失败！';
						}else{
						echo '计次成功！';
					}
				 }
			}
		}
	}
}
echo "第三次".date('h：i：s');
$color = implode(",",$color_index);
$sql = "update index_data set one_cold=".$arrs_num[0]['number'].",two_cold=".$arrs_num[1]['number'].",three_cold=".$arrs_num[2]['number'].",four_cold=".$arrs_num[3]['number'].",five_cold=".$arrs_num[4]['number'].",five_hot=".$arrs_num[5]['number'].",four_hot=".$arrs_num[6]['number'].",three_hot=".$arrs_num[7]['number'].",two_hot=".$arrs_num[8]['number'].",one_hot=".$arrs_num[9]['number'].",color_index='$color' where name='$name'";
$res = $conn->query($sql);      
if(!$res){
    echo '记录失败！';
    }else{
    echo '记录成功！';
 }

for($b=0;$b<count($seven_and_eight);$b++){
$sql = "update push_data set ".$seven_and_eight[$b]['name']."=".$seven_and_eight[$b]['times_count']. " where name='$name'";
$res = $conn->query($sql);
if(!$res){
    echo '执行失败！';
}else{
    echo $seven_and_eight[$b]['name']."=".$seven_and_eight[$b]['times_count'].'执行成功！';
 }
}
echo "第四次".date('h：i：s');
$name_2 = $name."_2";
$stmt = $conn->prepare("INSERT INTO $name_2 (time,one_hot,two_hot,three_hot,four_hot,five_hot,five_cold,four_cold,three_cold,two_cold,one_cold) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
             $stmt->bind_param("sssssssssss", $time_2,$one_hot,$two_hot,$three_hot,$four_hot,$five_hot,$five_cold,$four_cold,$three_cold,$two_cold,$one_cold);
			 $time_2 = $opentime;
			 $one_hot = "0";
			 $two_hot = "0";
			 $three_hot = "0";
			 $four_hot = "0";
			 $five_hot = "0";
			 $five_cold = "0";
			 $four_cold = "0";
			 $three_cold ="0";
			 $two_cold = "0" ;
			 $one_cold = "0";
			 for($b=0;$b<count($color_index);$b++){
               if($color_index[$b]==0) $one_hot = "1";
			   if($color_index[$b]==1) $two_hot = "1";
			   if($color_index[$b]==2) $three_hot = "1";
			   if($color_index[$b]==3) $four_hot = "1";
			   if($color_index[$b]==4) $five_hot = "1";
			   if($color_index[$b]==5) $five_cold = "1";
			   if($color_index[$b]==6) $four_cold = "1";
			   if($color_index[$b]==7) $three_cold = "1";
			   if($color_index[$b]==8) $two_cold = "1";
			   if($color_index[$b]==9) $one_cold = "1";
			 }
             $stmt->execute();
			 echo "条件更新成功！";
//return;
$sql = "SELECT  name,num_index,date_or_index,index_2  FROM index_data";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		if($row["name"] == $name){
           $num_index = $row["num_index"];
		   $date_or_index = $row["date_or_index"];
		   $index_2 = $row["index_2"];
		}
	}
}
echo "第五次".date('h：i：s');
if($num_index > 0){
$sql = "SELECT one_hot,two_hot,three_hot,four_hot,five_hot,five_cold,four_cold,three_cold,two_cold,one_cold  FROM ".$name_2." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
        $i=0;
		$array_num_index = [array("index"=>0,"times_count"=>0,"name"=>"one_cold"),array("index"=>0,"times_count"=>0,"name"=>"two_cold"),
		                    array("index"=>0,"times_count"=>0,"name"=>"three_cold"),array("index"=>0,"times_count"=>0,"name"=>"four_cold"),
							array("index"=>0,"times_count"=>0,"name"=>"five_cold"),array("index"=>0,"times_count"=>0,"name"=>"five_hot"),
							array("index"=>0,"times_count"=>0,"name"=>"four_hot"),array("index"=>0,"times_count"=>0,"name"=>"three_hot"),
							array("index"=>0,"times_count"=>0,"name"=>"two_hot"),array("index"=>0,"times_count"=>0,"name"=>"one_hot")];
		while($row = $result->fetch_assoc()){
			echo $row["one_hot"].$row["two_hot"].$row["three_hot"];
			if($row["one_hot"]>0) $array_num_index[9]["index"] += $row["one_hot"];
			if($row["two_hot"]>0) $array_num_index[8]["index"] += $row["two_hot"];
			if($row["three_hot"]>0) $array_num_index[7]["index"] += $row["three_hot"];
			if($row["four_hot"]>0) $array_num_index[6]["index"] += $row["four_hot"];
			if($row["five_hot"]>0) $array_num_index[5]["index"] += $row["five_hot"];
			if($row["five_cold"]>0) $array_num_index[4]["index"] += $row["five_cold"];
			if($row["four_cold"]>0) $array_num_index[3]["index"] += $row["four_cold"];
			if($row["three_cold"]>0) $array_num_index[2]["index"] += $row["three_cold"];
			if($row["two_cold"]>0) $array_num_index[1]["index"] += $row["two_cold"];
			if($row["one_cold"]>0) $array_num_index[0]["index"] += $row["one_cold"];
			$i++;
			if($i>=$num_index) break;
		  }
		//   var_dump($array_num_index);
		  echo "输出！";
	$x=0;

while($x < count($array_num_index)){
	  for($i=0;$i<count($array_num_index);$i++){
	     for($j=0;$j<count($array_num_index);$j++){
		    if($j!=$i && $array_num_index[$i]["index"]== $array_num_index[$j]["index"]){
				$sql = "SELECT one_hot,two_hot,three_hot,four_hot,five_hot,five_cold,four_cold,three_cold,two_cold,one_cold  FROM ".$name_2." order by id desc";
				$result = $conn->query($sql);
				$arr_data = array(array("index"=>0,"times_count"=>0),array("index"=>0,"times_count"=>0));
				if($result->num_rows>0){
				$a = 0;
				while($row = $result->fetch_assoc()){
					$item = ["one_hot","two_hot","three_hot","four_hot","five_hot","five_cold","four_cold","three_cold","two_cold","one_cold"];
					if($a >= $index_2){
						for($b=0;$b<count($item);$b++){
							if($item[$b]==$array_num_index[$i]["name"]){
								$arr_data[0]["index"] += $row[$item[$b]];
							}
							if($item[$b]==$array_num_index[$j]["name"]){
								$arr_data[1]["index"] += $row[$item[$b]];
							}
						 }
					}
					if($arr_data[0]["index"]!=$arr_data[1]["index"]){
					if($arr_data[0]["index"]>$arr_data[1]["index"]){
						$array_num_index[$i]["times_count"] += 0.001;
						}
					break;
					}
					$a++;
				}
			 }
		  }
	   }
	}
	$x++;
}

for($i=0;$i<count($array_num_index);$i++){
	$array_num_index[$i]["index"]= $array_num_index[$i]["times_count"] +  $array_num_index[$i]["index"];
}
	$sql = "update index_data set 
		 one_hot_index=".$array_num_index[0]["index"].
		 ",two_hot_index=".$array_num_index[1]["index"].
		 ",three_hot_index=".$array_num_index[2]["index"].
		",four_hot_index=".$array_num_index[3]["index"].
		",five_hot_index=".$array_num_index[4]["index"].
		",five_cold_index=".$array_num_index[5]["index"].
		",four_cold_index=".$array_num_index[6]["index"].
		",three_cold_index=".$array_num_index[7]["index"].
		",two_cold_index=".$array_num_index[8]["index"].
		",one_cold_index=".$array_num_index[9]["index"]." where name='$name'";
		$res = $conn->query($sql);  
		if(!$res){
			echo '计次失败！';
		}else{
		    echo '计次成功！';
			// var_dump($array_num_index);
		}
    }
}
echo "第六次".date('h：i：s');

$sql = "SELECT  name,one_cold_index,two_cold_index,three_cold_index,four_cold_index,five_cold_index,five_hot_index,four_hot_index,three_hot_index,two_hot_index,one_hot_index,one_num,two_num,three_num,four_num,five_num,six_num,seven_num,eight_num,nine_num,ten_num  FROM index_data";
$result = $conn->query($sql);
if($result ->num_rows>0){
	while($row = $result ->fetch_assoc()){
	if($state =="true"){
		if($row["name"] == $name){
			$arr_index = array(
				          array("index"=>0,"numbers"=>$row["one_cold_index"]),
			              array("index"=>1,"numbers"=>$row["two_cold_index"]),
			              array("index"=>2,"numbers"=>$row["three_cold_index"]),
						  array("index"=>3,"numbers"=>$row["four_cold_index"]),
						  array("index"=>4,"numbers"=>$row["five_cold_index"]),
						  array("index"=>5,"numbers"=>$row["five_hot_index"]),
						  array("index"=>6,"numbers"=>$row["four_hot_index"]),
						  array("index"=>7,"numbers"=>$row["three_hot_index"]),
						  array("index"=>8,"numbers"=>$row["two_hot_index"]),
						  array("index"=>9,"numbers"=>$row["one_hot_index"]));
			foreach($arr_index as $numbers){
                    $arr_numbers[]=$numbers['numbers'];
                   }
            array_multisort($arr_numbers,SORT_ASC,SORT_NUMERIC,$arr_index);
		    // var_dump($arr_index);
			echo $row["one_num"];
			echo $row["two_num"];
			echo $row["three_num"];
			if($row["one_num"]!="无"){
              $one_more = $arr_index[$row["one_num"]]["index"];
			}else{
			  $one_more = "无";
			}
	       	if($row["two_num"]!="无"){
              $two_more =  $arr_index[$row["two_num"]]["index"];
			}else{
			  $two_more = "无";
			}
		    if($row["three_num"]!="无"){
              $three_more = $arr_index[$row["three_num"]]["index"];
			}else{
			  $three_more = "无";
			}
			if($row["four_num"]!="无"){
              $four_more = $arr_index[$row["four_num"]]["index"];
			}else{
			  $four_more = "无";
			}
			if($row["five_num"]!="无"){
              $five_more = $arr_index[$row["five_num"]]["index"];
			}else{
			  $five_more = "无";
			}
			if($row["six_num"]!="无"){
              $six_more = $arr_index[$row["six_num"]]["index"];
			}else{
			  $six_more = "无";
			}
		    if($row["seven_num"]!="无"){
              $seven_more = $arr_index[$row["seven_num"]]["index"];
			}else{
			  $seven_more = "无";
			}
			if($row["eight_num"]!="无"){
              $eight_more = $arr_index[$row["eight_num"]]["index"];
			}else{
			  $eight_more = "无";
			}
			if($row["nine_num"]!="无"){
              $nine_more = $arr_index[$row["nine_num"]]["index"];
			}else{
			  $nine_more = "无";
			}
			if($row["ten_num"]!="无"){
              $ten_more = $arr_index[$row["ten_num"]]["index"];
			}else{
			  $ten_more = "无";
			}
			$sql = "update new_ssc set one_num='$one_more',two_num='$two_more',three_num='$three_more',four_num='$four_more',five_num='$five_more',six_num='$six_more',seven_num='$seven_more',eight_num='$eight_more',nine_num='$nine_more',ten_num='$ten_more' where name='$name'";
			$res = $conn->query($sql);      
			if(!$res){
				echo '修改失败!';
				}else{
				echo '修改成功!';
			}
		}
	  }else{
           break;
		}	
	}
}
for($b=0;$b<6;$b++){
    if($b==0) $obj = &$arrs1;
	if($b==1) $obj = &$arrs2;
	if($b==2) $obj = &$arrs3;
	if($b==3) $obj = &$arrs4;
	if($b==4) $obj = &$arrs5;
	if($b==5) $obj = &$arrs_add;
	if(deal_with_value($obj,$total)==""){
		array_push($arr,"");
	}else {
		array_push($arr,deal_with_value($obj,$total));
	}
}

 echo '{"处理前"：'.$name.'"a":'.$arr[0].',"b":'.$arr[1].',"c":'.$arr[2].',"d":'.$arr[3].',"e":'.$arr[4].',"f":'.$arr[5].'}';

$data = explode(",",$open_num);
$sql = "SELECT name,a,b,c,d,e,f,index1,index2,index3,index4,index5,index6,one_num,two_num,three_num,four_num,five_num,push_nums,nums_index,nums_lose,and_count,and_index,six_num,seven_num,eight_num,nine_num,ten_num  FROM new_ssc";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			 if($row["name"]==$_GET['name']){
				 if($row["one_num"]!="无"){
					  $push_nums .= $arrs_num[$row["one_num"]]["number"];
				 }
				 if($row["two_num"]!="无"){
					  $push_nums .= $arrs_num[$row["two_num"]]["number"];
				 }
				 if($row["three_num"]!="无"){
					  $push_nums .= $arrs_num[$row["three_num"]]["number"];
				 }
				 if($row["four_num"]!="无"){
					  $push_nums .= $arrs_num[$row["four_num"]]["number"];
				 }
				  if($row["five_num"]!="无"){
					  $push_nums .= $arrs_num[$row["five_num"]]["number"];
				 }
				   if($row["six_num"]!="无"){
					  $push_nums .= $arrs_num[$row["six_num"]]["number"];
				 }
				   if($row["seven_num"]!="无"){
					  $push_nums .= $arrs_num[$row["seven_num"]]["number"];
				 }
				   if($row["eight_num"]!="无"){
					  $push_nums .= $arrs_num[$row["eight_num"]]["number"];
				 }
				   if($row["nine_num"]!="无"){
					  $push_nums .= $arrs_num[$row["nine_num"]]["number"];
				 }
				   if($row["ten_num"]!="无"){
					  $push_nums .= $arrs_num[$row["ten_num"]]["number"];
				 }
				  echo "push_nums:".$push_nums;
			 if($row["push_nums"]!=""){
                 $v = 0 ;
				 $x = 0 ;
				 if(mb_strlen($row["push_nums"],"UTF8")==2){
					 echo "推2个球！";
					 $item = 0;
					 for($i=0;$i<4;$i++){
						$item += substr_count($open_num,substr($row["push_nums"], $i, 1));
					  }
                    if($item ==1){
					  $x = $row["and_index"] + 1;
					 if($x>=$row["and_count"]){
                        $sql = "update new_ssc set and_index='0'  where name='$name'";
					 }else{
                       $push_nums = $row["push_nums"];
					   $sql = "update new_ssc set and_index='$x'  where name='$name'";
					   
					 }
			       }
				   if($item==0){
                      $v = $row["nums_index"] + 1;
					  if($v>=$row["nums_lose"]){
							$sql = "update new_ssc set nums_index='0'  where name='$name'";
						}else{
							$sql = "update new_ssc set nums_index='$v'  where name='$name'";
		                    $push_nums = $row["push_nums"];
						}
                        $res = $conn->query($sql); 
				     }
				 if($item >=2){
                    $sql = "update new_ssc set nums_index='0'  where name='$name'";
					$res = $conn->query($sql); 
				  } 
				 }
				 if(mb_strlen($row["push_nums"],"UTF8")==1){
					echo "推1个球！";
                     if(substr_count($open_num,$row["push_nums"]) ==0){
						 $v = $row["nums_index"] + 1;
					     if($v>=$row["nums_lose"]){
							$sql = "update new_ssc set nums_index='0'  where name='$name'";
						  }else{
							$sql = "update new_ssc set nums_index='$v'  where name='$name'";
		                    $push_nums = $row["push_nums"];
						  }
                         $res = $conn->query($sql); 
					 }
					 if(substr_count($open_num,$row["push_nums"]) >=1){
						$sql = "update new_ssc set nums_index='0'  where name='$name'";
					    $res = $conn->query($sql); 
					 }
				 }
				 if(mb_strlen($row["push_nums"],"UTF8")==3){
					echo "推3个球！";
					 $item = 0;
					 for($i=0;$i<3;$i++){
						$item += substr_count($open_num,substr($row["push_nums"], $i, 1));
					  }
					  if($item>=2){
						 echo "大于2";
						 $sql = "update new_ssc set nums_index='0'  where name='$name'";
					     $res = $conn->query($sql); 
					  }else{
						 echo "小于2";
						  $v = $row["nums_index"] + 1;
					     if($v>=$row["nums_lose"]){
							$sql = "update new_ssc set nums_index='0'  where name='$name'";
						  }else{
							$sql = "update new_ssc set nums_index='$v'  where name='$name'";
		                    $push_nums = $row["push_nums"];
						  }
                         $res = $conn->query($sql); 
					 }
				  }
				  if(mb_strlen($row["push_nums"],"UTF8")==4){
					 echo "推4个球！";
					 $item = 0;
					 for($i=0;$i<4;$i++){
						$item += substr_count($open_num,substr($row["push_nums"], $i, 1));
					  }
					  if($item==2){
							$x = $row["and_index"] + 1;
							if($x>=$row["and_count"]){
								$sql = "update new_ssc set and_index='0'  where name='$name'";
							}else{
								$push_nums = $row["push_nums"];
								$sql = "update new_ssc set and_index='$x'  where name='$name'";
							}
					  }
					  if($item>2){
                         $sql = "update new_ssc set nums_index='0'  where name='$name'";
					     $res = $conn->query($sql); 
					  }
                      if($item<2){
                          $v = $row["nums_index"] + 1;
					      if($v>=$row["nums_lose"]){
							$sql = "update new_ssc set nums_index='0'  where name='$name'";
						  }else{
							$sql = "update new_ssc set nums_index='$v'  where name='$name'";
		                    $push_nums = $row["push_nums"];
						  }
                         $res = $conn->query($sql); 
					  }
				  }
				 if(mb_strlen($row["push_nums"],"UTF8")==5){
					echo "推5个球！";
					 $item = 0;
					 for($i=0;$i<5;$i++){
						$item += substr_count($open_num,substr($row["push_nums"], $i, 1));
					  }
					  echo $item;
					  if($item>2){
						 $sql = "update new_ssc set nums_index='0'  where name='$name'";
					     $res = $conn->query($sql); 
					  }else{
						  $v = $row["nums_index"] + 1;
					     if($v>=$row["nums_lose"]){
							$sql = "update new_ssc set nums_index='0'  where name='$name'";
						  }else{
							$sql = "update new_ssc set nums_index='$v'  where name='$name'";
		                    $push_nums = $row["push_nums"];
						  }
                         $res = $conn->query($sql); 
					 }
				  }
			  }
			   for($n1 = 0 ; $n1<5;$n1++){
				   $obj = "";
				   $obj_index = "";
				   $obj_arr = "";
				   if($n1 == 0){
                     $obj = $row["a"];
					 $obj_index = "index1";
					 $obj_arr = $data[0];
				   }
				   	if($n1 == 1){
                     $obj = $row["b"];
					 $obj_index = "index2";
					 $obj_arr = $data[1];
				   }
				   	if($n1 == 2){
                     $obj = $row["c"];
					 $obj_index = "index3";
					 $obj_arr = $data[2];
				   }
				   	if($n1 == 3){
                     $obj = $row["d"];
					 $obj_index = "index4";
					 $obj_arr = $data[3];
				   }
				   if($n1 == 4){
                     $obj = $row["e"];
					 $obj_index = "index5";
					 $obj_arr = $data[4];
				   }
				  if($obj !=""){
					 $v = 0 ;
					 $nums = 0 ;
                     $mm ="";
					if($obj_arr == "0" || $obj_arr == "2" || $obj_arr == "4" ) $mm="小双";
					if($obj_arr == "1" || $obj_arr == "3" ) $mm="小单";
					if($obj_arr == "6" || $obj_arr == "8" ) $mm="大双";
					if($obj_arr == "5" || $obj_arr == "7" || $obj_arr == "9" ) $mm="大单";
					$one = substr($obj, 0, 3);
					$two = substr($obj, 3, 6);
					if(!strstr($mm,$one) && !strstr($mm,$two)){
						$v = $row[$obj_index] + 1;
						echo $obj_index .$v;
						if($v>=$total_lose){
							$sql = "update new_ssc set ".$obj_index."='0'  where name='$name'";
							$res = $conn->query($sql); 
							$arr[$n1] = "";
						}else{
							$sql = "update new_ssc set ".$obj_index."='$v'  where name='$name'";
							$res = $conn->query($sql); 
							$arr[$n1] = $obj;
						}
						}
					if(strstr($mm,$one) && strstr($mm,$two)){
							$sql = "update new_ssc set ".$obj_index."='0'  where name='$name'";
							$res = $conn->query($sql); 
							}
					if(!strstr($mm,$one) && $v<$total_lose && strstr($mm,$two) || strstr($mm,$one) && $v<$total_lose && !strstr($mm,$two)){
								$arr[$n1] = $obj;
							}
					}
			   }
		
				if($row["f"] !=""){
					 $v = 0 ;
					 $nums = 0 ;
					for($j=0;$j<count($data);$j++){
					$nums = $nums + (int)$data[$j];
					}
					if($nums<10) $nums ="0".$nums;
						$mm ="";
					if($nums>22&&substr($nums, 1, 2)%2==0){
						$mm="大双";
					}else if($nums>22&&substr($nums, 1, 2)%2!=0){
						$mm="大单";
					}else if($nums<=22&&substr($nums, 1, 2)%2!=0){
						$mm="小单";
					}else{
						$mm="小双";
						}
					$one = substr($row["f"], 0, 3);
					$two = substr($row["f"], 3, 6);

					if(!strstr($mm,$one) && !strstr($mm,$two)){
						$v = $row["index6"] + 1;
						echo "index6:" .$v;
						if($v>=$total_lose){
							$sql = "update new_ssc set index6='0'  where name='$name'";
							$res = $conn->query($sql); 
							$arr[5] = "";
						}else{
							$sql = "update new_ssc set index6='$v'  where name='$name'";
							$res = $conn->query($sql); 
							$arr[5] = $row["f"];
						}
						}
					if(strstr($mm,$one) && strstr($mm,$two)){
							$sql = "update new_ssc set index6='0'  where name='$name'";
							$res = $conn->query($sql); 
							}
					if(!strstr($mm,$one) && $v<$total_lose && strstr($mm,$two) || strstr($mm,$one) && $v<$total_lose && !strstr($mm,$two)){
								$arr[5] = $row["f"];
							}
					}
			 } 
		}
}

// $sql = "SELECT issue,num,push_nums,a,b,c,d,e FROM ".$name." order by id desc";
// $result = $conn->query($sql);
// if($result->num_rows>0){
// 	$i = 0;
// 	$n1 = 0;
// 	$n2 = 0;
// 	$n3 = 0;
// 	$n4 = 0;
// 	$n5 = 0;
// 	$buff1 = false;
// 	$buff2 = false;
// 	$buff3 = false;
// 	$buff4 = false;
// 	$buff5 = false;
// 	$init = false;
// 	while($row = $result->fetch_assoc()){
// 			$item = explode(",",$row["num"]);
// 		if($buff1 == false && $arr[0]!=""){
// 			if($row["a"]!=""){
// 				if(mb_substr($row["a"],0,1,'utf-8')=="小" && $item[0]>=5 || mb_substr($row["a"],0,1,'utf-8')=="大" && $item[0]<5){
// 					$buff1 = true;
// 					if($n1==6 || $n1==7){
//                        if(mb_substr($arr[0],0,1,'utf-8')=="小")$arr[0]="大".mb_substr($arr[0],1,1,'utf-8');
// 					   if(mb_substr($arr[0],0,1,'utf-8')=="大")$arr[0]="小".mb_substr($arr[0],1,1,'utf-8');
// 					}
// 				}
// 			}
// 		}else{
// 			$buff1 = true;
// 		}
// 		if($buff2 == false && $arr[1]!=""){
// 			if($row["b"]!=""){
// 				if(mb_substr($row["b"],0,1,'utf-8')=="小" && $item[1]>=5 || mb_substr($row["b"],0,1,'utf-8')=="大" && $item[1]<5){
// 					$buff2 = true;
// 					if($n2==6 || $n2==7){
//                        if(mb_substr($arr[1],0,1,'utf-8')=="小")$arr[1]="大".mb_substr($arr[1],1,1,'utf-8');
// 					   if(mb_substr($arr[1],0,1,'utf-8')=="大")$arr[1]="小".mb_substr($arr[1],1,1,'utf-8');
// 					}
// 				}
// 			}
// 		}else{
// 			$buff2 = true;
// 		}
// 		if($buff3 == false && $arr[2]!=""){
// 			if($row["c"]!=""){
// 				if(mb_substr($row["c"],0,1,'utf-8')=="小" && $item[2]>=5 || mb_substr($row["c"],0,1,'utf-8')=="大" && $item[2]<5){
// 					$buff3 = true;
// 					if($n3==6 || $n3==7){
//                        if(mb_substr($arr[2],0,1,'utf-8')=="小")$arr[2]="大".mb_substr($arr[2],1,1,'utf-8');
// 					   if(mb_substr($arr[2],0,1,'utf-8')=="大")$arr[2]="小".mb_substr($arr[2],1,1,'utf-8');
// 					}
// 				}
// 			}
// 		}else{
// 			$buff3 = true;
// 		}
// 		if($buff4 == false && $arr[3]!=""){
// 			if($row["d"]!=""){
// 				if(mb_substr($row["d"],0,1,'utf-8')=="小" && $item[3]>=5 || mb_substr($row["d"],0,1,'utf-8')=="大" && $item[3]<5){
// 					$buff4 = true;
// 					if($n4==6 || $n4==7){
//                        if(mb_substr($arr[3],0,1,'utf-8')=="小")$arr[3]="大".mb_substr($arr[3],1,1,'utf-8');
// 					   if(mb_substr($arr[3],0,1,'utf-8')=="大")$arr[3]="小".mb_substr($arr[3],1,1,'utf-8');
// 					}
// 				}
// 			}
// 		}else{
// 			$buff4 = true;
// 		}
// 		if($buff5 == false && $arr[4]!=""){
// 			if($row["e"]!=""){
// 				if(mb_substr($row["e"],0,1,'utf-8')=="小" && $item[1]>=5 || mb_substr($row["e"],0,1,'utf-8')=="大" && $item[1]<5){
// 					$buff5 = true;
// 					if($n5==6 || $n5==7){
//                        if(mb_substr($arr[4],0,1,'utf-8')=="小")$arr[4]="大".mb_substr($arr[4],1,1,'utf-8');
// 					   if(mb_substr($arr[4],0,1,'utf-8')=="大")$arr[4]="小".mb_substr($arr[4],1,1,'utf-8');
// 					}
// 				}
// 			}
// 		}else{
// 			$buff5 = true;
// 		}
// 		if($buff1 ==true && $buff2 ==true && $buff3 ==true && $buff4 ==true  && $buff5 ==true){
// 			   break;
// 			}
// 		$i++;
// 		if($row["a"]!="")$n1++;
// 		if($row["b"]!="")$n2++;
// 		if($row["c"]!="")$n3++;
// 		if($row["d"]!="")$n4++;
// 		if($row["e"]!="")$n5++;
// 	}
// }

// $sql = "SELECT issue,num,push_nums,a,b,c,d,e FROM ".$name." order by id desc";
// $result = $conn->query($sql);
// if($result->num_rows>0){
// 	$i = 0;
// 	$n1 = 0;
// 	$n2 = 0;
// 	$n3 = 0;
// 	$n4 = 0;
// 	$n5 = 0;
// 	$buff1 = false;
// 	$buff2 = false;
// 	$buff3 = false;
// 	$buff4 = false;
// 	$buff5 = false;
// 	while($row = $result->fetch_assoc()){
// 			$item = explode(",",$row["num"]);
// 		if($buff1 == false && $arr[0]!=""){
// 			if($row["a"]!=""){
// 				if(mb_substr($row["a"],1,1,'utf-8')=="单" && $item[0]%2==0 || mb_substr($row["a"],1,1,'utf-8')=="双" && $item[0]%2!=0){
// 					$buff1 = true;
// 					if($n1==6 || $n1==7){
//                        if(mb_substr($arr[0],1,1,'utf-8')=="单")$arr[0]=mb_substr($arr[0],0,1,'utf-8')."双";
// 					   if(mb_substr($arr[0],1,1,'utf-8')=="双")$arr[0]=mb_substr($arr[0],0,1,'utf-8')."单";
// 					}
// 				}
// 			}
// 		}else{
// 			$buff1 = true;
// 		}
// 		if($buff2 == false && $arr[1]!=""){
// 			if($row["b"]!=""){
// 				if(mb_substr($row["b"],1,1,'utf-8')=="单" && $item[1]%2==0 || mb_substr($row["b"],1,1,'utf-8')=="双" && $item[1]%2!=0){
// 					$buff2 = true;
// 					if($n2==6 || $n2==7){
//                        if(mb_substr($arr[1],1,1,'utf-8')=="单")$arr[1]=mb_substr($arr[1],0,1,'utf-8')."双";
// 					   if(mb_substr($arr[1],1,1,'utf-8')=="双")$arr[1]=mb_substr($arr[1],0,1,'utf-8')."单";
// 					}
// 				}
// 			}
// 		}else{
// 			$buff2 = true;
// 		}
// 		if($buff3 == false && $arr[2]!=""){
// 			if($row["c"]!=""){
// 				if(mb_substr($row["c"],1,1,'utf-8')=="单" && $item[2]%2==0 || mb_substr($row["c"],1,1,'utf-8')=="双" && $item[2]%2!=0){
// 					$buff3 = true;
// 					if($n3==6 || $n3==7){
//                        if(mb_substr($arr[2],1,1,'utf-8')=="单")$arr[2]=mb_substr($arr[2],0,1,'utf-8')."双";
// 					   if(mb_substr($arr[2],1,1,'utf-8')=="双")$arr[2]=mb_substr($arr[2],0,1,'utf-8')."单";
// 					}
// 				}
// 			}
// 		}else{
// 			$buff3 = true;
// 		}
// 		if($buff4 == false && $arr[3]!=""){
// 			if($row["d"]!=""){
// 				if(mb_substr($row["d"],1,1,'utf-8')=="单" && $item[3]%2==0 || mb_substr($row["d"],1,1,'utf-8')=="双" && $item[3]%2!=0){
// 					$buff4 = true;
// 					if($n4==6 || $n4==7){
//                        if(mb_substr($arr[3],1,1,'utf-8')=="单")$arr[3]=mb_substr($arr[3],0,1,'utf-8')."双";
// 					   if(mb_substr($arr[3],1,1,'utf-8')=="双")$arr[3]=mb_substr($arr[3],0,1,'utf-8')."单";
// 					}
// 				}
// 			}
// 		}else{
// 			$buff4 = true;
// 		}
// 		if($buff5 == false && $arr[4]!=""){
// 			if($row["e"]!=""){
// 				if(mb_substr($row["e"],1,1,'utf-8')=="单" && $item[4]%2==0 || mb_substr($row["e"],1,1,'utf-8')=="双" && $item[4]%2!=0){
// 					$buff5 = true;
// 					if($n5==6 || $n5==7){
//                        if(mb_substr($arr[4],1,1,'utf-8')=="单")$arr[4]=mb_substr($arr[4],0,1,'utf-8')."双";
// 					   if(mb_substr($arr[4],1,1,'utf-8')=="双")$arr[4]=mb_substr($arr[4],0,1,'utf-8')."单";
// 					}
// 				}
// 			}
// 		}else{
// 			$buff5 = true;
// 		}
// 		if($buff1 ==true && $buff2 ==true && $buff3 ==true && $buff4 ==true  && $buff5 ==true){
// 			   break;
// 			}
// 		$i++;
// 		if($row["a"]!="")$n1++;
// 		if($row["b"]!="")$n2++;
// 		if($row["c"]!="")$n3++;
// 		if($row["d"]!="")$n4++;
// 		if($row["e"]!="")$n5++;
// 	}
// }

$sql = "update new_ssc set a='$arr[0]',b='$arr[1]',c='$arr[2]',d='$arr[3]',e='$arr[4]',f='$arr[5]',opentime='$opentime',lotterytime='$lottery_time',num='$open_num',push_nums='$push_nums' where name='$name'";
// $sql = "update new_ssc set opentime='$opentime',lotterytime='$lottery_time',num='$open_num',push_nums='$push_nums' where name='$name'";
$res = $conn->query($sql);  
if(!$res){
    echo '{"msg":"插入失败"}';
    }else{
    echo '{"msg":"插入成功"}';
 }
//  echo '{"处理后：""a":'.$arr[0].',"b":'.$arr[1].',"c":'.$arr[2].',"d":'.$arr[3].',"e":'.$arr[4].',"push_nums":'.$push_nums.' }';

$now_lose_text="";

for($i=0;$i<count($case_array);$i++){
	if($i==count($case_array)-1){
       $now_lose_text .= $case_array[$i]["name"]."_".$case_array[$i]["index"];
	}else{
       $now_lose_text .= $case_array[$i]["name"]."_".$case_array[$i]["index"]."&";
	}
}

$sql = "update push_data set push_date='$opentime',push_num='$open_num',push_nums='$push_nums',now_lose_text='$now_lose_text'  where name='$name'";
$res = $conn->query($sql);      
if(!$res){
	echo '自动投注失败！';
	}else{
	echo '自动投注成功!';
}

// if($name=="cqssc") $sendname = '重庆时时彩'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
// if($name=="tjssc" && $name=="txffc") 
// if($name=="tjssc") $sendname = '天津时时彩'.substr($opentime,13,19).'期开奖号码'."：".$open_num ;
// if($name=="bjssc") $sendname = '北京时时彩'.$opentime.'期开奖号码'."：".$open_num;
// if($name=="twssc") $sendname = '台湾五分彩'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
// require 'jpush/autoload.php';
// use JPush\Client as JPush;
// $client = new JPush("8c5cc25f42734c1b8db29c22", "a41a33c7144819b408c9419f");
// $client->push()
//     ->setPlatform('all')
//     ->addAllAudience()
// 	->message($sendname)
//     ->send();

function compute_arr3($index){
   $obj = &$GLOBALS['arrs_num'];
   $obj[$index]["index"] += 1;
}
function deal_with_value($obj,$n){
    $back_value="";
for($i=0;$i<count($obj);$i++){
   if($obj[$i]>=$n){
	   echo "超过5期：".$i."|";
		 if($i%2==0){
			if($obj[$i+1]==0){
               $back_value = BackData($i+1);
			   break;
			}
		}else{
            if($obj[$i-1]==0){
                 $back_value = BackData($i-1);
				 break;
				}
			}
		 }
	 }
return $back_value;
}
function get_num($obj){
   if($obj == "1" || $obj == "3" ){
			$items = "小单";
		}else if($obj == "0" || $obj == "2" || $obj == "4" ){
			$items = "小双";
		}else if( $obj == "5" || $obj == "7" || $obj == "9"){
			$items = "大单";
		}else if( $obj == "6" || $obj == "8"){
			$items = "大双";
		}
		return $items;
}
function set_array($value,$index){
	$obj = [];
	if($index  == 1) $obj = &$GLOBALS['arrs1'];
	if($index  == 2) $obj = &$GLOBALS['arrs2'];
	if($index  == 3) $obj = &$GLOBALS['arrs3'];
	if($index  == 4) $obj = &$GLOBALS['arrs4'];
	if($index  == 5) $obj = &$GLOBALS['arrs5'];
	if($index  == 6) $obj = &$GLOBALS['arrs_add'];
	 
	if($value == "大双") $obj[0] +=  1;
	if($value == "小单") $obj[1] +=  1;
	if($value == "小双") $obj[2] +=  1;
	if($value == "大单") $obj[3] +=  1;
}
function BackData($index){
	if($index == 0) return "大双";
	if($index == 1) return "小单";
	if($index == 2) return "小双";
	if($index == 3) return "大单";
}
?>
