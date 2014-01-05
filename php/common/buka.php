<?php
require_once ('../plugin/smarty/Smarty.class.php');
require_once 'config.php';
$conn = $dbConnection->connect ();

$action = $_GET ['action'];

$session = new session ();
$session->start ();
$from = $_POST ['from'];
$to = $_POST ['to'];
$type = $_POST ['type'];
$drawData = new drawData ( $conn );

switch ($action) {
	case "drawSummary" :
		echo $drawData->getSummaryData ( $from, $to, "1", $session->getValue ( "userid" ) );
		break;
	case "drawSummaryForPie" :
		echo $drawData->getSummaryDataForPie ( $from, $to, "1", $session->getValue ( "userid" ) );
		break;
	case "drawSub" :
		$type = $_GET ['type'];
		echo $drawData->getSubData ( $from, $to, "1", $session->getValue ( "userid" ), $type );
		break;
	case "drawAccount" :
		echo $drawData->getAccountData ( $from, $to, $session->getValue ( "userid" ) );
		// echo $drawData->getSubData($from, $to, "0",$session->getValue("userid"),"0");
		break;
	default :
		break;
}
