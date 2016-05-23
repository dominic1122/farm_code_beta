<?php 

function GoLogin($tmp_mobile)
{
        echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">未登录</h2>
                <p class=\"weui_msg_desc\">[$tmp_mobile]未登录，请登录后继续</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
                <a href=\"login.php\" class=\"weui_btn weui_btn_default\">去登录</a>
                </p>
                </div>";
        $auth_str = base64_encode($tmp_mobile. "\t" . "");
        setcookie("auth_str",$auth_str, time()+3600*24*30);
}

function GoRegister($tmp_mobile)
{
        echo "
                <div class=\"weui_msg\">
                <div class=\"weui_icon_area\"><i class=\"weui_icon_warn weui_icon_msg\"></i></div>
                <div class=\"weui_text_area\">
                <h2 class=\"weui_msg_title\">未注册</h2>
                <p class=\"weui_msg_desc\">[$tmp_mobile]未注册，请注册后继续</p>
                </div>
                <div class=\"weui_opr_area\">
                <p class=\"weui_btn_area\">
                <a href=\"register.php\" class=\"weui_btn weui_btn_default\">去注册</a>
                </p>
                </div>";
        $auth_str = base64_encode($tmp_mobile. "\t" . "");
        setcookie("auth_str",$auth_str, time()+3600*24*30);
}
?>
