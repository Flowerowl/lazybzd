
<div id="bottom">
<div id="footer">
	<div id="links">
	
	<h3>友情链接</h3>
	<ul>
		 <?php wp_list_bookmarks('title_li=&orderby=rand&categorize=0&limit=14'); ?>	
	</ul>
	</div>
	<div class="about">
	<h3>关于</h3>
		<p>
		<?php
			$bzd_about=get_option('bzd_about');
		?>
		<?php echo $bzd_about?>	
		</p>
		
	</div>
	<?php $bzd_count=get_option('bzd_count');?>
	<div id="copyright">
		
		<p>© Copyright 夜阑 2011-2012. All rights reserved.  Theme BZD by <a href="http://lazynight.me" target="_blank">Lazynight</a>  <?php echo $bzd_count?> |&nbsp;查询<?php echo get_num_queries(); ?> 次,页面加载 <?php timer_stop(1); ?> 秒. | <a href="http://lazynight.me/sitemap_baidu.xml">XML</a>|<a href="http://lazynight.me/sitemap.html">SiteMap</a> </p>
		 
		<div id="backtop">
		▲
		</div>
	</div>
	
</div>

<?php wp_footer(); ?>
<?php wp_footer();?>
</div>


</body>
</html>
