<?php /* Smarty version Smarty-3.1.12, created on 2014-01-05 01:25:09
         compiled from "..\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:2142252a06b8ba01237-75169654%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca365edcc839197ba64986d19c332fc7497f373e' => 
    array (
      0 => '..\\templates\\index.html',
      1 => 1388850830,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2142252a06b8ba01237-75169654',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52a06b8ba9cfd1_48326757',
  'variables' => 
  array (
    'ISLOGIN' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a06b8ba9cfd1_48326757')) {function content_52a06b8ba9cfd1_48326757($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<title>EasyAccount,您的记账专家</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bootstrap 101 Template</title>
	<link href="../css/docs.css" rel="stylesheet">
	<script src="../js/common/jquery1.10.2.js"></script>
	<script src="../css/bootstrap/js/bootstrap.min.js"></script>
	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet"
		media="screen">
	<link href="../css/bootstrap/css/bootstrap-responsive.css"
		rel="stylesheet" media="screen">
	<style type="text/css">
	img{
		width:100%;
	}
	</style>
	<script type="text/javascript">
		$(function(){
			$('.carousel').carousel({
			  interval: 2000		//每2秒切换一张图片
			});
		});
	</script>
</head>
<body>
	<?php echo $_smarty_tpl->getSubTemplate ("nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<div class="item active">
				<img src="../css/images/1.jpg">
			</div>
			<div class="item ">
				<img src="../css/images/2.jpg">
				<div class="container">
					<div class="carousel-caption" style="height: 20%">
						<p class="lead">他提供最简洁的账目明细.</p>
					</div>
				</div>
			</div>
			<div class="item">
				<img src="../css/images/3.jpg">
				<div class="container">
					<div class="carousel-caption" style="height: 20%">
						<p class="lead">他提供最清晰的报表分析.</p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
	</div>
	<div class="container">
		<div style="margin:0 auto;max-width:50%">
			<?php if ($_smarty_tpl->tpl_vars['ISLOGIN']->value==true){?>
			<a href="showList.php" class="btn btn-large btn-block btn-primary">查看账目</a>
			<?php }else{ ?>
			<a href="register.php" class="btn btn-large btn-block btn-primary">注册</a>
			<?php }?>
		</div>
	</div>
	<?php echo $_smarty_tpl->getSubTemplate ("foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>