<?php
	require_once ('../php/plugin/smarty/Smarty.class.php');
	require_once "../php/common/config.php";
	$cate = new Category($conn);
	$cate->generateRandomData(1000);
?>