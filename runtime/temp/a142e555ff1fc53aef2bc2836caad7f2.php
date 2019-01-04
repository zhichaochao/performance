<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\admin_user\index.html";i:1546572450;}*/ ?>

        <!--左边内容导航-->
        <div class="lfnav_text clearfix">
            <button class="edit_btn" type="button">
                <span>编辑部门</span>
            </button>
            <ul id='bu_liist'>


                <li class="active">
                    <a href="###"><span>所有成员（88）</span></a>
                </li>
                <li>
                    <a href="###"><span>总经理（2）</span></a>
                </li>
                <li>
                    <a href="###"><span>采购部（3）</span></a>
                </li>
                <li>
                    <a href="###"><span>财务部（2）</span></a>
                </li>
                <li>
                    <a href="###"><span>人事部（2）</span></a>
                </li>
                <li>
                    <a href="###"><span>技术部（6）</span></a>
                </li>
                <li>
                    <a href="###"><span>尼佳（6）</span></a>
                </li>
                <li>
                    <a href="###"><span>乐米（20）</span></a>
                </li>
                <li>
                    <a href="###"><span>思创（8）</span></a>
                </li>
                <li>
                    <a href="###"><span>勇往直前（6）</span></a>
                </li>
                <li>
                    <a onclick="loadlist();"><span>全力以赴（5）</span></a>
                </li>
                <li>
                    <a onclick="loadlist();"><span>储运部（10）</span></a>
                </li>
            </ul>
        </div>
        
        <!--右边主内容-->
        <div class="rftext_con clearfix" id="list">
            <div class="search">
                <form action="">
                    <input class="in_sub" type="submit" value=""/>
                    <input class="in_text" type="text" placeholder="搜索姓名、部门、职位" />
                </form>
                
            </div>
            
            <div class="daochu clearfix">
                <span>导出为Excel</span>
            </div>
            
            <a class="add_cy clearfix" data-href="<?php echo \think\Url::build('admin_user/newmembera'); ?>" data-nav="<?php echo \think\Url::build('admin_user/nav'); ?>">+&nbsp;新增成员</a>
            
            
            <div class="bot clearfix">
                <table border="" cellspacing="" cellpadding="">
                    <tr>
                        <th>头像</th>
                        <th>姓名</th>
                        <th>部门</th>
                        <th>职位</th>
                        <th>更新时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a" href="###">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a" href="###">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a" href="###">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a" href="###">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a" href="###">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a"  onclick=" loadhtml('<?php echo \think\Url::build('admin_user/nav'); ?>');">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/grzx_02jpg.jpg"/></td>
                        <td><span>王二小</span></td>
                        <td><span>全力以赴</span></td>
                        <td><span>初级业务员</span></td>
                        <td><span>11/23  14:08</span></td>
                        <td><span>激活</span></td>
                        <td>
                            <button>重置密码</button>
                            <a class="edit_a" href="###">修改</a>
                            <button>冻结</button>
                            <button class="del">删除</button>
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>
        
        <!--编辑部门弹窗-->
        <div class="edit_bm_modal clearfix" >
            <div class="text clearfix">
                <h1>编辑部门</h1>
                <div class="md_close"></div>
                <!-- <form> -->
                    <div class="sc_div">
                        <ol class="bm_ol" id="if_gdt">
                            <h2>选择部门:</h2>
                            <!--  -->

                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="总经理" disabled="disabled" />
                            </li>
                            <li ondrop
                            ="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="采购部" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="财务部" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="人事部" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="技术部" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="储运部" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="乐米" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="尼佳" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="思创" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="全力以赴" disabled="disabled" />
                            </li>
                            <li ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)">
                                <input type="text" value="勇往直前" disabled="disabled" />
                            </li>
                            <li>
                                <input class="active" type="text" placeholder="请输入新建部门名称" name="ment" />
                            </li>
                        </ol>
                    </div>
                    
                    <input class="qd_in" type="submit"  draggable="true" value="确定" onclick="cancel_ment();" />
                    <input class="qx_in" type="reset" value="取消"/>
                <!-- </form> -->
                
                
            </div>
        </div>
{/block}
<script>
//新建部门
// $('.qd_in').on('click', function() {
    // alert(11);
function cancel_ment(){
            $.ajax({
                url:'<?php echo \think\Url::build("insertment"); ?>',
                type:"post",
                data: $('#if_gdt input[type=\'text\']'),
                // success:function(){
                //        location.reload(); 
                // }
            });
    }

// function loadlist(href) {
//          $.ajax({
//             url:href,
//               success: function(data){
//                $('#list').html(data);
//               }

