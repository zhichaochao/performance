<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\admin_user\newmembera.html";i:1546582268;}*/ ?>
   <!--返回-->
   <!-- <div class="top_nav clearfix"> -->
            <div class="fanhui clearfix">
                <a class="fh_a" href="###">返回</a>
            </div> 
            <!-- </div> -->
    <!--右边主内容-->
        <div class="r_content presonal_center xgzl_text clearfix" id="formmem">
            <!-- <form > -->
                <div class="lf_img clearfix">
                    <img class="bg_img" src="__STATIC__/img/grzx_01.jpg"/>
                    
                    <div class="tx_img">
                        <div class="file_div">
                            <input type="file" class="file_in" id="file"/>
                            <img class="tx" src="__STATIC__/img/grzx_02jpg.jpg"/>
                            <p>更换头像</p> 
                        </div>
                    </div>
                    
                </div>
                
                <div class="rf_text clearfix">
                        <div class="label clearfix">
                            <h1>个人信息</h1>
                            <label for="">
                                <span class="ts_sp">姓名</span>
                                <input type="text" value="" name="name" />
                            </label>
                            <label for="">
                                <span class="ts_sp">性别</span>
                                <input type="text" value=""  name="gender"/>
                            </label>
                            <label for="">
                                <span class="ts_sp">部门</span>
                                <input type="text" value=""  name="department"/>
                            </label>
                            <label for="">
                                <span class="ts_sp">职位</span>
                                <input type="text" value=""  name="position" />
                            </label>
                        </div>
                        <input type="hidden" name="dxx" id="is_jurisdiction" value="2"/>
                        <div class="label clearfix">
                            <h1 class="qx_h1">权限设置</h1>
                            
                            <ul class="qx_ul clearfix">
                                <li>
                                    <span class="dx_span">
                                        <input type="radio" name="dx" value="1" />
                                    </span>
                                    <em>个人</em>
                                </li>
                                <li>
                                    <span class="dx_span active">
                                        <input type="radio" name="dx" value="2" />
                                    </span>
                                    <em>团队</em>
                                </li>
                                <li>
                                    <span class="dx_span">
                                        <input type="radio" name="dx" value="3"/>
                                    </span>
                                    <em>管理员</em>
                                </li>
                            </ul>
                                
                        </div>
                        
                        <div class="label clearfix">
                            <h1>账号设置</h1>
                            <label for="">
                                <span class="ts_sp">用户名</span>
                                <input type="text" value="" name="username"/>
                            </label>
                            <label for="">
                                <span class="ts_sp">重置密码</span>
                                <input type="text" value="" name="password" />
                            </label>
                        </div>
                        
                        <input class="in_sub" type="submit" value="保存" onclick="addmember();" />
                    
                </div>
            <!-- </form> -->
        </div>
        <script>
        function addmember(){
            $.ajax({
                url:'<?php echo \think\Url::build("addmember"); ?>',
                type:"post",
                data: $('#formmem input[type=\'text\'],#formmem input[type=\'hidden\'],#formmem input[type=\'select\']'),
                // success:function(){
                //        location.reload(); 
                // }
            });
    }
    $(function(){
        $(".rf_text").height($(".lf_img").height());
        
        $(window).resize(function(){
            $(".rf_text").height($(".lf_img").height());
        })
        
//      权限设置单选
        $(".qx_ul>li").click(function(){
            $(".qx_ul>li .dx_span").removeClass("active");
            $(this).find(".dx_span").addClass("active");
            var val=$(this).find("input").val();
         $('#is_jurisdiction').val(val);
        })
        
        
    })
    
    //调取上传框
    $(".file_in").change(function(){   
    var file = this.files[0];
    if(window.FileReader){    
        var reader = new FileReader();    
        reader.readAsDataURL(file);    
        reader.onloadend = function (e) {
            $(".file_div .tx").attr("src",e.target.result);    
        };    
    } 
});
     
    
</script>