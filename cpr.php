<?php 
/**
 * @package dynamic-cpr
 * Plugin Name: Dynamic CPR
 * Description: Simple and lightweight plugin for creating and managing custom post types in WordPress.
 * Version: 2.4
 * Author: Kazi Mohammad Foysal
 * Author URI: https://www.github.com/kmfoysal06
 * Tags: cpr, custom post type, dynamic
 * Requires at least: 4.7
 * Tested up to: 6.7
 * Requires PHP: 7.0
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if(!defined('ABSPATH')){
	exit;
	// exit if accessed directly
}

// enqueue script and style for admin
function kmfdcpr_enqueue_admin_scripts($hook){
    $approved_hooks = ['dynamic-cpr_page_dynamic-cpr-settings', 'toplevel_page_dynamic-cpr'];
    if(!in_array($hook, $approved_hooks)){
        return;
    }

    wp_register_style('kmfdcpr-admin-style', plugin_dir_url(__FILE__).'assets/src/css/admin.css', [], filemtime(plugin_dir_path(__FILE__).'assets/src/css/admin.css'), 'all');
    wp_register_script('kmfdcpr-admin-script', plugin_dir_url(__FILE__).'assets/src/js/admin.js', [], filemtime(plugin_dir_path(__FILE__).'assets/src/js/admin.js'), true);

    wp_enqueue_style('kmfdcpr-admin-style');
    wp_enqueue_script('kmfdcpr-admin-script');

}
add_action('admin_enqueue_scripts', 'kmfdcpr_enqueue_admin_scripts');

require_once plugin_dir_path(__FILE__)."inc/custom-post.inc.php";
require_once plugin_dir_path(__FILE__)."inc/custom-metaboxes.inc.php";
require_once plugin_dir_path(__FILE__)."inc/register-post-types-custom-metas.inc.php";
require_once plugin_dir_path(__FILE__)."inc/create_post.inc.php";
require_once plugin_dir_path(__FILE__)."inc/setup.php";
require_once plugin_dir_path(__FILE__)."inc/template-tags.php";
?>
