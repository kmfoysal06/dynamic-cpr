<?php 
if(!defined('ABSPATH')){
    exit;
    // exit if accessed directly
}
add_action('init','kmfdcpr_custom_post');
function kmfdcpr_custom_post(){
	register_post_type("cpr",[
'labels' => [
	'name' => __('CPR'),
],
'public' => false,
'show_ui' => true,
'capability_type' => 'post',
'capabilities' => [ 'create_posts' => true, ],
'map_meta_cap' => true,
'menu_icon' => 'dashicons-welcome-add-page',
'supports' => ['title'],
	]);
}