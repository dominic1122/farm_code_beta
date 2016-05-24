<html class="ltr" lang="zh" data-rtl="false">
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<head>
<title>小鹿佳农|订单下载</title>
</head>

<?php 

include 'common_xlf.php';

if (isset($_GET["tag_"])) {
	$tag_ = $_POST["tag_"];
} else {
	$tag_ = "all";
}

if (isset($_COOKIE["auth_str"])) {
	$t1 = explode("\t",base64_decode($_COOKIE["auth_str"]));
	$mobile_ = $t1[0];
        $tmp_pass = $t1[1];
} else {
        GoLogin("");
	exit();
}

$con_ = mysql_connect("localhost","minideer_web","minideer_web$&2016");
if (!$con_) {
	die("could not connect".mysql_error());
}
mysql_select_db("minideer_order",$con_);

$admin_mobiles = "18676692607,15672625111";
if (strpos($admin_mobiles,$mobile_) !== FALSE) {
	//检查是否注册
	$result = mysql_query("select * from order_users where mobile_='$mobile_' limit 1;");
	if (mysql_num_rows($result) == 1) {
		//检查登录态
		$result = mysql_query("select * from order_users where mobile_='$mobile_' and pass_='$tmp_pass' limit 1;");
		
		if (mysql_num_rows($result) == 1) {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=orders_export_".date('YmdHis').".xls");
			echo "
			<table border='1'>
			<tr>
			    	<th>序号</th>
				<th>类型</th>
				<th>数量</th>
				<th>姓名</th>
				<th>手机号码</th>
				<th>收货地址</th>
				<th>备用电话</th>
				<th>备注</th>
				<th>下单时间</th>
			</tr>";
			$sql = mysql_query("select type_,count_,name_,mobile_,address_,bak_mobile,memo_,order_time from new_order order by order_time desc;");
			$no = 1;
			while ($data = mysql_fetch_assoc($sql)) {
			echo  "
			<tr>
				<td>".$no."</td>
				<td>".$data["type_"]."</td>
				<td>".$data["count_"]."</td>
				<td>".$data["name_"]."</td>
				<td>".$data["mobile_"]."</td>
				<td>".$data["address_"]."</td>
				<td>".$data["bak_mobile"]."</td>
				<td>".$data["memo_"]."</td>
				<td>".$data["order_time"]."</td>
			</tr> ";
			$no++;
			}
		} else {
			GoLogin($mobile_);
		}
	} else {
		GoRegister($mobile_);
	}
} else {
	echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">没有权限</h2>
                <p class=\"weui_msg_desc\">抱歉，您没有权限进行此操作。请重新登录管理员账户！</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
                        <a href=\"login.php\" class=\"weui_btn weui_btn_primary\">确定</a>
                </p>
                </div>";
}

mysql_close($con_);

?>
</html>
