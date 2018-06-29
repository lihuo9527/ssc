<?php 
require  'header.php';
global $conn,$sql,$state,$getname;
$getname = $_GET["name"];
$src = "";
switch($_GET["name"]){
	case "jsk3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=jsk3&format=json';
	break;
	case "shk3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=shk3&format=json';
	break;
	case "ahk3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=ahk3&format=json';
	break;
	case "gxk3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=gxk3&format=json';
	break;
	case "jxk3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=jxk3&format=json';
	break;
	case "hubeik3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=hubk3&format=json';
	break;
	case "hebeik3":$src = 'http://d.apiplus.net/newly.do?token=f5d52cb03215fc5f&code=hebk3&format=json';
	break;
}
$json = file_get_contents(urldecode($src));
$json = json_decode($json);
$data = "";
$state = false;
$sql = "SELECT 	id FROM ".$getname;
$result = $conn->query($sql);
if($result->num_rows>2000){
	$i=0;
while($row = $result->fetch_assoc()){
    $sql_delete = "delete from ".$getname. " where id=".$row["id"];
	$conn->query($sql_delete);
	if($i==99)break;
	$i++;
	}
}
if(count($json->data)>0){
for ($i = 0; $i < count($json->data); $i++) {
	$p = $json->data[$i]->expect;
	$sql = "SELECT 	issue FROM ".$getname." order by id desc";
	$result = $conn->query($sql);
    if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if(substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-3,3) == $row["issue"]){
              $state = true;
			  //echo $row["issue"];
			  break;
		  }else{
			  break;
		  }
		}
	}
	if(!$state){
			$sql = "SELECT name,push_num,push_nums,_case  FROM new_k3c";
			$result = $conn->query($sql);
        if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
           if($row["name"]==$_GET["name"]){
			 $stmt = $conn->prepare("INSERT INTO $getname (issue,num,lotterytime,push_nums,push_num) VALUES(?,?,?,?,?)");
             $stmt->bind_param("sssss", $issue,$num,$lotterytime,$p_nums,$total);
             $issue = substr($p,0,4).'-'.substr($p,4,2).'-'.substr($p,6,2).'   '.substr($p,-3,3);
             $num = $json ->data[$i]->opencode;
		     $lotterytime = $json ->data[$i]->opentime;
	         $p_nums = $row["push_nums"];
			 $total = $row["push_num"];
             $stmt->execute();
			 echo $issue;
			 echo "插入成功";
			 if($row["_case"]=="A"){
			   echo "A计划";
               require  'new_k3c.php';
			 }else{
			   echo "B计划";
               require  'new_k3c2.php';
			 }
			 $conn -> close();
			 return ;
		     }
		   }
		 }
		}
	break;
  }
}
echo "插入失败";
$conn -> close();
?>