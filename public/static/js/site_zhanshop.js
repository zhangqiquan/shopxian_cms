/**
 * 弹窗  iframe窗 触发器 class 为 alert_iframe  data中包含 iframe_url
 */

	(function(a){
		$().ready(function() {
			$(".validateform").validate(
				{     
				 submitHandler: function(form) 
				   {  
					  var url=$(form).attr("action");
					  var data=$(form).serialize();
					   layer.load(30, {
						  shade: [0.1,'#fff'] //0.1透明度的白色背景
						});
					  $.post(url,data,function(data){
                         layer.closeAll();
						if(data.code==false){
                            layer.msg(data.msg, {icon: 2});
							window.setTimeout(function(){
							if(data.url&&data.url!=undefined){
								window.location=data.url;
							}
							console.log("失败操作跳转失败url没有定义");	
							}, 800);
						}else{
                            layer.msg(data.msg, {icon: 1});
							window.setTimeout(function(){
							if(data.url&&data.url!=undefined){
								window.location=data.url;
							}
							console.log("跳转失败url没有定义");	
						}, 800);
						}
					});
					return false;
				   }  
				 }
			);
		});
		$("form3").submit(function(){
			var validateform=$(".validateform").validate();
			var url=$(this).attr("action");
			var data=$(this).serialize();
			$.post(url,data,function(data){
				var data=eval("("+data+")");
				if(data.status==false){
					layer.msg(data.msg, {icon: 2});
				}else{
					layer.msg(data.msg, {icon: 1});
					window.setTimeout(function(){
					window.location=data.url;	
				}, 2000);
				}
			});
			return false;
		});
		
		var click_href=$('.click_href');
		click_href.click(function(){
			var geturl=$(this).data('url');
			window.location=geturl;
		});
	    var alert_iframe=$('.alert_iframe');
	    alert_iframe.click(function(){
	    	var fwidth='1150px';
	    	var fheight='650px';
	    	if($(this).data('width')&&$(this).data('height')){
	    		fwidth=$(this).data('width');
	    		fheight=$(this).data('height');
	    	}
	    	//iframe窗
	    	var geturl=$(this).data('url');
	    	var title=$(this).data('title');
			layer.open({
			    type: 2,
			    title: false,
			    closeBtn: true,
			    shade: [0],
			    area: ['340px', '215px'],
			    offset: 'rb', //右下角弹出
			    time: 200, //2秒后自动关闭
			    shift: 2,
			    content: [geturl, 'no'], //iframe的url，no代表不显示滚动条
			    end: function(){ //此处用于演示
			        layer.open({
			            type: 2,
			            title: title,
			            shadeClose: true,
			            shade: false,
			            maxmin: true, //开启最大化最小化按钮
			            area: [fwidth, fheight],
			            content: geturl,
			        });
			    }
			});
	    });
	}(this)),
		(function(){
			try{
				document.getElementById("checked_all").onclick=function(){
					if(this.checked){
						var zhanshop_checkbox=document.getElementsByClassName("zhanshop_checkbox");
						for(var i=0;i<zhanshop_checkbox.length;i++){
							zhanshop_checkbox[i].checked=true;
						}
					}else{
						var zhanshop_checkbox=document.getElementsByClassName("zhanshop_checkbox");
						for(var i=0;i<zhanshop_checkbox.length;i++){
							zhanshop_checkbox[i].checked=false;
						}
					}
				}
			}catch(e){}
			
		}()),
		(function(){
			$('.delconfirm').click(function(){
				var form_data=$('#form').serialize();
				if(form_data==false||form_data==''){
					layer.msg('没有选择任何记录', {icon: 2});return false;
				}
				var dataurl=$(this).data('url');
				$(this).parent().parent().parent().parent('form').attr('action',dataurl);
				//询问框
				layer.confirm('确定删除？', {
				    btn: ['是','否'], //按钮
				    shade: false //不显示遮罩
				}, function(){
					var form_data=$('#form').serialize();
					$.post(dataurl,form_data,function(data){
						if(data.status==false){
							layer.msg(data.msg, {icon: 2});
						}else{
							layer.msg(data.msg, {icon: 1});
							window.location.reload();
						}
					});
				}, function(){
				    layer.msg('操作已取消', {icon: 2});
				});
			});
		}());
		(function(){
			$('.delconfirm_row').click(function(){
				var dataurl=$(this).data('url');
				//询问框
				layer.confirm('确定删除？', {
				    btn: ['是','否'], //按钮
				    shade: false //不显示遮罩
				}, function(){
					var form_data=$('#form').serialize();
					$.post(dataurl,'',function(data){
						if(data.status==false){
							layer.msg(data.msg, {icon: 2});
						}else{
							layer.msg(data.msg, {icon: 1});
							window.location.reload();
						}
					});
				}, function(){
				    layer.msg('操作已取消', {icon: 2});
				});
			});
		}());




