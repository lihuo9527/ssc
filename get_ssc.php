<?php 
require  'header.php';
global $conn,$sql,$state,$getname,$date,$arr;
$getname = $_GET["name"];
$date = date("his");
$arr = [];
$rand_number = rand(1,3);

  $ip = "http://267599.com:89";
  $ip2 = "http://luck887.com";

if($_GET["name"]=="cqssc") $url =  $ip.'/Shared/GetNewPeriod?gameid=7&_'.$date;  
if($_GET["name"]=="tjssc") $url =  $ip.'/Shared/GetNewPeriod?gameid=42&_'.$date;
if($_GET["name"]=="bjssc") $url =  $ip.'/Shared/GetNewPeriod?gameid=56&_'.$date;
if($_GET["name"]=="twssc") $url =  $ip.'/Shared/GetNewPeriod?gameid=58&_'.$date;
if($_GET["name"]=="txffc") $url =  $ip.'/Shared/GetNewPeriod?gameid=76&_'.$date;
if($_GET["name"]=="qqffc") $url =  $ip.'/Shared/GetNewPeriod?gameid=78&_'.$date;
if($_GET["name"]=="jsffc") $url =  $ip.'/Shared/GetNewPeriod?gameid=116&_'.$date;
$json = file_get_contents(urldecode($url));
$json = json_decode($json);
$data = "";
$state = false;

// 删除记录
// $sql = "SELECT 	id FROM ".$getname;
// $result = $conn->query($sql);
// if($result->num_rows>5000){
// 	$i=0;
// while($row = $result->fetch_assoc()){
//     $sql_delete = "delete from ".$getname. " where id=".$row["id"];
// 	$conn->query($sql_delete);
// 	if($i==50)break;
// 	$i++;
// 	}
// }
// 删除记录

$open_date = (float)$json->fpreviousperiod;
if($open_date>0){
  if($_GET["name"]=="twssc"){
		$p = (float)str_replace('/', '', substr($json->fsettletime,0,10)).substr($open_date,4,5);
	}else{
        $p = $open_date;
	}

$sql = "SELECT 	issue,num FROM ".$getname." order by id desc";
	$result = $conn->query($sql);
    if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$issue = (float)str_replace('-', '',str_replace(' ', '', $row["issue"]));
			 echo $_GET["name"].$p."_".$issue;
             if($p > $issue && $_GET["name"]=="cqssc" || $p > $issue && $_GET["name"]=="twssc" || $_GET["name"]=="txffc" && $p%2!=0 && $p > $issue && $row["num"]!=$json->fpreviousresult || $_GET["name"]=="qqffc" && $p%2!=0 && $p > $issue && $row["num"]!=$json->fpreviousresult || $_GET["name"]=="jsffc" && $p%2!=0 && $p > $issue && $row["num"]!=$json->fpreviousresult){
			   echo "开始录入！";
			   break;
		      }else{
			  $state = true;
			  echo "插入失败！";
			  break;
		 }
	   }
	}
