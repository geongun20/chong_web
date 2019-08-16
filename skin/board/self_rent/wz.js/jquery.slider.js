$.proc={};

$.proc['top.popup']=function(o){
    this.platform	=o;
    this.button		=o.find('span.btn_control a[ntt]');
    this.cookie		=o.find('p.popup_close a');
    this.layer		=o.find('ul.popup_list li');
    this.param		={index : 1000, status : false, time : 5000, size : this.button.size(), pause : false}
    this.play		=o.find('a[play]');
    this.pause		=o.find('a[pause]');
    this.open		=$('a.popbutton');
    this.setting();
}

$.extend($.proc['top.popup'].prototype, {
    setting : function(){
        var na=this;

        na.platform.hover(function(){ na.param.pause=true }, function(){ na.param.pause=false })

        na.cookie.one('click', function(){
            na.platform.slideUp();
            cookie.set('toppop', 1, 86400);
        })

        na.button.on('click', function(){
            na.motion(this.getAttribute('ntt'));
        })

        na.play.on('click', function(){
            na.param.status=true;
        })

        na.pause.on('click', function(){
            na.param.status=false;
        })

        na.open.on('click', function(){
            if(na.platform.is(':hidden')){
                na.param.status=true;
                na.platform.slideDown();
                na.button.eq(0).trigger('click');

                $(this).find('img').attr('src', '../images/btn/btn_popup_close.gif');
            }else{
                na.param.status=false;
                na.platform.slideUp();
                $(this).find('img').attr('src', '../images/btn/btn_popup_open.gif');
            }
        })

        if(na.button.size() > 0){
            $.window.setInterval(function(){ na.timeout() }, na.param.time);
            if(!cookie.get('toppop')){
                na.open.click();
            }
        }
    },
    motion : function(ntt){
        var na=this;

        if(parseInt(ntt) != na.param.index){
            na.button.eq(na.param.index).find('img').attr('src' , '../images/btn/number_off.png');
            na.button.eq(ntt).find('img').attr('src', '../images/btn/number_on.png');
            na.layer.eq(na.param.index).hide();
            na.layer.eq(ntt).fadeIn();
            na.param.index=ntt;	
        }
    },
    timeout : function(){
        var na=this;
        if(na.param.status && !na.param.pause){
            na.motion((na.param.index+1) % na.param.size)
        }
    }

});

/*calendar
*/
$.proc['month']=function(o){
		this.platform	=o;
		this.rows		=this.platform.find('tbody >tr');
		this.width		=this.rows.find('td').outerWidth();
		this.setting();
}

$.extend($.proc['month'].prototype, {
		setting : function(){
				var na=this;

				na.rows.each(function(){
						var row=$(this).find('span.import');

						row.css({'width' : row.width(), 'position' : 'absolute'});
						row.each(function(){
								na.sort($(this), row);
						})						
				})
		},
		sort : function(span, row){
				var na		=this;
				var offset	=span.position();
				var w			=parseInt(span.attr('w'));
				var t			=parseInt(span.attr('t'));
				var width	=(span.width() * w) + ((na.width-span.width()) * (w-1))
				var left		=offset.left;
				var top		=(!t)? offset.top+6 : row.eq(t-1).position().top+row.eq(t-1).height()+8;
				var height	=(!t)? 70 : span.parent('td').height();

				span.css({'width' : width, 'top' : top , 'left' : left});
				span.parent('td').height(height +span.height()+8);
		}
});

jQuery(document).ready(function () {
    new $.proc['top.popup']($('div#page_popup'));
});