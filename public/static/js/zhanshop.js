/**
 * 弹窗  iframe窗 触发器 class 为 alert_iframe  data中包含 iframe_url
 */

	(function(a){
		$('.validateform').submit(function(){
			$.post($(this).prop('action'),$(this).serialize,function(data){
				alert(data);
			});
			return false;
		});
	    var alert_iframe=$('.alert_iframe');
	    alert_iframe.click(function(){
			parent.layer.closeAll();	
	    	var fwidth='80%';
	    	var fheight='80%';
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
			    area: ['80%', '80%'],
			    offset: 'rb', //右下角弹出
			    time: 10, //2秒后自动关闭
			    shift: 2,
			    content: ['', 'no'], //iframe的url，no代表不显示滚动条
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
        var location=$('.location');
	    location.click(function(){
                var geturl=$(this).data('url');
                window.location=geturl;
        });
        var openurl=$('.openurl');
        openurl.click(function(e){
        	var geturl=$(this).data('url');
        	window.open (geturl, "", "height="+window.screen.height+", width="+window.screen.width+", top=0, left=0,toolbar=no, menubar=no, scrollbars=yes, resizable=no, loca tion=no, status=no")//写成一行
        })
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
				parent.layer.closeAll();	
				var form_data=$('#form').find('.primary_id');
				var selectId={};
				var num=0;
				form_data.each(function(i){
					if(this.checked&&$(this).val()!='on'){
                                                                                            selectId[num]=$(this).val();
                                                                                            num++;
					}
				})
				if(jQuery.isEmptyObject( selectId )){
					parent.layer.msg('没有选择任何记录', {anim: 6,icon: 2});return false;
				}
				
				var dataurl=$(this).data('url');
				$(this).parent().parent().parent().parent('form').attr('action',dataurl);
				//询问框
				parent.layer.confirm('确定'+$(this).data("title")+'？', {
				    btn: ['是','否'], //按钮
				    shade: false //不显示遮罩
				}, function(){
					var form_data={'id':selectId};
					$.post(dataurl,form_data,function(data){
						if(data.code==false){
							parent.layer.msg(data.msg, {anim: 6,icon: 2});
						}else{
							parent.layer.msg(data.msg, {anim: 6,icon: 1});
							window.location.reload();
						}
					});
				}, function(){
				    parent.layer.msg('操作已取消', {anim: 6,icon: 2});
				});
			});
			$('.submitOpen').click(function(){
					parent.layer.closeAll();	
					var fwidth='80%';
					var fheight='80%';
					if($(this).data('width')&&$(this).data('height')){
						fwidth=$(this).data('width');
						fheight=$(this).data('height');
					}
					var form_data=$('#form').find('.primary_id');
					var selectId={};
                                                                                      var selectIdStr='';
					form_data.each(function(i){
						if(this.checked&&$(this).val()!='on'){
							selectId[i]=$(this).val();
							selectIdStr+='id['+i+']='+$(this).val()+'&';
						}
					})
					if(jQuery.isEmptyObject( selectId )){
						parent.layer.msg('没有选择任何记录', {anim: 6,icon: 2});return false;
					}
                                                                                      console.log(selectId);
					var dataurl=$(this).data('url')+'?'+selectIdStr;
					var title=$(this).data('title');
					$(this).parent().parent().parent().parent('form').attr('action',dataurl);
					layer.open({
						type: 2,
						title: false,
						closeBtn: true,
						shade: [0],
						area: [fwidth, fheight],
						offset: 'rb', //右下角弹出
						time: 10, //2秒后自动关闭
						shift: 2,
						content: ['', 'no'], //iframe的url，no代表不显示滚动条
						end: function(){ //此处用于演示
							parent.layer.open({
								type: 2,
								title: title,
								shadeClose: true,
								shade: false,
								maxmin: true, //开启最大化最小化按钮
								area: [fwidth, fheight],
								content: dataurl,
							});
						}
					});
					
				});
					$('.submitOpenChild').click(function(){
                                                                                      //parent.layer.closeAll();
					var fwidth='80%';
					var fheight='80%';
					if($(this).data('width')&&$(this).data('height')){
						fwidth=$(this).data('width');
						fheight=$(this).data('height');
					}
					var form_data=$('#form').find('.primary_id');
					var selectId={};
                                                                                      var selectIdStr='';
					form_data.each(function(i){
						if(this.checked&&$(this).val()!='on'){
							selectId[i]=$(this).val();
							selectIdStr+='id['+i+']='+$(this).val()+'&';
						}
					})
					if(jQuery.isEmptyObject( selectId )){
						parent.layer.msg('没有选择任何记录', {anim: 6,icon: 2});return false;
					}
                                                                                      console.log(selectId);
					var dataurl=$(this).data('url')+'?'+selectIdStr;
					var title=$(this).data('title');
					$(this).parent().parent().parent().parent('form').attr('action',dataurl);
					layer.open({
						type: 2,
						title: false,
						closeBtn: true,
						shade: [0],
						area: [fwidth, fheight],
						offset: 'rb', //右下角弹出
						time: 10, //2秒后自动关闭
						shift: 2,
						content: ['', 'no'], //iframe的url，no代表不显示滚动条
						end: function(){ //此处用于演示
							parent.layer.open({
								type: 2,
								title: title,
								shadeClose: true,
								shade: false,
								maxmin: true, //开启最大化最小化按钮
								area: [fwidth, fheight],
								content: dataurl,
							});
						}
					});
					
				});
		}());
		(function(){
			$('.delconfirm_row').click(function(){
				parent.layer.closeAll();	
				var dataurl=$(this).data('url');
				//询问框
				parent.layer.confirm('确定'+$(this).data('title')+'？', {
				    btn: ['是','否'], //按钮
				    shade: false //不显示遮罩
				}, function(){
					$.get(dataurl,'',function(data){
						if(data.code==false){
								parent.layer.msg(data.msg, {anim: 6,icon: 2});
						}else{
								parent.layer.msg(data.msg, {icon: 1});
								window.location.reload();
						}
					});
				}, function(){
				    parent.layer.msg('操作取消',{icon: 2} );
				});
			});
			
			$('.finder_open').on('click',function(e){
				parent.layer.closeAll();	
				var fwidth='80%';
				var fheight='80%';
				if($(this).data('width')&&$(this).data('height')){
					fwidth=$(this).data('width');
					fheight=$(this).data('height');
				}
				var title=$(this).data('title');
				var id=$(this).data("id");
				var finder_path=$(this).data("finder_path");
				var url=$(this).data("url")+"?id="+id+'&finder_path='+finder_path+'&isAjax=0';
				layer.open({
					type: 2,
					title: false,
					closeBtn: true,
					shade: [0],
					area: [fwidth, fheight],
					offset: 'rb', //右下角弹出
					time: 10, //2秒后自动关闭
					shift: 2,
					content: ['', 'no'], //iframe的url，no代表不显示滚动条
					end: function(){ //此处用于演示
						layer.open({
							type: 2,
							title: title,
							shadeClose: true,
							shade: false,
							maxmin: true, //开启最大化最小化按钮
							area: [fwidth, fheight],
							content: url,
						});
					}
				});
				//window.open (url+"?id="+id+'&finder_path='+finder_path,'','height=600,width=800,top=100,left=100,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') 
			});
			//finder 明细事件
			$('.detail_tr_1').on('click',function(e){
				var finder_path=$(this).data("finder_path");
				var id=$(this).data("id");
				$.get(finder_url,'finder_path='+finder_path+'&id='+id,function(data){
					$('#finder_body').html(data);
				});
			});
		}());

