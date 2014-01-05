<?php /* Smarty version Smarty-3.1.12, created on 2014-01-05 03:32:18
         compiled from "..\templates\nav.html" */ ?>
<?php /*%%SmartyHeaderCode:1446952a06e24a91b47-17713223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc9998af78db17466305bdf5f49d23b8f24c79b0' => 
    array (
      0 => '..\\templates\\nav.html',
      1 => 1388892737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1446952a06e24a91b47-17713223',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52a06e24a9c682_86329558',
  'variables' => 
  array (
    'LOCATION' => 0,
    'ISLOGIN' => 0,
    'USERNAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a06e24a9c682_86329558')) {function content_52a06e24a9c682_86329558($_smarty_tpl) {?><link href="../js/plugin/jquery_ui/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="../js/plugin/jquery_ui/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#loginButton").click(function(){
		var email = $("#AdminEmail").val();
		var password = $("#AdminPass").val();
		
		if(!verifyLegal(email))
		{
			alert("邮箱格式不正确！");
		}
		else if(password.trim()==""){
			alert("密码不能为空！");
		}
		else 
		{
			
			$.ajax({
				url : $('#loginForm').attr('action'),
				data : $('#loginForm').serialize(),
				type : $('#loginForm').attr('method'),
				cache : false,
				success : function(data) {
							if(data=="fail")
							{
								alert("帐号或密码错误");
							}
							window.location.href = "../display/index.php";
						  }
			});
		}
	}); 
	$("#loginForm").keypress(function(event){		//按回车键即可登录
		if(event.keyCode==13){
			login();
		}
	});
	$("#signoutButton").click(function(){
		$.post("../php/common/actions.php?action=logout",{},function(data,status){
			window.location.href = "index.php";
		});
	});
	
	var emailTags = ["126.com","163.com","gmail.com","hotmail.com","live.com"];
	$("#AdminEmail").autocomplete({
		source:function(request,response){
			var preText = request.term;
			var result = new Array();
			var atpos = preText.indexOf("@");
			if(atpos==-1)
			{
				for(var postemail in emailTags)
				{
					result.push(preText+"@"+emailTags[postemail]);
				}
			}
			else
			{
				var postText = preText.substring(atpos+1);
				var host = preText.substring(0,atpos);
				for(var postemail in emailTags)
				{
					if(emailTags[postemail].indexOf(postText)==0)
					{
						result.push(host+"@"+emailTags[postemail]);
					}
				}
			}
			response(result);
		}
	});
});
//验证邮箱格式是否正确的函数
function verifyLegal(email){
	var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);
	return patten.test(email);
}
function login()
{
	var email = $("#AdminEmail").val();
	var password = $("#AdminPass").val();
	if(!verifyLegal(email))
	{
		alert("邮箱格式不正确！");
	}
	else if(password.trim()==""){
		alert("密码不能为空！");
	}
	else{
		$.ajax({
			url : $('#loginForm').attr('action'),
			data : $('#loginForm').serialize(),
			type : $('#loginForm').attr('method'),
			cache : false,
			success : function(data) {
						if(data=="fail")
						{
							alert("帐号或密码错误");
						}
						window.location.href = "../display/index.php";
					  }
		});
	}
}
</script>
<style>
	input[type]{
		text-align:left;
	}
</style>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">Easy Account</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($_smarty_tpl->tpl_vars['LOCATION']->value=='index'){?>class="active"<?php }?>><a href="index.php">首页</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['LOCATION']->value=='list'){?>class="active"<?php }?>><a href="showList.php">收支详情</a></li>
              <?php if ($_smarty_tpl->tpl_vars['LOCATION']->value=='list'){?>
              <li><a href="#addItem" data-toggle="modal">添加记录</a></li>
             
              <?php }?>
              
              <li <?php if ($_smarty_tpl->tpl_vars['LOCATION']->value=='report'){?>class="active"<?php }?>><a href="report.php">图表分析</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['LOCATION']->value=='about'){?>class="active"<?php }?>><a href="about.php">关于</a></li>
            </ul>
            <?php if ($_smarty_tpl->tpl_vars['ISLOGIN']->value==true){?>
            <form class="navbar-form pull-right">
              <span class="navbar-brand hidden-sm" style="font-size:larger;color:#fff;vertical-align:middle;"><?php echo $_smarty_tpl->tpl_vars['USERNAME']->value;?>
，您好！</span>
              <span class="btn btn-danger" id="signoutButton">注销</span>
            </form>
            <?php }else{ ?>
            <form class="navbar-form pull-right" action="../php/common/actions.php?action=login" method="post" id="loginForm">
              <input class="span2" type="text" name="AdminEmail" id="AdminEmail" placeholder="Email">
              <input class="span2" type="password" name="AdminPass" id="AdminPass" placeholder="Password">
              <span id="loginButton" class="btn">登录</span>
            </form>
            <?php }?>
          </div>
        </div>
      </div>
    </div><?php }} ?>