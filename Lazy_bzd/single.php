<?php get_header();?>
<div id="container">

	<div id="navigator">
	<span id="random">
		<?php $rand_posts = get_posts('numberposts=5&orderby=rand');  foreach( $rand_posts as $post ) : ?>
			<?php endforeach; ?><a href="<?php the_permalink(); ?>">手气</a>
</span>
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
			<div id="share">
			<!-- JiaThis Button BEGIN -->
<div id="jiathis_style_32x32">
	<a class="jiathis_button_qzone"></a>
	<a class="jiathis_button_tsina"></a>
	<a class="jiathis_button_tqq"></a>
	<a class="jiathis_button_renren"></a>
	<a class="jiathis_button_kaixin001"></a>
	<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
	<a class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
		</div>
		<div class="alignleft">
			<?php previous_post_link(__('前一篇： %link   ','we')); ?>
		</div>
		<div class="alignright">
			<?php next_post_link(__('后一篇： %link ','we')); ?>
		</div>
		<div id="other">
		<ul>
		<li>更新日期：<?php the_time('y-m-d') ?></li>
		<li>本文标签：<?php if(get_the_tags())the_tags('');
				else echo '还没有标签呢'; ?></li>
		<li>本文分类：<?php the_category( '&gt;</li><li>', 'multiple'); ?></li>
		<li>围观次数：<?php if(function_exists('the_views')) { print the_views(); } ?>
</li>
		<li>文章链接：<a href=<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_permalink(); ?></a>【转载请注明文章来源】</li>
		</ul>
		
		</div>
			<div class="querypost">
				<div class="querypost-left">
				<h3>相关文章</h3>
					<ul>
					<?php
					$post_num = 5; 
					
					$posttags = get_the_tags(); $i = 0;
					if ( $posttags ) { $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
					$args = array(
						'post_status' => 'publish',
						'tag_slug__in' => explode(',', $tags), 
						'post__not_in' => explode(',', $exclude_id), 
						'caller_get_posts' => 1,  
						'orderby' => 'comment_date', 
						'posts_per_page' => $post_num
					);
					query_posts($args); 
					while( have_posts() ) { the_post(); ?>
						<li><img src="<?php bloginfo('template_url'); ?>/images/postheadericon.png"/>&nbsp; <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php
						$exclude_id .= ',' . $post->ID; $i ++;
					} wp_reset_query();
					}
					if ( $i < $post_num ) { 
					$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
					$args = array(
						'category__in' => explode(',', $cats), 
						'post__not_in' => explode(',', $exclude_id),
						'caller_get_posts' => 1,
						'orderby' => 'comment_date',
						'posts_per_page' => $post_num - $i
					);
					query_posts($args);
					while( have_posts() ) { the_post(); ?>
						<li><img src="<?php bloginfo('template_url'); ?>/images/postheadericon.png"/>&nbsp; <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php
						$i ++;
					} wp_reset_query();
					}
					if ( $i  == 0 )  echo '<li>&#9829; 暂无相关文章</li>';
					?>
					</ul>
				</div>
				<div class="querypost-right">
				<h3>热门文章</h3>
					<ul>
					<?php
					$post_num = 5; 
					$exclude_id = $post->ID;
					$myposts = $wpdb->get_results("
					SELECT ID, post_title FROM $wpdb->posts
					WHERE ID != $exclude_id
					AND post_status = 'publish'
					AND post_type = 'post'
					ORDER BY comment_count
					DESC LIMIT $post_num
					"); 
					foreach($myposts as $mypost) { ?>
						<li><img src="<?php bloginfo('template_url'); ?>/images/postheadericon.png"/>&nbsp; <a href="<?php echo get_permalink($mypost->ID); ?>"><?php echo $mypost->post_title; ?></a></li>
					<?php
					$exclude_id .= ',' . $post->ID; 
					}
					?>
					</ul>
					</div>
			
				</div>
		
		<?php endwhile; ?>
		<div id="comments">
			<?php comments_template(); ?>
		</div>
		
	</div>
	
	<?php get_sidebar();?>
	<?php get_footer();?>
