<?php
header ( "Content-Type: text/html; charset=utf-8" );
require_once 'functions.php';
class salt {
	var $salt;
	function salt($email)
	{
		$this->salt = $email;
	}
	function getSalt() {
		return $this->salt;
	}
}
class dbConnection {
	var $DB;
	var $USER;
	var $SERVERID;
	var $PWD;
	var $conn;
	function connect() {
		$serverName = "tcp:" . $this->SERVERID . ".database.windows.net, 1433";
		$connectionOptions = array (
				"Database" => $this->DB,
				"UID" => $this->USER . "@" . $this->SERVERID,
				"PWD" => $this->PWD,
				"CharacterSet"=>"UTF-8"
		);
		$this->conn = sqlsrv_connect ( $serverName, $connectionOptions );
		if (! $this->conn) {
			print_r ( sqlsrv_errors (), true );
			exit ();
		} else
		{
			//sqlsrv_query ( $this->conn, "set names gb2313");
			return $this->conn;
		}
	}
	function disconnect() {
	}
}
class session {
	var $salt;
	function session() {
		$this->salt = new salt ("");
		$this->salt = $this->salt->getSalt ();
	}
	function start() {
		session_start ();
	}
	function destroy() {
		setcookie ( "cookiename", '', time () - 1 );
		session_unset ();
		session_destroy ();
	}
	function setValue($name, $value) {
		$_SESSION [sha1 ( $this->salt . $name )] = $value;
	}
	function getValue($name) {
		return $_SESSION [sha1 ( $this->salt . $name )];
	}
	function startSupervise($indexURL) {
		if (! isset ( $_SESSION [sha1 ( $this->salt . "username" )] ) || $_SESSION [sha1 ( $this->salt . "password" )] == "" || $_SESSION [sha1 ( $this->salt . "userid" ) == ""]) {
			echo "<script type='text/javascript'>alert('请先登录！');</script>";
			echo "<script type='text/javascript'>window.location.href='" . $indexURL . "';</script>";
			exit ();
		}
	}
	function isLogin() {
		if (! isset ( $_SESSION [sha1 ( $this->salt . "username" )] ) || $_SESSION [sha1 ( $this->salt . "password" )] == "" || $_SESSION [sha1 ( $this->salt . "userid" ) == ""]) {
			return false;
		} else {
			return true;
		}
	}
}
class verify {
	var $conn;
	var $table = "[dbo].[user]";
	var $salt;
	var $username;
	var $uid;
	function verify($conn,$email) {
		$this->conn = $conn;
		$this->salt = new salt ($email);
		$this->salt = $this->salt->getSalt ();
	}
	function loginVerify($email, $pass) {
		$pass = sha1 ( sha1 ( $this->salt . $pass ) );
		$sql = "SELECT uid,name FROM $this->table WHERE email='$email' AND password='$pass'";
		$result = sqlsrv_query($this->conn, $sql);
		if($row = sqlsrv_fetch_array($result))
		{
			$this->username = $row["name"];
			$this->uid = $row["uid"];
			return true;
		}
		else
		{
			return false;
		}
	}
	function getUserId() {
		return $this->userId;
	}
}
class Payment {
	var $conn;
	function Payment($conn) {
		$this->conn = $conn;
	}
	function getById($userId) {
		$tsql = "SELECT  payment.pid as pid, category.type as type, category.cname as cname, payment.amount as amount,payment.flag as flag, payment.data as data, payment.description as description from [dbo].[payment]
                        as payment,[dbo].[category] as category where payment.uid=$userId and payment.cid=category.cid ORDER BY payment.data DESC";
		$result = sqlsrv_query ( $this->conn, $tsql );
		if ($result === false) {		//连接出错
			die ( print_r ( sqlsrv_errors (), true ) );
		}
		$paymentArray = array ();
		$id = 0;
		while ( $row = sqlsrv_fetch_array ( $result ) ) {
			$id++;
			$row['id']=$id;
			$row['data']=$row['data']->format ( 'm/d/Y' );
			if($row['flag']==1)
			{
				$row['type']=getNameByTypeId($row['type']);
			}
			else
			{
				$row['type'] = "";
				$row['cname'] = "";
			}
			array_push ( $paymentArray, $row );
		}
		return $paymentArray;
	}
	/**
	 * 每天生成$num条数据
	 * $fromdate是string
	 * $todate是string
	 */
	function generateRandomData($num,$fromdate,$todate)
	{
		set_time_limit(0);		//设置最大运行时间为无限
		//1.定义变量
		$uid = -1;
		$cid = -1;
		$amount = 0;
		$flag = 0;
		$description = '描述';
		$begindate = $fromdate;
		$tsqlbase = "INSERT INTO [dbo].[payment](uid,cid,amount,flag,data,description) VALUES ";
		$tsql = "";
		//2.生成数据
		while(strtotime($begindate)<strtotime($todate))
		{
			$tsql = $tsqlbase;
			for($i=0;$i<$num;$i++)
			{
				$uid = mt_rand(1, 10000);		//uid只能在1～10000
				$cid = mt_rand(1, 1000);		//cid只能在1～1000
				$amount = mt_rand(1,20000);
				$flag = mt_rand(0,1);
				$tsql = $tsql."($uid,$cid,$amount,$flag,'$begindate','$description')";
				if($i<$num-1)
				{
					$tsql = $tsql.",";
				}
			}	
			$result = sqlsrv_query($this->conn,$tsql) ;
			if ($result === false) {
				die ( print_r ( sqlsrv_errors (), true ) );
			}
			$begindate = date("m/d/Y",strtotime($begindate)+86400);
		}
	}
}

