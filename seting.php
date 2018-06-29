<?php 
require  'header.php';
global $conn,$a,$sql,$text,$get_name,$select1,$select2,$select3,$select4,$select5;
$name = $_POST["name"];
$first = $_POST["first"];
$last  = $_POST["last"];
$total = $_POST["total"];
$first_lose = $_POST["firstlose"];
$last_lose  = $_POST["lastlose"];
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
$seven_num = $_POST["seven_num"];
$eight_num = $_POST["eight_num"];
$nine_num = $_POST["nine_num"];
$ten_num = $_POST["ten_num"];
$nums_lose =  $_POST["nums_lose"];
$and_count =  $_POST["and_count"];
$state =  $_POST["state"];
$get_name = "set_".$_POST["name"];
$text = 0;
$sql = "SELECT name FROM new_ssc";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
            if($row["name"] == $_POST["name"]){
               $sql = "update new_ssc set first='$first',last='$last',total='$total',first_lose='$first_lose',last_lose='$last_lose',total_lose='$total_lose',times_count='$times_count',times_count2='$times_count2',times_count3='$times_count3',one_num= '$one_num',two_num='$two_num',three_num='$three_num',four_num='$four_num',five_num='$five_num',six_num='$six_num',seven_num='$seven_num',eight_num='$eight_num',nine_num='$nine_num',ten_num='$ten_num',nums_lose='$nums_lose',and_count='$and_count',state='$state' where name='$name'";
               $res = $conn->query($sql); 
               if($res){
                  $date = date('Y/m/d H:i:s',time());
                  echo '{"msg":"设置成功！"}';
                  $datas = ["最冷","第二冷","第三冷","第四冷","第五冷","第五热","第四热","第三热","第二热","最热","无"];
                  for($i=0;$i<count($datas);$i++){
                      if($one_num!="无"){
                         if($i==$one_num){
                            $select1 = $datas[$i];
                        }
                      }else{
                            $select1 = "无";
                      }
                      if($two_num!="无"){
                         if($i==$two_num){
                            $select2 = $datas[$i];
                        }
                      }else{
                            $select2 = "无";
                      }
                      if($three_num!="无"){
                         if($i==$three_num){
                           $select3 = $datas[$i];
                         }
                      }else{
                           $select3 = "无";
                      }
                     if($four_num!="无"){
                         if($i==$four_num){
                           $select4 = $datas[$i];
                         }
                      }else{
                           $select4 = "无";
                      }
                      if($five_num!="无"){
                         if($i==$five_num){
                           $select5 = $datas[$i];
                         }
                      }else{
                           $select5 = "无";
                      }
                       if($six_num!="无"){
                         if($i==$six_num){
                           $select6 = $datas[$i];
                         }
                      }else{
                           $select6 = "无";
                      }
                       if($seven_num!="无"){
                         if($i==$seven_num){
                           $select7 = $datas[$i];
                         }
                      }else{
                           $select7 = "无";
                      }
                       if($eight_num!="无"){
                         if($i==$eight_num){
                           $select8 = $datas[$i];
                         }
                      }else{
                           $select8 = "无";
                      }
                       if($nine_num!="无"){
                         if($i==$nine_num){
                           $select9 = $datas[$i];
                         }
                      }else{
                           $select9 = "无";
                      }
                       if($ten_num!="无"){
                         if($i==$ten_num){
                           $select10 = $datas[$i];
                         }
                      }else{
                           $select10 = "无";
                      }
                  }
                  $stmt = $conn->prepare("INSERT INTO $get_name (value) VALUES(?)");
                  $value = "设置时间：".$date.'*'.
                           "前二/后二获取最近".$times_count."期数据".'*'.
                           "前二输".$first.'期后开始推荐'.'*'.
                           "前二推荐输".$first_lose.'期后不继续'.'*'.
                           "后二输".$last.'期后开始推荐'.'*'.
                           "后二推荐输".$last_lose.'期后不继续'.'*'.
                           "和值获取最近".$times_count2."期数据".'*'.
                           "和值输".$total.'期后开始推荐'.'*'.
                           "和值推荐输".$total_lose."期后不继续".'*'.
                           "五星二胆获取最近".$times_count3."期数据".'*'.
                           "设置第一个条件:".$select1.'*'.
                           "设置第二个条件:".$select2.'*'.
                           "设置第三个条件:".$select3.'*'.
                           "设置第四个条件:".$select4.'*'.
                           "设置第五个条件:".$select5.'*'.
                           "设置第六个条件:".$select6.'*'.
                           "设置第七个条件:".$select7.'*'.
                           "设置第八个条件:".$select8.'*'.
                           "设置第九个条件:".$select9.'*'.
                           "设置第十个条件:".$select10.'*'.
                            "五星二胆输".$nums_lose."期后不继续".'*'.
                            "五星二胆和".$and_count."期后不继续"
                            ;
                  $stmt->bind_param("s", $value);
                  $stmt->execute();

               }else{
                  echo '{"msg":"设置失败，请稍后再试！"}';
               }
            }
    }
}
$conn->close();
?>


