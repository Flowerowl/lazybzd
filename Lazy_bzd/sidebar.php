	<div id="right-sidebar">
		<div class="widget">
			<ul id="tabfirst">
			<li class="tabin">新</li>
			<li>热</li>
			<li>随</li>
			</ul>
			<div class="contentin contentfirst">
			<?php get_posts2( $orderby = 'date', $plusmsg = 'post_date' );?></div>
			<div class="contentfirst">
			<?php get_posts2( $orderby = 'comment_count', $plusmsg = 'commentcount' );?>
			</div>
			<div class="contentfirst"><?php get_posts2( $orderby = 'rand', $plusmsg = 'post_date' );?>
			</div>
			
				
		</div>
			
		<div class="widget">
		<h3><img src="<?php bloginfo('template_url'); ?>/images/postcomments.png"/>&nbsp;日志排行</h3>	
			 <ul><?php get_most_viewed('post',10); ?></ul>
		</div>
		
		
		<?php dynamic_sidebar();//自定义侧栏?>
		
	</div>
</div>