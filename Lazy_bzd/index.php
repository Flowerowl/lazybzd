<?php get_header();?>
<div id="container">
	<div id="navigator">
	<span id="random">
		<?php $rand_posts = get_posts('numberposts=5&orderby=rand');  foreach( $rand_posts as $post ) : ?>
			<?php endforeach; ?><a href="<?php the_permalink(); ?>">手气</a>
	</span>
		
		
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
		<div id="pic">
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/orbit-1.2.3.css">
			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.5.1.min.js"></script>
			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery.orbit-1.2.3.min.js"></script>
			<script type="text/javascript">
			$(window).load(function() {
			$('#featured').orbit();
			});
			</script>
			<div id="featured">
			<a href="http://lazynight.me/61.html"><img src="<?php bloginfo('template_url'); ?>/images/1.jpg"  /></a>
			<a href="http://lazynight.me/147.html"><img src="<?php bloginfo('template_url'); ?>/images/2.jpg"  /></a>
			<a href="http://lazynight.me/1132.html"><img src="<?php bloginfo('template_url'); ?>/images/3.jpg"  /></a>
			</div>
		</div>
		<div id="hot">
			<small><img src="<?php bloginfo('template_url'); ?>/images/posttagicon.png"/>&nbsp;热门标签:&nbsp;</small><?php wp_tag_cloud('smallest=10&largest=10&unit=px&number=10&orderby=count&order=RAND'); ?>
		</div>
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
			
		
		</div>
		<?php endwhile; ?>
		
	<div class="pagenavi"><?php pagenavi(); ?></div>		
	</div>
	
	<?php get_sidebar();?>
	<?php get_footer();?>
