<?php get_header();?>
<div id="container">
	<div id="navigator">
		<ul class="trail">
			您的位置&gt;<li><a href="<?php bloginfo('url'); ?>/" title="BZD" rel="homepage">首页&gt;</a></li>
			<li><?php the_category( '&gt;</li><li>', 'multiple'); ?>&gt;</li> 
			
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
	<div id="postcontent">
		<div class="postname" id="p-<?php the_ID(); ?>">
			<span class="postdetails"></span>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		
		</div>
		
		<div class="entry">
			<?php the_content(); ?>
		</div>	
	</div>
		<?php endwhile; ?>
		<div id="comments">
			<?php comments_template(); ?>
		</div>
		
	</div>
	
	<?php get_sidebar();?>
	<?php get_footer();?>
