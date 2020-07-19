//星期几要变成中文
function numOfChinese(num) {
	var arr = ["日", "一", "二", "三", "四", "五", "六"];
	return arr[num];
}


//单位数的时间前面要补零
function doubleNum(n) {
	if (n < 10) {
		return "0" + n;
	} else {
		return n;
	}
}

function showTime(time) {
	var d = new Date(time);
	var year = d.getFullYear();
	var month = d.getMonth() + 1; //0~11
	var date = d.getDate();

	var week = d.getDay(); //0~6,0 是星期日
	week = numOfChinese(week);


	var hour = doubleNum(d.getHours());
	var min = doubleNum(d.getMinutes());
	var sec = doubleNum(d.getSeconds());
	var str = year + "年" + month + "月" + date + "日 星期" + week + "" + hour + ":" + min + ":" + sec;
	return str;
}
