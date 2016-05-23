<html class="ltr" lang="zh" data-rtl="false">
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<head>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="/node_modules/weui/dist/style/weui.css"/>
<link rel="stylesheet" href="/node_modules/weui/dist/example/example.css"/>

<title>小鹿佳农|完成注册</title>
</head>

<body ontouchstart>

<?php 
session_start();

$mobile_ = $_POST["mobile_"];
$pass_ = $_POST["pass_"];
$name_= $_POST["name_"];
$address_ = $_POST["address_"];
$source_ = $_POST["source_"];


$pass_str = $pass_."xlf88888888";
$pass_data = md5($pass_str);

function DoAlert($tmp_mobile)
{
	echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">重复注册</h2>
                <p class=\"weui_msg_desc\">号码[".$tmp_mobile."]已经注册，无需重复提交。</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
            		<a href=\"login.php\" class=\"weui_btn weui_btn_default\">去登录</a>
                </p>
                </div>";
}


$con_ = mysql_connect("localhost","minideer_web","minideer_web$&2016");
if (!$con_) {
	die("could not connect".mysql_error());
}

mysql_select_db("minideer_order",$con_);
mysql_query("insert into order_users (mobile_, pass_, name_, address_,source_) 
		values ('$mobile_', '$pass_data', '$name_', '$address_','$source_')");

if (mysql_errno() == 0) {
	echo "
		<div class=\"weui_msg\">
    		<div class=\"weui_icon_area\"><i class=\"weui_icon_success weui_icon_msg\"></i></div>
		<div class=\"weui_text_area\">
		<h2 class=\"weui_msg_title\">注册成功</h2>
        	<p class=\"weui_msg_desc\">号码[".$mobile_."]注册成功</p>
		</div>
    		<div class=\"weui_opr_area\">
        	<p class=\"weui_btn_area\">
            		<a href=\"order.php\" class=\"weui_btn weui_btn_default\">去下单</a>
        	</p>
		</div>";

	$auth_str = base64_encode($mobile_ . "\t" . $pass_data);
	setcookie("auth_str",$auth_str, time()+3600*24*30);
	//$a_data = $name_ . "\t" . $address_;
	//$a_str = base64_encode($name_ . "\t" . $address_);
	//setcookie("a_str",$a_str, time()+3600*24*30);
}

if (mysql_errno() == 1062) {
	DoAlert($mobile_);
}
mysql_close($con_);

//想要防止重复提交，就不能destroy
//session_destroy();
?>

</body>
</html>
