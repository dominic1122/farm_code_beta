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

<title>小鹿佳农|新增订单</title>
</head>


<body ontouchstart>

<div class="hd">
	<h1 class="page_title" style="font-size:30px"><img src="../supermario.png" height=35 width=35 />新增订单</h1>
</div>

<form action="new_order.php" method="post">
	<div class="weui_cells">
		<div class="weui_cell weui_cell_select weui_select_after">
                            <div class="weui_cell_hd">
                                <label for="" class="weui_label">鸡蛋品种</label>
                            </div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <select class="weui_select" name="type_">
                                    <option value="红蛋">红蛋</option>
                                    <option value="白蛋">白蛋</option>
                                    <option value="粉蛋">粉蛋</option>
                                </select>
                            </div>
                        </div>
                </div>

		<div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">件数</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="number" name="count_" required="required" pattern="[0-9]*" maxlength=11 placeholder="(必填)如：25"/>
                        </div>
                </div>

		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">联系电话</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="mobile_" required="required" value="<?php echo explode("\t",base64_decode($_COOKIE["auth_str"]))[0];?>" pattern="^1[345678][0-9]{9}$" maxlength=11 placeholder="(必填)如：13612348888"/>
		        </div>
		</div>
	
		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">收货人</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="name_" required="required" value="<?php echo explode("\t",base64_decode($_COOKIE["a_str"]))[0];?>" placeholder="(必填)如：张三"/>
		        </div>
		</div>
	
		<div class="weui_cell">
		        <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
		        <div class="weui_cell_bd weui_cell_primary">
		            <input class="weui_input" type="text" name="address_" required="required" value="<?php echo explode("\t",base64_decode($_COOKIE["a_str"]))[1];?>" placeholder="(必填)如：惠州市淡水镇体育路123号小四川餐厅"/>
		        </div>
		</div>

		<div class="weui_cell">
			<div class="weui_cell_hd"><label class="weui_label">备用联系电话</label></div>
			<div class="weui_cell_bd weui_cell_primary">
				<input class="weui_input" type="text" name="bak_moible" pattern="^1[345678][0-9]{9}$" maxlength=11 placeholder="(选填)如：13612348889"/>
			</div>
		</div>

		<div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">备注</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="text" name="memo_" value="<?php echo explode("\t",base64_decode($_COOKIE["a_str"]))[2];?>" placeholder="(选填)如：上午送货"/>
                        </div>
                </div>

	
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

	<input name="order_tag" type="hidden" id="order_tag" value="<?php echo rand(10000,100000000000);?>" />

	<div class="weui_btn_area">
		<input type="submit" class="weui_btn weui_btn_primary" value="确认提交"/>
	</div>

</form>
<br> <br>

</body>
</html>
