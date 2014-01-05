<?php /* Smarty version Smarty-3.1.12, created on 2013-12-05 11:39:26
         compiled from "..\templates\main.html" */ ?>
<?php /*%%SmartyHeaderCode:1514952a065ee4f9c38-70006923%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d0efd2560a8037f32327ae6913e6df3ea3f0b93' => 
    array (
      0 => '..\\templates\\main.html',
      1 => 1386242921,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1514952a065ee4f9c38-70006923',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52a065ee5804c4_61477041',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a065ee5804c4_61477041')) {function content_52a065ee5804c4_61477041($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<style>
.dataBlock {
	height: 380px;
}

.dataRow {
	
}

.dataShow {
	height: 300px;
	margin-top: -20px;
	border-left: solid 2px #d4d4d4;
	border-right: solid 2px #d4d4d4;
	border-bottom: solid 2px #d4d4d4;
}

.dataTitle {
	color: #777777;
	display: block;
	float: left;
	font-size: 16px;
	font-weight: 200;
	margin-left: -20px;
	padding: 10px 20px;
	text-shadow: 0 1px 0 #FFFFFF;
}

input {
	
}
</style>
<title>Bootstrap 101 Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->

<script src="../js/common/jquery1.10.2.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/plugin/highcharts/highcharts.js"></script>
<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet"
	media="screen">
<link href="../css/bootstrap/css/bootstrap-responsive.css"
	rel="stylesheet" media="screen">
	
<script src="../js/plugin/jquery_ui/jquery-ui-1.9.2.custom.min.js"></script>
<link href="../js/plugin/jquery_ui/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" media="screen">
	
<script src="../js/ajax/main.js"></script>
</head>
<body>
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<a class="brand" href="#">Eassy Account</a>
			<ul class="nav">
				<li class="active"><a href="#">首页</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
			</ul>
		</div>
	</div>

	<div class="row-fluid dataRow">
		<div class="span1" style="height: 0px;"></div>
		<div class="span5 dataBlock">
			<div class="navbar">
				<div class="navbar-inner">
					<span class="dataTitle " href="#">综合分析</span> 
					<span class="mybtn btn btn-primary pull-right update" value="all"
						style="height: 15px; line-height: 15px; margin-top: 8px;">
							更新</span> <span class="pull-right"
						style="margin-top: 8px; margin-right: 10px;"> 从&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-02"/>&nbsp;&nbsp;至&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-05"/>
					</span>
				</div>
			</div>
			<div class="dataShow" id="all"></div>
		</div>

		<div class="span5 dataBlock">
			<div class="navbar">
				<div class="navbar-inner">
					<span class="dataTitle " href="#">餐饮</span>
					<span class="mybtn btn btn-primary pull-right update" value="meal"
						style="height: 15px; line-height: 15px; margin-top: 8px;">
							更新</span> <span class="pull-right"
						style="margin-top: 8px; margin-right: 10px;"> 从&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-02"/>&nbsp;&nbsp;至&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-05"/>
					</span>
				</div>
			</div>
			<div class="dataShow" id="meal"></div>
		</div>
		<div class="span1"></div>
	</div>

	<div class="row-fluid dataRow">
		<div class="span1" style="height: 0px;"></div>
		<div class="span5 dataBlock">
			<div class="navbar">
				<div class="navbar-inner">
					<span class="dataTitle">购物</span>
					<span class="mybtn btn btn-primary pull-right update" value="shop"
						style="height: 15px; line-height: 15px; margin-top: 8px;">
							更新</span> <span class="pull-right"
						style="margin-top: 8px; margin-right: 10px;"> 从&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-02"/>&nbsp;&nbsp;至&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-05"/>
					</span>
				</div>
			</div>
			<div class="dataShow" id="shop"></div>
		</div>
		<div class="span5 dataBlock">
			<div class="navbar">
				<div class="navbar-inner">
					<span class="dataTitle " href="#">交通</span>
					<span class="mybtn btn btn-primary pull-right update" value="traffic"
						style="height: 15px; line-height: 15px; margin-top: 8px;">
							更新</span> <span class="pull-right"
						style="margin-top: 8px; margin-right: 10px;"> 从&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-02"/>&nbsp;&nbsp;至&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-05"/>
					</span>
				</div>
			</div>
			<div class="dataShow" id="traffic"></div>
		</div>
		<div class="span1"></div>
	</div>

	<div class="row-fluid">
		<div class="span1" style="height: 0px;"></div>
		<div class="span5 dataBlock">
			<div class="navbar">
				<div class="navbar-inner">
					<span class="dataTitle " href="#">杂费</span>
					<span class="mybtn btn btn-primary pull-right update" value="fee"
						style="height: 15px; line-height: 15px; margin-top: 8px;">
							更新</span> <span class="pull-right"
						style="margin-top: 8px; margin-right: 10px;"> 从&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-02"/>&nbsp;&nbsp;至&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-05"/>
					</span>
				</div>
			</div>
			<div class="dataShow" id="fee"></div>
		</div>
		<div class="span5 dataBlock">
			<div class="navbar">
				<div class="navbar-inner">
					<span class="dataTitle " href="#">其他</span>
					<span class="mybtn btn btn-primary pull-right update" value="other"
						style="height: 15px; line-height: 15px; margin-top: 8px;">
							更新</span> <span class="pull-right"
						style="margin-top: 8px; margin-right: 10px;"> 从&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-02"/>&nbsp;&nbsp;至&nbsp;&nbsp;<input
							style="width: 75px;"  class="date" value="2013-12-05"/>
					</span>
				</div>
			</div>
			<div class="dataShow" id="other"></div>
		</div>
		<div class="span1"></div>
	</div>

</body>
</html><?php }} ?>