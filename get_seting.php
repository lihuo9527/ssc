<?php 
require  'header.php';
global $conn,$date,$sql;
 $sql = "SELECT  name,first,last,total,first_lose,last_lose,total_lose,times_count,times_count2,times_count3,one_num,two_num,three_num,four_num,five_num,six_num,seven_num,eight_num,nine_num,ten_num,nums_lose,and_count,state  FROM new_ssc";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
                    echo '{"first":"'.$row["first"].'","last":"'.$row["last"].'","total":"'.$row["total"].'","first_lose":"'.$row["first_lose"].'","last_lose":"'.$row["last_lose"].'","total_lose":"'.$row["total_lose"].'","times_count":"'.$row["times_count"].'","times_count2":"'.$row["times_count2"].'","times_count3":"'.$row["times_count3"].'","one_num":"'.$row["one_num"].'","two_num":"'.$row["two_num"].'","three_num":"'.$row["three_num"].'","four_num":"'.$row["four_num"].'","five_num":"'.$row["five_num"].'","nums_lose":"'.$row["nums_lose"].'","and_count":"'.$row["and_count"].'","state":"'.$row["state"].'","six_num":"'.$row["six_num"].'","seven_num":"'.$row["seven_num"].'","eight_num":"'.$row["eight_num"].'","nine_num":"'.$row["nine_num"].'","ten_num":"'.$row["ten_num"].'"}';
			}
  	}
}
$conn->close();
?>