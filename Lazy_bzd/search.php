<?php get_header();?>
<div id="container">
<div id="navigator">
	<span id="random">
		<?php $rand_posts = get_posts('numberposts=5&orderby=rand');  foreach( $rand_posts as $post ) : ?>
			<?php endforeach; ?><a href="<?php the_permalink(); ?>">手气</a>
	</span>
		<ul class="trail">
			<img src="<?php bloginfo('template_url'); ?>/images/arrow.png"/>您的位置&gt;<li><a href="<?php bloginfo('url'); ?>/" title="BZD" rel="homepage">首页&gt;</a></li>
			<li><?php the_category( '&gt;</li><li>', 'multiple'); ?>&gt;</li> 
			
		</ul>
		
	</div>
	<div id="left-sidebar">
		<div id="nav">
			
				<?php wp_nav_menu( array('theme_location' => 'header_nav','menu_id'=>'nav','container'=>'ul') ); ?>
			
		</div>
		<div class="lwidget">
			<h3><img src="<?php bloginfo('template_url'); ?>/images/postcomments.png"/>&nbsp;最新评论</h3>
			<ul>
			<?php //Recent Comments by zwwooooo
			$show_comments = 15;
			$my_email = get_bloginfo ('admin_email');
			$i = 1;
			$comments = get_comments('number=100&status=approve&type=comment');
			foreach ($comments as $rc_comment) {
				if ($rc_comment->comment_author_email != $my_email) {
					?>
					<li>
						<img src="<?php bloginfo('template_url'); ?>/images/postbullets.png"/>&nbsp;
						<span class="rc_author"><?php echo $rc_comment->comment_author; ?>: </span>
						<?php // echo my_avatar($rc_comment->comment_author_email,40,'',$rc_comment->comment_author); ?>
						<a href="<?php echo get_comment_link( $rc_comment->comment_ID, array('type' => 'comment')); ?>" title="on <?php echo get_the_title($rc_comment->comment_post_ID); ?>"><?php echo convert_smilies(strip_tags($rc_comment->comment_content)); ?></a>
					</li>
					<?php
					if ($i == $show_comments) break;
					$i++;
				}
			}
			?>
		</ul>
		</div>
		
	</div>
	<div id="content">
		<?php while (have_posts()) : the_post(); ?>
		
		<div class="post">
		
			<span class="more-comment">
				<?php comments_number('0','1','%'); ?>
			</span>
			<h3>
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
			<div class="thumb">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php post_thumbnail( 110,110 ); ?></a>
			</div>
			<div class="post-content">
				<?php the_excerpt();?>
			</div >
			<div class="details">
				
			</div>
		
		</div>
			
		<?php endwhile;?>
		
		 <?php if (have_posts()) : else:?>
		 
		<div class="content">
		<div class="post"><h3>温馨提示</h3>
		
		<h6>抱歉，没有符合条件的内容。请使用搜索功能查找其他相关的关键词。</h6>
		</div>
		</div>
		<?php endif;?>
		<div class="pagenavi"><?php pagenavi(); ?></div>
	</div>
<?php get_sidebar();?>
<?php get_footer();?>

