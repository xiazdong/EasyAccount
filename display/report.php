<?php
require_once ('../php/plugin/smarty/Smarty.class.php');
include_once ('../php/common/config.php');

$session=new session();
$session->start();
$islogin = $session->getValue("islogin");
$username = $session->getValue("username");

if($session->getValue("islogin"))
{
	$conn=$dbConnection->connect();
	$uid = $session->getValue("userid");
	$username = $session->getValue("username");
	$payment=new Payment($conn);
	$paymentArray=$payment->getById($uid);
	$smarty->assign("dateFrom",getDateDaysAgo(15));
	$smarty->assign("dateTo",getCurrentDate());
	$smarty->assign("LOCATION","report");
	$smarty->assign("ISLOGIN",$session->getValue("islogin"));
	$smarty->assign("USERNAME",$username);
	$smarty->display ( 'report.html' );
}
else
{
	echo "<script type='text/javascript'>alert('未登录');</script>";
	echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
}

?>
