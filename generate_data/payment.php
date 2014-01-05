<?php
	require_once ('../php/plugin/smarty/Smarty.class.php');
	require_once "../php/common/config.php";
	$payment = new Payment($conn);
	$payment->generateRandomData(100, "12/6/2012", "12/6/2013");
?>