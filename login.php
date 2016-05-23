<!DOCTYPE HTML>
<html class="ltr" lang="zh" data-rtl="false">
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<!--定义通用格式-->
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="/node_modules/weui/dist/style/weui.css"/>
<link rel="stylesheet" href="/node_modules/weui/dist/example/example.css"/>

<title>小鹿佳农|登录</title>
</head>


<body ontouchstart>

<div class="hd">
	<h1 class="page_title" style="font-size:30px"><img src="../supermario.png" height=35 width=35 />用户登录</h1>
</div>

<form action="do_login.php" method="post">
	<div class="weui_cells">
		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">手机号码</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="mobile_" required="required" pattern="^1[345678][0-9]{9}$" maxlength=11 placeholder="如：13677889900" value="<?php echo explode("\t",base64_decode($_COOKIE["auth_str"]))[0];?>"/>
		        </div>
		</div>
	
		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="password" name="pass_" required="required" placeholder="如：2016$&Gz"/>
		        </div>
		</div>
	</div>
	
	<div class="weui_btn_area">
		<input type="submit" class="weui_btn weui_btn_primary" value="登录"/>
	</div>

</form>
<br>

<div class="weui_btn_area">
        <a href="register.php" class="weui_btn weui_btn_plain_primary">没有账号，3秒注册</a>
        <a href="reset_pass.html" class="weui_btn weui_btn_plain_default">忘记密码，请点这里</a>
</div>
<br> <br>

</body>
</html>
