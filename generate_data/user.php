<?php
	require_once ('../php/plugin/smarty/Smarty.class.php');
	require_once "../php/common/config.php";
	$user = new user($conn);
	$user->generateRandomData(10000);
?>