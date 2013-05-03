<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php if (is_home()||is_search()||is_tag()||is_page()||is_404()){
$u_description = get_option('bzd_description');$u_keywords = get_option('bzd_keywords');
$keywords = $u_keywords;
$description = $u_description;
} 
elseif (is_category()){
$keywords = single_cat_title('', false);
$description = get_bloginfo('name') . " - 有关'" . single_cat_title('', false) . "'的文章";
}
elseif (is_single()){
if ($post->post_excerpt) {
	$description = $post->post_excerpt;
} else {
	$description = mb_strimwidth(strip_tags($post->post_content),0,200);
}
$keywords = "";
$tags = wp_get_post_tags($post->ID);
foreach ($tags as $tag ) {
	$keywords = $keywords . $tag->name . ", ";
}}
else {
$keywords = trim( wp_title('', false) );
$description = get_bloginfo('name') . " " . trim( wp_title('', false) );
}
?>
<meta name="description" content="<?php echo $description?>" />
<meta name="keywords" content="<?php echo $keywords?>" />
<title><?php wp_title(' - ', true, 'right'); bloginfo('name'); if (!is_single () && !is_404()) echo " - ", bloginfo('description'); if ($paged > 1) echo ' - Page ', $paged; ?></title>
<link rel="shorcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-ico" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/bzd.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery.orbit-1.2.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/scripts/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript">
    $(function() {
        $(".entry a:has(img)").lightBox({
        imageBlank:"<?php bloginfo( 'template_url' ); ?>/images/lightbox-blank.gif",
        imageLoading:"<?php bloginfo( 'template_url' ); ?>/images/lightbox-ico-loading.gif",
        imageBtnClose:"<?php bloginfo( 'template_url' ); ?>/images/lightbox-btn-close.gif",
        imageBtnPrev:"<?php bloginfo( 'template_url' ); ?>/images/lightbox-btn-prev.gif",
        imageBtnNext:"<?php bloginfo( 'template_url' ); ?>/images/lightbox-btn-next.gif"    
        });
    });
</script>
<?php wp_head(); ?>
</head>
<body>
<div id="top">
	<div id="top-bar">
		<div id="top-bar-middle">
			<?php
			$bzd_rss=get_option('bzd_rss');
			?>
			
			<div class="top-btn"><a href="http://lazynight.me/about">关于</a></div>
			<div class="top-btn"><a href="<?php echo $bzd_rss?>">订阅</a></div>	
			
			<div class="top-btn" id="search">
				<?php get_search_form(); ?>
			</div>
				
			
			
			
			<div class="top-lbtn">
				<a href="<?php bloginfo('url'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png"></a>
			</div>
			<div class="top-lbtn"><script type="text/javascript">eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('6(2.0){2.0=7(2.0)+1;5.4("欢迎您第 <3>"+2.0+"</3> 次回访本站.")}8{2.0=1;5.4("欢迎您的初访，新朋友。")}',9,9,'pagecount||localStorage|span|write|document|if|Number|else'.split('|'),0,{}));</script> 
			</div>
			<div class="top-lbtn">
				<a href="http://weibo.com/u/1959230741" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/sina.png"></a>
			</div>
			<div class="top-lbtn">
				<a href="http://www.songtaste.com/user/1201428/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/st.png"></a>
			</div>
		</div>
	</div>
	<div id="nav">
	
			<ul class="header_nav">
				<li <?php if (is_home()) echo 'class="current_page_item"'; ?>><a href="<?php echo get_option('home'); ?>/" title="<?php _e('Home'); ?>"><?php _e('Home'); ?></a></li>
				<?php wp_list_categories('orderby=name&title_li=<a href="javascript:void(0);">文章分类</a>'); wp_list_pages('title_li='); ?> 
				<li><a href="http://lazynight.me/tools/UP.htm" target="_blank">工具箱</a></li>
			</ul>
			<p id="des">夜阑，声如窃，独难解。</p>
			<span id="z"><img src="<?php bloginfo('template_url'); ?>/images/ava.jpg"></span>
	</div>
</div>
