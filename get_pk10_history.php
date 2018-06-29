<?php 
require  'header.php';
global $conn,$data,$arr,$state,$dates,$times,$name;
$state = $_GET["init"];
$name = $_GET["name"];
$dates = array();
$times = "";
$data = "";
$arr = array();
$sql = "SELECT  open_issue,open_num,open_date,push_num FROM ".$_GET["name"]." order by id desc";
$result = $conn->query($sql);
if($result->num_rows>0){
	  $num = $result->num_rows;
	  $i = 0;	
	  $j = 0;
	  $x = 0;
	  $text = "";
	  $state2 = false;
	  $v = 0;
		while($row = $result->fetch_assoc()){
			   if($state=="true"){ 
            if($i==0){
				        $text = substr($row["open_issue"],0,8);
								array_push($dates,$text);
			      }      
			      
        if($text == substr($row["open_issue"],0,8)){
					if($x<15){
							  array_push($arr,'{"issue":"'.$row["open_issue"].'","lotterytime":"'.$row["open_date"].'","num":"'.$row["open_num"].'","push_num":"'.$row["push_num"].'"}');
					  }
					  $x++;
			   }else{
           if($dates[count($dates)-1]!=substr($row["open_issue"],0,8))array_push($dates,substr($row["open_issue"],0,8));
				 }
				$i++;
			}else{
				  if($_GET["buff"]=="true"){
					  if($_GET["date"] == $row["open_issue"]){
						  $v = 1;
						  continue;
					  }
					  if($v==1){
						  if(substr($_GET["date"],0,8)==substr($row["open_issue"],0,8)){
							 if($j<15){
									array_push($arr,'{"issue":"'.$row["open_issue"].'","lotterytime":"'.$row["open_date"].'","num":"'.$row["open_num"].'","push_num":"'.$row["push_num"].'"}');
							  }else{
							   break;
							 }
							$j++;
						  }
					  }

				  }else{
          if($_GET["date"] == substr($row["open_issue"],0,8)) $state2=true;
					if($state2){
							if($_GET["date"]==substr($row["open_issue"],0,8)){
							if($j<15){
								array_push($arr,'{"issue":"'.$row["open_issue"].'","lotterytime":"'.$row["open_date"].'","num":"'.$row["open_num"].'","push_num":"'.$row["push_num"].'"}');
							}else{
							   break;
							 }
							$j++;
						   }
						}
				  }
			  }
		  }
		}
if(count($dates)>0){
	$times = implode("|",$dates);
}
if(count($arr)>0){
	$data = implode("*",$arr);
}
if($state=="true"){
  echo $data."#".$times;
}else{
  echo $data;
}

$conn->close();
?>
