<?php 
require  'header.php';
global $conn,$date,$data;

 $sql = "SELECT  name,e  FROM new_ssc";
$result = $conn->query($sql);
if($result->num_rows>0){
 		while($row = $result->fetch_assoc()){
 			if($row["name"]==$_GET["name"]){
                $data = $row["e"];
			}
  	}
}
 $sql = "SELECT  name,push_nums,push_num,push_date,now_lose_text  FROM push_data";
 $result = $conn->query($sql);
$date = date('H|i');
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["name"]==$_GET["name"]){
               echo $row["push_date"]."*".$row["push_nums"]."*".$data."*".$row["now_lose_text"]."*".$date;
			}
  	}
}
$conn->close();
?>