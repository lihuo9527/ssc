<?php 
require  'header.php';
global $conn,$date,$sql;
 $sql = "SELECT  name,total,total_lose,times_count,_case,times_count2,one_num,two_num,three_num,four_num,five_num,six_num,nums_lose,times_count3,and_count,nums_lose2,state  FROM new_k3c";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
                    echo '{"total":"'.$row["total"].'","total_lose":"'.$row["total_lose"].'","times_count":"'.$row["times_count"].'","times_count2":"'.$row["times_count2"].'","times_count3":"'.$row["times_count3"].'","one_num":"'.$row["one_num"].'","two_num":"'.$row["two_num"].'","three_num":"'.$row["three_num"].'","nums_lose":"'.$row["nums_lose"].'","and_count":"'.$row["and_count"].'","nums_lose2":"'.$row["nums_lose2"].'","_case":"'.$row["_case"].'","state":"'.$row["state"].'","four_num":"'.$row["four_num"].'","five_num":"'.$row["five_num"].'","six_num":"'.$row["six_num"].'"}';
			}
  	}
}
$conn->close();
?>