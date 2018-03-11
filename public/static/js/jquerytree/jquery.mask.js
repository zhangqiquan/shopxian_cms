// Download by http://www.mb5u.com
(function(){
	$.fn.mask = function(msg,msgCls,maskCls){
		var mask;
		if(!$(this).hasClass('masked')){
			$(this).addClass('masked');			
		}
		if(typeof maskCls!='object'){
			maskCls={};
		}
		if($(this).css('position'=='static')&&!$(this).is('body')){
			$(this).css('position','relative');
		}
		mask = $('<div class="mask"></div>');
		$(this).append(mask);
		if($.browser.msie){
			mask.width($(this).width())
			.height($(this).height());
		}
		if(typeof msg == 'string'){
			if(typeof msgCls !='object'){
				msgCls={};
			}
			$('<div class="mask-msg"><div>'+msg+'</div></div>')
			.css(msgCls).appendTo($(this)).center();
		}
		return mask.css(maskCls).show();
	}
	$.fn.rmmask = function(){
		if ($(this).hasClass('masked')) {
			$(this).children('div.mask-msg:first').remove();
			$(this).children('div.mask:first').remove();
			return $(this).css('position','static');
		}
		else{
			return $(this);
		}
	}
	$.fn.center = function(){
		var p=$(this).parent();
		if(p.is('body')){
			p=$(window);
		}
		return $(this).css({
			position:'absolute',
			top:(p.height()-$(this).height())/2.2,
			left:(p.width()-$(this).width())/2
		});		
	}
	$.fn.position = function(){
		var o=$(this).offset();
		return {
			top:o.top,
			left:o.left,
			width:$(this).width(),
			height:$(this).height()
		}
	}
	$.fn.mload = function(opt){
		var o=$(this);
		var cfg = {
			url:'',
			beforeSend:function(){},
			success:function(data){
				o.children().not('.mask,.mask-msg').remove();
				o.append('<div class="ajax-content">'+data+'</div>');
			},
			complete:function(){
				o.children('.ajax-content').show();
			},
			error:function(){},
			msg:'Loading...',
			data:'',
			type:'GET',
			msgCls:{},
			maskCls:{}
		};
		cfg=$.extend(cfg,opt);
		if(cfg.url==''){
			return o;
		}	
		return $.ajax({
			url:cfg.url,
			type:cfg.type,
			data:cfg.data,
			beforeSend:function(){
				cfg.beforeSend();
				o.mask(cfg.msg,cfg.msgCls,cfg.maskCls);
			},
			success:function(data){
				cfg.success(data,o);
			},
			complete:function(){
				o.rmmask();
				cfg.complete();				
			},
			error:function(){
				o.rmmask();
			}
		});
	}
	$.win = function(opt){		
		var cfg={
			title:'数据录入',
			url:'',
			html:'',
			button:['close','min','max'],
			icon:'i_write.gif',
			content:'This is a window!',
			maskCls:{background:'#000'},
			width:250,
			height:150,
			defaultWidth:260,
			defaultHeight:160
		}
		cfg=$.extend(cfg,opt);
		var mask,win,body,head,close,title;
		mask=$(document.body).mask(null, null, cfg.maskCls);
		win=$('<div class="win"/>');		
		if($.browser.msie&&$.browser.version=='6.0'){
			win.append('<iframe src="" frameborder="0" style="width:100%;height:100%;position:absolute;z-index:-1" />');
		}
		win.append(head=$('<div class="win-head" />')
			.append(close=$('<div class="win-top-right">关闭</div>'))
			.append(title=$('<div class="win-top-left">'+cfg.title+'</div>'))
		)
		.append(body=$('<div class="win-body">'))
		.height(cfg.height).width(cfg.width)
		.appendTo(document.body).center();
		close.click(function(){
			$.rmwin();
		});
		if (cfg.url!='') {
			body.height(cfg.height-20).mload({url:cfg.url,maskCls:{background:'#FFF'},msg:cfg.msg,complete:function(){
				var contents=body.children().eq(0);
				var w=parseInt(contents.children().eq(0).attr('w'));
				var h=parseInt(contents.children().eq(0).attr('h'));
				//定义的时候只能在页面的第一个元素
				if(isNaN(w)||isNaN(h)){
					w=cfg.defaultWidth;
					h=cfg.defaultHeight;
				}
				var top=(h-130)/2;
				var left=(w-250)/2;
				if(top>0&&left>0){
					win.animate({
						top:win.offset().top-top,
						left:win.offset().left-left,
						width:w,
						height:h+20
					},'fast',function(){
						contents.show();
					});
				}
			}});
		}
		else if(cfg.html!=''){
			body.html(cfg.html);
		}
		win.jqDrag(title);
		return {win:win,mask:mask};
	}
	$.rmwin = function(win){
		if (win == undefined) {
			$(document.body).children('.win:last').remove();
			$(document.body).children('.mask:last').remove();
		}
		else {
			win.win.remove();
			win.mask.remove();
		}
	}
	$.alertIframe = function (title,html,width,height){
		var win=$.win({title:title,html:html,width:width,height:height});
	}
	$.error = function(msg,fn){
		var html=$('<div class="alert-body" style="background:url(img/i_error.gif) no-repeat 20px center">'+msg+'</div><input type="button" class="btn-sub" value="确定" style="margin-left:135px" />');
		var win=$.win({title:'错误',html:html,width:350,height:130});
		html.eq(1).click(function(){
			$.rmwin(win);
			$(document.body).children('.mask:last').insertBefore($(document.body).children('.win:last'));
			if(fn){
				fn();
			}
		}).focus();
	}	
	$.success = function(msg,fn){
		var html=$('<div class="alert-body" style="background:url(img/i_success.gif) no-repeat 20px center">'+msg+'</div><input type="button" class="btn-sub" value="确定" style="margin-left:135px" />');
		var win=$.win({title:'成功',html:html,width:350,height:130});
		html.eq(1).click(function(){
			$.rmwin(win);
			if(fn){
				fn();
			}
		}).focus();
	}
	$.warn = function(msg,fn){
		var html=$('<div class="alert-body" style="background:url(img/i_warn.gif) no-repeat 20px center">'+msg+'</div><input type="button" class="btn-sub" value="确定" style="margin-left:135px" />');
		var win=$.win({title:'警告',html:html,width:350,height:130});
		html.eq(1).click(function(){
			$.rmwin(win);
			if(fn){
				fn();
			}
		}).focus();
	}
	$.alert = function(msg,fn){		
		var html=$('<div class="alert-body" style="background:url(img/i_info.gif) no-repeat 20px center">'+msg+'</div><input type="button" class="btn-sub" value="确定" style="margin-left:135px" />');
		var win=$.win({title:'错误',html:html,width:350,height:130});
		html.eq(1).click(function(){
			$.rmwin(win);
			if(fn){
				fn();
			}
		}).focus();
	}
	$.confirm = function(msg,yes,no){
		var html=$('<div class="alert-body" style="background:url(img/i_question.gif) no-repeat 20px center">'+msg+'</div><input type="button" class="btn-sub" value="确定" style="margin-left:90px;" /> <input type="button" class="btn-sub" value="取消" />');
		var win=$.win({title:'警告',html:html,width:350,height:130});
		html.filter('input').click(function(){
			$.rmwin(win);
			if($(this).val()=='确定'&&yes){
				yes();
			}
			else if(no){
				no();
			}
		}).focus();
	}
	$.prompt = function(msg,yes,no){
		var html=$('<div style="margin:20px"><input type="text" size="40" value="'+msg+'" /></div><input type="button" class="btn-sub" value="确定" style="margin-left:90px;" /> <input type="button" class="btn-sub" value="取消" />');
		var win=$.win({width:350,height:130,title:'请输入',html:html});
		html.filter('input[type=button]').click(function(){
			$.rmwin(win);
			if($(this).val()=='确定'&&yes){
				yes(html.find('input:first').val());
			}
			else if(no){
				no(html.find('input:first').val());
			}
		}).focus();
		
	}
})(jQuery);