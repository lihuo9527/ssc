<?php 
require  'header.php';
global $conn,$arr,$back_data,$data,$opentime,$open_num,$lottery_time,$name,$total,$total_lose,$arrs,$arrs1,$arrs2,$times_count,$times_count3,$arrs_num,$push_nums,$nums_lose2,$nums_index2,$arr_nums,$arr_nums2,$push_nums;
$arr = array();
$arrs2 = array(0,0,0,0);
$push_nums="";
$arr_nums = array(
	array("number"=>"12","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"13","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"14","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"15","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"16","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"23","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"24","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"25","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"26","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"34","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"35","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"36","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"45","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"46","index"=>0,"times_count"=>0,"lose"=>0),
	array("number"=>"56","index"=>0,"times_count"=>0,"lose"=>0)
	);
$arr_nums2 =  array();
$name = $_GET["name"];
$sql = "SELECT opentime,name,total,total_lose,times_count,times_count3,nums_lose2,nums_index2 FROM new_k3c";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			 if($row["name"]==$name){
                    $opentime = $row["opentime"];
					$total = $row["total"];
					$total_lose = $row["total_lose"];
					$nums_lose2 = $row["nums_lose2"];
					$nums_index2 = $row["nums_index2"];
					$times_count = $row["times_count"];
					$times_count3 = $row["times_count3"];

			 };
		}
}
$sql = "SELECT  issue, num, lotterytime FROM ".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
	  $i = 0;
		while($row = $result->fetch_assoc()){
		  for($x=0;$x<count($arr_nums);$x++){
              if(substr_count($row["num"],substr($arr_nums[$x]["number"], 0, 1)) >=1 && substr_count($row["num"],substr($arr_nums[$x]["number"], 1, 2)) >=1 || 
				 substr_count($row["num"],substr($arr_nums[$x]["number"], 0, 1)) >=2 && substr_count($row["num"],substr($arr_nums[$x]["number"], 1, 2)) ==0 ||
				 substr_count($row["num"],substr($arr_nums[$x]["number"], 0, 1)) ==0 && substr_count($row["num"],substr($arr_nums[$x]["number"], 1, 2)) >=2){
					 if($arr_nums[$x]["times_count"]==0){
                        $arr_nums[$x]["times_count"] = $i + 1;
					 }
				}
			}
           
			$item = explode(",",$row["num"]);
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

for($x=0;$x<count($arr_nums);$x++){
	$sql = "SELECT num FROM ".$_GET['name']." order by id desc";
    $result = $conn->query($sql);
    if($result->num_rows>0){
	   $num = $result->num_rows;
	   $i = 0;
	  while($row = $result->fetch_assoc()){
		 if($i==$arr_nums[$x]["times_count"]){
				break;
			 }
		 if(substr_count($row["num"],substr($arr_nums[$x]["number"], 0, 1)) ==0 && substr_count($row["num"],substr($arr_nums[$x]["number"], 1, 2)) ==0){
			  $arr_nums[$x]["lose"] +=1;
			  if($arr_nums[$x]["lose"]>=$times_count3){
				  array_push($arr_nums2,$arr_nums[$x]);
			  }
			}
		$i++;
		}
	}
}
if(count($arr_nums2)>0){
  foreach($arr_nums2 as $val){
  $key_arrays[]=$val['lose'];
 }
  array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$arr_nums2);
}

var_dump($arr_nums);
echo "分界----------------";
if(count($arr_nums2)>0){
var_dump($arr_nums2[count($arr_nums2)-1]);
}else{
 echo "没有符合条件！";
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
$sql = "SELECT name,total_index,one_num,two_num,push_num,push_nums,nums_lose2,nums_index2,and_count,and_index FROM new_k3c";
$result = $conn->query($sql);
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			 if($row["name"]==$_GET['name']){
				if(count($arr_nums)>0){
                    $push_nums = $arr_nums2[count($arr_nums2)-1]["number"];
				 }
			    echo "push_nums:".$push_nums;
			  if($row["push_nums"]!=""){
                 $v = 0 ;
				 $x = 0 ;
                 if(substr_count($open_num,substr($row["push_nums"], 0, 1)) ==0 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==1 || 
				    substr_count($open_num,substr($row["push_nums"], 0, 1)) ==1 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==0){
					$push_nums = $row["push_nums"];
			     }
				 if(substr_count($open_num,substr($row["push_nums"], 0, 1)) ==0 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==0){
                      $v = $row["nums_index2"] + 1;
					  if($v>=$row["nums_lose2"]){
						    $push_nums = "";
							$sql = "update new_k3c set nums_index2='0'  where name='$name'";
						}else{
							$sql = "update new_k3c set nums_index2='$v'  where name='$name'";
		                    $push_nums = $row["push_nums"];
						}
                        $res = $conn->query($sql); 
				 }
				 if(substr_count($open_num,substr($row["push_nums"], 0, 1)) >=1 && substr_count($open_num,substr($row["push_nums"], 1, 2)) >=1 || 
				    substr_count($open_num,substr($row["push_nums"], 0, 1)) >=2 && substr_count($open_num,substr($row["push_nums"], 1, 2)) ==0 ||
					substr_count($open_num,substr($row["push_nums"], 0, 1)) ==0 && substr_count($open_num,substr($row["push_nums"], 1, 2)) >=2){
                    $sql = "update new_k3c set nums_index2='0'  where name='$name'";
					$res = $conn->query($sql); 
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
echo $arr[0]."-".$opentime."-".$lottery_time."-".$open_num."-".$name;
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
