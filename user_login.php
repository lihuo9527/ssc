<?php
require 'header.php';
$buff = "";
$username = $_POST["username"];
global $conn,$sql,$buff,$username;

if (!isset($_POST["username"]) || empty($_POST["username"]) || !isset($_POST["userpassword"]) || empty($_POST["userpassword"])) {
		echo '参数错误!';
		return;
	}
 $sql = "SELECT username, userpassword FROM userinfo";

if(preg_match('/^[\d]+$/',$_POST["username"])){
    if(strlen($_POST["username"])==11
       && preg_match('/^1[3|4|5|7|8][0-9]{9}$/',$_POST["username"]) 
       && preg_match('/^(\w){6,25}$/',$_POST["userpassword"])){
         $buff = "ture";
    }else{
         echo '{"msg":"用户名或密码不合法!"}';
         
    }
   
 }else if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$_POST["username"])){
    if(preg_match('/^(\w){6,25}$/',$_POST["userpassword"])){
         $buff = "ture";
       }else{
         echo '{"msg":"用户名或密码不合法!"}';
    }
}else{
   echo '{"msg":"用户名或密码不合法"}';
}
if($buff == "ture"){
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $state = "";
        while($row = $result->fetch_assoc()) {
            if($_POST["username"]==$row["username"]){
            if($_POST["userpassword"]==$row["userpassword"]){
                $state = "true";
                break;
            }else{
                $state = "false";
                break;
            }
          }
        }
    if($state == "" || $state == "false"){
        if($state == "false"){
        echo '{"msg":"输入的密码不正确,请重新核对输入！"}';
        }else{
        echo '{"msg":"用户名不存在！"}';
        }
    } else{
        $date = date('YmdHis',time());
        $sql = "update userinfo set logintime='$date' where username='$username'";
        $res = $conn->query($sql);      
       if(!$res){
         echo '{"msg":"网络繁忙,请稍后重试！"}';
        }else{
          if($username=="13928483354"){
               echo '{"msg":"登录成功","logintime":"'.$date.'","admin":"true"}';
          }else{
              echo '{"msg":"登录成功","logintime":"'.$date.'","admin":"false"}';
          }
        }
      }
    } else {
        echo "{'msg':'请检查网络环境！'}";
    }
}

$conn -> close();
?>