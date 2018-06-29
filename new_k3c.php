<?php 
require  'header.php';
global $conn,$arr,$back_data,$data,$opentime,$open_num,$lottery_time,$name,$total,$total_lose,$arrs,$arrs1,$arrs2,$times_count,$times_count2,$arrs_num,$x,$e,$push_nums,$nums_lose,$nums_index,$buff,$init_money,$buy_money,$color_index,$one_more,$two_more,$three_more,$state,$num_index,$date_or_index,$index_2;
$push_nums="";
$arr = array();
$color_index = array();
$arrs2 = array(0,0,0,0);
$arrs_num = array(array("number"=>1,"index"=>0,"times_count"=>0),array("number"=>2,"index"=>0,"times_count"=>0),array("number"=>3,"index"=>0,"times_count"=>0),array("number"=>4,"index"=>0,"times_count"=>0),array("number"=>5,"index"=>0,"times_count"=>0),array("number"=>6,"index"=>0,"times_count"=>0));
$name = $_GET["name"];
$sql = "SELECT opentime,name,total,total_lose,times_count,times_count2,nums_lose,nums_index,state FROM new_k3c";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			 if($row["name"]==$name){
                    $opentime = $row["opentime"];
					$total = $row["total"];
					$total_lose = $row["total_lose"];
					$nums_lose = $row["nums_lose"];
					$nums_index = $row["nums_index"];
					$times_count = $row["times_count"];
					$times_count2 = $row["times_count2"];
					$state = $row["state"];
					// echo "first:" . $first."last:".$last."total:".$total."first_lose:" . $first_lose."last_lose:".$last_lose."total_lose:".$total_lose;

			 };
		}
}
$sql = "SELECT  issue, num, lotterytime  FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
	  $i = 0;
	  $x = 1;
	  $buff = true;
		while($row = $result->fetch_assoc()){
			$item = explode(",",$row["num"]);
		  if($i <= $times_count2 - 1){
              for($j=0;$j<count($item);$j++){
				  compute_arr3($item[$j]);
			  }
		  }
		//总和
		  if($i <= $times_count - 1){
                $add_num = $item[0] + $item[1] + $item[2];
				//echo "add:".$add_num;
						if($add_num<10) $add_num ="0".$add_num;
						$mm ="";
						if($add_num>10&&substr($add_num, 1, 2)%2==0){
                            $mm="大双";
						}else if($add_num>10&&substr($add_num, 1, 2)%2!=0){
                            $mm="大单";
						}else if($add_num<=10&&substr($add_num, 1, 2)%2!=0){
							$mm="小单";
						}else{
							$mm="小双";
						}
			   set_array($mm,3);
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
		}
	}
foreach($arrs_num as $val){
$key_arrays[]=$val['index'];
}
array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$arrs_num);
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
$arrays[]=$value['index'];
}
array_multisort($arrays,SORT_ASC,SORT_NUMERIC,$arrs_num);
var_dump($arrs_num);

