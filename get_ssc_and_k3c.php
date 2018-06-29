<?php 
require  'header.php';
global $conn,$data,$arr,$state,$dates,$times,$name;
$name = $_GET["name"];
$sql = "SELECT  issue, num, lotterytime FROM "."".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
		while($row = $result->fetch_assoc()){
              echo '{"num":"'.$row["num"].'","date":"'.$row["issue"].'","time":"'.$row["lotterytime"].'","name":"'.$name.'"}';
		      break ;
		  }
}
$conn->close();
?>
