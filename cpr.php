<?php 
/*
Plugin Name: Dynamic CPR
Description: Simple and lightweight plugin for creating and managing custom post types in WordPress.
Version: 2.2
Author: Kazi Mohammad Foysal
Author URI: https://www.github.com/kmfoysal06
Tags: cpr, custom post type, dynamic
Requires at least: 4.7
Tested up to: 6.4.2
Stable tag: 2.2
Requires PHP: 7.0
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
?>