if($state===false){
			$sql = "SELECT name,a,b,c,d,e,push_nums FROM new_ssc";
			$res = $conn->query($sql);
        if ($res->num_rows > 0){
		while($row = $res->fetch_assoc()){
           if($row["name"]==$_GET["name"]){
			 $stmt = $conn->prepare("INSERT INTO $getname (issue,num,lotterytime,a,b,c,d,e,push_nums) VALUES(?,?,?,?,?,?,?,?,?)");
             $stmt->bind_param("sssssssss", $issue,$num,$lotterytime,$a,$b,$c,$d,$e,$p_nums);
			 if($_GET["name"]=="bjssc"){
                $issue = $p;
			 }else if($_GET["name"]=="twssc"){
                $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-5,5);
			 }else if($_GET["name"]=="txffc" || $_GET["name"]=="qqffc" || $_GET["name"]=="jsffc"){
                $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-4,4);
			 }else{
                $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-3,3);
			 }
             $num = $json->fpreviousresult;
			
			 $lotterytime = date('Y-m-d H:i:s',time());
		     //$lotterytime = str_replace('/','-' ,$json->fsettletime);
			 $a = $row["a"];
			 $b = $row["b"];
			 $c = $row["c"];
			 $d = $row["d"];
			 $e = $row["e"];
	         $p_nums = $row["push_nums"];
             $stmt->execute();
			 echo "插入成功";
			 require  'new_ssc.php';
			 $conn -> free_result();
			 $conn -> close();
			 return ;
		   }
		  }
		}
	  }
}else{
	if($_GET["name"]=="cqssc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=7&_'.$date;  
	if($_GET["name"]=="tjssc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=42&_'.$date;
	if($_GET["name"]=="bjssc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=56&_'.$date;
	if($_GET["name"]=="twssc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=58&_'.$date;
	if($_GET["name"]=="txffc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=76&_'.$date;
	if($_GET["name"]=="qqffc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=78&_'.$date;
        if($_GET["name"]=="jsffc") $url =  $ip2.'/Shared/GetNewPeriod?gameid=116&_'.$date;
	    $json = file_get_contents(urldecode($url));
		$json = json_decode($json);
		$data = "";
		$state = false;
$open_date = (float)$json->fpreviousperiod;
if($open_date>0){
  if($_GET["name"]=="twssc"){
		$p = (float)str_replace('/', '', substr($json->fsettletime,0,10)).substr($open_date,4,5);
	}else{
        $p = $open_date;
	}
$sql = "SELECT 	issue,num FROM ".$getname." order by id desc";
	$result = $conn->query($sql);
    if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$issue = (float)str_replace('-', '',str_replace(' ', '', $row["issue"]));
			 echo $_GET["name"].$p."_".$issue;
			//  if($p%2==0){
			// 	 echo "是偶数！";
			//  }else{
			// 	 echo "是机数！";
			//  }
             if($p > $issue && $_GET["name"]=="cqssc" || $p > $issue && $_GET["name"]=="twssc" || $_GET["name"]=="txffc" && $p%2!=0 && $p > $issue && $row["num"]!=$json->fpreviousresult || $_GET["name"]=="qqffc" && $p%2!=0 && $p > $issue && $row["num"]!=$json->fpreviousresult || $_GET["name"]=="jsffc" && $p%2!=0 && $p > $issue && $row["num"]!=$json->fpreviousresult){
			   echo "开始录入！";
			   break;
		      }else{
			  $state = true;
			  echo "插入失败！";
			  break;
		 }
	   }
	}
if($state===false){
			$sql = "SELECT name,a,b,c,d,e,push_nums FROM new_ssc";
			$res = $conn->query($sql);
        if ($res->num_rows > 0){
		while($row = $res->fetch_assoc()){
           if($row["name"]==$_GET["name"]){
			 $stmt = $conn->prepare("INSERT INTO $getname (issue,num,lotterytime,a,b,c,d,e,push_nums) VALUES(?,?,?,?,?,?,?,?,?)");
             $stmt->bind_param("sssssssss", $issue,$num,$lotterytime,$a,$b,$c,$d,$e,$p_nums);
			 if($_GET["name"]=="bjssc"){
                $issue = $p;
			 }else if($_GET["name"]=="twssc"){
                $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-5,5);
			 }else if($_GET["name"]=="txffc" || $_GET["name"]=="qqffc" || $_GET["name"]=="jsffc"){
                $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-4,4);
			 }else{
                $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-3,3);
			 }
             $num = $json->fpreviousresult;
			
			 $lotterytime = date('Y-m-d H:i:s',time());
		     //$lotterytime = str_replace('/','-' ,$json->fsettletime);
			 $a = $row["a"];
			 $b = $row["b"];
			 $c = $row["c"];
			 $d = $row["d"];
			 $e = $row["e"];
	         $p_nums = $row["push_nums"];
             $stmt->execute();
			 echo "插入成功";
			 require  'new_ssc.php';
			 $conn -> free_result();
			 $conn -> close();
			 return ;
		   }
		  }
		}
	  }
   } 
}
echo "插入失败";
function getSubstr($str, $leftStr, $rightStr){
    $left = strpos($str, $leftStr);
    $right = strpos($str, $rightStr,$left);
    if($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}
$conn -> close();
?>