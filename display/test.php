<?php
include_once ('../php/plugin/smarty/Smarty.class.php');
include_once ('../php/common/config.php');

$tmp=new drawData($conn);

//echo md5("中国")

//print_r($tmp->getSubData("2013-12-15", "2013-12-30", "1", "10015", "1"));

// $array=array(array("dike",16),array("list",30));
// echo json_encode($array);

$tmp->getSummaryDataForPie("2013-12-8", "2013-12-23", "1", "10015");