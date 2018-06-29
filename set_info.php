<?php 
require  'header.php';
global $conn,$sql,$data,$get_name;
$get_name = $_GET["name"];
$data = [];
$datas = "";
$sql = "SELECT 	id,value FROM ".$get_name." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
while($row = $result->fetch_assoc()){
	  array_push($data,$row["value"]);
	}
}else{
	echo "not_have_value";
	return;
}
if(count($data)>0){
	$datas = implode("&",$data);
}
echo $datas;
$conn -> close();
?>