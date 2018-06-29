<?php
require 'header.php';
$buff = "";
global $conn,$sql,$buff;

if (!isset($_POST["username"]) || empty($_POST["username"]) || !isset($_POST["userpassword"]) || empty($_POST["userpassword"])) {
		echo '参数错误!';
		return;
	}

 $sql = "SELECT username FROM userinfo";

function get_length($str){
 return mb_strlen($str,"UTF8");
}

if(preg_match('/^[\d]+$/',$_POST["username"])){
    if(strlen($_POST["username"])==11
       && preg_match('/^1[3|4|5|7|8][0-9]{9}$/',$_POST["username"]) 
       && $_POST["userpassword"] == $_POST["userpassword1"]
       && preg_match('/^(\w){6,25}$/',$_POST["userpassword"])){
         $buff = "ture";
    }else{
         echo '{"msg":"用户名或密码不合法!"}';
         
    }
   
 }else if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$_POST["username"])){
    if( $_POST["userpassword"] == $_POST["userpassword1"]
       && preg_match('/^(\w){6,25}$/',$_POST["userpassword"])){
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
                $state = "true";
                break;
            }
            }
        if($state == "true"){
            echo '{"msg":"用户名已存在！"}';
        } else{
            $stmt = $conn->prepare("INSERT INTO userinfo (username,userpassword) VALUES(?,?)");
            $stmt->bind_param("ss", $username, $userpassword);
            $username = $_POST["username"];
            $userpassword = $_POST["userpassword"];
            $stmt->execute();
            echo '{"msg":"注册成功！"}';
            }
    }else{
        echo '{"msg":"网络连接失败，请检查网络环境！"}';
    }
}



$conn -> close();
?>