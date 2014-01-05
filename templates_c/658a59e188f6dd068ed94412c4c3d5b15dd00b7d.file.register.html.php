<?php /* Smarty version Smarty-3.1.12, created on 2013-11-30 22:17:11
         compiled from "../templates/register.html" */ ?>
<?php /*%%SmartyHeaderCode:431551405299f36724dff1-57475364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '658a59e188f6dd068ed94412c4c3d5b15dd00b7d' => 
    array (
      0 => '../templates/register.html',
      1 => 1362659860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '431551405299f36724dff1-57475364',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5299f36729aa09_58529926',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5299f36729aa09_58529926')) {function content_5299f36729aa09_58529926($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" id="viewport" content="width=1000, maximum-scale=1.0"/>
<title>登录 | 基于个人兴趣的网页推送服务欢迎您！</title>
<link rel="shortcut icon" href="../themes/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/images/favicon.ico"/>
<link rel="stylesheet" href="../themes/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/css/login_register.css" />
<script type="text/javascript" src="../js/common/login_register.js"></script>
</head>

<body>
<div class="header">
  <div class="inner">
    <div class="logo"></div>
    <div class="nav">
      <ul>
        <li><a>升级</a></li>
        <li><a>功能</a></li>
        <li><a>服务支持</a></li>
        <li><a>博客</a> </li>
      </ul>
    </div>
    <div class="lang_switch">
      <div class="lang cn"></div>
      <div class="lang-dropmenu">
        <ul>
          <li>
            <div class="lang-choose en"></div>
            <a>English</a></li>
          <li>
            <div class="lang-choose cn"></div>
            <a>简体中文</a></li>
          <li>
            <div class="lang-choose tw"></div>
            <a>繁體中文</a></li>
          <li>
            <div class="lang-choose ja"></div>
            <a>日本語</a></li>
        </ul>
      </div>
    </div>
    <div class="signin_register"> <a href="login.php">登录</a> <span>|</span> <a href="register.php">免费注册</a> </div>
  </div>
</div>
<div class="body">
  <div class="inner">
    <div class="signin-box">
      <form method="post" action="../php/common/actions.php?action=register">
        <div class="usernamepart">
          <input id="username_prompt"  type="text" name="username_prompt" value="用户名" class="inputprompt" onfocus="inputPromptHide(this)"/>
          <input id="username"  type="text" name="AdminName" value="" class="inputcontent" onblur="inputPromptShow(this)"/>
        </div>
        <div class="passwordpart">
          <input id="email_prompt"  type="text" name="email_prompt" value="电子邮箱" class="inputprompt" onfocus="inputPromptHide(this)"/>
          <input id="email"  type="text" name="AdminEmail" value="" class="inputcontent" onblur="inputPromptShow(this)"/>
        </div>
<!--        
        <div class="passwordpart">
          <input id="email2_prompt"  type="text" name="email2_prompt" value="再次输入电子邮箱" class="inputprompt" onfocus="inputPromptHide(this)"/>
          <input id="email2"  type="text" name="AdminEmail2" value="" class="inputcontent" onblur="inputPromptShow(this)"/>
        </div>
-->    
        <div class="passwordpart">
          <input id="password_prompt"  type="text" name="password_prompt" value="密码" class="inputprompt" onfocus="inputPromptHide(this)"/>
          <input id="password"  type="password" name="AdminPass" value="" class="inputcontent" onblur="inputPromptShow(this)"/>
        </div>        
      
        <div class="forgetpassword"><a>忘记密码?</a></div>
        <div class="submitbtnpart">
          <input type="submit" name="" value="免费注册" class="signin_btn"/>
        </div>
      </form>
      <hr />
    </div>
  </div>
</div>
<div class="footer"></div>
</body>
</html><?php }} ?>