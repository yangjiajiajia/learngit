<?php
	header("Content-type:text/html;charset:utf-8");
	//统一返回格式
	$responseData = array("code" => 0,"message" => "");
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$addTime = $_POST["addTime"];
	
	//密码和用户名不能为空
	if(!$username){
		$responseData["code"] = 1;
		$responseData["message"] = "用户名不能为空";
		echo json_encode($responseData);
		exit;
	}
	if(!$password){
		$responseData["code"] = 2;
		$responseData["message"] = "密码不能为空";
		echo json_encode($responseData);
		exit;
	}
	
	
	$link = mysql_connect("localhost","root","2521849124");
	if(!$link){
		$responseData["code"] = 3;
		$responseData["message"] = "数据库链接失败";
		echo json_encode($responseData);
		exit;
	}
	mysql_set_charset("utf8");
	mysql_select_db("yyy");
	
	
	//准备sql语句，用来验证数据库里有没有重名的
	$sql1 = "SELECT * FROM user WHERE username='{$username}'";
	
	//发送sql语句
	$res = mysql_query($sql1);
	
	//取出一行来判断，如果取不出说明没有重名
	$row = mysql_fetch_assoc($res);
	if($row){//存在说明有重名
		$responseData["code"] = 4;
		$responseData["message"] = "用户名已存在";
		echo json_encode($responseData);
		exit;
	}
	
	//md5加密
	$str = md5(md5(md5($password)."xxx")."yyy");
	
	
	//准备sql语句插入到数据库
	$sql2 = "INSERT INTO user(username,password,create_time) VALUES('{$username}','{$str}',{$addTime})";
	//插入语句会返回一个布尔值判断是否插入成功
	$res = mysql_query($sql2);
	
	if(!$res){
		$responseData["code"] = 5;
		$responseData["message"] = "注册失败";
		echo json_encode($responseData);
		exit;
	}else{
		$responseData["message"] = "注册成功";
		echo json_encode($responseData);
	}
	mysql_close($link);
?>
