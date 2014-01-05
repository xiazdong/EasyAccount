<?php
require_once ('../plugin/smarty/Smarty.class.php');
require_once 'config.php';
$conn=$dbConnection->connect();

$action = $_GET ['action'];
switch ($action) {
	case 'register' :
		$AdminName = $_POST ['AdminName'];
		$AdminEmail = $_POST ['AdminEmail'];
		$AdminPass = $_POST ['AdminPass'];
		$user = new user ($conn);
		$user->setName ( $AdminName );
		$user->setEmail ( $AdminEmail );
		$user->setPass ( $AdminPass );
		if ($user->exist ( $AdminEmail )) {
			echo "fail";
		} else {
			if (isLegal ( $AdminName ) && isLegal ( $AdminEmail ) && isLegal ( $AdminPass )) {
				$uid = $user->add ();
				$session = new session();
				$session->start();
				$session->setValue ( 'userid', $uid);
				$session->setValue ( 'username', $AdminName);
				$session->setValue ( 'islogin', true);
				echo "success";
			}
		}
		break;
	case 'login' :
		$email = $_POST ['AdminEmail'];
		$password = $_POST ['AdminPass'];
		$verify = new verify ( $conn,$email);
		if (isLegal ( $email ) && isLegal ( $password ) && $verify->loginVerify ( $email, $password )) 
		{
			$session = new session ();
			$session->start ();
			$session->setValue ( 'userid', $verify->uid);
			$session->setValue ( 'username', $verify->username );
			$session->setValue ( 'islogin', true);
			echo 'success';
		} 
		else 
		{
			echo 'fail';
		}
		break;
	case 'logout' :
		$session = new session ();
		$session->start ();
		$session->destroy ();
		break;
	
	// ------------------------------------------user-------------------------------------------------
	case 'changePass' :
		$session = new session ();
		$session->start ();
		$session->startSupervise ( '../../display/login.php' );
		$oldPass = $_POST ['oldpass'];
		$newPass = $_POST ['newpass'];
		$newPass2 = $_POST ['newpass2'];
		if (isLegal ( $oldPass ) && isLegal ( $newPass ) && isLegal ( $newPass2 )) {
			$username = $session->getValue ( "username" );
			$verify = new verify ( $mysqli );
			if ($verify->loginVerify ( $username, $oldPass )) {
				if ($newPass != $newPass2) {
					echo "fail:两次密码输入不一致，修改失败！";
					exit ();
				}
				$user = new user ( $mysqli );
				$user->setName ( $username );
				$user->setPass ( $newPass );
				$user->update ();
				echo "succ:修改成功！";
			} else {
				echo "fail:原始密码错误，修改失败！";
			}
		} else {
			echo "fail:输入内容不能为空！";
		}
		break;
	default :
		break;
}
