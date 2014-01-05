<?php
	require_once ('../php/plugin/smarty/Smarty.class.php');
	require_once ('../php/common/config.php');
	//判断是否登陆
	$session=new session();
	$session->start();
	if($session->getValue("islogin"))
	{
		$conn=$dbConnection->connect();
		$uid = $session->getValue("userid");
		$username = $session->getValue("username");
		$payment=new Payment($conn);
		$paymentArray=$payment->getById($uid);
		$smarty->assign("paymentArray",$paymentArray);
		$smarty->assign("LOCATION","list");	
		$smarty->assign("ISLOGIN",$session->getValue("islogin"));
		$smarty->assign("USERNAME",$username);
		$smarty->display ('showList.html');
	}
	else
	{
		echo "<script type='text/javascript'>alert('未登录');</script>";
		echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
	}
?>