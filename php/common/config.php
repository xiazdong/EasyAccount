<?php

require_once ('objects.php');
$dbConnection = new dbConnection ();
//=======================================================
$dbConnection->DB="easyaccount2";
$dbConnection->USER="easyaccount";
$dbConnection->SERVERID="ybyjp2f7zw";
$dbConnection->PWD="Sei_1234";
//$conn=$dbConnection->connect();
//=======================================================
$smarty = new Smarty ();
$smarty->template_dir = "../templates"; // 模板存放目录
$smarty->compile_dir = "../templates_c"; // 编译目录
$smarty->left_delimiter = "{{"; // 左定界符
$smarty->right_delimiter = "}}"; // 右定界符