class user {
	var $conn;
	var $uid = -1;
	var $username;
	var $password;
	var $email;
	var $salt;
	var $tableName = "[dbo].[user]";
	function user($conn)
	{
		$this->conn = $conn;
	}
	function setName($userName) {
		$this->userName = $userName;
	}
	function setEmail($email) {
		$this->email = $email;
		$this->salt = $email;
	}
	function setPass($pass) {
		$this->password = $pass;
	}
	function setId($id) {
		$this->uid = $id;
	}
	function add() {
		$this->password = sha1 ( sha1 ( $this->salt . $this->password ) );
		$sql = "INSERT INTO $this->tableName(email,name,password) VALUES ('$this->email','$this->userName','$this->password');";
		sqlsrv_query ( $this->conn, $sql );
		$sql = "SELECT uid FROM $this->tableName WHERE email='$this->email'";
		$result = sqlsrv_query($this->conn,$sql);
		if($row = sqlsrv_fetch_array($result))
		{
			$this->uid = $row['uid'];
		}
		return $this->uid;
	}
	function update() {
		$this->password = sha1 ( sha1 ( $this->salt . $this->password ) );
		$sql = "UPDATE $this->tableName SET password='$this->password' WHERE email='$this->email';";
		sqlsrv_query ($this->conn, $sql);
	}
	function delete() {
		$sql = "DELETE FROM $this->tableName WHERE email='$this->email';";
		sqlsrv_query ($this->conn, $sql);
	}
	function getIdByEmail($email) {
		$sql = "SELECT uid FROM $this->tableName WHERE email='$email';";
		$result = sqlsrv_query ($this->conn, $sql);
		if($row=sqlsrv_fetch_array($result))
		{
			$this->uid = $row["uid"];
			return $this->uid;
		}
		else return -1;
	}
	function getNameByEmail($email) {
		$sql = "SELECT name FROM $this->tableName WHERE email='$email';";
		$result = sqlsrv_query ($this->conn, $sql);
		if($row=sqlsrv_fetch_array($result))
		{
			$this->name = $row["name"];
			return $this->name;
		}
		else return -1;
	}
	function exist($email) {
		$sql = "SELECT * FROM $this->tableName WHERE email='$email';";
		$result = sqlsrv_query ($this->conn, $sql);
		if($row=sqlsrv_fetch_array($result)) return true;
		else return false;
	}
	function generateRandomData($num)
	{
		set_time_limit(0);		//设置最大运行时间为无限
		//1.定义变量
		$namebase = "xiazdong";
		$password = "12345678";
		$email = "xiazdong@126.com";
		$tsqlbase = "INSERT INTO [dbo].[user](name,password,email) VALUES ";
		$tsql = "";
		$count = 1;
		//2.生成数据
		for($i=0;$i<$num/100;$i++)
		{
			$tsql = $tsqlbase;
			for($j=0;$j<100;$j++)
			{
				$name = $namebase."-".$count;
				$count++;
				$tsql = $tsql."('$name','$password','$email')";
				if($j<99)
				{
					$tsql = $tsql.",";
				}
			}
			$result = sqlsrv_query($this->conn,$tsql) ;
			if ($result === false) {
				die ( print_r ( sqlsrv_errors (), true ) );
			}
			//echo $tsql;
		}
	}
}

