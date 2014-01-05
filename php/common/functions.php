<?php
function isLegal($parameter)
{
	if ((isset($parameter))&&(!empty($parameter))&&($parameter!='')) {
		return true;
	}
	else return false;
}
function checkUrl($weburl)
{
	//return !ereg("^http(s)*://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$", $weburl);
	return filter_var($parameter,FILTER_VALIDATE_URL);
}
function url_exists($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_NOBODY, 1); // 不下载
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	return (curl_exec($ch)!==false) ? true : false;
}
function getIdByTypeName($type)
{
	switch($type)
	{
		case "收入":$type = 0;break;
		case "餐饮":$type = 1;break;
		case "购物":$type = 2;break;
		case "交通":$type = 3;break;
		case "杂费":$type = 4;break;
		case "其他":$type = 5;break;
	}
	return $type;
}
function getNameByTypeId($type)
{
	switch($type)
	{
		case 0:$type = "收入";break;
		case 1:$type = "餐饮";break;
		case 2:$type = "购物";break;
		case 3:$type = "交通";break;
		case 4:$type = "杂费";break;
		case 5:$type = "其他";break;
	}
	return $type;
}
function getDateRange($start, $end) {
	list ( $s_year, $s_month, $s_day ) = explode ( "-", $start );
	list ( $e_year, $e_month, $e_day ) = explode ( "-", $end );
	$mk_start = mktime ( 0, 0, 0, $s_month, $s_day, $s_year );
	$mk_end = mktime ( 0, 0, 0, $e_month, $e_day, $e_year );
	$day = ($mk_end - $mk_start) / (24 * 3600);
	$re_arr = array ();
	for($i = 0; $i < $day + 1; $i ++) {
		$temp_day = $s_day + $i;
		$str = mktime ( 0, 0, 0, $s_month, $temp_day, $s_year );
		$re_arr [$i] = strftime ( "%Y-%m-%d", $str );
	}
	return $re_arr;
}
function getCurrentDate(){
	return date("Y-m-d");
}
function getDateDaysAgo($days) {
	$curDate=getCurrentDate();
	$array=explode('-',$curDate);
	$year=$array[0];
	$month=$array[1];
	$day=$array[2];
	$time=date("Y-m-d",mktime(0,0,0,$month,$day-$days,$year));
	return $time;
}