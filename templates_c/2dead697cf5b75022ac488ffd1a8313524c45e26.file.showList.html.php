<?php /* Smarty version Smarty-3.1.12, created on 2014-01-05 03:28:33
         compiled from "..\templates\showList.html" */ ?>
<?php /*%%SmartyHeaderCode:2611252a06c7c30ad65-84445790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dead697cf5b75022ac488ffd1a8313524c45e26' => 
    array (
      0 => '..\\templates\\showList.html',
      1 => 1388891359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2611252a06c7c30ad65-84445790',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52a06c7c4f6603_14233830',
  'variables' => 
  array (
    'paymentArray' => 0,
    'pitem' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a06c7c4f6603_14233830')) {function content_52a06c7c4f6603_14233830($_smarty_tpl) {?><!DOCTYPE html>
<html>
<title>EasyAccount,您的记账专家</title>
<head>
<meta charset="UTF-8">
<link href="../css/docs.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet"
	media="screen">
<link href="../css/bootstrap/css/bootstrap-responsive.css"
	rel="stylesheet">
<link href="../js/plugin/jquery_ui/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="../js/common/jquery1.10.2.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/plugin/jquery_ui/jquery-ui-1.9.2.custom.min.js"></script>

<style>
.additemtable .alert {
	float: left;
	margin: 0px 2px 0px 2px;
}

.additemtable .alert:hover {
	cursor: pointer;
}

.additemtable  td {
	padding: 10px;
	valign: middle;
}


</style>
<script type="text/javascript">
	$(function() {
//----------------------------------------------------------------------------------------------------------------------------------------------------------
//删除账目
//----------------------------------------------------------------------------------------------------------------------------------------------------------
		$(".removePaymentItemButton").click(function(){
			if (confirm("确认要删除？")) {
				$.post("../php/common/xzd.php?action=deletePaymentItem",{pid:$(this).parent().parent().find(".pidhidden").val()},function(data,status){
					if(data=="fail"){
						alert("删除失败");
					}		
					else{
						location.reload();		//刷新当前页面
					}
				});
			}
		});	

//----------------------------------------------------------------------------------------------------------------------------------------------------------
// 更新账目
//----------------------------------------------------------------------------------------------------------------------------------------------------------
		$(".changeItemButton").click(function(){
			var type = $(this).parent().parent().find(".pitemtype").html();
			var cname = $(this).parent().parent().find(".pitemcname").html();
			var data = $(this).parent().parent().find(".pitemdate").html();
			var amount = $(this).parent().parent().find(".pitemamount").html();
			var description = $(this).parent().parent().find(".pitemdescription").html();
			var pid = $(this).parent().parent().find(".pidhidden").val();
			var flag = 0;
			if($(this).parent().parent().find(".pitemget").html()==undefined)
			{
				flag = 1;
			}
			if(flag==0)
			{
				$("#updateIsPay").val(0);
				$("#myModalLabel1").html("修改收入记录");
				$("#submitbutton2").html("更新收入");
				$("#updateCategoryDiv").css("display","none");
				$("#updateTypeDiv").css("display","none");
			}
			else
			{
				$("#updateIsPay").val(1);
				$("#myModalLabel1").html("修改支出记录");
				$("#submitbutton2").html("更新支出");
				$("#updateCategoryDiv").css("display","table-row");
				$("#updateTypeDiv").css("display","table-row");
				$("#updateSelectType").html(type);
				$("#updateSelectedCategory").html("<div class='alert' style='float:left'><button type='button' id='updateRemoveButton' class='close' data-dismiss='alert'>&times;</button>"
						+ cname + "</div><input type='hidden' name='updateCategoryHidden' value='"+cname+"'>");
				$("#updateRemoveButton").click(function() {
					$("#updateCategoryComboBox").css("display", "inline");
					var typeValue = $("#updateSelectType").html();
					$.post("../php/common/xzd.php?action=selectType",{type:typeValue},function(data,status){
						var cateArr = data.trim().split(" ");
						var categoryhtml = "";
						for(var i=0;i<cateArr.length;i++)
						{
							categoryhtml += ("<li><a href='#' class='updateCategoryValue'>"+cateArr[i]+"</a></li>");
						}
						$(".updateCategoryList").html(categoryhtml);
					});
				});
			}
			$("#updateAmountText").val(amount);
			$("#updateDateText").val(data);
			$("#updateDescriptionTextArea").html(description);
			$("#updatePid").val(pid);
		});
 		$("#updateAddCategoryButton").click(function(){
 			var categoryvalue = $("#updateAddCategoryText").val().trim();
 			var typevalue = $("#updateSelectType").html();
			if(categoryvalue==""){
				alert("类别不能为空");	
			}
			else if(typevalue=="选择"){
				alert("选择大类别");
			}
			else{
				$.post("../php/common/xzd.php?action=addCategory",{category:categoryvalue,type:typevalue},function (data,status){
					if(data=="success"){
						$(".updateCategoryList").html(("<li><a href='#' class='updateCategoryValue'>"+categoryvalue+"</a></li>")+$(".updateCategoryList").html());
						alert("添加成功");
					}
					else if(data=="fail"){
						alert("失败");
					}
					else{
						alert("已经存在该小类别");
					}
					$("#updateAddCategoryText").val("");
				});
			}
		});
		$("#updateDateText").datepicker({
			changeMonth : true,
			changeYear : true,
			showButtonPanel : true
		});
		
		$(".updateTypeValue").click(function(){
			if($("#updateCategoryComboBox").css("display")=="none")
			{
				alert("首先取消小标签再说！");
			}
			else{
				var typeValue = $(this).html();
				$("#updateSelectType").html(typeValue);
				$("#updateSelectType").attr("value", typeValue);
				$.post("../php/common/xzd.php?action=selectType",{type:typeValue},function(data,status){
					var cateArr = data.trim().split(" ");
					var categoryhtml = "";
					for(var i=0;i<cateArr.length;i++)
					{
						categoryhtml += ("<li><a href='#' class='updateCategoryValue'>"+cateArr[i]+"</a></li>");
					}
					$(".updateCategoryList").html(categoryhtml);
				});
			}
		});
		$('body').on('click', '.updateCategoryValue',function() {
			$("#updateCategoryComboBox").css("display", "none");
			$("#updateSelectedCategory").html("<div class='alert' style='float:left'><button type='button' id='updateRemoveButton' class='close' data-dismiss='alert'>&times;</button>"
					+ $(this).html() + "</div><input type='hidden' name='updateCategoryHidden' value='"+$(this).html()+"'>");
			$("#updateRemoveButton").click(function() {
				$("#updateCategoryComboBox").css("display", "inline");
			});
		});
		
		$("#submitbutton2").click(function(){
			//判断是修改收入还是修改支出
			var datetxt = $("#updateDateText").val();
			var amount = $("#updateAmountText").val();
			
			if($("#updateCategoryDiv").css("display")!="none")	//收入
			{
				var selecttype = $("#updateSelectType").html();
				var category = $("#updateCategoryComboBox").css("display");
				if(!validateType(selecttype))
				{
					alert("未选择大类别！");
					return;
				}
				if (!validateCategory(category))
				{
					alert("未选择小类别！");
					return;
				}
			}
			if(!validateDate(datetxt))
			{
				alert("未选择日期或日期格式不正确！");
				return;
			}
			if(!validateAmount(amount))
			{
				alert("为输入金额或金额格式不正确！");
				return;
			}
			$.ajax({
				url : $('#updateForm').attr('action'),
				data : $('#updateForm').serialize(),
				type : $('#updateForm').attr('method'),
				cache : false,
				success : function(data) {
					location.reload();
				}
			});
		});
		$("#updateAmountText").blur(function(){
			var v = $(this).val();
			if(!testAmount(v)){
				alert("金额格式不正确！请重新填写！");
				$(this).val("");
			}
		});
//----------------------------------------------------------------------------------------------------------------------------------------------------------
//添加支出账目		
//----------------------------------------------------------------------------------------------------------------------------------------------------------
		$("#addDateText").datepicker({
			changeMonth : true,
			changeYear : true,
			showButtonPanel : true
		});
		$("#submitbutton").click(function(){	//支出按钮
			var selecttype = $("#addSelectType").html();
			var category = $("#addCategoryComboBox").css("display");
			var datetxt = $("#addDateText").val();
			var amount = $("#addAmountText").val();
			if(!validateType(selecttype))
			{
				alert("未选择大类别！");
				return;
			}
			if (!validateCategory(category))
			{
				alert("未选择小类别！");
				return;
			}
			if(!validateDate(datetxt))
			{
				alert("未选择日期或日期格式不正确！");
				return;
			}
			if(!validateAmount(amount))
			{
				alert("未输入金额或金额格式不正确！");
				return;
			}
			$.ajax({
				url : $('#addForm').attr('action'),
				data : $('#addForm').serialize(),
				type : $('#addForm').attr('method'),
				cache : false,
				success : function(data) {
					location.reload();
				}
			});
		});
		$(".addTypeValue").click(function(){
			if($("#addCategoryComboBox").css("display")=="none")
			{
				alert("首先取消小标签再说！");
			}
			else{
				var typeValue = $(this).html();
				$("#addSelectType").html(typeValue);
				$("#addSelectType").attr("value", typeValue);
				$.post("../php/common/xzd.php?action=selectType",{type:typeValue},function(data,status){
					var cateArr = data.trim().split(" ");
					var categoryhtml = "";
					for(var i=0;i<cateArr.length;i++)
					{
						categoryhtml += ("<li><a href='#' class='addCategoryValue'>"+cateArr[i]+"</a></li>");
					}
					$(".addCategoryList").html(categoryhtml);
				});
			}
		});
		$('body').on('click', '.addCategoryValue',function() {
			$("#addCategoryComboBox").css("display", "none");
			$("#addSelectedCategory").html("<div class='alert' style='float:left'><button type='button' id='addRemoveButton' class='close' data-dismiss='alert'>&times;</button>"
					+ $(this).html() + "</div><input type='hidden' name='addCategoryHidden' value='"+$(this).html()+"'>");
			$("#addRemoveButton").click(function() {
				$("#addCategoryComboBox").css("display", "inline");
			});
		});
		$("#addAddCategoryButton").click(function(){
 			var categoryvalue = $("#addAddCategoryText").val().trim();
 			var typevalue = $("#addSelectType").html();
			if(categoryvalue==""){
				alert("类别不能为空");	
			}
			else if(typevalue=="选择"){
				alert("选择大类别");
			}
			else{
				$.post("../php/common/xzd.php?action=addCategory",{category:categoryvalue,type:typevalue},function (data,status){
					if(data=="success"){
						$(".addCategoryList").html(("<li><a href='#' class='addCategoryValue'>"+categoryvalue+"</a></li>")+$(".addCategoryList").html());
						alert("添加成功");
					}
					else if(data=="fail"){
						alert("失败");
					}
					else{
						alert("已经存在该小类别");
					}
					$("#addAddCategoryText").val("");
				});
			}
		});
		$("#addAmountText").blur(function(){
			var v = $(this).val();
			if(!testAmount(v)){
				alert("金额格式不正确！请重新填写！");
				$(this).val("");
			}
		});
//----------------------------------------------------------------------------------------------------------------------------------------------------------
//添加收入账目		
//----------------------------------------------------------------------------------------------------------------------------------------------------------
		$("#addIncomeDateText").datepicker({
			changeMonth : true,
			changeYear : true,
			showButtonPanel : true
		});
		$("#addIncomeAmountText").blur(function(){
			var v = $(this).val();
			if(!testAmount(v)){
				alert("金额格式不正确！请重新填写！");
				$(this).val("");
			}
		});
		$("#submitbutton3").click(function(){	//收入按钮
			
			var datetxt = $("#addIncomeDateText").val();
			var amount = $("#addIncomeAmountText").val();
			if(!validateDate(datetxt))
			{
				alert("未选择日期或日期格式不正确！");
				return;
			}
			if(!validateAmount(amount))
			{
				alert("未输入金额或金额格式不正确！");
				return;
			}
			$.ajax({
				url : $('#addIncomeForm').attr('action'),
				data : $('#addIncomeForm').serialize(),
				type : $('#addIncomeForm').attr('method'),
				cache : false,
				success : function(data) {
					location.reload();
				}
			});
		});
	});

function testAmount(amount){
	var r = new RegExp(/^\d+(\.\d+)?$/);
	var r2 = new RegExp(/^$/)
	return r.test(amount) || r2.test(amount);
}
function validateType(type)
{
	if(type.indexOf("选择")==-1) return true;
	return false;
}
function validateCategory(category)
{
	if(category.indexOf("none")==-1) return false;
	return true;
}
function validateDate(datetxt)
{
	var r = new RegExp(/^\d\d\/\d\d\/\d\d\d\d$/);
	return r.test(datetxt);
}
function validateAmount(amount)
{
	var r = new RegExp(/^\d+(\.\d+)?$/);
	return r.test(amount);
}
</script>
</head>

<body>
	<?php echo $_smarty_tpl->getSubTemplate ("nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="container">
		<table class="table table-bordered table-hover" style="margin-top: 30px">
			<tr>
				<td>编号</td>
				<td>日期</td>
				<td>大类别</td>
				<td>小类别</td>
				<td>金额</td>
				<td>描述</td>
				<td>支出</td>
				<td>&nbsp</td>
			</tr>
			<?php  $_smarty_tpl->tpl_vars['pitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['paymentArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pitem']->key => $_smarty_tpl->tpl_vars['pitem']->value){
$_smarty_tpl->tpl_vars['pitem']->_loop = true;
?> 
				<?php if ($_smarty_tpl->tpl_vars['pitem']->value['flag']==1){?>
				<tr class="error">
				<?php }else{ ?>
				<tr class="success">
				<?php }?>
				<td class="pitemid"><?php echo $_smarty_tpl->tpl_vars['pitem']->value['id'];?>
</td>
				<input type="hidden" class="pidhidden" value="<?php echo $_smarty_tpl->tpl_vars['pitem']->value['pid'];?>
"/>
				<td class="pitemdate"><?php echo $_smarty_tpl->tpl_vars['pitem']->value['data'];?>
</td>
				<td class="pitemtype"><?php echo $_smarty_tpl->tpl_vars['pitem']->value['type'];?>
</td>
				<td class="pitemcname"><?php echo $_smarty_tpl->tpl_vars['pitem']->value['cname'];?>
</td>
				<td class="pitemamount"><?php echo $_smarty_tpl->tpl_vars['pitem']->value['amount'];?>
</td>
				<td class="pitemdescription"><?php echo $_smarty_tpl->tpl_vars['pitem']->value['description'];?>
</td> 
				<?php if ($_smarty_tpl->tpl_vars['pitem']->value['flag']==1){?>
				<td class="pitempay">支出</td> 
				<?php }else{ ?>
				<td class="pitemget">收入</td>
				<?php }?>
				<td style="width: 20%; text-align: center">
					<a href="#" class="removePaymentItemButton" title="删除该账目"><img src="../css/images/icon-remove.png"></a>
					<a href="#changeItem" data-toggle="modal" title="修改该账目" class="changeItemButton"><img src="../css/images/icon-edit.png"></a>
				    	<div id="changeItem" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="max-width: 1000px; max-height: 450px" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true">×</button>
								<h3 id="myModalLabel1">修改记录页面</h3>
							</div>
							<form id="updateForm" action="../php/common/xzd.php?action=updateItem" method="post">
							<div class="modal-body">
							<!-- ------------------------------------------------------------------------------ -->
								<input type="hidden" name="updatePid" id="updatePid">		<!-- 隐藏的控件 ，保存了当前修改的账目的pid -->
								<input type="hidden" name="updateIsPay" id="updateIsPay">
							<!-- ------------------------------------------------------------------------------ -->
									<table class="updateitemtable" style="width:90%;border-color:#DDD">
										<tr id="updateTypeDiv">
											<td width="70px">大类别</td>
											<td>
												<div class="btn-group" id="updateTypeComboBox">
													<span class="btn" id="updateSelectType" name="updateSelectType">选择</span>
													<span class="btn dropdown-toggle" data-toggle="dropdown">
														<span class="caret"></span>
													</span>
													<ul class="dropdown-menu">
														<li><a href="#" class="type updateTypeValue" >餐饮</a></li>
														<li><a href="#" class="type updateTypeValue">购物</a></li>
														<li><a href="#" class="type updateTypeValue">交通</a></li>
														<li><a href="#" class="type updateTypeValue">杂费</a></li>
														<li><a href="#" class="type updateTypeValue">其他</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<tr id="updateCategoryDiv">
											<td>小类别</td>
											<td>
												<div id="updateSelectedCategory"></div>
												<div id="updateCategoryComboBox" style="float:left;display: none">
													<div class="btn-group">
														<span class="btn dropdown-toggle" data-toggle="dropdown" id="updateSelectCategory" > 选择 <span class="caret"></span>
														</span>
														<ul class="dropdown-menu updateCategoryList">
														</ul>
													</div>
												</div>
												<input type="text" id="updateAddCategoryText" name="updateAddCategoryText" style="width:5em;margin-left:10px">
												<span id="updateAddCategoryButton" name="updateAddCategoryButton" class="btn btn-success" style="margin-top: -10px;margin-left:5px">添加</span>
											</td>
										</tr>
										<!-- <tr>
											<td>支出</td>
											<td><label class="radio" style="float:left"><input type="radio" name="updateisPayRadio" id="updateisPayRadio1" value="1">是 </label> <label class="radio" style="float:left;margin-left:10px" ><input type="radio" name="updateisPayRadio" id="updateisPayRadio2" value="0">否</label> </td>
										</tr> -->
										<tr>
											<td>描述</td>
											<td><textarea id="updateDescriptionTextArea" name="updateDescriptionTextArea" rows="3" style="width: 90%"></textarea></td>
										</tr>
										<tr>
											<td>日期</td>
											<td><input type="text" id="updateDateText" name="updateDateText"
												style="margin: 5px; width: 100px; height: 18px;"></td>
										</tr>
										<tr>
											<td>金额</td>
											<td><input type="text" id="updateAmountText" name="updateAmountText" style="width: 50px; height: 18px;">&nbsp
												元</td>
										</tr>
									</table>
							</div>
							<div class="modal-footer">
								<span class="btn btn-primary btn-large" id="submitbutton2">更新</span>
							</div>
							</form>
						</div>
			    </td>
			</tr>
			<?php } ?>
		</table>
		<!-- <a href="#addItem" role="button" class="btn" data-toggle="modal">添加记录</a> -->
		<div id="addItem" class="modal hide fade" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel"
			style="max-width: 1000px; max-height: 500px" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">×</button>
				<h3 id="myModalLabel">添加记录页面</h3>
			</div>
			<div class="tabbable">
			  <ul class="nav nav-tabs">
			    <li class="active"><a href="#tab1" data-toggle="tab">支出</a></li>
			    <li><a href="#tab2" data-toggle="tab">收入</a></li>
			  </ul>
			  <div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<form id="addForm" action="../php/common/xzd.php?action=addItem" method="post">
					<div class="modal-body">
							<table class="additemtable" style="width: 90%">
								<tr>
									<td width="70px">大类别</td>
									<td>
										<div class="btn-group ">
											<span class="btn" id="addSelectType" name="addSelectType">选择</span>
											<span class="btn dropdown-toggle" data-toggle="dropdown">
												<span class="caret"></span>
											</span>
											<ul class="dropdown-menu">
												<li><a href="#" class="type addTypeValue" >餐饮</a></li>
												<li><a href="#" class="type addTypeValue">购物</a></li>
												<li><a href="#" class="type addTypeValue">交通</a></li>
												<li><a href="#" class="type addTypeValue">杂费</a></li>
												<li><a href="#" class="type addTypeValue">其他</a></li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>小类别</td>
									<td>
										<div id="addSelectedCategory"></div>
										<div id="addCategoryComboBox" style="float:left">
											<div class="btn-group">
												<span class="btn dropdown-toggle" data-toggle="dropdown"
													id="addSelectCategory" > 选择 <span class="caret"></span>
												</span>
												<ul class="dropdown-menu addCategoryList">
												</ul>
											</div>
										</div>
										<input type="text" id="addAddCategoryText" name="addAddCategoryText" style="width:5em;margin-left:10px">
										<span id="addAddCategoryButton" name="addAddCategoryButton" class="btn btn-success" style="margin-top: -10px;margin-left:5px">添加</span>
									</td>
								</tr>
								<!-- <tr>
									<td>支出</td>
									<td><label class="radio" style="float:left"><input type="radio" name="isPayRadio" id="isPayRadio1" value="1" checked>是 </label> <label class="radio" style="float:left;margin-left:10px" ><input type="radio" name="isPayRadio" id="isPayRadio2" value="0">否</label> </td>
								</tr> -->
								<tr>
									<td>描述</td>
									<td><textarea name="addDescriptionTextArea" rows="3" style="width: 90%"></textarea></td>
								</tr>
								<tr>
									<td>日期</td>
									<td><input type="text" id="addDateText" name="addDateText"
										style="margin: 5px 0px ; width: 100px; height: 18px;"></td>
								</tr>
								<tr>
									<td>金额</td>
									<td><input type="text" id="addAmountText" name="addAmountText" style="width: 50px; height: 18px;">&nbsp
										元</td>
								</tr>
							</table>
						
					</div>
					<div class="modal-footer">
						<span class="btn btn-primary btn-large" id="submitbutton">添加支出</span>
					</div>
					</form>
				</div>
				<div class="tab-pane" id="tab2">
					<form id="addIncomeForm" action="../php/common/xzd.php?action=addIncomeItem" method="post">
						<div class="modal-body">
								<table class="addincomeitemtable" style="width: 90%">
									<tr>
										<td>描述</td>
										<td><textarea name="addIncomeDescriptionTextArea" rows="3" style="width: 90%"></textarea></td>
									</tr>
									<tr>
										<td>日期</td>
										<td><input type="text" id="addIncomeDateText" name="addIncomeDateText"
											style="margin: 15px 0px 10px; width: 100px; height: 18px;"></td>
									</tr>
									<tr>
										<td>金额</td>
										<td><input type="text" id="addIncomeAmountText" name="addIncomeAmountText" style="margin:10px 0px 10px 0px;width: 50px; height: 18px;">&nbsp
											元</td>
									</tr>
								</table>
							
						</div>
						<div class="modal-footer">
							<span class="btn btn-primary btn-large" id="submitbutton3">添加收入</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php echo $_smarty_tpl->getSubTemplate ("foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>