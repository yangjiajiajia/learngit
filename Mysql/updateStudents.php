<?php
	header("Content-type:text/html;charset:utf-8");
	//统一返回格式
	$responseData = array("code" => 0,"message" => "");
	
	$id = $_GET['id'];
	if(!$id){
		$responseData["code"] = 1;
		$responseData["message"] = "没有要修改的数据";
		echo json_encode($responseData);
		exit;
	}
	
	$link = mysql_connect("localhost","root","2521849124");
	if(!$link){
		$responseData["code"] = 2;
		$responseData["message"] = "数据库链接失败";
		echo json_encode($responseData);
		exit;
	}
	mysql_set_charset("utf8");
	mysql_select_db("yyy");
	
	////准备sql语句
	$sql = "SELECT * FROM user WHERE id={$id}";
	
	$res = mysql_query($sql);
	
	$row = mysql_fetch_assoc($res);
	if(!$row){
		$responseData["code"] = 3;
		$responseData["message"] = "修改的数据不存在";
		echo json_encode($responseData);
	}else{
		$responseData["message"] = json_encode($row);
		echo json_encode($responseData);
	}
	
	mysql_close($link);
	
?>