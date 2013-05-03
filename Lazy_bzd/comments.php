<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">请输入密码</p>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
<h3 id="comments"><?php comments_number('评论', '1条评论', '% 条评论' );?> </h3>
<ol class="commentlist">
<?php wp_list_comments(); ?>
</ol>

<div class="next-prev left"><?php previous_comments_link() ?></div>
<div class="next-prev right"><?php next_comments_link() ?></div>
<div class="clear"></div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments">评论已关闭.</p>
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<h3><strong><?php comment_form_title( '评论'); ?></strong></h3>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>请 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a> 后发表评论.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p>Hi, <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 感谢你的支持！ <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="登出">登出 &raquo;</a></p>

<?php else : ?>
<div class="left span-8">
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small style="color:#ff3a00;">昵称：</small></label></p>
<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small style="color:#ff3a00;">邮箱：</small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>地址：</small></label></p>
</div><div class="clear"></div>
<?php endif; ?>
<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<?php $smiley = get_option('T_smiley'); if($smiley == "On") { include (TEMPLATEPATH . '/smiley.php'); } ?>
<p><textarea name="comment" id="comment" cols="100%" rows="15" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment (Ctrl+Enter)" /></p>
<?php comment_id_fields(); ?>
</form>

<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
