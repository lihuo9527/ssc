<?php 
require  'header.php';
global $conn,$date;
$sql = "SELECT  name,opentime,a,b,c,d,e,f,lotterytime,num,push_nums  FROM new_ssc";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
               echo '{"opentime":"'.$row["opentime"].'","a":"'.$row["a"].'","b":"'.$row["b"].'","c":"'.$row["c"].'","d":"'.$row["d"].'","e":"'.$row["e"].'","f":"'.$row["f"].'","lotterytime":"'.$row["lotterytime"].'","name":"'.$_GET["name"].'","nowtime":"'.$date.'","num":"'.$row["num"].'","push_nums":"'.$row["push_nums"].'"}';
			}
  	}
}
$conn->close();
?>