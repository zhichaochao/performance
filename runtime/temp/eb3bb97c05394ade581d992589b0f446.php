<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\phpStudy\PHPTutorial\WWW\fsdfsdf\public/../application/admin\view\admin_user\newmembera.html";i:1547105519;}*/ ?>
   <!--返回-->
   <!-- <div class="top_nav clearfix"> -->
            <div class="fanhui clearfix">
                <a class="fh_a" href="###">返回</a>
            </div> 
            <!-- </div> -->
    <!--右边主内容-->
        <div class="r_content presonal_center xgzl_text clearfix">
            <form method="post" id="formmem">
                <div class="lf_img clearfix">
                    <img class="bg_img" src="__STATIC__/img/grzx_01.jpg"/>
                    
                    <div class="tx_img">
                        <div class="file_div">
                            <input type="file" class="file_in" id="file" name="file" value="" />
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
                                <input type="text" value="" name="name" id="name" />
                            </label>
                            <label for="">
                                <span class="ts_sp">性别</span>
                                <input type="text" value=""  name="gender" id="gender"/>
                            </label>
                            <label for="">
                                <span class="ts_sp">部门</span>
                                <input type="text" value=""  name="department" id="department"/>
                            </label>
                            <label for="">
                                <span class="ts_sp">职位</span>
                                <input type="text" value=""  name="position" id="position"/>
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
                                <input type="text" value="" name="username" id="username"/>
                            </label>
                            <label for="">
                                <span class="ts_sp">重置密码</span>
                                <input type="text" value="" name="password"  id="password"/>
                            </label>
                        </div>
                        
                        <input class="in_sub" type="button" value="保存"  />
                    
                </div>
            </form>
        </div>
        <script>
        $('.in_sub').click(function(){
            var  form =document.getElementById("formmem");
           var formdata =new FormData(form);
           // alert(formdata);
            var name = $("#name").val(); 
            var name = $("#gender").val();
            var name = $("#department").val();
            var name = $("#position").val();
            var name = $("#is_jurisdiction").val(); 
            var name = $("#username").val(); 
            var name = $("#password").val();  
            $.ajax({
                url:'<?php echo \think\Url::build("addmember"); ?>',
                type:"post",

                data: formdata, 
                contentType: false, 
                processData: false,
                dataType:'json',
                // async:false,
                // data: $('#formmem input[type=\'text\'],#formmem input[type=\'hidden\'],#formmem input[type=\'select\']'),
                success:function(){
                       // location.reload(); 
                }
            });
    })
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