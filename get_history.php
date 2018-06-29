<?php 
require  'header.php';
global $conn,$data,$arr,$state,$dates,$times,$name;
$state = $_GET["init"];
$name = $_GET["name"];
$dates = array();
$times = "";
$data = "";
$arr = array();
if($_GET["name"]=="cqssc"||$_GET["name"]=="tjssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="twssc" ||$_GET["name"]=="txffc" ||$_GET["name"]=="qqffc"||$_GET["name"]=="jsffc"){
		$sql = "SELECT  issue, num, lotterytime,a,b,c,d,e,f,push_nums FROM ".$_GET["name"]." order by id desc";
	}else{
	    $sql = "SELECT  issue,num,lotterytime,push_nums,push_num FROM ".$_GET["name"]." order by id desc";
}
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
            if($name=="bjssc"){
				        $text = substr($row["issue"],0,4);
			      }else{
				        $text = substr($row["issue"],0,10);
			      }      
			      array_push($dates,$text);
			     }
        if($text == substr($row["issue"],0,10) || $text == substr($row["issue"],0,4) && $name=="bjssc"){
					if($x<15){
						       if($_GET["name"]=="cqssc"||$_GET["name"]=="tjssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="twssc" ||$_GET["name"]=="txffc" ||$_GET["name"]=="qqffc"||$_GET["name"]=="jsffc"){
							        array_push($arr,'{"issue":"'.$row["issue"].'","lotterytime":"'.$row["lotterytime"].'","num":"'.$row["num"].'","a":"'.$row["a"].'","b":"'.$row["b"].'","c":"'.$row["c"].'","d":"'.$row["d"].'","e":"'.$row["e"].'","f":"'.$row["f"].'","push_nums":"'.$row["push_nums"].'"}');
						       }else{
							        array_push($arr,'{"issue":"'.$row["issue"].'","lotterytime":"'.$row["lotterytime"].'","num":"'.$row["num"].'","push_nums":"'.$row["push_nums"].'","push_num":"'.$row["push_num"].'"}');
						      }
					       }
					  $x++;
			}else{
			     if($name=="bjssc"){
				     if($dates[count($dates)-1]!=substr($row["issue"],0,4))array_push($dates,substr($row["issue"],0,4));
					   }else{
                      if($dates[count($dates)-1]!=substr($row["issue"],0,10))array_push($dates,substr($row["issue"],0,10));
				   }
			}
		    $i++;
			}else{
				  if($_GET["buff"]=="true"){
					  if($_GET["date"] == $row["issue"]){
						  $v = 1;
						  continue;
					  }
					  if($v==1){
						  if(substr($_GET["date"],0,10)==substr($row["issue"],0,10) ||  substr($_GET["date"],0,4)==substr($row["issue"],0,4) && $name=="bjssc"){
							 if($j<15){
							 if($_GET["name"]=="cqssc"||$_GET["name"]=="tjssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="twssc" ||$_GET["name"]=="txffc" ||$_GET["name"]=="qqffc"||$_GET["name"]=="jsffc"){
								array_push($arr,'{"issue":"'.$row["issue"].'","lotterytime":"'.$row["lotterytime"].'","num":"'.$row["num"].'","a":"'.$row["a"].'","b":"'.$row["b"].'","c":"'.$row["c"].'","d":"'.$row["d"].'","e":"'.$row["e"].'","f":"'.$row["f"].'","push_nums":"'.$row["push_nums"].'"}');
							  }else{
									array_push($arr,'{"issue":"'.$row["issue"].'","lotterytime":"'.$row["lotterytime"].'","num":"'.$row["num"].'","push_nums":"'.$row["push_nums"].'","push_num":"'.$row["push_num"].'"}');
								}
							  }else{
							   break;
							 }
							$j++;
						  }
					  }

				  }else{
          if($_GET["date"] == substr($row["issue"],0,10) ||  $_GET["date"]==substr($row["issue"],0,4) && $name=="bjssc") $state2=true;
					if($state2){
							if($_GET["date"]==substr($row["issue"],0,10) ||  $_GET["date"]==substr($row["issue"],0,4) && $name=="bjssc"){
							if($j<15){
						    if($_GET["name"]=="cqssc" ||$_GET["name"]=="tjssc" ||$_GET["name"]=="bjssc" ||$_GET["name"]=="twssc" ||$_GET["name"]=="txffc" ||$_GET["name"]=="qqffc"||$_GET["name"]=="jsffc"){
								array_push($arr,'{"issue":"'.$row["issue"].'","lotterytime":"'.$row["lotterytime"].'","num":"'.$row["num"].'","a":"'.$row["a"].'","b":"'.$row["b"].'","c":"'.$row["c"].'","d":"'.$row["d"].'","e":"'.$row["e"].'","f":"'.$row["f"].'","push_nums":"'.$row["push_nums"].'"}');
							}else{
								array_push($arr,'{"issue":"'.$row["issue"].'","lotterytime":"'.$row["lotterytime"].'","num":"'.$row["num"].'","push_nums":"'.$row["push_nums"].'","push_num":"'.$row["push_num"].'"}');
							}
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
  echo $data."&".$times;
}else{
  echo $data;
}

$conn->close();
?>
