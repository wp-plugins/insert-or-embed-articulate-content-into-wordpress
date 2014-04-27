<?php
/*
Plugin Name: Insert or Embed Articulate Content into Wordpress
Plugin URI: http://www.articulatefreak.com/presenter/insert-or-embed-articulate-content-into-wordpress-plugin/
Description:Quickly embed or insert Articulate content into a post or page.
Version: 2.12
Author: Brian Batt
Author URI: http://www.articulatefreak.com
*/

define ( 'WP_QUIZ_EMBEDER_PLUGIN_DIR', dirname(__FILE__)); // Plugin Directory
define ( 'WP_QUIZ_EMBEDER_PLUGIN_URL', plugin_dir_url(__FILE__)); // Plugin URL (for http requests) // with forward slash (/).



require_once("functions.php");

add_shortcode( 'iframe_loader', 'iframe_handler' );

function iframe_handler($attr,$content)
{
extract($attr);
return "

<iframe src='$src'
width='$width' height='$height' frameborder='$border'></iframe>";

}


register_activation_hook(__FILE__,'quiz_embeder_install'); 


register_deactivation_hook( __FILE__, 'quiz_embeder_remove' );

function quiz_embeder_install() {

@mkdir(getUploadsPath());
@file_put_contents(getUploadsPath()."index.html","");

}
function quiz_embeder_remove() {


}


add_action( 'wp_ajax_quiz_upload', 'wp_ajax_quiz_upload' );
add_action( 'wp_ajax_del_dir', 'wp_ajax_del_dir' );
add_action( 'wp_ajax_rename_dir', 'wp_ajax_rename_dir');


function wp_myplugin_media_button() {
	$wp_myplugin_media_button_image = getPluginUrl().'quiz.png';
	echo '<a href="media-upload.php?type=upload&TB_iframe=true&tab=upload" class="thickbox">
  <img src="'.$wp_myplugin_media_button_image.'"  width=15 height=15 /></a>';
}

function media_upload_quiz_form()
{
	print_tabs();
	echo "<div style='margin-left:20px;'>";
	echo "<h2>Upload File</h2>";
	print_upload();
	echo "</div>";

}
function media_upload_quiz_content()
{
	print_tabs();
	echo "<div style='margin-left:20px;'>";
	echo "<h2>Content Library</h2>";
	
	
	printInsertForm();
	
	echo "</div>";
}
function media_upload_quiz()
{
	wp_iframe( "media_upload_quiz_content" );
}
function media_upload_upload()
{
	if($_GET['tab']=='quiz') #I added this technique because: on wordpress 3.4  'media_upload_quiz' action hook does not work.
	{
	wp_iframe( "media_upload_quiz_content" );
	}
	else
	{
	wp_iframe( "media_upload_quiz_form" );
	}
}

function print_tabs()
{

	
	function quiz_tabs($tabs) 
	{
	$newtab1 = array('quiz' => 'Content Library');
	$newtab2 = array('upload' => 'Upload File');
	return array_merge( $newtab2,$newtab1);
	}
add_filter('media_upload_tabs', 'quiz_tabs');
media_upload_header();

}


add_action('media_upload_upload','media_upload_upload');
add_action('media_upload_quiz','media_upload_quiz');
add_action( 'media_buttons', 'wp_myplugin_media_button',100);


/* added by oneTarek --*/
add_action('wp_head','quiz_embeder_wp_head');

function quiz_embeder_enqueue_script() {
	wp_enqueue_script('jquery');
}    
 
add_action('wp_enqueue_scripts', 'quiz_embeder_enqueue_script');
?>