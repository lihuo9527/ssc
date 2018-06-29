<?php 
require  'header.php';
global $conn,$data,$arr,$name;
$data = "";
$arr = array();
$name = $_GET["name"];
$sql = "SELECT  open_date, open_num FROM "."".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
	  $j = 0;
	  $state = false;
		while($row = $result->fetch_assoc()){
		  if($_GET["date"]==$row["open_date"]){
              $state = true;
			  continue;
			 }
		  if($state){
          if(substr($_GET["date"],0,8)==substr($row["open_date"],0,8)){
              array_push($arr,$row["open_date"].'_'.$row["open_num"]);
			  }
			if($j >= 29) break ;
			   $j++;
		   }
		}
	}
if(count($arr)>0){
for($i=0;$i<count($arr);$i++){
	$data = $data.$arr[$i].'*';
	if($i==29) break;
}
$data = substr($data,0,strlen($data)-1); 
}
echo '{"msg":"'.$data.'"}';
$conn->close();
?>
