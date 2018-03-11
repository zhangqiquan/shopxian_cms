
jQuery.fn.extend({
  showTree:function(opt){
  	opt=opt||{};
  	var showDataObj=$(this).prev();
  	var fn,bindings,title,callbackAny,inputFlag;
  	var _self=this;
  	var dataList=opt.data||{};
  	opt.callback?fn=opt.callback:fn=function(t,o){
  		showDataObj.val($(t).html());
  		$.rmwin();
  	};
  	opt.bindings?bindings=opt.bindings:null;
  	opt.callbackAny?callbackAny=opt.callbackAny:callbackAny=false;
  	opt.inputFlag?inputFlag=opt.inputFlag:inputFlag=false;
  	opt.title?title=opt.title:title='选择分类';
  	var width=opt.width||210;
  	var height=opt.height||460;
  	var funcBefore=opt.before||function(){};
  	if(opt.alert=='alert'){
    	$(this).click(function(){
				var html='<div  style="height:450px;width:200px;overflow:auto"><ul class="treeview filetree" id="showTreeSelectParent">';
				$.each(dataList,function(i,n){
					if(n.parent_id==0){
						html+='<li class="expandable"><div class="hitarea"></div><span class="folder" val="'+n.id+'" loaded="false">'+n.name+'</span><span><a onclick="alert_iframe(this,1);" data-url="'+edit_url+'?id='+n.id+'" data-height="50%" data-width="50%" href="javascript:void(0);" >编辑</a> | <a  onclick="del_row(this);" data-url="'+del_url+'?id='+n.id+'" data-height="50%" data-width="50%" href="javascript:void(0);"  >删除</a></span></li>';
					}
				});
				html+='</ul></div>';
				html=$(html);
				var win=$.win({title:title,html:html,width:width,height:height});
				initTree($('#showTreeSelectParent'));
				funcBefore(html);
			});
		}
		else{
			$.each(dataList,function(i,n){
				if(n.parent_id==0){
					$(_self).append('<li class="expandable"><div class="hitarea"></div><span class="folder" val="'+n.id+'" loaded="false">'+n.name+'</span><span><a onclick="alert_iframe(this);"  data-url="'+edit_url+'?id='+n.id+'" data-height="50%" data-width="50%" href="javascript:void(0);" >编辑</a> | <a onclick="del_row(this);" data-url="'+del_url+'?id='+n.id+'" data-height="50%" data-width="50%" href="javascript:void(0);"  >删除</a></span></li>');
				}
			});
			initTree($(_self));
		}
		if(!inputFlag){
	  	showDataObj.focus(function(){
	  		$(this).next().click();
	  	});
  	}
  	function initTree(t){
			t.find('span[loaded=false]').each(function(){
				if(bindings){
					$(this).unbind('contextmenu').contextMenu(this,'myTreeMenuGroup',{
						bindings:bindings,
						clickFlag:true
					});
				}
				
				var id=$(this).attr('val');
				var flag=false;
				//判断是不是有子元素
				$.each(dataList,function(i,n){
					if(n.parent_id==id){
						flag=true;
						return false;
					}
				});
				//没有子元素
				if(!flag){
					$(this).unbind('click').bind('click',function(){
						fn(this,_self);
					}).attr('loaded','true').removeClass('folder').addClass('file');
					if($(this).parent().next().html()){
						$(this).parent().removeClass();
					}
					else{
						$(this).parent().removeClass().addClass('last');
					}
					return true;
				}
				
				$(this).bind('click',this,addChindList).toggle(function(){
					var o=$(this).parent();
					o.find('>ul').show();
					if(o.hasClass('lastExpandable')){
						o.addClass('lastCollapsable').removeClass('lastExpandable');
					}
					else{
						o.addClass('collapsable').removeClass('expandable');
					}
					o.siblings().each(function(){
						if($(this).hasClass('collapsable')||$(this).hasClass('lastCollapsable')){
							$(this).find('>span:first').click();
						}
					});
				},function(){
					var o=$(this).parent();
					o.find('>ul').hide();
					if(o.hasClass('lastCollapsable')){
						o.addClass('lastExpandable').removeClass('lastCollapsable');
					}
					else{
						o.addClass('expandable').removeClass('collapsable');
					}
				});
				$(this).prev().bind('click',function(){
					$(this).next().click();
				});
			});
			var o=t.find('>ul >li:last');
			(o.html()==null)?o=t.find('>li:last'):null;
			if(o.hasClass('expandable')){
				o.addClass('lastExpandable').removeClass('expandable');
			}
			else{
				o.addClass('lastCollapsable').removeClass('collapsable');
			}
			t.find('.last').removeClass().addClass('last');
		}
		function addChindList(evt){
			if(callbackAny) {
				fn(evt.data,_self);
			}
			var id=$(evt.data).attr('val');
			var str='';
			$.each(dataList,function(i,n){
				if(n.parent_id==id){
					str+='<li class="expandable"><div class="hitarea"></div><span class="folder" val="'+n.id+'" loaded="false">'+n.name+'</span><span><a onclick="alert_iframe(this);"  data-url="'+edit_url+'?id='+n.id+'" data-height="50%" data-width="50%" href="javascript:void(0);" >编辑</a> | <a  onclick="del_row(this);" data-url="'+del_url+'?id='+n.id+'" data-height="50%" data-width="50%" href="javascript:void(0);"  >删除</a></span></li>';
				}
			});
			if(str){
				$(evt.data).parent().append('<ul>'+str+'</ul>');
			}
			$(evt.data).attr('loaded','true');
			$(evt.data).unbind('click',addChindList);
			initTree($(evt.data).parent());
		}	
  }
});
