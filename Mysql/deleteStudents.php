<?php
	header("Content-type:text/html;charset:utf-8");
	//统一返回格式
	$responseData = array("code" => 0,"message" => "");
	
	//删除 的数据
	$id = $_GET['id'];
	
	$link = mysql_connect("localhost","root","2521849124");
	if(!$link){
		$responseData["code"] = 1;
		$responseData["message"] = "数据库链接失败";
		echo json_encode($responseData);
		exit;
	}
	mysql_set_charset("utf8");
	mysql_select_db("yyy");
	
	////准备sql语句,用id删除语句
	$sql = "DELETE FROM user WHERE id={$id}";
	
	$res = mysql_query($sql);
	if(!$res){
		$responseData["code"] = 2;
		$responseData["message"] = "删除失败";
		echo json_encode($responseData);
	}else{
		$responseData["message"] = "删除成功";
		echo json_encode($responseData);
	}
	mysql_close($link);
	
?>