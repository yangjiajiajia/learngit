function querystring(obj){
	var str = "";
	for(var attr in obj){
		str += attr + "=" + obj[attr] + "&";
	}
	return str.substring(0,str.length -1);
}

function $ajax({method = "get",url,data,success,error}){
	var xhr = null;
	try{
		xhr = new XMLHttpRequest();
	}catch{
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	if(data){
		data = querystring(data);
	}

	if(method == "get" && data){
		url += "?" + data;
	}

	xhr.open(method,url,true);

	if(method == "get"){
		xhr.send();
	}else{
		xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
		xhr.send(data);
	}

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				if(success){
				success(xhr.responseText);
				}
			}else{
				if(error){
				error("Error:" + xhr.status);
				}
			}
		}
	}

}