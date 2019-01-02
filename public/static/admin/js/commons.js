
$(function(){
	$(".lf_nav").height($(window).height());
	$(".lfnav_text").height($(window).height());
	$(window).resize(function(){
		$(".lf_nav").height($(window).height());
		$(".lfnav_text").height($(window).height());
	})
	
	
	//日历年月选择器
    var in_n=new Date().getFullYear();
    var in_y=new Date().getMonth();
	var date=new Date().getDate();
	
	$(".ny_label .in_text").focus(function(){
		const this_par = $(this).parents(".ny_label");
		this_par.find(".ny_in").attr("value",in_n);
		ny_li(in_n,this_par);
		this_par.find(".time_ny").fadeIn();
	})
	$(".ny_label .ny_in").change(function(){
		const this_val = $(this).attr("value");
		const this_par = $(this).parents(".ny_label");
		ny_li(this_val,this_par);
	})
	$(".ny_label .sp_lf").click(function(){
		const this_par = $(this).parents(".ny_label");
		const in_val =parseInt(this_par.find(".ny_in").attr("value"))-1;
		this_par.find(".ny_in").attr("value",in_val);
		ny_li(in_val,this_par);
	})
	$(".ny_label .sp_rf").click(function(){
		const this_par = $(this).parents(".ny_label");
		const in_val =parseInt(this_par.find(".ny_in").attr("value"))+1;
		this_par.find(".ny_in").attr("value",in_val);
		ny_li(in_val,this_par);
	})
	
	//循环li年月内容
	function ny_li(n,obj_par){
		obj_par.find(".ul_ny").html('');
		for(var i=1;i<=12;i++){
			if(i.toString().length<=1){
				i = "0"+i.toString();
			}
			let li_text = '<li>'+n+'-'+i+'</li>'
			obj_par.find(".ul_ny").append(li_text);
			const li_val = obj_par.find(".ul_ny>li").eq(i-1).text();
			if(li_val == in_n.toString()+"-"+(in_y+1).toString()){
				obj_par.find(".ul_ny>li").eq(i-1).addClass("active");
			}
		}
	}
	//选择年月
	$(".ny_label .ul_ny").delegate(">li","click",function(){
		const this_par = $(this).parents(".ny_label");
		this_par.find(".in_text").attr("value",$(this).text());
		$(this).parents(".time_ny").fadeOut();
	})
	
	
	
	//select2级联动
	var off=true;
	//打开下拉选择
	$(".select_down .select_btn").click(function(){
		if(off){
			off = false;
			$(this).parents(".select_down").animate({height:"100%"},500);
			$(this).parents(".select_down").css("overflow","inherit");
			
			$(".fqgg_midal .text .btn").addClass("active");
		}else{
			off = true;
			$(this).parents(".select_down").animate({height:"42px"},100);
			$(this).parents(".select_down").css("overflow","hidden");
			$(".fqgg_midal .text .btn").removeClass("active");
		}
	})
	//鼠标经过下拉	
	$(".select_down .select_ol>li").hover(function(){
			$(this).find(".select_ul").stop().show();
	},function(){
			$(this).find(".select_ul").stop().hide();
		
	})
	$(".select_down .select_ol>li").click(function(){
		$(this).parents(".select_down").find(".select_btn").text($(this).find("em").text());
		off = true;
		$(this).parents(".select_down").animate({height:"42px"},100);
		$(this).parents(".select_down").css("overflow","hidden");
		
	})
	$(".select_down .select_ul>li").click(function(e){
		$(this).parents(".select_down").find(".select_btn").text($(this).text());
		off = true;
		$(this).parents(".select_down").animate({height:"42px"},100);
		$(this).parents(".select_down").css("overflow","hidden");
		
		
		e.stopPropagation();
		
		
	})
	
})

//员工下拉选择
function select_down(){
	let arr_ol=[];
	arr_ol[0] = ['所有成员',[]];
	arr_ol[1] = ['全力以赴队',['岑丽欣','成明辉','练金妍','盘洁华','姚永坚','赵浩宇','章玲丽']];
	arr_ol[2] = ['勇往直前队',['杜婉君','邝美红','梁玉婵','张永凤']];
	arr_ol[3] = ['赫特财务部',['代黎黎','彭瑞芸']];
	arr_ol[4] = ['赫特技术部',['陈丽珊','陈志超','刘碧辉','李想','苏立鹏','张培義']];
	arr_ol[5] = ['赫特采购部',['程啦啦','吴国栋']];
	arr_ol[6] = ['赫特储运部',['陈成','马洪照','黄风弟','陈嘉俊','刘婉君','萧晓清','朱震勇']];
	arr_ol[7] = ['naijabeauty',['贝楚玫','张莹莹','王俊星','唐海静','李鸿光','胡程鹏']];
	arr_ol[8] = ['总经理办公室',['李文丹','董兰']];
	arr_ol[9] = ['人事行政部',['张泽群','丘祖金']];
	$(".select_down").append('<ol class="select_ol"></ol>');
	for(var i=0;i<arr_ol.length;i++){
		var li_text = '<li><em>'+arr_ol[i][0]+'</em><ul class="select_ul"></ul></li>';
		$(".select_down>.select_ol").append(li_text);
		for(var j=0;j<arr_ol[i][1].length;j++){
			var li_text = '<li>'+arr_ol[i][1][j]+'</li>';
			$(".select_down>.select_ol>li").eq(i).find(".select_ul").append(li_text);
		}
	}
}	
	
	

function loadhtml(href) {
	     $.ajax({
            url:href,
              success: function(data){
               $('#content').html(data);
              }

    		});
}
function loadnav(href) {
	     $.ajax({
            url:href,
              success: function(data){
              	if (data.code==0) {
	              	data= data.msg;
	              	var nav='';
	              	if (data) {
	              		for (var i = 0; i< data.length; i++) {

	              			var hrefk="loadhtml('"+data[i].href+"');";

	              			if (i==0) {
	              			nav+='<a class="nav_a active" onclick="'+hrefk+'">'+data[i].name+'</a>';
	              			}else{
	              				nav+='<a class="nav_a " onclick="'+hrefk+'">'+data[i].name+'</a>';
	              			}
	              		}
	              		 $('#nav').html(nav);
	              	}else{
	              		 $('#nav').html('');
	              	}
	              }
	          	}

    		});
}