<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\index\index.html";i:1546480799;s:87:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\template\base.html";i:1546480821;s:91:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\template\nav_left.html";i:1547106067;s:90:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\template\nav_top.html";i:1546422885;}*/ ?>
﻿<!DOCTYPE html>
<html>
      <head>
        <meta charset="utf-8" />
        <meta name="renderer" content="webkit">
         <title>管理后台 - <?php echo \think\Config::get('site.title'); ?></title>
          ﻿ <meta name="keywords" content="<?php echo \think\Config::get('site.keywords'); ?>">
        <meta name="description" content="<?php echo \think\Config::get('site.keywords'); ?>">
         <link rel="Bookmark" href="__ROOT__/favicon.ico" >
        <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="__STATIC__/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="__STATIC__/css/index.css"/>
        <script type="text/javascript" src="__STATIC__/js/jquery.min.js" ></script>
        <script type="text/javascript" src="__STATIC__/js/commons.js" ></script>
    </head>
    <body class="hei">
             <!--左边导航-->
        <div class="lf_nav">
            <div class="top">
                <a href="/">
                    <img class="logo1" src="__STATIC__/img/png/logo1.png"/>
                    <img class="logo2" src="__STATIC__/img/png/logo2.png"/>
                </a>
            </div>
            
            <ul class="lf_ul clearfix">
                <li class="active">
                    <a data-href="<?php echo \think\Url::build('index/welcome'); ?>" data-nav="<?php echo \think\Url::build('index/nav'); ?>">
                        <span>首页</span>
                    </a>
                </li>
                <li >
                    <a data-href="<?php echo \think\Url::build('index/welcome'); ?>" data-nav="<?php echo \think\Url::build('index/nav'); ?>">
                        <span>考核待办</span>
                    </a>
                </li>
                <li>
                    <a href="###">
                        <span>考核模板</span>
                    </a>
                </li>
                <li>
                    <a href="###">
                        <span>目标管理</span>
                    </a>
                </li>
                <li>
                    <a href="###">
                        <span>考核结果</span>
                    </a>
                </li>
                <li>
                    <a data-href="<?php echo \think\Url::build('admin_group/index'); ?>" data-nav="<?php echo \think\Url::build('admin_user/nav'); ?>">
                        <span>团队管理</span>
                    </a>
                </li>
                <li>
                    <a data-href="<?php echo \think\Url::build('admin_user/index'); ?>" data-nav="<?php echo \think\Url::build('admin_user/nav'); ?>">
                        <span>企业设置</span>
                    </a>
                </li>
            </ul>
            
        </div>

<script type="text/javascript">
    $(function(){
            $(".lf_ul li>a").click(function(){
           
                if ($(this).attr('data-href')) {
                    loadhtml($(this).attr('data-href'));
                }
                if ($(this).attr('data-nav')) {
                    loadnav($(this).attr('data-nav'));

                }

            })

    });
    
</script>
        
      
        
        <!--上导航-->
        <div class="top_nav clearfix">
             <div id="nav" class="nav_con clearfix">
            </div>
               <!--个人中心、头像-->
            <div class="head_img">
                <a  data-href="<?php echo \think\Url::build('Pub/profile'); ?>'">
                    <span></span>
                    <i>
                        <img src="__STATIC__/img/heda_img.jpg" alt="" />
                    </i>
                </a>
            </div>
            
            <!--消息提醒-->
            <div class="message">
                <a data-href="###">
                    <i class="active"></i>
                </a>
            </div>
            
            <!--搜索-->
            <div class="nav_search">
                <form>
                    <input class="in_text" type="text"/>
                    <input class="in_btn" type="submit" value=""/>
                </form>
            </div>
           
            
        </div>
        <div id='content'>
            
        </div>
        
        
       
        
        
        
    </body>
    <script type="text/javascript">
         loadhtml('<?php echo \think\Url::build("index/welcome"); ?>')
    </script>
</html>



