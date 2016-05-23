<html class="ltr" lang="zh" data-rtl="false">
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<head>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="/node_modules/weui/dist/style/weui.css"/>
<link rel="stylesheet" href="/node_modules/weui/dist/example/example.css"/>

<title>小鹿佳农|登录</title>
</head>

<body ontouchstart>

<?php 

$mobile_ = trim($_POST["mobile_"]);
$pass_ = $_POST["pass_"];
$order_flag = $_GET["flag_"];

$pass_str = $pass_."xlf88888888";
$pass_data = md5($pass_str);

function DoAlert($tmp_mobile)
{
	echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">登录失败</h2>
                <p class=\"weui_msg_desc\">号码[".$tmp_mobile."]。</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
                        <a href=\"login.html\" class=\"weui_btn weui_btn_primary\">确定</a>
                </p>
                </div>";
}


$con_ = mysql_connect("localhost","minideer_web","minideer_web$&2016");
if (!$con_) {
	die("could not connect".mysql_error());
}

mysql_select_db("minideer_order",$con_);
$result = mysql_query("select * from order_users where mobile_='$mobile_' limit 1;");

if (mysql_num_rows($result) < 1) {
	echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">登录失败</h2>
                <p class=\"weui_msg_desc\">号码[$mobile_]未注册，请前往注册。</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
                        <a href=\"register.php\" class=\"weui_btn weui_btn_primary\">确定</a>
                </p>
                </div>";
} else {
	while ($row = mysql_fetch_array($result)) {
		if ($row['pass_'] == $pass_data) {
			$auth_str = base64_encode($mobile_ . "\t" . $pass_data);
			setcookie("auth_str",$auth_str, time()+3600*24*30);
			if ($order_flag == "from_order") {
				echo "<script>window.location.href='do_order.php';</script>";;
				//echo "
				//	<div class=\"weui_msg\">
				//	<div class=\"weui_icon_area\"><i class=\"weui_icon_success weui_icon_msg\"></i></div>
				//	<div class=\"weui_text_area\">
				//	<h2 class=\"weui_msg_title\">登录成功</h2>
				//	<p class=\"weui_msg_desc\">号码[$mobile_]通过验证，查看我的订单。</p>
				//	</div>
				//	<div class=\"weui_opr_area\">
				//	<p class=\"weui_btn_area\">
				//	<a href=\"order.php\" class=\"weui_btn weui_btn_primary\">继续下单</a>
				//	</p>
				//	</div>";
			} else {
				echo "
					<div class=\"weui_msg\">
					<div class=\"weui_icon_area\"><i class=\"weui_icon_success weui_icon_msg\"></i></div>
					<div class=\"weui_text_area\">
					<h2 class=\"weui_msg_title\">登录成功</h2>
					<p class=\"weui_msg_desc\">号码[$mobile_]通过验证，查看我的订单。</p>
					</div>
					<div class=\"weui_opr_area\">
					<p class=\"weui_btn_area\">
					<a href=\"order.php\" class=\"weui_btn weui_btn_primary\">去下单</a>
					<a href=\"my_orders.php\" class=\"weui_btn weui_btn_primary\">查看我的订单</a>
					</p>
					</div>";
			}
		} else {
			echo "
				<div class=\"weui_msg\">
				<div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
				<div class=\"weui_text_area\">
				<h2 class=\"weui_msg_title\">登录失败</h2>
				<p class=\"weui_msg_desc\">号码[$mobile_]密码输入错误。</p>
				</div>
				<div class=\"weui_opr_area\">
				<p class=\"weui_btn_area\">
				<a href=\"login.php\" class=\"weui_btn weui_btn_primary\">重新输入</a>
				<a href=\"reset_pass.html\" class=\"weui_btn weui_btn_primary\">忘记密码</a>
				</p>
				</div>";
	
		}
	}
}
mysql_close($con_);

?>

</body>
</html>
