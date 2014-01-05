<?php
require_once ('../php/plugin/smarty/Smarty.class.php');
require_once ('../php/common/config.php');

$session=new session();
$session->start();
$islogin = $session->getValue("islogin");
$username = $session->getValue("username");
if($islogin){
	$smarty->assign("ISLOGIN",$islogin);
	$smarty->assign("USERNAME",$username);
}
else{
	$smarty->assign("ISLOGIN",false);
	$smarty->assign("USERNAME","");
}
$smarty->assign("LOCATION","index");
$smarty->display ( 'index.html' );
?>