$sql = "SELECT  name,one_cold,two_cold,three_cold,three_hot,two_hot,one_hot,one_cold_index,two_cold_index,three_cold_index,three_hot_index,two_hot_index,one_hot_index,one_num,two_num,three_num,date_or_index  FROM index_data";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
           if($row["name"] == $name){
			$obj_text = ["one_cold","two_cold","three_cold","three_hot","two_hot","one_hot"];
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
$color = implode(",",$color_index);
$sql = "update index_data set one_cold=".$arrs_num[0]['number'].",two_cold=".$arrs_num[1]['number'].",three_cold=".$arrs_num[2]['number'].",three_hot=".$arrs_num[3]['number'].",two_hot=".$arrs_num[4]['number'].",one_hot=".$arrs_num[5]['number'].",color_index='$color' where name='$name'";
$res = $conn->query($sql);      
if(!$res){
    echo '记录失败！';
    }else{
    echo '记录成功！';
 }

$name_2 = $name."_2";
$stmt = $conn->prepare("INSERT INTO $name_2 (time,one_hot,two_hot,three_hot,three_cold,two_cold,one_cold) VALUES(?,?,?,?,?,?,?)");
             $stmt->bind_param("sssssss", $time_2,$one_hot,$two_hot,$three_hot,$three_cold,$two_cold,$one_cold);
			 $time_2 = $opentime;
			 $one_hot = "0";
			 $two_hot = "0";
			 $three_hot = "0";
			 $three_cold ="0";
			 $two_cold = "0" ;
			 $one_cold = "0";
			 for($b=0;$b<count($color_index);$b++){
               if($color_index[$b]==0) $one_hot = "1";
			   if($color_index[$b]==1) $two_hot = "1";
			   if($color_index[$b]==2) $three_hot = "1";
			   if($color_index[$b]==3) $three_cold = "1";
			   if($color_index[$b]==4) $two_cold = "1";
			   if($color_index[$b]==5) $one_cold = "1";
			 }
             $stmt->execute();
			 echo "条件更新成功！";

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
if($num_index > 0){
$sql = "SELECT one_hot,two_hot,three_hot,three_cold,two_cold,one_cold  FROM ".$name_2." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
        $i=0;
        $array_num_index = [array("index"=>0,"times_count"=>0,"name"=>"one_cold"),array("index"=>0,"times_count"=>0,"name"=>"two_cold"),
		                    array("index"=>0,"times_count"=>0,"name"=>"three_cold"),array("index"=>0,"times_count"=>0,"name"=>"three_hot"),
							array("index"=>0,"times_count"=>0,"name"=>"two_hot"),array("index"=>0,"times_count"=>0,"name"=>"one_hot")];
		while($row = $result->fetch_assoc()){
			if($row["one_hot"]>0) $array_num_index[5]["index"] += $row["one_hot"];
			if($row["two_hot"]>0) $array_num_index[4]["index"] += $row["two_hot"];
			if($row["three_hot"]>0) $array_num_index[3]["index"] += $row["three_hot"];
			if($row["three_cold"]>0) $array_num_index[2]["index"] += $row["three_cold"];
			if($row["two_cold"]>0) $array_num_index[1]["index"] += $row["two_cold"];
			if($row["one_cold"]>0) $array_num_index[0]["index"] += $row["one_cold"];
			$i++;
			if($i>=$num_index) break;
		  }
	$x=0;
while($x < count($array_num_index)){
	  for($i=0;$i<count($array_num_index);$i++){
	     for($j=0;$j<count($array_num_index);$j++){
		    if($j!=$i && $array_num_index[$i]["index"]== $array_num_index[$j]["index"]){
				$sql = "SELECT one_hot,two_hot,three_hot,three_cold,two_cold,one_cold  FROM ".$name_2." order by id desc";
				$res = $conn->query($sql);
				$arr_data = array(array("index"=>0,"times_count"=>0),array("index"=>0,"times_count"=>0));
				if($res->num_rows>0){
				$a = 0;
				while($row = $res->fetch_assoc()){
					$item = ["one_hot","two_hot","three_hot","three_cold","two_cold","one_cold"];
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
var_dump($array_num_index);
	$sql = "update index_data set 
		 one_hot_index=".$array_num_index[0]["index"].
		 ",two_hot_index=".$array_num_index[1]["index"].
		 ",three_hot_index=".$array_num_index[2]["index"].
		",three_cold_index=".$array_num_index[3]["index"].
		",two_cold_index=".$array_num_index[4]["index"].
		",one_cold_index=".$array_num_index[5]["index"]." where name='$name'";
		$res = $conn->query($sql);  
		if(!$res){
			echo '计次失败！';
		}else{
		    echo '计次成功！';
		}
    }
}
$sql = "SELECT  name,one_cold_index,two_cold_index,three_cold_index,three_hot_index,two_hot_index,one_hot_index,one_num,two_num,three_num,four_num,five_num,six_num  FROM index_data";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
	if($state =="true"){
		if($row["name"] == $name){
			$arr_index = array(
				          array("index"=>1,"numbers"=>$row["one_cold_index"]),
			              array("index"=>2,"numbers"=>$row["two_cold_index"]),
			              array("index"=>3,"numbers"=>$row["three_cold_index"]),
						  array("index"=>4,"numbers"=>$row["three_hot_index"]),
						  array("index"=>5,"numbers"=>$row["two_hot_index"]),
						  array("index"=>6,"numbers"=>$row["one_hot_index"]));
			foreach($arr_index as $numbers){
                    $arr_numbers[]=$numbers['numbers'];
                   }
            array_multisort($arr_numbers,SORT_ASC,SORT_NUMERIC,$arr_index);
		    var_dump($arr_index);
			echo $row["one_num"];
			echo $row["two_num"];
			echo $row["three_num"];
			if($row["one_num"]!="无"){
              $one_more = $arr_index[$row["one_num"]-1]["index"];
			}else{
			  $one_more = "无";
			}
	       	if($row["two_num"]!="无"){
              $two_more =  $arr_index[$row["two_num"]-1]["index"];
			}else{
			  $two_more = "无";
			}
		    if($row["three_num"]!="无"){
              $three_more = $arr_index[$row["three_num"]-1]["index"];
			}else{
			  $three_more = "无";
			}
			if($row["four_num"]!="无"){
              $four_more = $arr_index[$row["four_num"]-1]["index"];
			}else{
			  $four_more = "无";
			}
			if($row["five_num"]!="无"){
              $five_more = $arr_index[$row["five_num"]-1]["index"];
			}else{
			  $five_more = "无";
			}
			if($row["six_num"]!="无"){
              $six_more = $arr_index[$row["six_num"]-1]["index"];
			}else{
			  $six_more = "无";
			}
			$sql = "update new_k3c set one_num='$one_more',two_num='$two_more',three_num='$three_more',four_num='$four_more',five_num='$five_more',six_num='$six_more'  where name='$name'";
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

function compute_arr3($index){
   $obj = &$GLOBALS['arrs_num'];
   $obj[$index-1]["index"] += 1;
}
function deal_with_value($obj,$n,$r){
    $back_value="";
for($i=0;$i<count($obj);$i++){
   if($obj[$i]>=$n){
		 if($i%2==0){
			if($obj[$i+1]==0){
			   if($r){
                 $back_value = BackData($i+1,true);
			   }else{
                 $back_value = BackData($i+1);
			   } 
               
			   break;
				}
		}else{
            if($obj[$i-1]==0){
			 if($r){
                 $back_value = BackData($i-1,true);
			   }else{
                 $back_value = BackData($i-1);
			   } 
				break;
				}
			}
		 }
	 }
return $back_value;
}
if(deal_with_value($arrs2,$total)==""){
   var_dump($arrs2);
   array_push($arr,"");
}else {
	var_dump($arrs2);
	array_push($arr,deal_with_value($arrs2,$total,true));
}

echo '{"处理前"：'.$name.'"总和":'.$arr[0].'}';

$data = explode(",",$open_num);
$sql = "SELECT name,total_index,one_num,two_num,three_num,four_num,five_num,six_num,push_num,push_nums,nums_lose,nums_index,and_count,and_index FROM new_k3c";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			 if($row["name"]==$_GET['name']){
				 if($row["one_num"]!="无"){
					  $push_nums .= $arrs_num[$row["one_num"]-1]["number"];
				 }
				 if($row["two_num"]!="无"){
					  $push_nums .= $arrs_num[$row["two_num"]-1]["number"];
				 }
				 if($row["three_num"]!="无"){
					  $push_nums .= $arrs_num[$row["three_num"]-1]["number"];
				 }
				if($row["four_num"]!="无"){
					  $push_nums .= $arrs_num[$row["four_num"]-1]["number"];
				 }
				 if($row["five_num"]!="无"){
					  $push_nums .= $arrs_num[$row["five_num"]-1]["number"];
				 }
				 if($row["six_num"]!="无"){
					  $push_nums .= $arrs_num[$row["six_num"]-1]["number"];
				 }

				echo "push_nums:".$push_nums;
			  if($row["push_nums"]!=""){
				  $v = 0 ;
				  $x = 0 ;
				  if(mb_strlen($row["push_nums"],"UTF8")==2){
					  echo "推2个球！";
						if(substr_count($open_num,substr($row["push_nums"], 0, 1)) ==0 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==1 || 
						   substr_count($open_num,substr($row["push_nums"], 0, 1)) ==1 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==0){
							$x = $row["and_index"] + 1;
							if($x>=$row["and_count"]){
							$sql = "update new_k3c set and_index='0'  where name='$name'";
							}else{
							$push_nums = $row["push_nums"];
							$sql = "update new_k3c set and_index='$x'  where name='$name'";
							}
						}
						if(substr_count($open_num,substr($row["push_nums"], 0, 1)) ==0 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==0){
							$v = $row["nums_index"] + 1;
							if($v>=$row["nums_lose"]){
									$sql = "update new_k3c set nums_index='0'  where name='$name'";
								}else{
									$sql = "update new_k3c set nums_index='$v'  where name='$name'";
									$push_nums = $row["push_nums"];
								}
								$res = $conn->query($sql); 
						}
						if(substr_count($open_num,substr($row["push_nums"], 0, 1)) >=1 && substr_count($open_num,substr($row["push_nums"], 1, 2)) >=1 || 
						   substr_count($open_num,substr($row["push_nums"], 0, 1)) >=2 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==0 ||
						   substr_count($open_num,substr($row["push_nums"], 0, 1)) ==0 && substr_count($open_num,substr($row["push_nums"], 1, 2)) >=2){
							$sql = "update new_k3c set nums_index='0'  where name='$name'";
							$res = $conn->query($sql); 
						}
				  }
                  if(mb_strlen($row["push_nums"],"UTF8")==1){
					   echo "推1个球！";
						if(substr_count($open_num,$row["push_nums"]) ==0){
							$v = $row["nums_index"] + 1;
							if($v>=$row["nums_lose"]){
									$sql = "update new_k3c set nums_index='0'  where name='$name'";
								}else{
									$sql = "update new_k3c set nums_index='$v'  where name='$name'";
									$push_nums = $row["push_nums"];
								}
								$res = $conn->query($sql); 
						}
						if(substr_count($open_num,$row["push_nums"]) >=1){
							$sql = "update new_k3c set nums_index='0'  where name='$name'";
							$res = $conn->query($sql); 
						}
				  }
				 if(mb_strlen($row["push_nums"],"UTF8")==3){
					 echo "推3个球！";
					 $item = 0;
					 for($i=0;$i<3;$i++){
						$item += substr_count($open_num,substr($row["push_nums"], $i, 1));
					  }
					 echo $item;
					 if($item < 2){
							$v = $row["nums_index"] + 1;
							if($v>=$row["nums_lose"]){
									$sql = "update new_k3c set nums_index='0'  where name='$name'";
								}else{
									$sql = "update new_k3c set nums_index='$v'  where name='$name'";
									$push_nums = $row["push_nums"];
								}
								$res = $conn->query($sql); 
						}else{
							$sql = "update new_k3c set nums_index='0'  where name='$name'";
							$res = $conn->query($sql); 
					}
				 }
			  }
			  
			  if($row["push_num"] !=""){
					 $v = 0 ;
					 $nums = 0 ;
				for($j=0;$j<count($data);$j++){
	              $nums = $nums + (int)$data[$j];
                }
				if($nums<10) $nums ="0".$nums;
				$mm ="";
				if($nums>10&&substr($nums, 1, 2)%2==0){
                    $mm="大双";
				}else if($nums>10&&substr($nums, 1, 2)%2!=0){
                    $mm="大单";
				}else if($nums<=10&&substr($nums, 1, 2)%2!=0){
					$mm="小单";
				}else{
					$mm="小双";
					}
				$one = substr($row["push_num"], 0, 3);
				$two = substr($row["push_num"], 3, 6);

                 if(!strstr($mm,$one) && !strstr($mm,$two)){
					$v = $row["total_index"] + 1;
					echo "total_index:" .$v;
					if($v>=$total_lose){
						$sql = "update new_k3c set total_index='0'  where name='$name'";
						$res = $conn->query($sql); 
						$arr[0] = "";
					 }else{
						$sql = "update new_k3c set total_index='$v'  where name='$name'";
						$res = $conn->query($sql); 
						$arr[0] = $row["push_num"];
					  }
					}
				  if(strstr($mm,$one) && strstr($mm,$two)){
                        $sql = "update new_k3c set total_index='0'  where name='$name'";
						$res = $conn->query($sql); 
						}
                  if(!strstr($mm,$one) && $v<$total_lose && strstr($mm,$two) || strstr($mm,$one) && $v<$total_lose && !strstr($mm,$two)){
							  $arr[0] = $row["push_num"];
						 }
					}
			 } 
		}
}
echo $arr[0]."-".$opentime."-".$lottery_time."-".$open_num."-".$name."-".$push_nums;
$sql = "update new_k3c set push_num='$arr[0]',opentime='$opentime',lotterytime='$lottery_time',num='$open_num',push_nums='$push_nums' where name='$name'";
$res = $conn->query($sql);      
if(!$res){
    echo '{"msg":"插入失败"}';
    }else{
    echo '{"msg":"插入成功"}';
 }
 echo '{"处理后"：'.$name.'"总和":'.$arr[0].'}';	
 if($name=="jsk3") $sendname = '江苏快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
 if($name=="ahk3") $sendname = '安徽快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
 if($name=="gxk3") $sendname = '广西快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
 if($name=="shk3") $sendname = '上海快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
 if($name=="jxk3") $sendname = '江西快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
 if($name=="hubeik3") $sendname = '湖北快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
 if($name=="hebeik3") $sendname = '河北快三'.substr($opentime,13,19).'期开奖号码'."：".$open_num;
require 'jpush/autoload.php';
use JPush\Client as JPush;
$client = new JPush("8c5cc25f42734c1b8db29c22", "a41a33c7144819b408c9419f");
$client->push()
    ->setPlatform('all')
    ->addAllAudience()
	->message($sendname)
    ->send();
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
function set_array($value,$obj){
	if($obj==1){
    $obj = &$GLOBALS["arrs"];
	}else if($obj==2){
    $obj = &$GLOBALS["arrs1"];
	}else{
		$obj = &$GLOBALS["arrs2"];
		if($value == "大双") $obj[0] +=  1;
	    if($value == "小单") $obj[1] +=  1;
		if($value == "小双") $obj[2] +=  1;
		if($value == "大单") $obj[3] +=  1;
		return ;
	}
     if($value == "大大") $obj[0]  += 1;
	 if($value == "大小") $obj[2] +=  1;
	 if($value == "大单") $obj[4] +=  1;
	 if($value == "大双") $obj[6] +=  1;
	 if($value == "小大") $obj[3] +=  1;
	 if($value == "小小") $obj[1] +=  1;
	 if($value == "小单") $obj[7] +=  1;
	 if($value == "小双") $obj[5] +=  1;
	 if($value == "单大") $obj[8] +=  1;
	 if($value == "单双") $obj[14] +=  1;
	 if($value == "单小") $obj[10] +=  1;
	 if($value == "单单") $obj[12] += 1;
	 if($value == "双大") $obj[11] +=  1;
	 if($value == "双单") $obj[15] +=  1;
	 if($value == "双小") $obj[9] +=  1;
	 if($value == "双双")	$obj[13] +=  1;
}
function BackData($index,$i){
	if($i===true){
		if($index == 0) return "大双";
	    if($index == 1) return "小单";
		if($index == 2) return "小双";
		if($index == 3) return "大单";
	}
     if($index == 0) return "大大";
	 if($index == 1) return "小小";
	 if($index == 2) return "大小";
	 if($index == 3) return "小大";
	 if($index == 4) return "大单";
	 if($index == 5) return "小双";
	 if($index == 6) return "大双";
	 if($index == 7) return "小单";;
	 if($index == 8) return "单大";
	 if($index == 9) return "双小";
	 if($index == 10) return "单小";
	 if($index == 11) return "双大";
	 if($index == 12) return "单单";
	 if($index == 13) return "双双";
	 if($index == 14) return "单双";
	 if($index == 15)	return "双单";
}
?>
