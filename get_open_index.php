<?php 
require  'header.php';
global $conn,$date;
if($_GET["name"]=="cqssc"||$_GET["name"]=="tjssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="twssc"  ||$_GET["name"]=="txffc"  ||$_GET["name"]=="qqffc"||$_GET["name"]=="jsffc"){
   $sql = "SELECT  name,one_cold_index,two_cold_index,three_cold_index,four_cold_index,five_cold_index,five_hot_index,four_hot_index,three_hot_index,two_hot_index,one_hot_index,clear_index_date,color_index,one_num,two_num,three_num,four_num,five_num,six_num,seven_num,eight_num,nine_num,ten_num,date_or_index,num_index,index_2  FROM index_data";
}else{
   $sql = "SELECT name,one_cold_index,two_cold_index,three_cold_index,three_hot_index,two_hot_index,one_hot_index,clear_index_date,color_index,one_num,two_num,three_num,four_num,five_num,six_num,date_or_index,num_index,index_2  FROM index_data";
}
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($_GET["name"]=="cqssc"||$_GET["name"]=="tjssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="twssc"||$_GET["name"]=="txffc"  ||$_GET["name"]=="qqffc"||$_GET["name"]=="jsffc"){
                if($row["name"]==$_GET["name"]){
                   echo '{"one_cold_index":"'.$row["one_cold_index"].'","two_cold_index":"'.$row["two_cold_index"].'","three_cold_index":"'.$row["three_cold_index"].'","four_cold_index":"'.$row["four_cold_index"].'","five_cold_index":"'.$row["five_cold_index"].'","five_hot_index":"'.$row["five_hot_index"].'","four_hot_index":"'.$row["four_hot_index"].'","three_hot_index":"'.$row["three_hot_index"].'","two_hot_index":"'.$row["two_hot_index"].'","one_hot_index":"'.$row["one_hot_index"].'","clear_index_date":"'.$row["clear_index_date"].'","name":"'.$_GET["name"].'","color_index":"'.$row["color_index"].'","one_num":"'.$row["one_num"].'","two_num":"'.$row["two_num"].'","three_num":"'.$row["three_num"].'","four_num":"'.$row["four_num"].'","five_num":"'.$row["five_num"].'","six_num":"'.$row["six_num"].'","seven_num":"'.$row["seven_num"].'","eight_num":"'.$row["eight_num"].'","nine_num":"'.$row["nine_num"].'","ten_num":"'.$row["ten_num"].'","date_or_index":"'.$row["date_or_index"].'","index":"'.$row["num_index"].'","index_2":"'.$row["index_2"].'"}';
			   }
			}else{
              if($row["name"]==$_GET["name"]){
                   echo '{"one_cold_index":"'.$row["one_cold_index"].'","two_cold_index":"'.$row["two_cold_index"].'","three_cold_index":"'.$row["three_cold_index"].'","three_hot_index":"'.$row["three_hot_index"].'","two_hot_index":"'.$row["two_hot_index"].'","one_hot_index":"'.$row["one_hot_index"].'","clear_index_date":"'.$row["clear_index_date"].'","name":"'.$_GET["name"].'","color_index":"'.$row["color_index"].'","one_num":"'.$row["one_num"].'","two_num":"'.$row["two_num"].'","three_num":"'.$row["three_num"].'","date_or_index":"'.$row["date_or_index"].'","four_num":"'.$row["four_num"].'","five_num":"'.$row["five_num"].'","six_num":"'.$row["six_num"].'","index":"'.$row["num_index"].'","index_2":"'.$row["index_2"].'"}';
			}
		}
  	}
}
$conn->close();
?>