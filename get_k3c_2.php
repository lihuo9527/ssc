<?php 
require  'header.php';
global $conn,$sql,$state,$getname,$item;
$getname = $_GET["name"];
$src = "http://123.207.43.236/php/get_cp_2.php?name=".$getname;
$json = file_get_contents($src);
$json =  iconv("GB2312", "UTF-8//Ignore", $json);
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
$item = explode("*", $json);
$item[0] = substr($item[0],3,16);
if(count($item)>2){
$sql = "SELECT 	issue FROM ".$getname." order by id desc";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
	if($item[0] == $row["issue"]){
        $state = true;
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
             $issue = $item[0];
             $num = $item[2];
		     $lotterytime = $item[1];
	         $p_nums = $row["push_nums"];
			 $total = $row["push_num"];
             $stmt->execute();
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
}
echo "插入失败";
$conn -> close();
?>