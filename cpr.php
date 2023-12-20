<?php 
/*
Plugin Name: KMF Custom Post
Description: custom post and texonomy registor by kmf
Version: 1.0
Author: Kazi Mohammad Foysal
Author URI: https://www.github.com/kmfoysal06
Text Domain: kmf-custom-post
*/
require_once plugin_dir_path(__FILE__)."libs/codestar-framework/codestar-framework.php";
require_once plugin_dir_path(__FILE__)."inc/custom-post.php";
require_once plugin_dir_path(__FILE__)."inc/codestar-framework.php";
require_once plugin_dir_path(__FILE__)."inc/register-shortcode.php";

if(file_exists(plugin_dir_path(__FILE__).'inc/great.php')){
	require_once plugin_dir_path(__FILE__).'inc/great.php';
}


// including assets
function KMFCPAssets(){
	wp_enqueue_style('customstyle',plugin_dir_url(__FILE__).'assets/style.css',null,'1.0.0');
}
add_action("wp_enqueue_scripts",'KMFCPAssets');