class Category
{
	var $conn;
	function Category($conn)
	{
		$this->conn = $conn;
	}
	function generateRandomData($num)
	{
		set_time_limit(0);		//设置最大运行时间为无限
		//1.定义变量
		$cnamebase = "类别";
		$uid = 0;
		$type = 0;
		$tsqlbase = "INSERT INTO [dbo].[category](cname,uid,type) VALUES ";
		$tsql = $tsqlbase;
		//2.生成数据
		for($i=1;$i<=$num;$i++)
		{
			$cname = $cnamebase."-".$i;
			$type = mt_rand(1, 5);
			$uid = mt_rand(1, 10000);
			$tsql = $tsql."('$cname',$uid,$type)";
			if($i<$num)
			{
				$tsql = $tsql.",";
			}
		}
		$result = sqlsrv_query($this->conn,$tsql) ;
		if ($result === false) {
			die ( print_r ( sqlsrv_errors (), true ) );
		}
	}
	function getByType($uid,$type)
	{
		$tsql = "SELECT cname FROM [dbo].[category] WHERE uid = $uid AND type=$type";
		$result = sqlsrv_query($this->conn,$tsql);
		$cateList = "";
		while( $row = sqlsrv_fetch_array ( $result ))
		{
			$cateList .= ($row['cname']." ");
		}
		return $cateList;
	}
}

