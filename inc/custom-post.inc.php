<?php 
/**
 * Create a custom post type
 *
 * @package dynamic-cpr
 * @since 1.0
 */
if(!defined('ABSPATH')){
    exit;
    // exit if accessed directly
}
if(function_exists('kmfdcpr_custom_post')){
	add_action('init', 'kmfdcpr_custom_post');
}
function kmfdcpr_custom_post(){
	register_post_type("cpr",[
'labels' => [
	'name' => __('CPR'),
],
'public' => false,
'show_ui' => true,
'capability_type' => 'post',
'capabilities' => [ 'create_posts' => 'manage_options', ],
'map_meta_cap' => true,
'menu_icon' => 'dashicons-welcome-add-page',
'supports' => ['title'],
	]);
}