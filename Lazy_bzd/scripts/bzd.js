
 var timoutid;
 
 jQuery(document).ready(function($) {
		$('.sub-menu').hide();
		
		
        $('#nav li').hover(function() {
            $('ul', this).slideDown(100)
        },
        function() {
            $('ul', this).slideUp(100)
        });
		$('#backtop').click(function(){$('html,body').animate({scrollTop: '0px'}, 500);});
		
		
		$(document).mousemove(function(e){
		$(".post").addClass('jqborder');
		});
		$("#tabfirst li").each(function(index){
		$(this).mouseover(function(){	
			var liNode = $(this);
			timoutid = setTimeout(function(){
				$("div.contentin").removeClass("contentin");
				
				$("#tabfirst li.tabin").removeClass("tabin");
				
				$("div.contentfirst:eq(" + index + ")").addClass("contentin");
				liNode.addClass("tabin");	
			},300);			
		}).mouseout(function(){
			clearTimeout(timoutid);	
		});
	});
    });

var $body = window.opera ? document.compatMode == "CSS1Compat" ? jQuery("html") : jQuery("body") : jQuery("html,body");
jQuery(document).ajaxStop(jQuery.unblockUI);
var css = 'p{word-wrap: break-word;}table {border-collapse:collapse;border-spacing:0;}.railscasts ::selection, .railscasts .codecolorer ::selection { background:#adb9d2; }.railscasts ::-moz-selection, .railscasts .codecolorer ::-moz-selection { background:#566381; }';
function css3(b) {
    css += '{-moz-' + b + '-webkit-' + b + '-o-' + b + '-khtml-' + b + b + '}\n'
}
if (!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version >= 9)) {
    
    css += '.header_nav li li a,.header_nav li li a:hover,.header_nav li li:hover>a,.header_nav li li.hover>a{background:rgba(222,222,222,0.6);}\n';
    css += '.header_nav:hover{background:rgba(0,0,0,0.88);}header #description{background:rgba(0,0,0,0.88);}\n';
    css += '.header_nav,.header_nav li li a:hover,.header_nav li li:hover>a,.header_nav li li.hover>a{background:rgba(0,0,0,0.75);}\n';
};
css += 'header h1 a *,.avatar,a';
	css3('transition:all 0.3s ease-in-out;');
css += '#comments .comment-body:hover .commentmeta img,#comments .comment-author img';
	css3('transform:rotate(720deg);');
css += '.header_nav>li>a';
	css3('transform: rotate(-40deg);');
css += '.header_nav li li a:hover,.header_nav li li:hover>a,.header_nav li li.hover>a';
	css3('transform:scale(1.15);');
css += '#s,.header_nav li li a:hover,.header_nav li li:hover>a,.header_nav li li.hover>a,input[type=text],input[type=submit],textarea,.avatar';
	css3('border-radius:5px;');
css += '#description';
	css3('border-radius:10px;');
css += '#description';
	css3('box-shadow:5px 5px 5px #555;');
css += '.post_content h2 span';
	css3('border-radius:15px;');
css += '.post_content h2 span';
	css3('box-shadow: 0 1px 1px #555555 inset, 0 1px 0 gray;');
	
document.write('<style type="text\/css">' + css + '<\/style><div id="sweet_title" style="display:none;"><\/div>');

jQuery(document).ready(function(w){
	w('a,input[type="submit"],button[type="button"],object').bind('focus', function() {if (this.blur) {this.blur();}});
    if (w.browser.mozilla) {$body.bind("DOMMouseScroll",function() {$body.stop();})} else {$body.bind("mousewheel", function() {$body.stop();})};
    w('.header_nav li').live('mouseover', function() {w(this).addClass('hover');});
    w('.header_nav li').live('mouseout', function() {w(this).removeClass('hover');});
    
    if (!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version >= 9)) {
        w('#sweet_title').css({'position': 'fixed'});
        w('a,img').live('mouseover',function(){
	    	var tmp_title='';
	    	if(w(this).attr('title')!=undefined&&w(this).attr('title')!='')
	    	{	
	    		tmp_title=w(this).attr('title');
	    		w(this).attr('title','');
	    		w('#sweet_title').html(tmp_title).fadeIn(0);
	    	}
	    });
	    w('a,img').live('mouseout',function(){w(this).attr('title',w('#sweet_title').html());w('#sweet_title').fadeOut(0,function(){w('#sweet_title').html('');});});
    } 
    
    w('a').live('click', function() {
        var $pjax_url = w(this).attr('href').replace('&pjax=true', '').replace('?pjax=true', '');
        var $pjax_alt = w(this).html();
        if (w(this).hasClass('comment-edit-link') || w(this).hasClass('comment-reply-link') || w(this).hasClass('smiley') || w(this).attr('id') == 'cancel-comment-reply-link') {
            return true;
        }
        if (w(this).attr('target') == '_blank' || $pjax_url.indexOf(base) == -1 || $pjax_url.indexOf('.png') != -1 || $pjax_url.indexOf('.gif') != -1 || $pjax_url.indexOf('.jpg') != -1 || $pjax_url.indexOf('.bmp') != -1 || $pjax_url.indexOf('.zip') != -1 || $pjax_url.indexOf('.rar') != -1 || $pjax_url.indexOf('.7z') != -1) {
            window.open($pjax_url);
            return false;
        }
        do_pjax($pjax_url, $pjax_alt);
        return false;
    });
    w('#searchform').live('submit',function() {
        do_pjax(base + '?s=' + w('#s').val(), w('#s').val());
        return false;
    });
});

