(function($) {
	var menu, shadow, trigger, content, hash, currentTarget;
	var defaults = {
		menuStyle : {
			listStyle : 'none',
			padding : '1px',
			margin : '0px',
			backgroundColor : '#fff',
			border : '1px solid #999',
			width : '100px',
			float:'left'
		},
		itemStyle : {
			margin : '0px',
			color : '#000',
			display : 'block',
			cursor : 'default',
			padding : '3px',
			border : '1px solid #fff',
			backgroundColor : 'transparent'
		},
		itemHoverStyle : {
			border : '1px solid #0a246a',
			backgroundColor : '#b6bdd2'
		},
		itemFalseStyle :{
			color : '#ccc'
		},
		eventPosX : 'pageX',
		eventPosY : 'pageY',
		shadow : true,
		onContextMenu : null,
		onShowMenu : null
	};
	$.fn.contextMenu = function(o,id, options,noevent) {
		var clickFlag=false;
		if(!options.bindings) return $(o);
		options.clickFlag?clickFlag=options.clickFlag:clickFlag=false;
		if (!menu) {
			menu = $('<div id="jqContextMenu"></div>').hide().css({
				position : 'absolute',
				zIndex : '500'
			}).appendTo('body').bind('click', function(e) {
				e.stopPropagation();
			});
		}
		if (!shadow) {
			shadow = $('<div></div>').css({
				backgroundColor : '#000',
				position : 'absolute',
				opacity : 0.2,
				zIndex : 499
			}).appendTo('body').hide()
		}
		hash = hash || [];
		hash.push({
			id : id,
			menuStyle : $.extend({}, defaults.menuStyle, options.menuStyle
			|| {}),
			itemStyle : $.extend({}, defaults.itemStyle, options.itemStyle
			|| {}),
			itemHoverStyle : $.extend({}, defaults.itemHoverStyle,
			options.itemHoverStyle || {}),
			itemFalseStyle : $.extend({}, defaults.itemFalseStyle,
			options.itemFalseStyle || {}),
			bindings : options.bindings || {},
			shadow : options.shadow || options.shadow === false
			? options.shadow
			: defaults.shadow,
			onContextMenu : options.onContextMenu || defaults.onContextMenu,
			onShowMenu : options.onShowMenu || defaults.onShowMenu,
			eventPosX : options.eventPosX || defaults.eventPosX,
			eventPosY : options.eventPosY || defaults.eventPosY
		});

		var index = hash.length - 1;
		$(this).bind('contextmenu', function(e) {
			if(!clickFlag) $(o).click();
			var bShowContext = (!!hash[index].onContextMenu) ? hash[index]
			.onContextMenu(e) : true;
			if (bShowContext)
			display($(o),index, this, e, options);
			return false
		});
		return this
	};
	function display(o,index, trigger, e, options) {
		menu.html('');
		var cur = hash[index];
		if (!!cur.onShowMenu)
		menu = cur.onShowMenu(e, menu);
		menus(o,cur,cur.bindings,trigger);
		menu.css({
		'left' : e[cur.eventPosX],
		'top' : e[cur.eventPosY]
		}).show();
		if (cur.shadow)
		shadow.css({
			width : menu.width(),
			height : menu.height(),
			left : e.pageX + 2,
			top : e.pageY + 2
		}).show();
		$(document).one('click', hide)
	}
	function menus(o,cur,bindings,trigger,po){
		content = $('<ul/>').css(cur.menuStyle);
		if(po){
			content.css({'margin-top':$(po).offset().top-$('#jqContextMenu').offset().top});
		}
		$.each(bindings, function(id, v) {
			var is_my=($(o).attr('ismy')=='1'||v.ismy)?1:0;
			$('<li/>').html(v.val).css(cur.itemStyle).css(!is_my&&cur.itemFalseStyle).hover(
			function(){
				is_my&&$(this).css(cur.itemHoverStyle);
				$(this).parent().nextAll().remove();
				(is_my&&v.nt)&&menus(o,cur,v.nt,trigger,this);
			},function(){
				is_my&&$(this).css(cur.itemStyle);
			}).click(function(){
				hide();
				(!v.nt&&is_my)&&v.cb(trigger, currentTarget);
			}).appendTo(content).find('img').css({
				verticalAlign : 'middle',
				paddingRight : '2px'
			});
		});
		menu.append(content);
	}
	function hide() {
		menu.hide();
		shadow.hide()
	}
	$.contextMenu = {
		defaults : function(userDefaults) {
			$.each(userDefaults, function(i, val) {
				if (typeof val == 'object' && defaults[i]) {
					$.extend(defaults[i], val)
				} else
				defaults[i] = val
			})
		}
	}
})(jQuery);