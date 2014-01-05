<?php
	require_once ('../plugin/smarty/Smarty.class.php');
	require_once 'config.php';
	$conn=$dbConnection->connect();
	
	$action = $_GET ['action'];
	$session=new session();
	$session->start();
	switch ($action) {
		case "selectType":
		{
			$type = $_POST["type"];
			$type = getIdByTypeName($type);
			$cate = new Category($conn);
			$uid = $session->getValue("userid");
			$cateList = $cate->getByType($uid, $type);
			echo $cateList;	//向前台返回的数据
			break;
		}
		case "addCategory":
		{
			$type = $_POST["type"];
			$type = getIdByTypeName($type);
			$category = $_POST["category"];
			$uid = $session->getValue("userid");
			$tsql = "SELECT cname FROM [dbo].[category] WHERE uid=$uid AND cname='$category' AND type=$type";
			$result = sqlsrv_query($conn,$tsql);
			if($row=sqlsrv_fetch_array($result))
			{
				echo "exist";
			}
			else{
				$tsql = "INSERT INTO [dbo].[category](uid,cname,type) VALUES('$uid','$category','$type')";
				$result = sqlsrv_query($conn,$tsql);
				if($result){
					echo "success";
				}
				else{
					echo "fail";
				}
			}
			break;
		}
		case "addItem":
		{
			$uid = $session->getValue("userid");
			$type = $_POST["addSelectType"];
			$cname = $_POST["addCategoryHidden"];
			$cid = 0;
			$isPay = 1;
			$description = $_POST["addDescriptionTextArea"];
			$data = $_POST["addDateText"];
			$amount = $_POST["addAmountText"];
			$tsql = "SELECT cid FROM [dbo].[category] WHERE uid='$uid' AND cname='$cname'";
			$result = sqlsrv_query($conn,$tsql);
			if($row=sqlsrv_fetch_array($result))
			{
				$cid = $row["cid"];
			}
			$tsql = "INSERT INTO [dbo].[payment](uid,cid,amount,flag,data,description) VALUES($uid,$cid,$amount,$isPay,'$data','$description')";
			$result = sqlsrv_query($conn,$tsql);
			if($result==false)
			{
				echo "fail";
			}
			else
			{
				echo "success";
			}
			break;
		}
		case "deletePaymentItem":
		{
			$pid = $_POST["pid"];
			$tsql = "DELETE FROM [dbo].[payment] WHERE pid=$pid";
			$result = sqlsrv_query($conn,$tsql);
			if($result==false)
			{
				echo "fail";
			}
			break;
		}
		case "updateItem":
		{
			$uid = $session->getValue("userid");
			$isPay = $_POST["updateIsPay"];
			$pid = $_POST["updatePid"];
			$description = $_POST["updateDescriptionTextArea"];
			$data = $_POST["updateDateText"];
			$amount = $_POST["updateAmountText"];
			$cid = 0;
			if($isPay==0)
			{
				$cid = 1;
			}
			else
			{
				$type = $_POST["updateSelectType"];
				$cname = $_POST["updateCategoryHidden"];
				$tsql = "SELECT cid FROM [dbo].[category] WHERE uid=$uid AND cname='$cname'";
				$result = sqlsrv_query($conn,$tsql);
				if($row=sqlsrv_fetch_array($result))
				{
					$cid = $row["cid"];
				}
			}
			$tsql = "UPDATE [dbo].[payment] SET cid=$cid,flag=$isPay,description='$description', data='$data',amount=$amount WHERE pid=$pid";
			$result = sqlsrv_query($conn,$tsql);
			if($result==false)
			{
				echo "fail";
			}
			break;
		}
		case 'addIncomeItem':
		{
			$uid = $session->getValue("userid");
			$description = $_POST["addIncomeDescriptionTextArea"];
			$data = $_POST["addIncomeDateText"];
			$amount = $_POST["addIncomeAmountText"];
			$isPay = 0;
			$cid = 1;
			$tsql = "INSERT INTO [dbo].[payment](uid,cid,amount,flag,data,description) VALUES($uid,$cid,$amount,$isPay,'$data','$description')";
			$result = sqlsrv_query($conn,$tsql);
			if($result==false)
			{
				echo "fail";
			}
			else
			{
				echo "success";
			}
			break;
		}
			
	}
?>