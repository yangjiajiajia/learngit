<?php
	header("Content-type:text/html;charset:utf-8");
	//统一返回格式
	
	$link = mysql_connect("localhost","root","2521849124");
	if(!$link){
		echo "数据库链接失败";
		exit;
	}
	mysql_set_charset("utf8");
	mysql_select_db("yyy");
	
	
	//准备sql语句
	$sql = "SELECT * FROM user";
	
	$res = mysql_query($sql);
	
	$arr = array();
	
	while($row = mysql_fetch_assoc($res)){
		array_push($arr,$row);
	}
	
	echo json_encode($arr);
	mysql_close($link);
?>