<?php
require_once 'config.php';
include_once ('../plugin/Snoopy.class.php');

$action = $_GET ['action'];

switch ($action) {
	// --------------------------------------------common------------------------------------------------
	case 'register' :
		$user = new user ( $mysqli );
		$AdminName = $_POST ['AdminName'];
		$AdminEmail = $_POST ['AdminEmail'];
		$AdminPass = $_POST ['AdminPass'];
		$user->setName ( $AdminName );
		$user->setEmail ( $AdminEmail );
		$user->setPass ( $AdminPass );
		if (isLegal ( $AdminName ) && isLegal ( $AdminEmail ) && isLegal ( $AdminPass )) {
			$user->add ();
			echo "<script type='text/javascript'>window.location.href='../../display/login.php';</script>";
		}
		break;
	//------------------------------------------user-------------------------------------------------
	case 'changePass':
		$session = new session ();
		$session->start ();
		$session->startSupervise ( '../../display/login.php' );
		$oldPass=$_POST['oldpass'];
		$newPass = $_POST ['newpass'];
		$newPass2=$_POST['newpass2'];
		if (isLegal($oldPass)&&isLegal ( $newPass )&&isLegal($newPass2)) {
			$username = $session->getValue ( "username" );
			$verify=new verify($mysqli);
			if($verify->loginVerify($username, $oldPass)){
				if($newPass!=$newPass2){
					echo "fail:两次密码输入不一致，修改失败！";
					exit();
				}
				$user = new user ( $mysqli );
				$user->setName ( $username );
				$user->setPass($newPass);
				$user->update();
				echo "succ:修改成功！";				
			}
			else{
				echo "fail:原始密码错误，修改失败！";
			}
		}
		else{
			echo "fail:输入内容不能为空！";
		}
		break;
	default :
		break;
}
//echo $action;