class drawData {
	var $conn;
	function drawData($conn) {
		$this->conn = $conn;
	}
	function getSummaryData($from, $to, $flag,$userId) {
		$dateArray = getDateRange ( $from, $to );
		$dataLength = count ( $dateArray );
		
		$darr = array ();
		for($i = 0; $i < $dataLength; $i ++) {
			$darr [$dateArray [$i]] = 0;
		}
		$resultArr = array ();
		for($i = 1; $i <= 5; $i ++) {
			$element = array ();
			$element ["name"] =getNameByTypeId($i);
			$element ["data"] = $darr;
			$resultArr [] = $element;
		}
		// print_r($resultArr);
		
		$sql = "SELECT type,data,SUM(amount) as result FROM [dbo].[payment] payment,[dbo].[category] category WHERE data>= '$from' AND data<='$to' AND flag='$flag' 
		AND payment.cid=category.cid AND payment.uid='$userId' GROUP BY type,data";
		$re = sqlsrv_query ( $this->conn, $sql );
		// echo $sql;
		$result = array ();
		$allCost=0;
		while ( $row = sqlsrv_fetch_array ( $re ) ) {
			$row ['data'] = $row ['data']->format ( 'Y-m-d' );
			$result [] = $row;
			$resultArr [$row ["type"] - 1] ["data"] [$row ['data']] = $row ["result"];
			$allCost+=$row['result'];
		}
		for($i = 0; $i <= 4; $i ++) {
			$resultArr[$i]['data']=array_values($resultArr[$i]['data']);
		}
		//print_r ( $resultArr );
		foreach ($dateArray as &$date)
		{
			$tmp=split("-", $date);
			$date=$tmp[1]."/".$tmp[2];
		}
		
		$tmpFrom=explode("-", $from);
		$tmpTo=explode("-", $to);
		$array = array (
				'DATA' =>$resultArr,
				'CATEGORIES' =>$dateArray,
				//'TITLE' => $tmpFrom[1]."/".$tmpFrom[2]."至".$tmpTo[1]."/".$tmpTo[2]."综合分析",
				'TITLE'=>$allCost,
				'SUBTITLE' => "",
				'STEP' => floor($dataLength/10)
		);
		return json_encode($array);
	}
	function getSummaryDataForPie($from, $to, $flag,$userId){
		$sql = "SELECT type,SUM(amount) as result FROM [dbo].[payment] payment,[dbo].[category] category WHERE data>= '$from' AND data<='$to' AND flag='$flag'
		AND payment.cid=category.cid AND payment.uid='$userId' GROUP BY type";
		$re = sqlsrv_query ( $this->conn, $sql );
		// echo $sql;
		$result = array ();
		$allCost=0;
		while ( $row = sqlsrv_fetch_array ( $re ) ) {
			$data=array();
			//echo getNameByTypeId($row['type']);
			$data[]=getNameByTypeId($row['type']);
			$data[]=$row['result']/1;
			$result [] = $data;
			$allCost+=$row['result'];
		}
		//print_r($result);
		$array = array (
				'DATA' =>$result,
				'TITLE'=>$allCost
		);
		return json_encode($array);
	}
	function getAccountData($from, $to,$userId){
		$dateArray = getDateRange ( $from, $to );
		$dataLength = count ( $dateArray );
	
		$darr = array ();
		for($i = 0; $i < $dataLength; $i ++) {
			$darr [$dateArray [$i]] = 0;
		}
	
		$element = array ();
		$element ["name"] = "收入";
		$element ["data"] = $darr;
	
		$sql="SELECT amount,data FROM [dbo].[payment] WHERE data>= '$from' AND data<='$to' AND flag=0
		AND payment.uid='$userId'";
		//echo $sql;
	
		$re = sqlsrv_query ( $this->conn, $sql );
		// echo $sql;
	
		$allCost=0;
		while ( $row = sqlsrv_fetch_array ( $re ) ) {
			$row ['data'] = $row ['data']->format ( 'Y-m-d' );
			//echo getNameByTypeId($row['type']);
			$element["data"][$row ['data']]=$row['amount']/1;
			$allCost+=$row['amount']/1;
		}
		$element['data']=array_values($element['data']);
		foreach ($dateArray as &$date)
		{
			$tmp=split("-", $date);
			$date=$tmp[1]."/".$tmp[2];
		}
	
		//print_r($result);
		$resultsData=array();
		$resultsData[]=$element;
		$array = array (
				'DATA' =>$resultsData,
				'CATEGORIES' =>$dateArray,
				//'TITLE' => $tmpFrom[1]."/".$tmpFrom[2]."至".$tmpTo[1]."/".$tmpTo[2]."综合分析",
				'TITLE'=>$allCost,
				'SUBTITLE' => "",
				'STEP' => floor($dataLength/10)
		);
		return json_encode($array);
	}
	function getSubData($from,$to,$flag,$userId,$type){
		$dateArray = getDateRange ( $from, $to );
		$dataLength = count ( $dateArray );
		
		$darr = array ();
		for($i = 0; $i < $dataLength; $i ++) {
			$darr [$dateArray [$i]] = 0;
		}
		
		$sql="SELECT * FROM [dbo].[category] WHERE uid='$userId' AND type='$type'";
		$re=sqlsrv_query ( $this->conn, $sql );
		$typeData=array();
		while ($row=sqlsrv_fetch_array($re))
		{
			$typeData[]=$row;	
		}
		
		//echo "type count:".$typeCount."\n";
		$resultArr = array ();		
		for($i = 0; $i <count($typeData); $i ++) {
			$element = array ();
			$element ["name"] =$typeData[$i]['cname'];
			$element ["data"] = $darr;
			$resultArr [md5($typeData[$i]['cname'])] = $element;
		}
		//print_r($resultArr);
		$sql="SELECT cname,data,SUM(amount) as result FROM [dbo].[payment] payment, [dbo].[category] category WHERE 
		data>= '$from' AND data<='$to' AND flag='$flag' AND 
		category.cid=payment.cid AND category.type='$type' AND payment.uid='$userId'
		GROUP BY cname,data";
		
		//echo $sql;
		
		$re = sqlsrv_query ( $this->conn, $sql );
		// echo $sql;
		$result = array ();
		$allCost=0;
		while ( $row = sqlsrv_fetch_array ( $re ) ) {
			$row ['data'] = $row ['data']->format ( 'Y-m-d' );
			$result [] = $row;
			$resultArr [md5($row ["cname"])] ["data"] [$row ['data']] = $row ["result"];
			$allCost+=$row['result'];
		}
		
		//print_r($result);
		//print_r($resultArr);

		for($i = 0; $i < count($typeData); $i ++) {
			$resultArr[md5($typeData[$i]['cname'])]['data']=array_values($resultArr[md5($typeData[$i]['cname'])]['data']);
		}
		//print_r ( $resultArr );
		foreach ($dateArray as &$date)
		{
			$tmp=split("-", $date);
			$date=$tmp[1]."/".$tmp[2];
		}
		
		$tmpFrom=explode("-", $from);
		$tmpTo=explode("-", $to);
		$array = array (
				'DATA' =>array_values($resultArr),
				'CATEGORIES' =>$dateArray,
				//'TITLE' => $tmpFrom[1]."/".$tmpFrom[2]."至".$tmpTo[1]."/".$tmpTo[2]."综合分析",
				'TITLE'=>$allCost,
				'SUBTITLE' => "",
				'STEP' => floor($dataLength/10)
		);
		return json_encode($array);
	}
	
	
}
class fileOperater {
	function makeDir($path) {
		mkdir ( $path, 0777 );
	}
	// Delete file
	function delete($dirn) {
		if (file_exists ( $dirn )) {
			if (is_file ( $dirn )) {
				unlink ( $dirn );
			} else {
				$handle = opendir ( $dirn );
				while ( $file = readdir ( $handle ) ) {
					if ($file == "." || $file == "..")
						continue;
					if (is_dir ( "$dirn/$file" )) {
						$this->delete ( "$dirn/$file" );
					} else {
						unlink ( "$dirn/$file" );
					}
				}
				closedir ( $handle );
				rmdir ( "$dirn/$file" );
			}
		}
	}
	function fileCopy($source, $destination, $child) {
		// 用法：
		// xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
		// xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录
		if (! is_dir ( $source )) {
			copy ( $source, $destination );
			chmod ( $destination, 0777 );
			return true;
		}
		if (! is_dir ( $destination )) {
			mkdir ( $destination, 0777 );
			chmod ( $destination, 0777 );
		}
		
		$handle = dir ( $source );
		while ( $entry = $handle->read () ) {
			if (($entry != ".") && ($entry != "..")) {
				if (is_dir ( $source . "/" . $entry )) {
					if ($child)
						$this->fileCopy ( $source . "/" . $entry, $destination . "/" . $entry, $child );
				} else {
					copy ( $source . "/" . $entry, $destination . "/" . $entry );
				}
			}
		}
		return true;
	}
	function saveFile($content, $path) {
		$newFile = fopen ( $path, "w" );
		fwrite ( $newFile, $content );
		fclose ( $newFile );
		chmod ( $path, 0777 );
	}
}
?>
