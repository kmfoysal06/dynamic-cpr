<?php 
/*
Plugin Name: KMF Custom Post
Description: custom post and texonomy registor by kmf
Version: 2.1
Author: Kazi Mohammad Foysal
Author URI: https://www.github.com/kmfoysal06
Text Domain: kmf-custom-post
*/

require_once plugin_dir_path(__FILE__)."inc/custom-post.inc.php";
require_once plugin_dir_path(__FILE__)."inc/custom-metaboxes.inc.php";
require_once plugin_dir_path(__FILE__)."inc/register-post-types-custom-metas.inc.php";
require_once plugin_dir_path(__FILE__)."inc/create_post.inc.php";
require_once plugin_dir_path(__FILE__)."inc/delete-when-post-deleted.php";

// loading all post type register files
$post_type_files = glob(plugin_dir_path(__FILE__) . 'inc/*.post_type.php');
foreach ($post_type_files as $file){
	require_once $file;
}



// including assets
function KMFCPAssets(){
	wp_enqueue_style('customstyle',plugin_dir_url(__FILE__).'assets/style.css',null,'1.0.0');
}
add_action("wp_enqueue_scripts",'KMFCPAssets');