<?php 
/*
Plugin Name: Custom Post Type Register main
Description: custom post and texonomy registor by kmf
Version: 2.0
Author: Kazi Mohammad Foysal
Author URI: https://www.github.com/kmfoysal06
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if(!defined('ABSPATH')){
	exit;
	// exit if accessed directly
}

require_once plugin_dir_path(__FILE__)."inc/custom-post.inc.php";
require_once plugin_dir_path(__FILE__)."inc/custom-metaboxes.inc.php";
require_once plugin_dir_path(__FILE__)."inc/register-post-types-custom-metas.inc.php";
require_once plugin_dir_path(__FILE__)."inc/create_post.inc.php";