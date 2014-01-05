<?php /* Smarty version Smarty-3.1.12, created on 2014-01-05 04:56:20
         compiled from "..\templates\register.html" */ ?>
<?php /*%%SmartyHeaderCode:1903752ab1f9e6c83b4-61015737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b9b5212222d8f08ac336b47f10201c5bb49181e' => 
    array (
      0 => '..\\templates\\register.html',
      1 => 1388897777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1903752ab1f9e6c83b4-61015737',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52ab1f9e762b71_40193840',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ab1f9e762b71_40193840')) {function content_52ab1f9e762b71_40193840($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>EasyAccount,您的记账专家</title>

<link href="../css/docs.css" rel="stylesheet"/>
<script src="../js/common/jquery1.10.2.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet"
	media="screen"/>
<link href="../css/bootstrap/css/bootstrap-responsive.css"
	rel="stylesheet" media="screen"/>


<style>
	.loginBox{
		max-width:1000px;
		margin:0 auto;
	}
	form{
		align:center;
		margin:0 auto;
	}
	body{
	background:#efefef url(..css/images/login/bg-websitehome.png) repeat;
	}

</style>
<script type="text/javascript">
	$(function(){
		$("#registerButton").click(function(){
			var email = $("#registerAdminEmail").val();
			var name = $("#registerAdminName").val();
			var password = $("#registerAdminPass").val();

			if(!verifyEmail(email))
			{
				alert("邮箱格式不正确!");
			}
			else if(name.trim()=="")
			{
				alert("用户名不能为空!");	
			}
			else if(password.trim()=="")
			{
				alert("密码不能为空!");	
			}
			else
			{
				$.ajax({
					url : $('#registerForm').attr('action'),
					data : $('#registerForm').serialize(),
					type : $('#registerForm').attr('method'),
					cache : false,
					success : function(data) {
						if(data=="success"){
							alert("注册成功");
							window.location.href = "index.php";
						}
						else{
							alert("用户名已存在！");
							location.reload();
						}
					}
				});
			}
		}); 
		var emailTags1 = ["126.com","163.com","gmail.com","hotmail.com","live.com"];
		$("#registerAdminEmail").autocomplete({
			source:function(request,response){
				var preText = request.term;
				var result = new Array();
				var atpos = preText.indexOf("@");
				if(atpos==-1)
				{
					for(var postemail in emailTags1)
					{
						result.push(preText+"@"+emailTags1[postemail]);
					}
				}
				else
				{
					var postText = preText.substring(atpos+1);
					var host = preText.substring(0,atpos);
					for(var postemail in emailTags1)
					{
						if(emailTags1[postemail].indexOf(postText)==0)
						{
							result.push(host+"@"+emailTags1[postemail]);
						}
					}
				}
				response(result);
			}
		});
	});
	
	//验证邮箱格式是否正确的函数
	function verifyEmail(email){
		var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);
		return patten.test(email);
	}
</script>
</head>
<body>
	<?php echo $_smarty_tpl->getSubTemplate ("nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="container" style="margin-top:100px">
		<div class="loginBox">
		  <form class="form-horizontal" id="registerForm" action="../php/common/actions.php?action=register" method="post">
		  	<div class="control-group">
		  		<label class="control-label" for="inputEmail">邮箱</label>
		  		<div class="controls">
		  			<input type="text" id="registerAdminEmail" name="AdminEmail" placeholder="Email">
		  		</div>
		  	</div>
		  	<div class="control-group">
		  		<label class="control-label" for="inputName">昵称</label>
		  		<div class="controls">
		  			<input type="text" id="registerAdminName" name="AdminName" placeholder="nickname">
		  		</div>
		  	</div>
		  	<div class="control-group">
		  		<label class="control-label" for="inputPassword">密码</label>
		  		<div class="controls">
		  			<input type="password" id="registerAdminPass" name="AdminPass" placeholder="Password">
		  		</div>
		  	</div>
		  	<div class="control-group">
		  		<div class="controls">
		  			<label class="checkbox">
		  				<input type="checkbox">下次自动登录
		  			</label>
		  			<span class="btn btn-primary" id="registerButton">注册</span>
		  		</div>
		  	</div>
		  </form>
	  </div>
	</div>
	<?php echo $_smarty_tpl->getSubTemplate ("foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>