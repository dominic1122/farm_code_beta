<html class="ltr" lang="zh" data-rtl="false">
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<?php
session_start();
?>

<!--定义通用格式-->
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="/node_modules/weui/dist/style/weui.css"/>
<link rel="stylesheet" href="/node_modules/weui/dist/example/example.css"/>
<title>小鹿佳农|我的订单</title>
</head>

<body ontouchstart>

<?php 

include 'common_xlf.php';

session_start();

$mobile_="";
if (isset($_COOKIE["auth_str"])) {
        $mobile_ = explode("\t",base64_decode($_COOKIE["auth_str"]))[0];
}
if (isset($_POST["mobile_"])) {
        $mobile_ = $_POST["mobile_"];
}
if (isset($_GET["mobile_"])) {
        $mobile_ = $_GET["mobile_"];
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
			mysql_query("insert into new_order (order_tag,type_, count_, name_, mobile_, address_,memo_) values ('$order_tag','$type_', $count_, '$name_', '$mobile_', '$address_','$memo_');");
	
			$result = mysql_query("select * from new_order where mobile_='".$mobile_."' order by order_time desc");
			
			echo "
			<div class=\"hd\">    <h1 class=\"page_title\" style=\"font-size:30px\">我的订单</h1>
			</div>
			";
			
			
			echo "<div class=\"weui_cell\">
			                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">手机号码</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"$mobile_\"/> </div>
			</div>
			                <div class=\"weui_cell\">
			                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">订单数量</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".mysql_num_rows($result)."\"/> </div>
			</div>
			<div class=\"weui_cell\"></div>
			";
			
			while ($row = mysql_fetch_array($result)) {
				echo "
				<div class=\"weui_cells\">
				
				                <div class=\"weui_cell\">
				                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">订单时间</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".$row['order_time']."\"/> </div>
				                </div>
				                <div class=\"weui_cell\">
				                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">种类</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".$row['type_']."\"/> </div>
				                </div>
				                <div class=\"weui_cell\">
				                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">件数</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".$row['count_']."\"/> </div>
				                </div>
				                <div class=\"weui_cell\">
				                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">收件人</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".$row['name_']."\"/> </div>
				                </div>
				                <div class=\"weui_cell\">
				                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">收货地址</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".$row['address_']."\"/> </div>
				                </div>
				                <div class=\"weui_cell\">
				                        <div class=\"weui_cell_hd\"><label class=\"weui_label\">备注</label></div> <div class=\"weui_cell_bd weui_cell_primary\"> <input class=\"weui_input\" value=\"".$row['memo_']."\"/> </div>
				                </div>
				
				</div>
				";
			  echo "<br />";
			}
			echo "<br><br>";
			echo "<div class=\"weui_opr_area\">
				<p class=\"weui_btn_area\">
			       		<a href=\"order.php\" class=\"weui_btn weui_btn_primary\">去下单</a>
				</p>
			       </div>";
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