//             });
// }
// 
$(function(){
            $(".rftext_con a").click(function(){
           
                if ($(this).attr('data-href')) {
                    loadhtml($(this).attr('data-href'));
                }
                if ($(this).attr('data-nav')) {
                    loadnav($(this).attr('data-nav'));

                }

            })

    });

    $(function(){
//      打开弹窗        
        $(".edit_btn").click(function(){
            // alert(11);
            $(".edit_bm_modal").fadeIn();
            $("body").css("overflow","hidden");
        })
        
//      关闭弹窗
        $(".md_close").click(function(){
            $(".edit_bm_modal").fadeOut();
            $("body").css("overflow","");
        })
        $(".edit_bm_modal").click(function(e){
            var close = $('.edit_bm_modal .text'); 
            if(!close.is(e.target) && close.has(e.target).length === 0){
                $(".edit_bm_modal").fadeOut();
                $("body").css("overflow","");
            }
        })
        
        //双击编辑部门input
        $(".bm_ol").delegate("li","dblclick",function(){
            $(".bm_ol>li input").removeClass("active");
            $(".bm_ol>li input").attr("disabled",'disabled');
            $(".bm_ol>li:last-child() input").addClass("active");
            $(".bm_ol>li:last-child() input").removeAttr("disabled");
            $(this).find("input").addClass("active");
            $(this).find("input").removeAttr("disabled");
            $(this).find("input").focus();
        })
        //编辑完成之后还原input样式
        $(".bm_ol").delegate("li input","blur",function(){
            $(this).removeClass("active");
            $(this).attr("disabled",'disabled');
            $(this).attr("value",$(this).val());
        })
        //鼠标经过li出现删除图标等
        $(".bm_ol").delegate("li","mouseenter",function(){
                $(this).find(".del").css("display","block");
            if($(this).parent().find("li").length!=$(this).index()){
                let del = '<div class="del">'+
                                '<svg t="1539766974948" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5269" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20">'+
                                    '<path d="M793.6 998.4H220.16c-51.2 0-97.28-40.96-97.28-97.28V261.12c0-15.36 10.24-25.6 25.6-25.6s25.6 10.24 25.6 25.6v645.12c0 25.6 20.48 46.08 46.08 46.08h573.44c25.6 0 46.08-20.48 46.08-46.08v-563.2c0-15.36 10.24-25.6 25.6-25.6s25.6 10.24 25.6 25.6v563.2c0 46.08-46.08 92.16-97.28 92.16z" p-id="5270" fill="#999999"></path>'+
                                    '<path d="M51.2 266.24c-10.24 0-20.48-10.24-25.6-25.6 0-15.36 10.24-25.6 25.6-25.6l916.48-81.92c15.36 0 25.6 10.24 25.6 25.6s-10.24 25.6-25.6 25.6L51.2 266.24c5.12 0 0 0 0 0z" p-id="5271" fill="#999999"></path>'+
                                    '<path d="M343.04 230.4c-10.24 0-20.48-10.24-25.6-25.6l-5.12-76.8C307.2 87.04 337.92 51.2 378.88 46.08l225.28-20.48c20.48 0 40.96 5.12 56.32 15.36 15.36 10.24 25.6 30.72 25.6 51.2l5.12 81.92c0 15.36-10.24 25.6-25.6 25.6s-25.6-10.24-25.6-25.6l-5.12-81.92c0-10.24-10.24-20.48-25.6-20.48l-225.28 25.6c-5.12 0-10.24 5.12-15.36 10.24-5.12 0-5.12 10.24-5.12 15.36L368.64 204.8c0 10.24-10.24 25.6-25.6 25.6 5.12 0 0 0 0 0zM435.2 768c-15.36 0-25.6-15.36-25.6-30.72V399.36c0-15.36 10.24-40.96 25.6-40.96s25.6 25.6 25.6 35.84v337.92c0 15.36-10.24 35.84-25.6 35.84zM588.8 768c-15.36 0-25.6-15.36-25.6-30.72V465.92c0-15.36 10.24-25.6 25.6-25.6s25.6 10.24 25.6 25.6v271.36c0 15.36-10.24 30.72-25.6 30.72z" p-id="5272" fill="#999999"></path>'+
                                '</svg> '+
                            '</div>';
                $(this).append(del);
            }
        })
        //鼠标离开li隐藏删除图标等
        $(".bm_ol").delegate("li","mouseleave",function(){
            $(this).find(".del").hide();
            $(this).find(".del").remove();
        })
        //点击删除图标 删除li
        $(".bm_ol").delegate("li .del","click",function(){
            $(this).parents("li").remove();
        })
        
    })
    
    
    //判断部门编辑是否出现滚动条
    //offsetHeight=scrollHeight=clientHeight则没有滚动条
    var obj=document.getElementById("if_gdt");
    if(obj.scrollHeight>obj.clientHeight){
        $(".bm_ol").css("margin-right","-17px");
    }
    
    //部门编辑上下移动
    function allowDrop(ev) {
        ev.preventDefault();
    }
    var srcdiv = null;
    var temp = null;
    function drag(ev, divdom) {
        srcdiv = divdom;
        temp = divdom.outerHTML;
    }
    function drop(ev, divdom) {
        ev.preventDefault();
        if (srcdiv != divdom) {
            $(divdom).before(temp);
            $(srcdiv).remove();
            $(".bm_ol>li").find(".del").hide();
            $(".bm_ol>li input").removeClass("active");
            $(".bm_ol>li input").attr("disabled",'disabled');
            $(".bm_ol>li:last-child() input").addClass("active");
            $(".bm_ol>li:last-child() input").removeAttr("disabled");
        }
    }
</script>