<?php get_header();?>
<div id="container">
	<div id="navigator">
		<ul class="trail">
			<li>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
					<?php /* If this is a category */ if (is_category()) { ?>
				<h4 class="query-info">分类：<?php single_cat_title(); ?></h4>
				<?php /* If this is a tag */ } elseif( is_tag() ) { ?>
				<h4 class="query-info">标签：<?php single_tag_title(); ?> </h4>
				<?php /* If this is a daily */ } elseif (is_day()) { ?>
				<h4 class="query-info">归档： <?php the_time('Y年 m月 j日'); ?> </h4>
				<?php /* If this is a monthly */ } elseif (is_month()) { ?>
				<h4 class="query-info">归档： <?php the_time('Y年 m月'); ?> </h4>
				<?php /* If this is a yearly */ } elseif (is_year()) { ?>
				<h4 class="query-info">归档： <?php the_time('Y年'); ?> </h4>
				<?php /* If this is a paged */ } elseif (isset($_GET['paged']) && !empty($_GET['paged']) && !is_search()) { ?>
				<h4 class="query-info">您正在浏览的是以前的文章</h4>
				<?php } ?>
			</li>
			
		</ul>
	</div>
	<div id="left-sidebar">
		
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
		<div class="lwidget">
		<h3><img src="<?php bloginfo('template_url'); ?>/images/postcomments.png"/>&nbsp;归档</h3>
		<?php wp_get_archives(); ?>
		</div>
	</div>
	<div id="content">
		
		
		<?php while (have_posts()) : the_post(); ?>
		<div class="post">
			<span class="more-comment">
				<?php comments_number('+0','+1','+%'); ?>
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
		<?php endwhile; ?>
		
	<div class="pagenavi"><?php pagenavi(); ?></div>		
	</div>
	
	<?php get_sidebar();?>
	<?php get_footer();?>
