<?php
	header("Content-type:text/html;charset:utf-8");
	//统一返回格式
	$responseData = array("code" => 0,"message" => "");
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	
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
	
	//md5加密
	$str = md5(md5(md5($password)."xxx")."yyy");
	
	
	//5.登录
	$sql ="SELECT * FROM user WHERE username='{$username}' AND password='{$str}'";
	
	$res = mysql_query($sql);
	
	//取出一行
	$row = mysql_fetch_assoc($res);
	if(!$row){
		$responseData["code"] = 4;
		$responseData["message"] = "用户名或密码错误";
		echo json_encode($responseData);
	}else{
		$responseData["message"] = "登录成功";
		echo json_encode($responseData);
	}
	mysql_close($link);
?>
