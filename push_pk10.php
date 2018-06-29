<?php 
require  'header.php';
global $conn,$date;
$sql = "SELECT  name,opentime,lotterytime,num,push_nums FROM new_ssc";
$result = $conn->query($sql);
$date = date('Y/m/d   H:i:s',time());
if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row['name']=="pk10"){
				$arr = array("open_issue"=>$row["opentime"],"name"=>$_GET["name"],"nowtime"=>$date,"open_num"=>$row["num"],"push_nums"=>$row["push_nums"],"open_date"=>$row["lotterytime"]);
					break;
			}
  	}
}
echo json_encode($arr);
$conn->close();
?>