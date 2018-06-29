<?php 
require  'header.php';
global $conn,$date,$name,$get_name,$select1,$select2,$select3,$select4,$select5;
$name = $_GET["name"];
$one_num = $_GET["one_num"];
$two_num = $_GET["two_num"];
$three_num = $_GET["three_num"];
$four_num = $_GET["four_num"];
$five_num = $_GET["five_num"];
$six_num = $_GET["six_num"];
$seven_num = $_GET["seven_num"];
$eight_num = $_GET["eight_num"];
$nine_num = $_GET["nine_num"];
$ten_num = $_GET["ten_num"];
$date_or_index = $_GET["date_or_index"];
$num_index = $_GET["num_index"];
$index_2 = $_GET["index_2"];
$get_name = "set_".$_GET["name"];
$sql = "update index_data set one_num='$one_num',two_num='$two_num',three_num='$three_num',four_num='$four_num',five_num='$five_num',six_num='$six_num',seven_num='$seven_num',eight_num='$eight_num',nine_num='$nine_num',ten_num='$ten_num',date_or_index='$date_or_index',num_index='$num_index',index_2='$index_2'  where name='$name'";
$res = $conn->query($sql);  
if(!$res){
	echo '设置失败！';
}else{
    $date = date('Y/m/d H:i:s',time());
	echo '设置成功！';
	$stmt = $conn->prepare("INSERT INTO $get_name (value) VALUES(?)");
	if($name=="cqssc"|| $name=="tjssc" || $name=="bjssc" || $name=="twssc" || $name=="txffc" || $name=="qqffc" || $name=="jsffc"){
		$datas = ["最少","第二少","第三少","第四少","第五少","第五多","第四多","第三多","第二多","最多","无"];
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
                  $value = "设置时间：".$date.'*'.
                            "获取".$num_index."期条件的次数".'*'.
                            "从第".$index_2."期开始计算".'*'.
                           "设置第一个条件:".$select1.'*'.
                           "设置第二个条件:".$select2.'*'.
                           "设置第三个条件:".$select3.'*'.
                           "设置第四个条件:".$select4.'*'.
                           "设置第五个条件:".$select5.'*'.
						               "设置第六个条件:".$select6.'*'.
                           "设置第七个条件:".$select7.'*'.
                           "设置第八个条件:".$select8.'*'.
                           "设置第九个条件:".$select9.'*'.
                           "设置第十个条件:".$select10;
                  $stmt->bind_param("s", $value);
                  $stmt->execute();

		  }else{
			$datas = ["无","最少","第二少","第三少","第三多","第二多","最多"];
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
                  }
                  $value = "设置时间：".$date.'*'.
                           "设置第一个条件:".$select1.'*'.
                           "设置第二个条件:".$select2.'*'.
                           "设置第三个条件:".$select3.'*';
                  $stmt->bind_param("s", $value);
                  $stmt->execute();

		  }
		 
		}

$conn->close();
?>