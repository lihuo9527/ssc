<?php 
require  'header.php';
global $conn,$data,$name;
$name = $_GET["name"];
$data = "";
if($name=="cqssc_2" || $name=="tjssc_2" || $name=="bjssc_2" || $name=="twssc_2" || $name=="qqffc_2" || $name=="txffc_2"|| $name=="jsffc_2"){
$sql = "SELECT  time,one_hot,two_hot,three_hot,four_hot,five_hot,five_cold,four_cold,three_cold,two_cold,one_cold  FROM "."".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
        $i=0;
		while($row = $result->fetch_assoc()){
			$data .= $row["time"]."*".$row["one_hot"]."*".$row["two_hot"]."*".$row["three_hot"]."*".$row["four_hot"]."*".$row["five_hot"]."*".$row["five_cold"]."*".$row["four_cold"]."*".$row["three_cold"]."*".$row["two_cold"]."*".$row["one_cold"]."|";
			  $i++;
			  if($i>=119) break;
		  }
   }
}else{
$sql = "SELECT  time,one_hot,two_hot,three_hot,three_cold,two_cold,one_cold  FROM "."".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
        $i=0;
		while($row = $result->fetch_assoc()){
			$data .= $row["time"]."*".$row["one_hot"]."*".$row["two_hot"]."*".$row["three_hot"]."*".$row["three_cold"]."*".$row["two_cold"]."*".$row["one_cold"]."|";
			  $i++;
			  if($i>=119) break;
		  }
   }
}
$data = substr($data,0,strlen($data)-1); 
echo $data;
$conn->close();
?>
