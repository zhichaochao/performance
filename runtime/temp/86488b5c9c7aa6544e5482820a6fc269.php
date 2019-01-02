<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW\performance\public/../application/admin\view\pub\login.html";i:1546400963;}*/ ?>
﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="renderer" content="webkit">
         <title>后台登录 - <?php echo \think\Config::get('site.title'); ?></title>
    <meta name="keywords" content="<?php echo \think\Config::get('site.keywords'); ?>">
    <meta name="description" content="<?php echo \think\Config::get('site.keywords'); ?>">
         <link rel="Bookmark" href="__ROOT__/favicon.ico" >
        <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="__STATIC__/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="__STATIC__/css/index.css"/>
        <script type="text/javascript" src="__STATIC__/js/jquery.min.js" ></script>
        <script type="text/javascript" src="__STATIC__/js/commons.js" ></script>
    </head>
    <body class="hei">
        <div class="login">
            <div class="logo">
                <a ><img src="__STATIC__/img/png/logo3.png"/></a>
            </div>
            <h1>赫特·目标管理与绩效考核系统 </h1>
            
            <div class="login_f">
                 <form class="form form-horizontal" action="<?php echo \think\Url::build('checkLogin'); ?>" method="post" id="form">
                    <label for="name">
                        <input class="name" id="name" type="text" placeholder="请输入账号"   name="account" datatype="*" nullmsg="请填写帐号"/>
                    </label>
                    <label for="pass">
                        <input class="pass" id="pass" type="password" name="password"  placeholder="密码"  datatype="*" nullmsg="请填写密码" />
                    </label>
                    <a class="forget" >忘记密码？联系管理员重置</a>
                    <input class="in_sub"  type="submit" value="登录" />
                    
                    <!-- <input class="in_sub" onclick="login();" type="button" value="登录" /> -->
                </form>
            </div>
            
        </div>
        
    </body>
</html>
<script>
    $(function(){
        $(".login").height($(window).height());
    })


</script>
<!-- <script>

    function login() {
        $.ajax({
            url:'<?php echo \think\Url::build("checkLogin"); ?>',
            data:$('#form input'),
            type:'post',
              success: function(data){
                if (data.code==0) {
                       location.href = '<?php echo \think\Request::instance()->get('callback')?: \think\Url::build("Index/index"); ?>';
                }

              }



    });

    }

</script> -->





