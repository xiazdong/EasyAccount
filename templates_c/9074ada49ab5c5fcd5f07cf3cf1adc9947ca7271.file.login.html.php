<?php /* Smarty version Smarty-3.1.12, created on 2013-12-11 07:12:21
         compiled from "..\templates\login.html" */ ?>
<?php /*%%SmartyHeaderCode:2846152a065e4b1ad99-54935054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9074ada49ab5c5fcd5f07cf3cf1adc9947ca7271' => 
    array (
      0 => '..\\templates\\login.html',
      1 => 1386745939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2846152a065e4b1ad99-54935054',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52a065e4c807b9_30449393',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a065e4c807b9_30449393')) {function content_52a065e4c807b9_30449393($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="../css/docs.css" rel="stylesheet"/>
		<script src="../js/common/jquery1.10.2.js"></script>
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
		<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet"
			media="screen"/>
		<link href="../css/bootstrap/css/bootstrap-responsive.css"
			rel="stylesheet" media="screen"/>
		<link rel="stylesheet" href="../themes/black/css/login_register.css" />
		<script type="text/javascript" src="../js/common/login_register.js"></script>
	</head>

<body>
	<?php echo $_smarty_tpl->getSubTemplate ("nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="container">
		<div class="inner">
			<div class="signin-box">
				<form method="post" action="../php/common/actions.php?action=login">
					<div class="usernamepart">
						<input id="username_prompt" type="text" name="AdminName"
							value="用户名" class="inputprompt" onfocus="inputPromptHide(this)" />
						<input id="username" type="text" name="AdminName" value=""
							class="inputcontent" onblur="inputPromptShow(this)" />
					</div>
					<div class="passwordpart">
						<input id="password_prompt" type="text" name="AdminPass"
							value="密码" class="inputprompt" onfocus="inputPromptHide(this)" />
						<input id="password" type="password" name="AdminPass" value=""
							class="inputcontent" onblur="inputPromptShow(this)" />
					</div>
					<div class="rememberme">
						<!--      <input type="checkbox" value="1" name="autologin" id="autologin">
          <label for="autologin">记住我 </label>
-->
					</div>
					<div class="forgetpassword">
						<a>忘记密码?</a>
					</div>
					<div class="submitbtnpart">
						<input type="submit" name="" value="登录" class="signin_btn" />
					</div>
				</form>
				<hr />

			</div>
		</div>
	</div>
	<div class="footer"></div>
</body>
</html><?php }} ?>