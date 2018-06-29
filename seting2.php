<?php 
require  'header.php';
global $conn,$a,$sql,$text,$get_name,$select2,$select1,$select3;
$name = $_POST["name"];
$total = $_POST["total"];
$total_lose = $_POST["totallose"];
$times_count = $_POST["timescount"];
$times_count2 = $_POST["timescount2"];
$times_count3 = $_POST["timescount3"];
$one_num = $_POST["one_num"];
$two_num = $_POST["two_num"];
$three_num = $_POST["three_num"];
$four_num = $_POST["four_num"];
$five_num = $_POST["five_num"];
$six_num = $_POST["six_num"];
$nums_lose =  $_POST["nums_lose"];
$case =  $_POST["case"];
$nums_lose2 =  $_POST["nums_lose2"];
$and_count =  $_POST["and_count"];
$get_name = "set_".$_POST["name"];
$state =  $_POST["state"];
$text = 0;
$sql = "SELECT name FROM new_k3c";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
        if($times_count>0 && $times_count2>0){
            if($row["name"] == $_POST["name"]){
               $sql = "update new_k3c set _case='$case',nums_lose2='$nums_lose2',total='$total',total_lose='$total_lose',times_count='$times_count',times_count2='$times_count2',times_count3='$times_count3',one_num= '$one_num',two_num='$two_num',three_num='$three_num',four_num='$four_num',five_num='$five_num',six_num='$six_num',nums_lose='$nums_lose',and_count='$and_count',state='$state' where name='$name'";
               $res = $conn->query($sql); 
               if($res){
                  $date = date('Y/m/d H:i:s',time());
                  echo "设置成功!";
                  $datas = ["无","最冷","第二冷","第三冷","第三热","第二热","最热"];
                  for($i=0;$i<count($datas);$i++){
                    if($i==$one_num){
                        $select1 = $datas[$i];
                    }
                    if($i==$two_num){
                        $select2 = $datas[$i];
                     }
                    if($i==$three_num){
                        $select3 = $datas[$i];
                     }
                  }
                   $stmt = $conn->prepare("INSERT INTO $get_name (value) VALUES(?)");
                   $value = "设置时间：".$date.'*'.
                           "和值获取最近".$times_count."期数据".'*'.
                           "和值输".$total.'期后开始推荐'.'*'.
                           "和值推荐输".$total_lose."期后不继续".'*'.
                           "选择方案".$case.'*'.
                           "方案A获取最近".$times_count2."期数据".'*'.
                           "方案A第一个条件:".$select1.'*'.
                           "方案A第二个条件:".$select2.'*'.
                           "方案A第三个条件:".$select3.'*'.
                            "方案A输".$nums_lose."期后不继续".'*'.
                            "方案A和".$and_count."期后不继续".'*'.
                            "方案B距离上一次赢，输".$times_count3."期后开始推荐".'*'.
                            "方案B输".$nums_lose2."期后不继续"
                            ;
                  $stmt->bind_param("s", $value);
                  $stmt->execute();
               }else{
                  echo "设置失败，请稍后再试！";
               }
            }
        }
    }
}

$conn->close();
?>


