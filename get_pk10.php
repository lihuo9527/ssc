<?php 
require  'header.php';
global $conn,$data,$arr,$state,$dates,$times,$name;
$state = $_GET["init"];
$name = $_GET["name"];
$dates = array();
$times = "";
$data = "";
$arr = array();
$sql = "SELECT  open_issue, open_num, open_date,push_num FROM "."".$_GET['name']." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
	  $i = 0;	
	  $j = 0;
	  $x = 0;
	  $text = "";
		while($row = $result->fetch_assoc()){
			if($state=="true"){
               	 if($i==0){
                    $text = substr($row["open_issue"],0,8);
					array_push($dates,substr($row["open_issue"],0,8));
			     }
				
				if($text == substr($row["open_issue"],0,8)){
					if($x<30){  
					   array_push($arr,$row["open_issue"].'_'.$row["open_num"].'_'.$row["open_date"].'_'.$row["push_num"]);
					}
					 $x++;
				}else{
					  if($dates[count($dates)-1]!=substr($row["open_issue"],0,8)){
						array_push($dates,substr($row["open_issue"],0,8));
					   }
				     }
			    }else{
                    if($_GET["date"] == substr($row["open_issue"],0,8)){
                        if($j<30){
							array_push($arr,$row["open_issue"].'_'.$row["open_num"].'_'.$row["open_date"].'_'.$row["push_num"]);
						}else{
                          break;
						}
						$j++;
					}

			}
		
			  $i++;
		  }
}
for($i=0;$i<count($dates);$i++){
	$times = $times.$dates[$i].'|';
}
for($i=0;$i<count($arr);$i++){
	$data = $data.$arr[$i].'*';
}
$data = substr($data,0,strlen($data)-1); 
$times = substr($times,0,strlen($times)-1);
$date = date('Y/m/d H:i:s',time());
if($state=="true"){
echo '{"msg":"'.$data.'","date":"'.$date.'","dates":"'.$times.'","name":"'.$name.'"}';
}else{
echo '{"msg":"'.$data.'","date":"'.$date.'","name":"'.$name.'"}';
}

$conn->close();
?>
