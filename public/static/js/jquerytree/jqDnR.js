// Download by http://www.mb5u.com
(function($){
    $.fn.jqDrag = function(h,bf,ed){
        return i(this, h, 'd',bf,ed);
    };
    $.fn.jqResize = function(h,bf,ed){
        return i(this, h, 'r',bf,ed);
    };
    $.jqDnR = {
        dnr: {},
        e: 0,
				ed:function(){},
        drag: function(v){
        	var p = {};
        	if(E.css('visibility')=='hidden'){
        		E.css('visibility','visible');
        	}
          if (M.k == 'd') {
              var l = M.X + v.pageX - M.pX;
              var t = M.Y + v.pageY - M.pY;
              if (l < 0) {
                  l = 0;
              }
              else 
                  if (l > (B.W - M.W)) {
                      l = B.W - M.W;
                  }
              if (t < 0) {
                  t = 0;
              }
              else 
                  if (t > (B.H - M.H)) {
                      t = B.H - M.H;
                  }
              E.css({
                  left: l,
                  top: t
              });
          }
          else {
              E.css({
                  width: Math.max(v.pageX - M.pX + M.W, 0),
                  height: Math.max(v.pageY - M.pY + M.H, 0)
              });
          }
            return false;
        },
        stop: function(){
					ED(dt);
					if (M.k == 'd') {
			      dt.css({
							opacity: M.o,
							top:E.offset().top,
							left:E.offset().left
						});
					}
					else{
						dt.css({
              width: E.width(),
              height: E.height()
            });
					}
					E.remove();
		      $().unbind('mousemove', J.drag).unbind('mouseup', J.stop);
		     }
    };
    var B = {
        W: $(window).width(),
        H: $(window).height()
    };
    var J = $.jqDnR;
		var M = J.dnr;
		var E;
		var dt;
		var ED= J.ed;
		
		
		var i = function(e, h, k,bf,ed){
			if(bf==undefined){
				bf=function(){};
			}
			if(ed==undefined){
				ed=function(){};
			}
			ED = ed;
      return e.each(function(){
          h = (h) ? $(h,e) : e;
          h.bind('mousedown', {
              e: e,
              k: k
          }, function(v){
              var d = v.data,p={};
              dt = d.e;
							bf(dt);
							E=$('<div id="drag_div"></div>').appendTo(document.body)
							.css({
								position:'absolute',
								top:dt.offset().top+'px',
								left:dt.offset().left+'px',
								width:dt.width()+'px',
								height:dt.height()+'px',
								border:'#DDD 3px solid',
								opacity: 1,
								visibility:'hidden'
							});
							if (E.css('position') != 'relative') {
	              try {
	                  E.position(p);
	              } 
	              catch (e) {
	              }
	            }
	            M = {
	                X: p.left || f('left') || 0,
	                Y: p.top || f('top') || 0,
	                W: f('width') || E[0].scrollWidth || 0,
	                H: f('height') || E[0].scrollHeight || 0,
	                pX: v.pageX,
	                pY: v.pageY,
	                k: d.k,
	                o: E.css('opacity')
	            };
              $().mousemove($.jqDnR.drag).mouseup($.jqDnR.stop);
              return false;
          });
      });
	  }
	var f = function(k){
        return parseInt(E.css(k)) || false;
  };
})(jQuery);
