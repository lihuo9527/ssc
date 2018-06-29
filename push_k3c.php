<?php 
require  'header.php';
global $conn,$date;
$sql = "SELECT  name,opentime,lotterytime,num,push_num,push_nums  FROM new_k3c";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
        echo '{"opentime":"'.$row["opentime"].'","lotterytime":"'.$row["lotterytime"].'","name":"'.$_GET["name"].'","nowtime":"'.$date.'","num":"'.$row["num"].'","push_num":"'.$row["push_num"].'","push_nums":"'.$row["push_nums"].'"}';
			}
  	}
}
$conn->close();
?>