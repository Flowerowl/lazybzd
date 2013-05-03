<?php
//主题选项 
if(is_admin()) :
require_once ('theme-options.php');
endif;
add_theme_support('automatic-feed-links');
remove_action('wp_head', 'wp_generator');
//自定义菜单
if (function_exists('add_theme_support')) {
add_theme_support('nav-menus');
register_nav_menus( array( 'header_nav' => __( 'Header Navigation', 'BZD' ) ) );
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
set_post_thumbnail_size( 110, 110, true ); // thumbnail
}
//邮件
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回复:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复完整内容</a></p>
      <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发送，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
//缩略图
function post_thumbnail( $width = 110,$height = 110 ){ //略缩图默认大小
global $post;
if( has_post_thumbnail() ){
$timthumb_src =wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
$post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" />';
echo $post_timthumb;
} else {
$post_timthumb = '';
ob_start();
ob_end_clean();
$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content, $index_matches);
$first_img_src = $index_matches [1];
if( !empty($first_img_src) ){
$path_parts = pathinfo($first_img_src);
$first_img_name = $path_parts["basename"];
$first_img_pic = get_bloginfo('wpurl').'/cache/'.$first_img_name;
$first_img_file = ABSPATH. 'cache/'.$first_img_name; //保存地址
$expired = 604800; //略缩图过期时间
if ( !is_file($first_img_file) || (time() -filemtime($first_img_file)) > $expired ){
copy($first_img_src, $first_img_file);
$post_timthumb = '<img src="'.$first_img_src.'" alt="'.$post->post_title.'" />';
}
$post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$first_img_pic.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" />';
} else {
$post_timthumb = '<img src="'.get_bloginfo("template_url").'/images/default_thumb.gif" alt="'.$post->post_title.'" />'; //如果日志中没有图片，则显示默认，自行制作默认图片
}
echo $post_timthumb;
}
}
//三合一
function get_posts2($orderby = '', $plusmsg = '') {
    $get_posts2 = query_posts('posts_per_page=10&caller_get_posts=1&orderby='.$orderby);
    foreach ($get_posts2 as $get_post) {
            $output = '';
            $post_date = mysql2date('', $get_post->post_date);
            $commentcount = '('.$get_post->comment_count.' )';
            $post_title = htmlspecialchars(stripslashes($get_post->post_title));
            $permalink = get_permalink($get_post->ID);
            $output .= '<li><a href="' . $permalink . '" title="'.$post_title.'">' . $post_title . '</a>'.$$plusmsg.'</li>';
            echo '<ul>'.$output.'</ul>';
        }
    wp_reset_query();
}
//分页导航

function pagenavi( $p = 2 ) {

if ( is_singular() ) return;

global $wp_query, $paged;

$max_page = $wp_query->max_num_pages;

if ( $max_page == 1 ) return;

if ( empty( $paged ) ) $paged = 1;

echo '<span class="page-numbers">' . $paged . ' / ' . $max_page . ' </span> ';

if ( $paged > 1 ) p_link( $paged - 1, '<<', '<<' );

if ( $paged > $p + 1 ) p_link( 1, 'Start' );

if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';

for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {

if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );

}

if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';

if ( $paged < $max_page - $p ) p_link( $max_page, 'End' );

if ( $paged < $max_page ) p_link( $paged + 1,'>>', '>>' );

}
function p_link( $i, $title = '', $linktype = '' ) {

if ( $title == '' ) $title = " {$i} ";

if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }

echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";

}
//文章摘要

$size = 300;   

$more_link_text = '......';    

add_action('the_content', 'control_content_size');

function control_content_size($content) {

    global $size, $more_link_text;

    if (is_singular()) return $content;

    $content = strip_tags($content);

    $content = cut_str($content, $size);

    $content = '<p>' . $content . '</p><p><a href="' . get_permalink() . "\" class=\"more-link\">$more_link_text</a></p>";

    return $content;

}

function cut_str($str, $len) {

    if (!isset($str[$len])) {

    } else {

        if (seems_utf8($str[$len-1]))

            $str = substr($str, 0, $len); 

        else { 

            if(seems_utf8($str[$len-3].$str[$len-2].$str[$len-1]))

                $str = substr($str, 0, $len-3) . $str[$len-3] . $str[$len-2] . $str[$len-1];

            elseif(seems_utf8($str[$len-2].$str[$len-1].$str[$len]))

                $str = substr($str, 0, $len-2) . $str[$len-2].$str[$len-1].$str[$len];

            elseif(seems_utf8($str[$len-1].$str[$len].$str[$len+1]))

                $str = substr($str, 0, $len-1) . $str[$len-1].$str[$len].$str[$len+1];

            else 

                $str = substr($str, 0, $len);

        }

    }

    return $str;

}
//侧边栏小工具
if( function_exists('register_sidebar') ) {

	register_sidebar(array(

		'name' => '自定义侧栏',

		'before_widget' => '<div class="widget">',

		'after_widget' => '</div>',

		'before_title' => '<h3>',

		'after_title' => '</h3>'

	));

}

/*
Displays post image attachment (sizes: thumbnail, medium, full)
*/
function dp_attachment_image($postid=0, $size='thumbnail', $attributes='') {
	if ($postid<1) $postid = get_the_ID();
	if ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
		foreach($images as $image) {
			$attachment=wp_get_attachment_image_src($image->ID, $size);
			?><img src="<?php echo $attachment[0]; ?>" <?php echo $attributes; ?> class="glide-image-small"/><?php
		}
}

?>