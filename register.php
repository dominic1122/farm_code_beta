<!DOCTYPE HTML>
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

<title>小鹿佳农|新注册</title>
</head>


<body ontouchstart>

<div class="hd">
	<h1 class="page_title" style="font-size:30px"><img src="../supermario.png" height=35 width=35 />填写注册信息</h1>
</div>

<form action="do_register.php" method="post">
	<div class="weui_cells">
		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">手机号码</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="mobile_" required="required" pattern="^1[345678][0-9]{9}$" maxlength=11 value="<?php echo explode("\t",base64_decode($_COOKIE["auth_str"]))[0];?>" placeholder="(必填)请填写11位手机号码"/>
		        </div>
		</div>
	
		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">设定密码</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="pass_" required="required" placeholder="(必填)请填写密码"/>
		        </div>
		</div>
	
		<!--div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">收货人</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="name_" placeholder="(选填)请填写收货人姓名"/>
		        </div>
		</div-->
	
		<!--div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="address_" placeholder="(选填)请填写具体地址"/>
		        </div>
		</div-->
	
		<div class="weui_cell weui_cell_select weui_select_after">
			    <div class="weui_cell_hd">
			        <label for="" class="weui_label">所在区域</label>
			    </div>
			    <div class="weui_cell_bd weui_cell_primary">
			        <select class="weui_select" name="source_">
			            <option value="1">惠州淡水</option>
			            <option value="2">其他</option>
			        </select>
			    </div>
			</div>
		</div>
	</div>

	<div class="weui_cells_tips">*请确保所填信息准确</div>

	<div class="weui_btn_area">
		<input type="submit" class="weui_btn weui_btn_primary" value="创建账户"/>
	</div>
</form>

<br>
<div class="weui_btn_area">
        <a href="login.php" class="weui_btn weui_btn_plain_primary">已有账号，直接登录</a>
</div>
<br> <br>

</body>
</html>
