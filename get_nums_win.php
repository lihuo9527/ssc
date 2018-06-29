<?php 
require  'header.php';
global $conn,$data,$arr,$state,$dates,$times,$name;
$date = $_GET["date"];
$name = $_GET["name"];
$num = $_GET["num"];
$arrays = array();
$arr = array();
$sql = "SELECT issue, num FROM "."".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	$i = 0;	
	$last_open_index = 0 ;
	$index = 0 ;
	$last = 0;
	while($row = $result->fetch_assoc()){
		if(substr_count($row["num"], $num) > 0){
			 echo $row["issue"]."期中，";
			 if($last_open_index>0){
				 $last_open_index = $i - $last -1;
			 }else{
                 $last_open_index = $i - $last;
			 }
			
			 echo "间隔".$last_open_index."期";
			 echo "\n";
			 array_push($arrays,$last_open_index);
		     $index +=1;
			 if($last_open_index>0){
                 $last = $i;
			 }else{
				 $last = $i +1;
			 }
			
		  }
		if($i>=$date)break;
		$i++;
	}
   echo "查询号码：".$num." —— ".$date."期内中了".$index."期";
}

$conn->close();
?>