function detail_tr_click(ts){
	$(ts).parent().find("button").each(function(index){
		$(this).removeClass("Selected");
		this.disabled=false;
	})
	$(ts).addClass("Selected");
	ts.disabled=true;
	var id=$(ts).data("id");
	layer.load(1, {
	  shade: [0.1,'#fff']
	});
	$.get(finder_url,'app='+$(ts).data("app")+'&finder='+$(ts).data("finder")+'&func='+$(ts).data("func")+'&id='+id,function(data){
		layer.closeAll();
		console.log($(ts).parent().parent().parent());
		$(ts).parent().parent().parent().find('.finder_body').html(data);
	});
}
function finder_unfold(ts){
	if(ts.innerHTML!=''){
		ts.innerHTML='';
		$('.phtml_tr').each(function(i){
			if($(this).data("id")==$(ts).data("id")){
				$(this).remove();
			}
		})
		return false;
	}
	var innerHTML1=ts.innerHTML;
	ts.innerHTML=' ';
	var id=$(ts).data("id");
	var url=$(ts).data("url");
	var phtml=$(ts).parent().parent();
	var finder_path=$(ts).data("finder_path");
	var html='<tr class="phtml_tr" data-id="'+$(ts).data("id")+'"><td colspan="'+$(ts).parent().parent().find("td").length+'">';
	if(innerHTML1==''){
		$.get(url,"id="+id+'&finder_path='+finder_path,function(data){
			if(data!=false&&data!='NaN'){
				html+=data+'</td></tr>';
				phtml.after(html); 
			}					
		});
	}
	
	return false;
}

/*
 * js  滚动条 距离顶部的位置  当前滚动条距离和 当前标签位置相等的 时候 标签置顶
window.parent.onscroll = function(){
                var product_section=parent.document.getElementsByClassName("product-tags")[0];
                var aaa=$(product_section).offset().top;
                var bb=$(window.parent).scrollTop();
                console.log(aaa);
                console.log(bb);
                if(bb+100>=aaa){
                    //该置顶了
                }
            }
 * */

