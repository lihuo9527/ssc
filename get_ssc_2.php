<?php 
require  'header.php';
global $conn,$sql,$state,$getname,$item;
$getname = $_GET["name"];
$src = "http://123.207.43.236/php/get_cp_2.php?name=".$getname;
$json = file_get_contents($src);
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
if(count($item)>2){
$item[0] = substr($item[0],3,16);
$sql = "SELECT 	issue FROM ".$getname." order by id desc";
$result = $conn->query($sql);
if ($result->num_rows > 0){
while($row = $result->fetch_assoc()){
	if(substr($item[0],0,4).'-'.substr($item[0],5,2).'-'.substr($item[0],8,2).'   '.substr($item[0],-3,3) == $row["issue"]){
		$state = true;
		break;
	}else{
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
             $issue = substr($item[0],0,4).'-'.substr($item[0],5,2).'-'.substr($item[0],8,2).'   '.substr($item[0],-3,3);
             $num = $item[2];
		     $lotterytime = $item[1];
			 $a = $row["a"];
			 $b = $row["b"];
			 $c = $row["c"];
			 $d = $row["d"];
			 $e = $row["e"];
	         $p_nums = $row["push_nums"];
             $stmt->execute();
			 echo "插入成功";
			 require  'new_ssc.php';
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