<html class="ltr" lang="zh" data-rtl="false">
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<head>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="/node_modules/weui/dist/style/weui.css"/>
<link rel="stylesheet" href="/node_modules/weui/dist/example/example.css"/>

<title>小鹿佳农|下单</title>
</head>

<body ontouchstart>

<?php 

include 'common_xlf.php';
session_start();

$order_tag = $_POST["order_tag"]; //这个字段防止重复提交
$type_ = $_POST["type_"];
$count_ = $_POST["count_"];
$name_= $_POST["name_"];
$mobile_ = $_POST["mobile_"];
$bak_mobile = $_POST["bak_mobile"];
$address_ = $_POST["address_"];
$memo_ = $_POST["memo_"];


$a_str = base64_encode($name_ . "\t" . $address_ . "\t");
setcookie("a_str",$a_str, time()+3600*24*30);
$a_str = base64_encode($name_ . "\t" . $address_);
setcookie("a_str",$a_str, time()+3600*24*30);


function DoAlert($tmp_mobile)
{
	echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">重复提交</h2>
                <p class=\"weui_msg_desc\">订单已经提交成功，无需重复提交。谢谢！</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
                        <a href=\"order.php\" class=\"weui_btn weui_btn_primary\">确定</a>
                </p>
                </div>";
}


$con_ = mysql_connect("localhost","minideer_web","minideer_web$&2016");
if (!$con_) {
	die("could not connect".mysql_error());
}

mysql_select_db("minideer_order",$con_);

//检查是否注册
$result = mysql_query("select * from order_users where mobile_='$mobile_' limit 1;");
if (mysql_num_rows($result) == 1) {
	//检查是否登录
	if (isset($_COOKIE["auth_str"]) && explode("\t",base64_decode($_COOKIE["auth_str"]))[0] == $mobile_) {
		$tmp_pass = explode("\t",base64_decode($_COOKIE["auth_str"]))[1];
		$result = mysql_query("select * from order_users where mobile_='$mobile_' and pass_='$tmp_pass' limit 1;");
	
		if (mysql_num_rows($result) == 1) {
	
			mysql_query("insert into new_order (order_tag,type_, count_, name_, mobile_, address_,bak_mobile,memo_) values ('$order_tag','$type_', $count_, '$name_', '$mobile_', '$address_','$bak_mobile','$memo_');");
	
			if (mysql_errno() == 0) {
				echo "
					<div class=\"weui_msg\">
					<div class=\"weui_icon_area\"><i class=\"weui_icon_success weui_icon_msg\"></i></div>
					<div class=\"weui_text_area\">
					<h2 class=\"weui_msg_title\">提交成功</h2>
					<p class=\"weui_msg_desc\">我们已收到您的订单，将尽快为您处理，谢谢！<br>顺颂商祺！</p>
					</div>
					<div class=\"weui_opr_area\">
					<p class=\"weui_btn_area\">
					<a href=\"order.php\" class=\"weui_btn weui_btn_default\">再下一单</a>
					<a href=\"my_orders.php?mobile_=$mobile_\" class=\"weui_btn weui_btn_default\">查看我的订单</a>
					</p>
					</div>";
			} else if (mysql_errno() == 1062) {
				DoAlert($mobile_);
			} else {
				echo "mysql_errno:".mysql_errno();
			}
		} else {
			GoLogin($mobile_);
		}
	} else {
		GoLogin($mobile_);
	}
} else {
	GoRegister($mobile_);
}

mysql_close($con_);

?>

</body>
</html>
